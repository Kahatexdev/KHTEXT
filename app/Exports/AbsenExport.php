<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\{
    FromCollection,
    WithHeadings,
    WithStyles,
    WithEvents,
    WithTitle,
    ShouldAutoSize,
};
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Events\AfterSheet;
use Illuminate\Support\Facades\Http;

class AbsenExport implements FromCollection, WithHeadings, WithStyles, WithTitle, WithEvents, ShouldAutoSize
{
    protected $bulan;
    protected $tahun;
    protected $bulanNama = [1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
                           5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
                           9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'];

    public function __construct($bulan, $tahun)
    {
        $this->bulan = (int) $bulan;
        $this->tahun = $tahun;
    }

    public function collection()
    {
        $users = User::with('absen')->get();
        $data = collect();
        $no = 1;
        foreach ($users as $user) {
            // 1) Panggil API untuk dapatkan kode kartu
            $kodeKartu = '-';
            try {
                $resp = Http::timeout(5) // timeout 5 detik
                    ->get("http://172.23.44.14/HumanResourceSystem/public/api/getEmployeeByName/" . urlencode($user->name));

                if ($resp->ok()) {
                    $kodeKartu = $resp['employee_code'];
                    $shift     = strtoupper($resp['shift'] ?? '');
                    $section = strtoupper($resp['job_section_name'] ?? '');
                } else {
                    // Jika gagal, tetap gunakan placeholder '-'
                    $kodeKartu = '-';
                    $shift     = '';
                    $section   = '-';
                }
            } catch (\Exception $e) {
                // jika error, tetap gunakan placeholder '-' atau $user->kode_kartu
                $kodeKartu = '-';
                $shift     = '';
                $section   = '-';
            }

            // 2) Tentukan jam kerja berdasarkan shift
            if ($shift === 'NS') {
                $jamKerjaApi = '07.00-15.00';
            } else {
                // selain NS (misal DS, AS, dll)
                $jamKerjaApi = '06.45-14.45 & 14.15-21.45';
            }

            // 2) Persiapkan baris data
            $baris = [
                'NO'          => $no++,
                'BAGIAN'      => $section,
                'NAMA'        => $user->name,
                'KODE KARTU'  => $kodeKartu,
                'JAM KERJA'   => $jamKerjaApi
            ];

            // 3) Loop absen per tanggal
            for ($day = 1; $day <= 31; $day++) {
                $tgl = sprintf('%04d-%02d-%02d', $this->tahun, $this->bulan, $day);
                $absen = $user->absen->firstWhere('tanggal', $tgl);

                if ($absen) {
                    $ket = strtoupper($absen->keterangan ?? '');
                    $baris[$day] = ($ket === 'HADIR')
                        ? (!empty($absen->jam_masuk) ? date('H:i', strtotime($absen->jam_masuk)) : 'R')
                        : $ket;
                } else {
                    $baris[$day] = 'R';
                }
            }

            $data->push($baris);
        }

        return $data;
    }

    public function headings(): array
    {
        $head = ['NO', 'BAGIAN', 'NAMA', 'KODE KARTU', 'JAM KERJA'];
        for ($i = 1; $i <= 31; $i++) $head[] = $i;
        return $head;
    }

    public function styles(Worksheet $sheet)
    {
        return [1 => [
            'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
            'fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '4F81BD']],
            'alignment' => ['horizontal' => 'center', 'vertical' => 'center'],
        ]];
    }

    public function registerEvents(): array
    {
        return [AfterSheet::class => function (AfterSheet $event) {
            $sheet = $event->sheet->getDelegate();
            $sheet->freezePane('F2');
            $highestRow = $sheet->getHighestRow();
            $highestCol = $sheet->getHighestColumn();
            $sheet->getStyle("A1:{$highestCol}{$highestRow}")->applyFromArray([
                'borders' => ['allBorders' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN]],
                'alignment' => ['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER],
            ]);
            for ($row = 2; $row <= $highestRow; $row++) {
                $jamKerjaText = trim((string) $sheet->getCell("E{$row}")->getValue());
                $isNS = ($jamKerjaText === '07.00-15.00');
                for ($col = 6; $col <= 36; $col++) {
                    $cell = $sheet->getCellByColumnAndRow($col, $row);
                    $val = strtoupper((string) $cell->getValue());
                    $style = $sheet->getStyleByColumnAndRow($col, $row);
                    switch ($val) {
                        case '(SI)': // Blue background, darker blue text
                            $fill = 'BDD7EE';
                            $font = '1F4E79';
                            break;
                        case '(MI)': // Yellow bg, darker yellow text
                            $fill = 'FFF2CC';
                            $font = '7F6000';
                            break;
                        case '(T)':  // Green bg, darker green text
                            $fill = 'C6EFCE';
                            $font = '376F37';
                            break;
                        case '(M)': // Light red bg, dark red text
                            $fill = 'FF000B';
                            $font = '800000';
                            break;
                        case 'R':  // Pink bg, dark magenta text
                            $fill = 'FFC0CB';
                            // warna red pekat
                            $font = '800000';
                            break;
                        case '':   // Red bg, dark red text
                            $fill = 'FF0000';
                            $font = '4B0000';
                            break;
                        default:  // White bg, black text
                            $fill = 'FFFFFF';
                            $font = '000000';
                            break;
                    }
                    // 2) Cek apakah nilai cell adalah jam (HH:MM)
                    if (preg_match('/^([01]\d|2[0-3]):[0-5]\d$/', $val)) {
                        $ts = strtotime($val);

                        if ($isNS) {
                            // Shift Night (NS): pagi 07:00
                            if ($ts > strtotime('07:00')) {
                                // terlambat > 07:00 → merah pekat
                                $fill = 'FF0000';
                                $font = '000000';
                            } elseif ($ts >= strtotime('06:57')) {
                                // datang antara 06:57–07:00 → kuning pekat
                                $fill = 'FFF000';
                                $font = '000000';
                            } else {
                                continue; // on-time < 06:57, biarkan default
                            }
                        } else {
                            // Shift non-NS: ada dua window
                            if ($ts >= strtotime('14:00')) {
                                // window siang: threshold 14:13 & 14:15
                                if ($ts > strtotime('14:15')) {
                                    $fill = 'FF0000';
                                    $font = '000000';
                                } elseif ($ts >= strtotime('14:13')) {
                                    $fill = 'FFF000';
                                    $font = '000000';
                                } else {
                                    continue;
                                }
                            } else {
                                // window pagi: threshold 06:43 & 06:45
                                if ($ts > strtotime('06:45')) {
                                    $fill = 'FF0000';
                                    $font = '800000';
                                } elseif ($ts >= strtotime('06:43')) {
                                    $fill = 'FFF000';
                                    $font = '000000';
                                } else {
                                    continue;
                                }
                            }
                        }

                        // 3) Terapkan styling
                        $style
                            ->getFill()
                            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                            ->getStartColor()->setRGB($fill);

                        $style
                            ->getFont()
                            ->getColor()->setRGB($font);
                    }
                    
                    $style->getFill()->setFillType('solid')->getStartColor()->setRGB($fill);
                    $style->getFont()->getColor()->setRGB($font);
                }
            }
        }];
    }

    public function title(): string
    {
        return $this->bulanNama[$this->bulan] . ' ' . $this->tahun;
    }
}

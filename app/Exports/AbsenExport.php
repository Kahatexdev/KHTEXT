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
            $baris = ['NO' => $no++, 'BAGIAN' => $user->bagian ?? '-',
                      'NAMA' => $user->name, 'KODE KARTU' => $user->kode_kartu,
                      'JAM KERJA' => $user->jam_kerja ?? '-'];
            for ($day = 1; $day <= 31; $day++) {
                $tgl = sprintf('%04d-%02d-%02d', $this->tahun, $this->bulan, $day);
                $absen = $user->absen->firstWhere('tanggal', $tgl);
                if ($absen) {
                    $ket = strtoupper($absen->keterangan ?? '');
                    if ($ket === 'HADIR') {
                        $baris[$day] = !empty($absen->jam_masuk)
                            ? date('H:i', strtotime($absen->jam_masuk))
                            : 'R';
                    } else {
                        $baris[$day] = "{$ket}";
                    }
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
                for ($col = 6; $col <= 36; $col++) {
                    $cell = $sheet->getCellByColumnAndRow($col, $row);
                    $val = strtoupper((string) $cell->getValue());
                    $style = $sheet->getStyleByColumnAndRow($col, $row);
                    switch ($val) {
                        case '(SI)': // Blue background, darker blue text
                            $fill = 'BDD7EE'; $font = '1F4E79'; break;
                        case '(MI)': // Yellow bg, darker yellow text
                            $fill = 'FFF2CC'; $font = '7F6000'; break;
                        case '(T)':  // Green bg, darker green text
                            $fill = 'C6EFCE'; $font = '376F37'; break;
                        case '(M)': // Light red bg, dark red text
                            $fill = 'FF000B'; $font = '800000'; break;
                        case 'R':  // Pink bg, dark magenta text
                            $fill = 'FFC0CB'; $font = '8B004B'; break;
                        case '':   // Red bg, dark red text
                            $fill = 'FF0000'; $font = '4B0000'; break;
                        default:  // White bg, black text
                            $fill = 'FFFFFF'; $font = '000000'; break;
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

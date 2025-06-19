<?php

namespace App\Exports;

use App\Models\absen;
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
    protected $bulanNama = [
        1 => 'Januari',
        2 => 'Februari',
        3 => 'Maret',
        4 => 'April',
        5 => 'Mei',
        6 => 'Juni',
        7 => 'Juli',
        8 => 'Agustus',
        9 => 'September',
        10 => 'Oktober',
        11 => 'November',
        12 => 'Desember',
    ];

    public function __construct($bulan, $tahun)
    {
        $this->bulan = (int) $bulan;
        $this->tahun = $tahun;
    }

    public function collection()
    {
        $users = User::with('absen')->get(); // Pastikan ada relasi 'absens' dan kolom 'bagian', 'kode_kartu', dll

        $data = collect();
        $no = 1;

        foreach ($users as $user) {
            $baris = [
                'NO' => $no++,
                'BAGIAN' => $user->bagian ?? '-',
                'NAMA' => $user->name,
                'KODE KARTU' => $user->kode_kartu,
                'JAM KERJA' => $user->jam_kerja ?? '-',
            ];

            for ($day = 1; $day <= 31; $day++) {
                $tanggal = sprintf('%04d-%02d-%02d', $this->tahun, $this->bulan, $day);
                $absen = $user->absen->firstWhere('tanggal', $tanggal);
                $baris[$day] = $absen ? ($absen->jam_masuk ?? 'R') : 'R';
            }

            $data->push($baris);
        }

        return $data;
    }

    public function headings(): array
    {
        $head = ['NO', 'BAGIAN', 'NAMA', 'KODE KARTU', 'JAM KERJA'];
        for ($i = 1; $i <= 31; $i++) {
            $head[] = $i;
        }
        return $head;
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true], 'alignment' => ['horizontal' => 'center']],
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();

                $highestRow = $sheet->getHighestRow();
                $highestColumn = $sheet->getHighestColumn();

                for ($row = 2; $row <= $highestRow; $row++) {
                    for ($col = 6; $col <= 36; $col++) {
                        $cell = $sheet->getCellByColumnAndRow($col, $row);
                        $value = $cell->getValue();

                        $style = $sheet->getStyleByColumnAndRow($col, $row);

                        if ($value === 'R') {
                            $style->getFill()->setFillType('solid')->getStartColor()->setRGB('FFC0CB'); // Pink
                        } elseif (!$value) {
                            $style->getFill()->setFillType('solid')->getStartColor()->setRGB('FF0000'); // Merah
                        } else {
                            $style->getFill()->setFillType('solid')->getStartColor()->setRGB('FFFFFF'); // Putih
                        }
                    }
                }
            },
        ];
    }

    /**
     * Nama sheet
     */
    public function title(): string
    {
        return $this->bulanNama[$this->bulan] . ' ' . $this->tahun;
    }
}
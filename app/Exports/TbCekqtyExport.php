<?php

namespace App\Exports;

use App\Models\tb_cekqty;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithEvents;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Events\AfterSheet;

class TbCekqtyExport implements FromCollection, WithHeadings, ShouldAutoSize, WithStyles, WithEvents
{
    public function collection()
    {
        $data = tb_cekqty::select([
            'tanggal_input',
            'area',
            'qty_erp',
            'qty_timter',
            'qty_summary',
            'qty_running',
            'qty_apk',
            'qty_reject',
            'qty_rework',
            'ket_reject',
            'ket_rework',
            'ket_erp',
            'ket_timter',
            'ket_summary',
            'ket_running',
            'ket_apk',
            'shift',
            'id_user',
        ])->get();

        // Add row number as the first column
        $dataWithNo = $data->map(function ($item, $key) {
            return array_merge(
                ['No' => $key + 1],
                $item->toArray()
            );
        });

        return $dataWithNo;
    }

    public function headings(): array
    {
        return [
            [
                'REPORT DATA MESIN' // Judul besar di atas
            ],
            [   // Header kolom di baris ke-2
                'No',
                'Tanggal Input',
                'Area',
                'Qty ERP',
                'Qty Timter',
                'Qty Summary',
                'Qty Running',
                'Qty APK',
                'Qty Reject',
                'Qty Rework',
                'Keterangan Reject',
                'Keterangan Rework',
                'Keterangan ERP',
                'Keterangan Timter',
                'Keterangan Summary',
                'Keterangan Running',
                'Keterangan APK',
                'Shift',
                'ID User',
            ]
        ];
    }

    public function styles(Worksheet $sheet)
    {
        // Bold pada judul dan header
        return [
            1 => ['font' => ['bold' => true, 'size' => 14]], // Judul
            2 => ['font' => ['bold' => true]], // Header kolom
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet;

                // Merge judul dari kolom A sampai S (19 kolom)
                $sheet->mergeCells('A1:S1');
                $sheet->getStyle('A1')->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'size' => 14,
                    ],
                    'alignment' => [
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                        'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                    ],
                ]);
                // Border seluruh data (termasuk header)
                $dataRowCount = tb_cekqty::count();
                $lastRow = 2 + $dataRowCount; // Header di baris 2, data mulai baris 3
                $range = 'A2:S' . $lastRow;

                $sheet->getStyle($range)->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        ],
                    ],
                    'alignment' => [
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT,
                        'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                    ],
                ]);
            },
        ];
    }
}

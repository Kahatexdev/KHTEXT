<?php

namespace App\Exports;

use App\Models\tb_cekqty_rosset;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use Maatwebsite\Excel\Concerns\{
    FromCollection,
    WithHeadings,
    WithMapping,
    WithTitle,
    WithEvents,
    ShouldAutoSize
};
use Maatwebsite\Excel\Events\AfterSheet;
use Illuminate\Support\Str;

class CekQtyRossetExport implements FromCollection, WithHeadings, WithMapping, WithTitle, WithEvents, ShouldAutoSize
{
    protected $bagian;

    public function __construct(string $bagian)
    {
        $this->bagian = $bagian;
    }

    /**
     * Ambil data koleksi lengkap, termasuk user_id untuk relasi
     *
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return tb_cekqty_rosset::with('user')
            ->where('bagian', $this->bagian)
            ->orderBy('tanggal_input', 'desc')
            ->get();
    }

    /**
     * Mapping tiap baris menjadi array kolom export
     *
     * @param mixed $row
     * @return array
     */
    protected $rowNumber = 1;

    public function map($row): array
    {
        return [
            $this->rowNumber++,
            $row->area,
            $row->tanggal_input,
            $row->qty_erp_rosset,
            $row->qty_mis_rosset,
            $row->ket_erp_rosset,
            $row->ket_mis_rosset,
            $row->qty_reject,
            $row->qty_rework,
            $row->ket_reject,
            $row->ket_rework,
            $row->direct,
            $row->ttl_mc,
            $row->jl_mc,
            $row->ket_overshift_pagi_kesiang,
            $row->ket_overshift_siang_kepagi,
            $row->shift,
            optional($row->user)->name ?? '-',
        ];
    }

    /**
     * Judul kolom
     *
     * @return array
     */
    public function headings(): array
    {
        return [
            'No',
            'Area',
            'Tanggal Input',
            'Qty ERP Rosset',
            'Qty MIS Rosset',
            'Keterangan ERP Rosset',
            'Keterangan MIS Rosset',
            'Qty Reject',
            'Qty Rework',
            'Keterangan Reject',
            'Keterangan Rework',
            'Direct',
            'Total Mesin',
            'Jalan Mesin',
            'Keterangan Overshift Pagi ke Siang',
            'Keterangan Overshift Siang ke Pagi',
            'Shift',
            'Admin',
        ];
    }

    /**
     * Nama sheet di workbook
     */
    public function title(): string
    {
        return Str::upper("CekQty_{$this->bagian}");
    }

    /**
     * Event AfterSheet untuk menambahkan baris judul besar di atas header
     */
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();

                // 1) Insert judul
                $sheet->insertNewRowBefore(1, 1);
                $sheet->setCellValue('A1', 'LAPORAN CEK QTY - ' . strtoupper($this->bagian));
                // misal header ada di row 2, kolom A sampai M
                $sheet->mergeCells('A1:R1');
                $sheet->getStyle('A1')->applyFromArray([
                    'font' => ['bold' => true, 'size' => 14],
                    'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
                ]);

                // 2) Tentukan range header + data (misal header di row 2, data mulai row 3)
                $highestRow = $sheet->getHighestRow();        // otomatis dapat baris terakhir berisi data
                $range = "A2:R{$highestRow}";

                // 3) Terapkan border di semua sel pada range
                $sheet->getStyle($range)->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => ['argb' => '000000'],
                        ],
                    ],
                ]);

                // 4) (Opsional) Center alignment untuk header
                $sheet->getStyle("A2:R2")->applyFromArray([
                    'font' => ['bold' => true],
                    'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
                ]);
            },
        ];
    }
}

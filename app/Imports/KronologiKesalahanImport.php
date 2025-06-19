<?php
// app/Imports/KronologiKesalahanImport.php
namespace App\Imports;

use App\Models\kronologi;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class KronologiKesalahanImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new kronologi([
            'tanggal'                  => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['tanggal']),
            'wip'                      => $row['wip'],
            'area'                     => $row['area'],
            'no_model_salah'           => $row['no_model_salah'],
            'style_salah'              => $row['style_salah'],
            'label_salah'              => $row['label_salah'],
            'no_mc_salah'              => $row['no_mc_salah'],
            'krj_salah'                => $row['krj_salah'],
            'qty_salah'                => $row['qty_salah'],
            'no_model_benar'           => $row['no_model_benar'],
            'style_benar'              => $row['style_benar'],
            'label_benar'              => $row['label_benar'],
            'no_mc_benar'              => $row['no_mc_benar'],
            'krj_benar'                => $row['krj_benar'],
            'qty_benar'                => $row['qty_benar'],
            'kategori'                 => $row['kategori'],
            'keterangan'               => $row['keterangan'],
            'keterangan_maintenance'   => $row['keterangan_maintenance'],
            'username'                 => $row['username'],
        ]);
    }
}

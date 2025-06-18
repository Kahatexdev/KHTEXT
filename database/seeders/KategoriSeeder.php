<?php

namespace Database\Seeders;

use App\Models\kategori_kronologi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = now();
        $data = [
            ['id_kategori' => 1,  'nama_kategori' => 'Salah Tanggal',             'ket_kategori' => null],
            ['id_kategori' => 2,  'nama_kategori' => 'Salah Jc / Style',           'ket_kategori' => null],
            ['id_kategori' => 3,  'nama_kategori' => 'Salah Ukuran / Size',       'ket_kategori' => null],
            ['id_kategori' => 4,  'nama_kategori' => 'Salah Qty',                  'ket_kategori' => null],
            ['id_kategori' => 5,  'nama_kategori' => 'Salah Order',                'ket_kategori' => null],
            ['id_kategori' => 6,  'nama_kategori' => 'Salah Model / Pdk',         'ket_kategori' => null],
            ['id_kategori' => 7,  'nama_kategori' => 'Salah Label',                'ket_kategori' => null],
            ['id_kategori' => 8,  'nama_kategori' => 'Salah Box',                  'ket_kategori' => null],
            ['id_kategori' => 9,  'nama_kategori' => 'Salah Inisial',              'ket_kategori' => null],
            ['id_kategori' => 10, 'nama_kategori' => 'Salah No MC',               'ket_kategori' => null],
            ['id_kategori' => 11, 'nama_kategori' => 'Salah Area',                'ket_kategori' => null],
            ['id_kategori' => 12, 'nama_kategori' => 'Salah Shift',               'ket_kategori' => null],
            ['id_kategori' => 13, 'nama_kategori' => 'Salah Storage',             'ket_kategori' => null],
            ['id_kategori' => 14, 'nama_kategori' => 'Salah Kode Kartu',         'ket_kategori' => null],
            ['id_kategori' => 15, 'nama_kategori' => 'Salah No Palet',            'ket_kategori' => null],
            ['id_kategori' => 16, 'nama_kategori' => 'Salah No LOT',              'ket_kategori' => null],
            ['id_kategori' => 17, 'nama_kategori' => 'Ganti / Salah Barcode',     'ket_kategori' => null],
            ['id_kategori' => 18, 'nama_kategori' => 'Double Input',              'ket_kategori' => null],
            ['id_kategori' => 19, 'nama_kategori' => 'Cancel Order',              'ket_kategori' => null],
            ['id_kategori' => 20, 'nama_kategori' => 'Kesalahan System',          'ket_kategori' => null],
            ['id_kategori' => 21, 'nama_kategori' => 'Data Belum Lengkap',        'ket_kategori' => null],
            ['id_kategori' => 22, 'nama_kategori' => 'Salah kode defect',         'ket_kategori' => null],
            ['id_kategori' => 23, 'nama_kategori' => 'Kode defect tidak diisi',  'ket_kategori' => null],
        ];

        kategori_kronologi::insert(array_map(function ($item) use ($now) {
            return array_merge($item, [
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }, $data));
        
    }
}

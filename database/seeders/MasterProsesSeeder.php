<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\master_proses;

class MasterProsesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $storages = [
            'KK1A',
            'KK1B',
            'KK2A',
            'KK2B',
            'KK2C',
            'KK5G',
            'KK7K',
            'KK7L',
            'KK8D',
            'KK8F',
            'KK8J',
            'KK9D',
            'KK10E',
            'KK11M',
            'RS01',
            'RS02',
            'RS05',
            'RS07',
            'RS08',
            'RS11',
            'ST01',
            'ST02',
            'ST05',
            'ST07',
            'ST08',
            'ST11',
            'GS01',
            'GS02',
            'GS05',
            'GS07',
            'GS08',
            'GS11',
            'PCK_1',
            'PCK_2',
            'PCK_5',
            'PCK_7',
            'PCK_8',
            'PCK_11',
            'PCK_STC',
            'PCK_STK',
            'QAD01',
            'SPOKA11',
            'TEMP',
            'PC_01',
            'PC_07',
            'QC01',
            'QC02',
            'QC07',
            'QC11',
            '07',
            'WL01',
            'STK01',
            'APL001',
            'HNP01',
            'OB01',
            'LK01',
            'FOT01',
            'LP01',
            'SON_01',
            'SW01',
            'PA01',
            'PB01',
            'PA02',
            'PB02',
            'PC02',
            'PG05',
            'PK07',
            'PL_07',
            'PD08',
            'PF08',
            'PJ08',
            'PD09',
            'PE10',
            'PM11',
            'PR01',
            'PR02',
            'PR05',
            'PR07',
            'PR08',
            'PR011',
            'PHP01',
            'PO01',
            'PL01',
            'PLP01',
            'STOCKLOT1',
        ];

        foreach ($storages as $storage) {
            master_proses::create([
                'nama_proses' => $storage,
            ]);
        }
    }
}

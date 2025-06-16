<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\CapacityService;
use App\Models\tb_pdk; // Pastikan model Pdk sudah ada

class SyncApsPerStyle extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tls:sync-aps';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sinkronisasi APS per style dari Capacity ke TLS DB';

    /**
     * Execute the console command.
     */
    public function handle(CapacityService $capacity)
    {
        $data = $capacity->getApsPerStyle();

        foreach ($data as $item) {
            tb_pdk::updateOrCreate(
                [
                    'mastermodel' => $item['mastermodel'],
                    'factory'     => $item['factory'],
                ],
                [
                    'size'    => $item['size'],
                    'inisial' => $item['inisial'],
                ]
            );
        }

        $this->info('Sinkronisasi selesai. Total: ' . count($data) . ' record.');
    }
}

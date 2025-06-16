<?php

namespace App\Imports;

use App\Models\main_flowproses;
use App\Models\flow_proses;
use App\Models\master_proses;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\ToModel;

class FlowProsesImport implements ToCollection, WithHeadingRow
{
    /** @var string */
    protected $importDate;

    /**
     * Koleksi data APS per style dari Capacity (satu kali fetch)
     *
     * @var array<int,array<string,mixed>>
     */
    protected $capacityStyles = [];

    public function __construct(string $importDate)
    {
        $this->importDate = $importDate;
        // Panggil endpoint Capacity sekali saja
        $resp = Http::get(config('services.capacity.base_url') . '/getApsPerStyle');
        $this->capacityStyles = $resp->successful()
            ? $resp->json('data', [])
            : [];
            // dd ($this->capacityStyles);
    }

    /**
     * @param  Collection<int,\Illuminate\Support\Collection<string,mixed>>  $rows
     */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            // cari record di $capacityStyles yang matching semua kolom
            $match = collect($this->capacityStyles)
                ->first(function ($style) use ($row) {
                    return $style['mastermodel'] === $row['no_model']
                        && $style['factory']     === $row['area']
                        && $style['size']        === $row['jc']
                        && $style['inisial']     === $row['inisial'];
                });
                // dd ($match);
            if (! $match) {
                // Kalau gak ketemu, skip atau throw exception
                // bisa juga log: \Log::warning("APS style not found for row", $row->toArray());
                continue;
            }

            // dapatkan idapsperstyle
            $apsStyleId = $match['idapsperstyle'];
            // dd ($apsStyleId);
            // 1) firstOrCreate Flow (header)
            $flow = main_flowproses::firstOrCreate([
                'idapsperstyle' => $apsStyleId,
                'tanggal'      => $this->importDate,
                'area'         => $row['area'],
                'id_user'      => auth()->id(),
            ]);

            // 2) Loop kolom proses_1 .. proses_15 (atau sesuaikan)
            for ($i = 1; $i <= 15; $i++) {
                $col = 'proses_' . $i;
                if (! empty($row[$col])) {
                    // Cari atau buat master process
                    $mp = master_proses::firstOrCreate([
                        'nama_proses' => $row[$col],
                    ]);

                    flow_proses::create([
                        'id_main_flow'           => $flow->id_main_flow,
                        'id_master_proses' => $mp->id_master_proses,
                        'step_order'        => $i,
                    ]);
                }
            }
        }
    }
}

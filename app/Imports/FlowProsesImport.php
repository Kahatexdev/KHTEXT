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
use Illuminate\Support\Facades\Log;

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
            // Ambil dan bersihkan nilai kolom
            $noModel = trim($row['no_model']);
            $area    = trim($row['area']);
            $inisial = trim($row['inisial'] ?? '');
            $rawJc   = trim($row['jc']);
            // dd ($row->toArray(), $noModel, $area, $inisial, $rawJc);

            $params = [
                'mastermodel' => $noModel,
                'size'        => $row['jc'],
                'factory'        => $area,
            ];
            // 1) Siapkan URL endpoint sesuai route di CodeIgniter
            $base     = rtrim(config('services.capacity.base_url'), '/');
            // Ganti '/api/getApsPerStyle' jika route Anda berbeda (misal '/getApsPerStyle')
            $endpoint = $base . '/getApsPerStyles';
            // dd ($endpoint, $params);
            $resp = Http::get($endpoint, $params);
            // dd ($resp->status(), $resp->body());
            if (! $resp->successful()) {
                Log::warning("Gagal fetch APS untuk {$noModel}/{$area}/{$rawJc}", [
                    'status' => $resp->status(),
                    'body'   => $resp->body(),
                ]);
                continue;
            }

            // 3) Ambil data dan cari match jika perlu
            $data = $resp->json();
            // dd ($data);
            $match = is_array($data)
                ? collect($data)->first(fn($item) => $inisial === '' || (($item['inisial'] ?? '') === $inisial))
                : $data;

           

            $apsStyleId = $match['idapsperstyle'];
            // dd ($apsStyleId);
            // 4) Buat atau ambil header main_flowproses
            $flow = main_flowproses::firstOrCreate([
                'idapsperstyle' => $apsStyleId,
                'tanggal'       => $this->importDate,
                'area'          => $area,
                'id_user'       => auth()->id(),
            ]);

            // (Optional) Hapus proses lama jika perlu reset
            // flow_proses::where('id_main_flow', $flow->id_main_flow)->delete();

            // 5) Simpan proses langkah demi langkah
            for ($i = 1; $i <= 15; $i++) {
                $col  = 'proses_' . $i;
                $nama = trim($row[$col] ?? '');
                if ($nama === '') {
                    continue;
                }

                $mp = master_proses::firstOrCreate(['nama_proses' => $nama]);

                flow_proses::create([
                    'id_main_flow'     => $flow->id_main_flow,
                    'id_master_proses' => $mp->id_master_proses,
                    'step_order'       => $i,
                ]);
            }
        }
    }
}

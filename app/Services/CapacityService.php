<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\RequestException;


class CapacityService
{
    protected $baseUrl;
    protected $apiKey;

    public function __construct()
    {
        $this->baseUrl = config('services.capacity.base_url');
        $this->apiKey  = config('services.capacity.key');
    }

    /**
     * Ambil data APS per style dari CAPACITY berdasarkan model, size, dan area.
     *
     * @param  string  $noModel   Nomor model (mastermodel)
     * @param  string  $size      Ukuran style
     * @param  string  $area      Area/factory
     * @return array              Array data APS style yang match, atau [] jika gagal
     * @throws \Illuminate\Http\Client\RequestException
     */
    public function getApsPerStyle(string $noModel, string $size, string $area): array
    {
        // Build URL dengan query parameters
        $url = $this->baseUrl . '/getApsPerStyle';

        $response = Http::withHeaders([
            // 'API-KEY' => $this->apiKey, // uncomment jika perlu
        ])->timeout(10)    // timeout 10 detik
            ->get($url, [
                'no_model' => $noModel,
                'size'     => $size ?? null,
                'area'     => $area ?? null,
            ]);

        // Jika status bukan 2xx, lempar exception
        $response->throw();
        // Ambil data key `data` atau kembalikan array kosong
        return $response->json('data', []);
    }

    /**
     * Ambil data APS per style berdasarkan idapsperstyle dari API.
     *
     * @param  string  $idapsperstyle  ID APS per style
     * @return array                   Data APS per style atau [] jika gagal
     * @throws \Illuminate\Http\Client\RequestException
     */
    public function getApsPerStyleById(string $id): array
    {
        // Masukkan ID ke segment URL
        $url = "{$this->baseUrl}/getApsPerStyleById/{$id}";
        // dd ($url);
        try {
            $response = Http::withHeaders([
                // 'API-KEY' => $this->apiKey
            ])->timeout(10)
                ->get($url)
                ->throw();

            return $response->json();
        } catch (\Illuminate\Http\Client\RequestException $e) {
            \Log::error("CapacityService@getApsPerStyleById({$id}) → " . $e->getMessage());
            return [];
        }
    }


    /**
     * Ambil data APS per style berdasarkan beberapa idapsperstyle.
     *
     * @param  array<string>  $ids  Daftar ID APS per style
     * @return array<int,array<string,mixed>>  Array data APS per style yang ditemukan
     */
    // Method ini akan mengumpulkan data APS per style berdasarkan beberapa ID
    // dan mengembalikannya sebagai array.

    public function getApsPerStyleByIds(array $ids): array
    {
        $results = [];
        foreach (array_unique($ids) as $id) {
            $one = $this->getApsPerStyleById($id);
            // Jika API mengembalikan [ 0 => [ …fields… ] ], unwrap ke dalam satu dimensi
            if (! empty($one) && isset($one[0]) && is_array($one[0])) {
                $results[] = $one[0];
            }
        }
        return $results;
    }
}

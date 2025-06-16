<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

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
     * Ambil data APS per style dari CAPACITY
     */
    public function getApsPerStyle(): array
    {
        $response = Http::withHeaders([
            // 'API-KEY' => $this->apiKey, // aktifkan jika perlu
        ])
            ->get($this->baseUrl . '/getApsPerStyle');
        if ($response->successful()) {
            return $response->json('data', []);
        }

        // Bisa lempar exception atau kembalikan array kosong
        return [];
    }
}

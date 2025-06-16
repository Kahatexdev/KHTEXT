<?php

namespace App\Http\Controllers;

use App\Models\master_proses;
use App\Imports\FlowProsesImport;
use App\Models\main_flowproses;
use Illuminate\Http\Request;
use App\Services\CapacityService;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\FromCollection;
class FlowProsesController extends Controller
{
    public function index(CapacityService $capacity)
    {
        // 1) Ambil semua main flows + relasi detail proses + nama proses master
        $flows = main_flowproses::with('flowProses.masterProses')
            ->orderBy('tanggal', 'desc')
            ->get();

        // 2) Ambil daftar APS styles dari API, jadikan keyed-by idapsperstyle
        $stylesRaw = $capacity->getApsPerStyle();
        $styles = collect($stylesRaw)
            ->keyBy('idapsperstyle')
            ->toArray();

        // 3) Kirim ke view
        return view('monitoring.flowproses.index', compact('flows', 'styles'));
    }

    public function import(Request $request)
    {
        $data = $request->validate([
            'import_date' => 'required|date',
            'file_attachment' => 'required|file|mimes:xlsx,xls,csv',
        ]);
        // dd ($data);
        // Jalankan import, pass tanggal ke Import class
        Excel::import(new FlowProsesImport($data['import_date']), $data['file_attachment']);
        return redirect()
            ->route('flowproses.index')
            ->with('success', 'Data flow proses berhasil di‐import!');
    }
}

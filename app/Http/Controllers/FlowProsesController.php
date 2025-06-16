<?php

namespace App\Http\Controllers;

use App\Models\master_proses;
use App\Imports\FlowProsesImport;
use App\Models\main_flowproses;
use App\Models\flow_proses;
use App\Models\User;
use Illuminate\Http\Request;
use App\Services\CapacityService;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\FromCollection;
class FlowProsesController extends Controller
{
    public function index(CapacityService $capacity)
    {
        $flows = main_flowproses::with('flowProses.masterProses')
            ->orderBy('tanggal', 'desc')
            ->get();

        $ids = $flows->pluck('idapsperstyle')->unique()->toArray();
        $stylesArray = $capacity->getApsPerStyleByIds($ids);

        // Flatten:
        $flat = [];
        foreach ($stylesArray as $item) {
            // setiap $item adalah array[0 => [ … ]], atau array[…fields…]
            $record = isset($item[0]) ? $item[0] : $item;
            $flat[] = $record;
        }

        // Key by idapsperstyle
        $styles = collect($flat)
            ->keyBy('idapsperstyle')
            ->toArray();

        // Lampirkan style ke tiap flow
        foreach ($flows as $flow) {
            $flow->style = $styles[$flow->idapsperstyle] ?? null;
        }

        $masterProses = master_proses::orderBy('nama_proses')->get();
        return view('monitoring.flowproses.index', compact('flows', 'styles', 'masterProses'));
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
    public function create()
    {
        // Method ini bisa digunakan untuk menampilkan form tambah data flow proses
        return view('monitoring.flowproses.create');
    }
    public function store(Request $request)
    {
        // Method ini bisa digunakan untuk menyimpan data flow proses baru
        // Validasi dan simpan data sesuai kebutuhan
        $data = $request->validate([
            'tanggal' => 'required|date',
            'nama_proses' => 'required|string|max:255',
            // Tambahkan validasi lain sesuai kebutuhan
        ]);

        main_flowproses::create($data);
        return redirect()
            ->route('flowproses.index')
            ->with('success', 'Flow proses berhasil ditambahkan!');
    }

    public function edit(int $id, CapacityService $capacity)
    {
        // 1) Ambil header (main_flowproses) beserta semua detail (flowProses)
        $mainFlowproses = main_flowproses::with('flowProses')
            ->findOrFail($id);

        // 2) Panggil API Capacity untuk detail style
        $styleData = $capacity->getApsPerStyleById($mainFlowproses->idapsperstyle);
        // ambil elemen pertama jika API mengembalikan array di dalam array
        $style = $styleData[0] ?? [];

        // 3) Ambil daftar master proses untuk dropdown pada setiap detail
        $masterProses = master_proses::orderBy('nama_proses')->get();

        // 4) Kirim ke view
        return view('monitoring.flowproses.edit', compact(
            'mainFlowproses',
            'style',
            'masterProses'
        ));
    }

    public function update(Request $request, int $id)
    {
        // dd ($request->all());
        // 1) Validasi struktur detail array
        $data = $request->validate([
            'detail'                       => 'required|array',
            'detail.*.id'                  => 'required|integer|exists:flow_proses,id_flow_proses',
            'detail.*.step_order'          => 'required|integer|min:1',
            'detail.*.id_master_proses' => 'required|integer|exists:master_proses,id_master_proses',
        ]);
        // dd ($data);
        // 2) Loop dan update tiap record flow_proses
        foreach ($data['detail'] as $item) {
            \App\Models\flow_proses::where('id_flow_proses', $item['id'])
                ->update([
                    'step_order'       => $item['step_order'],
                    'id_master_proses' => $item['id_master_proses'],
                ]);
        }

        // 3) Redirect kembali dengan success message
        return redirect()
            ->route('flowproses.index')
            ->with('success', 'Detail flow proses berhasil diperbarui!');
    }

    public function destroy(main_flowproses $main_flowproses)
    {
        // (opsional) hapus detail dulu
        $main_flowproses->flowProses()->delete();
        // kemudian hapus header
        $main_flowproses->delete();

        return redirect()
            ->route('flowproses.index')
            ->with('success', 'Flow proses berhasil dihapus!');
    }
}

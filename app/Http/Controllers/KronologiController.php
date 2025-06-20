<?php

namespace App\Http\Controllers;

use App\Models\kategori_kronologi;
use App\Models\kronologi;
use App\Services\CapacityService;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\KronologiKesalahanImport;
use PDF;

class KronologiController extends Controller
{

    /**
     * Display the kronologi page.
     */
    public function index(CapacityService $capacityService)
    {
        $role = auth()->user()->role;
        $kategoriKronologi = kategori_kronologi::select('id_kategori', 'nama_kategori')
            ->orderBy('nama_kategori', 'asc')
            ->get();
        $kronologi = kronologi::all();
        // get all capacity service distict
        return view('monitoring.kronologi.index',compact('kategoriKronologi', 'kronologi'));
    }

    /**
     * Show the form for creating a new kronologi entry.
     */
    public function create()
    {
        return view('kronologi.create');
    }

    /**
     * Store a newly created kronologi entry in storage.
     */
    public function store(Request $request)
    {
        // Validate and store the kronologi entry logic here
        return redirect()->route('kronologi.index')->with('success', 'Kronologi entry created successfully.');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv',
        ]);
        // DD ($request->file('file'));
        Excel::import(new KronologiKesalahanImport, $request->file('file'));

        return redirect()->back()->with('success', 'Data berhasil diimport!');
    }

    public function edit($id)
    {
        $kronologi = kronologi::findOrFail($id);
        return response()->json([
            'status' => 'success',
            'data' => $kronologi,
        ]);
    }

    public function update(Request $request, $id)
    {
        // dd ($request->all());
        $request->validate([
            'tanggal' => 'required|date',
            'wip' => 'required|string',
            'area' => 'required|string',
            'no_model_salah' => 'required|string',
            'style_salah' => 'required|string',
            'label_salah' => 'required|string',
            'no_mc_salah' => 'required|string',
            'krj_salah' => 'required|string',
            'qty_salah' => 'required|integer',
            'no_model_benar' => 'required|string',
            'style_benar' => 'required|string',
            'label_benar' => 'required|string',
            'no_mc_benar' => 'required|string',
            'krj_benar' => 'required|string',
            'qty_benar' => 'required|integer',
            'kategori' => 'required',
            'keterangan' => 'required|string',
            'keterangan_maintenance' => 'nullable|string',
            'username' => 'required|string',
        ]);
        $kronologi = kronologi::findOrFail($id);
        $kronologi->update([
            'tanggal' => $request->tanggal,
            'wip' => $request->wip,
            'area' => $request->area,
            'no_model_salah' => $request->no_model_salah,
            'style_salah' => $request->style_salah,
            'label_salah' => $request->label_salah,
            'no_mc_salah' => $request->no_mc_salah,
            'krj_salah' => $request->krj_salah,
            'qty_salah' => $request->qty_salah,
            'no_model_benar' => $request->no_model_benar,
            'style_benar' => $request->style_benar,
            'label_benar' => $request->label_benar,
            'no_mc_benar' => $request->no_mc_benar,
            'krj_benar' => $request->krj_benar,
            'qty_benar' => $request->qty_benar,
            'kategori' => $request->kategori,
            'keterangan' => $request->keterangan,
            'keterangan_maintenance' => $request->keterangan_maintenance ?? '',
            'username' => $request->username,
        ]);
        return redirect()->route('kronologi.index')->with('success', 'Kronologi entry updated successfully.');
        
    }

    public function destroy($id)
    {
        $kronologi = kronologi::findOrFail($id);
        $kronologi->delete();
        return redirect()->route('kronologi.index')->with('success', 'Kronologi entry deleted successfully.');
    }

    public function exportPdf(Request $request)
    {
        // Validasi input tanggal
        $request->validate([
            'from' => 'required|date',
            'to'   => 'required|date|after_or_equal:from',
        ]);

        $from = $request->input('from');
        $to   = $request->input('to');

        // Query dengan whereBetween
        $items = kronologi::whereBetween('tanggal', [$from, $to])
            ->orderBy('tanggal')
            ->get();

        // Load view, kirim juga rentang tanggal
        $pdf = PDF::loadView('monitoring.kronologi.pdf', compact('items', 'from', 'to'))
            ->setPaper('a4', 'landscape')
            ->setOption('margin-top', '10mm')
            ->setOption('margin-bottom', '10mm');

        return $pdf->download("kronologi_{$from}_to_{$to}.pdf");
    }
}

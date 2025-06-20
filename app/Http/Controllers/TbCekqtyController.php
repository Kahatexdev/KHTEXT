<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\tb_cekqty;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\TbCekqtyExport;
use App\Models\input_erp;

class TbCekqtyController extends Controller
{
    public function index()
    {
        $records = tb_cekqty::orderBy('tanggal_input', 'desc')->get();

        return view('bagian.report.tabel-mesin', compact('records'));
    }

    public function create()
    {
        return view('bagian.mesin');
    }

    // Simpan data ke database
    public function store(Request $request)
    {
        $idUser = Auth::user()->id;
        $validated = $request->validate([
            'tanggal_input' => 'required|date',
            'area'          => 'required|string|max:100',
            'qty_erp'       => 'nullable|numeric',
            'qty_timter'    => 'nullable|numeric',
            'qty_summary'   => 'nullable|numeric',
            'qty_running'   => 'nullable|numeric',
            'qty_apk'       => 'nullable|numeric',
            'qty_reject'    => 'nullable|numeric',
            'qty_rework'    => 'nullable|numeric',
            'ket_reject'    => 'nullable|string|max:255',
            'ket_rework'    => 'nullable|string|max:255',
            'ket_erp'       => 'nullable|string|max:255',
            'ket_timter'    => 'nullable|string|max:255',
            'ket_summary'   => 'nullable|string|max:255',
            'ket_running'   => 'nullable|string|max:255',
            'ket_apk'       => 'nullable|string|max:255',
            'shift'         => 'required|string|max:10',
        ]);
        $validated['id_user'] = $idUser;
        tb_cekqty::create($validated);

        return redirect()->route('mesin.index')->with('success', 'Data berhasil disimpan!');
    }

    public function exportExcel()
    {
        return Excel::download(new TbCekqtyExport, 'data-cekqty.xlsx');
    }

    public function inputErp()
    {
        $records = input_erp::orderBy('tanggal_input', 'desc')->get();

        return view('bagian.report.tabel-input-erp', compact('records'));
    }
    public function createInputErp()
    {
        return view('bagian.input-erp');
    }

    public function storeErp(Request $request)
    {
        $idUser = Auth::user()->id;
        $validated = $request->validate([
            'tanggal_input' => 'required|date',
            'area'          => 'required|string|max:100',
            'shift'         => 'required|string|max:10',
            'start_input'   => 'nullable',
            'stop_input'    => 'nullable',
            'ttl_mc'        => 'nullable|integer',
            'jln_mc'        => 'nullable|integer',
            'prod_erp'      => 'nullable|numeric',
            'ket'           => 'nullable|string|max:255',
        ]);
        $validated['id_user'] = $idUser;
        input_erp::create($validated);

        return redirect()->route('mesin.inputErp')->with('success', 'Data berhasil disimpan!');
    }
}

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

    public function edit(int $id)
    {
        $item = tb_cekqty::findOrFail($id);

        return view('bagian.mesin', [
            'item'    => $item,
        ]);
    }

    public function update(Request $request, int $id)
    {
        // Validasi input
        $validated = $request->validate([
            'tanggal_input' => 'required|date',
            'area'          => 'required|string|max:100',
            'qty_erp'       => 'numeric',
            'qty_timter'    => 'numeric',
            'qty_summary'   => 'numeric',
            'qty_running'   => 'numeric',
            'qty_apk'       => 'numeric',
            'qty_reject'    => 'numeric',
            'qty_rework'    => 'numeric',
            'ket_reject'    => 'string|max:255',
            'ket_rework'    => 'string|max:255',
            'ket_erp'       => 'string|max:255',
            'ket_timter'    => 'string|max:255',
            'ket_summary'   => 'string|max:255',
            'ket_running'   => 'string|max:255',
            'ket_apk'       => 'string|max:255',
            'shift'         => 'required|string|max:10',
        ]);
        // dd ($validated);
        // Update data berdasarkan PK
        tb_cekqty::where('id_cekqty', $id)->update([
            'tanggal_input' => $validated['tanggal_input'],
            'area'          => $validated['area'],
            'qty_erp'       => $validated['qty_erp'],
            'qty_timter'    => $validated['qty_timter'],
            'qty_summary'   => $validated['qty_summary'],
            'qty_running'   => $validated['qty_running'] ?? '',
            'qty_apk'       => $validated['qty_apk'] ?? '',
            'qty_reject'    => $validated['qty_reject'] ?? '',
            'qty_rework'    => $validated['qty_rework' ?? ''],
            'ket_reject'    => $validated['ket_reject'] ?? '',
            'ket_rework'    => $validated['ket_rework'] ?? '',
            'ket_erp'       => $validated['ket_erp'] ?? '',
            'ket_timter'    => $validated['ket_timter'] ?? '',
            'ket_summary'   => $validated['ket_summary'] ?? '',
            'ket_running'   => $validated['ket_running'] ?? '',
            'ket_apk'       => $validated['ket_apk'] ?? '',
            'shift'         => $validated['shift'] ?? '',
        ]);

        return redirect()->route('mesin.index')->with('success', 'Data berhasil diupdate!');
    }

    public function destroy($id)
    {
        tb_cekqty::destroy($id);
        return redirect()->back()->with('success', 'User dihapus');
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

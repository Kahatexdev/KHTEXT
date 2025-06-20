<?php

namespace App\Http\Controllers;

use App\Models\input_erp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InputErpController extends Controller
{
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

    public function editErp($id)
    {
        $item = input_erp::findOrFail($id);

        return view('bagian.input-erp', [
            'item'    => $item,
        ]);
    }

    public function updateErp(Request $request, int $id)
    {
        // Validasi input
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
        // Update data berdasarkan PK
        input_erp::where('id_input', $id)->update([
            'tanggal_input' => $validated['tanggal_input'],
            'area'          => $validated['area'],
            'shift'         => $validated['shift'],
            'start_input'   => $validated['start_input'],
            'stop_input'    => $validated['stop_input'],
            'ttl_mc'        => $validated['ttl_mc'],
            'jln_mc'        => $validated['jln_mc'],
            'prod_erp'      => $validated['prod_erp'],
            'ket'           => $validated['ket'],
        ]);

        return redirect()->route('mesin.inputErp')->with('success', 'Data berhasil diupdate!');
    }

    public function destroy($id)
    {
        input_erp::destroy($id);
        return redirect()->back()->with('success', 'Data dihapus');
    }
}

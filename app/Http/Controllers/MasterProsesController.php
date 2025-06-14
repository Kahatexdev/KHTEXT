<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\master_proses;

class MasterProsesController extends Controller
{
    public function index()
    {
        $role = auth()->user()->role;
        $masterProses = master_proses::all(); // <- tambahkan ini biar data muncul
        return view($role . '.masterproses.index', compact('masterProses'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'nama_proses' => 'required|string|max:255',
        ]);

        master_proses::create([
            'nama_proses' => $request->nama_proses,
        ]);

        return redirect()->route('masterproses.index')->with('success', 'Data berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_proses' => 'required|string|max:255',
        ]);

        $proses = master_proses::findOrFail($id);
        $proses->update([
            'nama_proses' => $request->nama_proses,
        ]);

        return redirect()->route('masterproses.index')->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy($id)
    {
        master_proses::destroy($id);
        return redirect()->route('masterproses.index')->with('success', 'Data berhasil dihapus.');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\kategori_kronologi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class KategoriKronologiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = kategori_kronologi::orderBy('created_at', 'desc')->paginate(10);
        return view('monitoring.kategori_kronologi.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('monitoring.kategori_kronologi.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_kategori' => 'required|string|max:100',
            'ket_kategori' => 'required|string',
        ]);

        kategori_kronologi::create($validated);

        return redirect()->route('kategori_kronologi.index')
            ->with('success', 'Kategori berhasil dibuat.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(kategori_kronologi $kategoriKronologi)
    {
        return response()->json($kategoriKronologi);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, kategori_kronologi $kategoriKronologi)
    {
        $validated = $request->validate([
            'nama_kategori' => 'required|string|max:100',
            'ket_kategori' => 'required|string',
        ]);

        $kategoriKronologi->update($validated);

        return redirect()->route('kategori_kronologi.index')
            ->with('success', 'Kategori berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(kategori_kronologi $kategoriKronologi)
    {
        $kategoriKronologi->delete();

        return redirect()->route('kategori_kronologi.index')
            ->with('success', 'Kategori berhasil dihapus.');
    }
}

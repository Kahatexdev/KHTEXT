<?php

namespace App\Http\Controllers;
use App\Models\area;

use Illuminate\Http\Request;

class AreaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = area::orderBy('nama_area', 'asc')->paginate(10);
        return view('monitoring.area.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('monitoring.area.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_area' => 'required|string|max:100',
        ]);

        $a= area::create($validated);
        
        return redirect()->route('area.index')
            ->with('success', 'Area berhasil dibuat.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(area $area)
    {
        return response()->json($area);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, area $area)
    {
        $validated = $request->validate([
            'nama_area' => 'required|string|max:100',
        ]);

        $area->update($validated);

        return redirect()->route('area.index')
            ->with('success', 'Area berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(area $area)
    {
        $area->delete();
        return redirect()->route('area.index')
            ->with('success', 'Area berhasil dihapus.');
    }
}

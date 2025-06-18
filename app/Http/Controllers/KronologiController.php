<?php

namespace App\Http\Controllers;

use App\Models\kategori_kronologi;
use App\Models\kronologi;
use App\Services\CapacityService;
use Illuminate\Http\Request;

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
        return view($role.'.kronologi.index',compact('kategoriKronologi', 'kronologi'));
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
}

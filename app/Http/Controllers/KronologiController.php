<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KronologiController extends Controller
{

    /**
     * Display the kronologi page.
     */
    public function index()
    {
        $role = auth()->user()->role;
        return view($role.'.kronologi.index');
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

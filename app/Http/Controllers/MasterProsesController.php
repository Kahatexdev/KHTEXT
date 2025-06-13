<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MasterProsesController extends Controller
{
    public function index()
    {
        $role = auth()->user()->role;
        return view($role . '.masterproses.index');
    }
}

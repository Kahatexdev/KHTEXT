<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TbCekqtyRossetController extends Controller
{
    protected $role, $bagianArea;

    public function __construct()
    {
        $this->middleware(function ($req, $next) {
            $user = auth()->user();
            $this->role       = $user->role;
            $this->bagianArea = $user->bagian_area;
            return $next($req);
        });
    }

    public function loadByBagian(string $bagian)
    {
        if ($this->role === 'monitoring') {
            return view("monitoring.bagian.$bagian");
        }

        if ($this->role === 'user' && $this->bagianArea === $bagian) {
            return view("user.bagian.$bagian");
        }

        abort(403, 'Akses hanya untuk bagian: ' . $this->bagianArea);
    }
}

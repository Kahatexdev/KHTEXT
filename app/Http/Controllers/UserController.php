<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    protected $role;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->role = Auth::user()->role;
            return $next($request);
        });
    }

    public function indexMonitoring()
    {
        return view('monitoring.dashboard');
    }

    public function indexUser()
    {
        return view('user.dashboard');
    }

    public function index()
    {
        $role = auth()->user()->role;
        $users = User::all();
        return view($role . '.users.index', compact('users', 'role'));
    }

    public function store(Request $request)
    {
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'bagian_area' => $request->bagian_area,
            'role' => $request->role,
        ]);
        return redirect()->back()->with('success', 'User ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'bagian_area' => $request->bagian_area,
            'role' => $request->role,
            'password' => $request->filled('password') ? bcrypt($request->password) : $user->password,
        ]);
        return redirect()->back()->with('success', 'User diperbarui');
    }

    public function destroy($id)
    {
        User::destroy($id);
        return redirect()->back()->with('success', 'User dihapus');
    }

    public function showBagian($role, $bagian)
    {
        if (User::user()->bagian_area !== $bagian) {
            abort(403);
        }

        return view($role . '.bagian.' . $bagian);
    }
    // public function edit()
    // {
    //     return view('user.edit');
    // }

    // public function update(Request $request)
    // {
    //     // Validate and update user profile logic here
    //     return redirect()->route('user.dashboard')->with('success', 'Profile updated successfully.');
    // }
}

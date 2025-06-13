<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display the user dashboard.
     */
    public function index()
    {
        return view('user.dashboard');
    }

    public function indexMonitoring()
    {
        return view('monitoring.dashboard');
    }
    /**
     * Show the form for editing the user profile.
     */
    public function edit()
    {
        return view('user.edit');
    }

    /**
     * Update the user profile.
     */
    public function update(Request $request)
    {
        // Validate and update user profile logic here
        return redirect()->route('user.dashboard')->with('success', 'Profile updated successfully.');
    }
}

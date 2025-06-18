<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengumuman; // Ensure you import the Pengumuman model
use Illuminate\Support\Facades\Storage;

class PengumumanController extends Controller
{
    public function index()
    {
        $pengumuman = Pengumuman::latest()->paginate(10);
        return view('pengumuman.index', compact('pengumuman'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'judul_pengumuman' => 'required|string|max:255',
            'isi_pengumuman'   => 'required|string',
            'gambar'           => 'nullable|image|max:2048',
            'file_attachment'  => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx|max:4096',
        ]);

        if ($request->hasFile('gambar')) {
            $judul = preg_replace('/[^A-Za-z0-9_\-]/', '_', $request->input('judul_pengumuman'));
            $ext = $request->file('gambar')->getClientOriginalExtension();
            $filename = $judul . '_' . time() . '.' . $ext;
            $path = $request->file('gambar')->storeAs('pengumuman/images', $filename, 'public');
            $data['gambar'] = $path;
        }
        if ($request->hasFile('file_attachment')) {
            $judul = preg_replace('/[^A-Za-z0-9_\-]/', '_', $request->input('judul_pengumuman'));
            $ext = $request->file('file_attachment')->getClientOriginalExtension();
            $filename = $judul . '_' . time() . '.' . $ext;
            $path = $request->file('file_attachment')->storeAs('pengumuman/files', $filename, 'public');
            $data['file_attachment'] = $path;
        }

        Pengumuman::create($data);
        return back()->with('success', 'Pengumuman dibuat!');
    }

    public function edit(Pengumuman $pengumuman)
    {
        // dd ($pengumuman);
        return response()->json($pengumuman);
    }

    public function update(Request $request, Pengumuman $pengumuman)
    {
        $data = $request->validate([
            'judul_pengumuman' => 'required|string|max:255',
            'isi_pengumuman'   => 'required|string',
            'gambar'           => 'nullable|image|max:2048',
            'file_attachment'  => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx|max:4096',
        ]);

        // Handle gambar
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($pengumuman->gambar && \Storage::disk('public')->exists($pengumuman->gambar)) {
                \Storage::disk('public')->delete($pengumuman->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('pengumuman/images', 'public');
        } else {
            // Pakai gambar lama
            $data['gambar'] = $pengumuman->gambar;
        }

        // Handle file_attachment (optional: tambahkan logika serupa jika ingin hapus file lama)
        if ($request->hasFile('file_attachment')) {
            if ($pengumuman->file_attachment && \Storage::disk('public')->exists($pengumuman->file_attachment)) {
                \Storage::disk('public')->delete($pengumuman->file_attachment);
            }
            $data['file_attachment'] = $request->file('file_attachment')->store('pengumuman/files', 'public');
        } else {
            $data['file_attachment'] = $pengumuman->file_attachment;
        }

        $pengumuman->update($data);
        return back()->with('success', 'Pengumuman diperbarui!');
    }

    public function destroy(Pengumuman $pengumuman)
    {
        // Hapus gambar jika ada
        if ($pengumuman->gambar && \Storage::disk('public')->exists($pengumuman->gambar)) {
            \Storage::disk('public')->delete($pengumuman->gambar);
        }
        // Hapus file_attachment jika ada
        if ($pengumuman->file_attachment && \Storage::disk('public')->exists($pengumuman->file_attachment)) {
            \Storage::disk('public')->delete($pengumuman->file_attachment);
        }
        $pengumuman->delete();
        return back()->with('success', 'Pengumuman dihapus!');
    }
}

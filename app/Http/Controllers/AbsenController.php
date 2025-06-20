<?php

namespace App\Http\Controllers;

use App\Models\absen;
use App\Models\User;
use App\Exports\AbsenExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;

class AbsenController extends Controller
{
    public function index(Request $request)
    {
        $tanggal = $request->input('tanggal');
        // Logika untuk menampilkan daftar absen
        $absens = absen::with('user')
            ->orderBy('tanggal', 'desc')
            ->when($tanggal, function ($query) use ($tanggal) {
                return $query->whereDate('tanggal', $tanggal);
            })
            ->get();
        $users = User::orderBy('name')->get();
        // dd ($absens);
        return view('absen.index', compact('absens', 'users'));
    }

    public function create()
    {
        // Logika untuk menampilkan form tambah absen
        return view('absen.create');
    }

    public function store(Request $request)
    {
        // dd ($request->all());
        // Validasi input
        $request->validate([
            'id_user' => 'required',
            'tanggal' => 'required|date',
            'jam_masuk' => 'nullable',
            'keterangan' => 'nullable|string|max:255',
        ]);

        if($request->tanggal > date('Y-m-d')) {
            return redirect()->back()->withErrors(['error' => 'Tanggal tidak boleh lebih dari hari ini.']);
        } 
        // Periksa apakah absen untuk tanggal ini sudah ada
        if (absen::where('id_user', $request->id_user)
            ->whereDate('tanggal', $request->tanggal)
            ->exists()) {
            return redirect()->back()->withErrors(['error' => 'Absen untuk tanggal ini sudah ada.']);
        }
        // Periksa apakah keterangan valid
        if ($request->keterangan != 'HADIR') {
            $request->validate([
                'jam_masuk' => 'nullable',
            ]);
            $jam_masuk = null; // Set jam_masuk ke null jika keterangan tidak 'HADIR'
        } else {
            $jam_masuk = $request->jam_masuk; // Ambil jam masuk dari input
        }
        // Simpan data absen
        $data = [
            'id_user' => $request->id_user,
            'tanggal' => $request->tanggal,
            'jam_masuk' => $jam_masuk,
            'keterangan' => $request->keterangan,
        ];

        $exitingAbsen = absen::where('id_user', $data['id_user'])
            ->whereDate('tanggal', $data['tanggal'])
            ->first();
        if ($exitingAbsen) {
            return redirect()->back()->withErrors(['error' => 'Absen untuk tanggal ini sudah ada.']);
        }
        absen::create($data);
        return redirect()->route('absen.index')->with('success', 'Absen berhasil ditambahkan.');
    }

    public function edit($id)
    {
        // Logika untuk menampilkan form edit absen
        $absen = absen::findOrFail($id);
        $users = User::orderBy('name')->get();
        return response()->json([
            'absen' => $absen,
            'users' => $users,
        ]);
    }

    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'id_user'    => 'required',
            'tanggal'    => 'required|date',
            'jam_masuk'  => 'nullable',
            'keterangan' => 'nullable|string|max:255',
        ]);
        // Temukan absen yang akan diupdate
        $absen = absen::findOrFail($id);
        
        // Periksa apakah absen untuk tanggal ini sudah ada
        $existingAbsen = absen::where('id_user', $request->id_user)
            ->whereDate('tanggal', $request->tanggal)
            ->where('id_absen', '!=', $id) // Pastikan tidak memeriksa absen yang sedang diupdate
            ->first();
        if ($existingAbsen) {
            return redirect()->back()->withErrors(['error' => 'Absen untuk tanggal ini sudah ada.']);
        }
        // Periksa apakah keterangan valid
        if ($request->keterangan != 'HADIR') {
            $request->validate([
                'jam_masuk' => 'nullable',
            ]);
            $jam_masuk = null; // Set jam_masuk ke null jika keterangan tidak 'HADIR'
        } else {
            $jam_masuk = $request->jam_masuk; // Ambil jam masuk dari input
        }
        // Update data absen
        $updatedData = [
            'id_user' => $request->id_user,
            'tanggal' => $request->tanggal,
            'jam_masuk' => $jam_masuk,
            'keterangan' => $request->keterangan,
        ];
        $absen->update($updatedData);
        return redirect()->route('absen.index')->with('success', 'Absen berhasil diperbarui.');
    }

    public function destroy(absen $absen)
    {
        // Logika untuk menghapus absen
        $absen->delete();
        return redirect()->route('absen.index')->with('success', 'Absen berhasil dihapus.');
    }

    public function export(Request $request)
    {
        $bulan = $request->input('bulan', date('m'));
        $tahun = $request->input('tahun', date('Y'));


        return Excel::download(new AbsenExport($bulan, $tahun), 'data-absensi.xlsx');
    }
}

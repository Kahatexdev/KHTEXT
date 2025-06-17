<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\tb_cekqty_rosset;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat\DateFormatter;

class TbCekqtyRossetController extends Controller
{
    protected $role, $bagianArea;

    public function __construct()
    {
        $role = Auth::user()->role ?? 'user';
        $bagianArea = Auth::user()->bagian_area ?? 'rosso';
    }

    // public function loadByBagian(string $bagian)
    // {
    //     // Validasi bagian yang diizinkan
    //     $allowedBagian = ['rosso', 'setting', 'gudang', 'handprint', 'jahit', 'perbaikan'];
    //     if (!in_array($bagian, $allowedBagian)) {
    //         abort(404, 'Bagian tidak ditemukan');
    //     }

    //     // Ambil data berdasarkan bagian
    //     $data = tb_cekqty_rosset::where('bagian', $bagian)->get();

    //     // Kembalikan view dengan data
    //     return view('bagian.' . $bagian, [
    //         'data' => $data,
    //         'bagian' => $bagian,
    //     ]);
    // }

    public function index(Request $request, string $bagian)
    {
        // Validasi bagian yang diizinkan
        $allowedBagian = ['rosso', 'setting', 'gudang', 'handprint', 'jahit', 'perbaikan'];
        // jika role monitoring, izinkan semua bagian
        if (Auth::user()->role === 'monitoring') {
            $allowedBagian = ['rosso', 'setting', 'gudang', 'handprint', 'jahit', 'perbaikan'];
        } else if (Auth::user()->role === 'user') {
            // jika role user, hanya izinkan bagian sesuai bagian_area user
            $allowedBagian = [Auth::user()->bagian_area];
        }
        // dd ($allowedBagian, $bagian);
        if (!in_array($bagian, $allowedBagian)) {
            abort(404, 'Bagian tidak ditemukan');
        }

        // Ambil data berdasarkan bagian
        $data = tb_cekqty_rosset::where('bagian', $bagian)
            ->orderBy('tanggal_input', 'desc')
            ->get();

        // Kembalikan view dengan data
        return view('bagian.' . $bagian, [
            'data' => $data,
            'bagian' => $bagian,
        ]);
    }

    public function store(Request $request, string $bagian)
    {
        // dd(Auth::user()->role,$bagian, $request->all());
        // Validasi input
        $validated = $request->validate([
            'tanggalCrossCheck' => 'required|date',
            'area' => 'required|string',
            'shift' => 'required|string',
            'erp' => 'required',
            'smv' => 'required',
            'keterangan_erp' => 'required|string',
            'keterangan_smv' => 'required|string',
            'keterangan_reject' => 'required|string',
            'keterangan_rework' => 'required|string',
            'total_mesin' => 'required|integer',
            'jalan_mesin' => 'required|integer'
        ]);
        // dd ($validated);
        // Simpan data ke database
        tb_cekqty_rosset::create([
            'tanggal_input' => $validated['tanggalCrossCheck'],
            'area' => $validated['area'],
            'shift' => $validated['shift'],
            'qty_erp_rosset' => $validated['erp'],
            'qty_mis_rosset' => $validated['smv'],
            'ket_erp_rosset' => $validated['keterangan_erp'],
            'ket_mis_rosset' => $validated['keterangan_smv'],
            'ket_reject' => $validated['keterangan_reject'],
            'ket_rework' => $validated['keterangan_rework'],
            'ttl_mc' => $validated['total_mesin'],
            'jl_mc' => $validated['jalan_mesin'],
            'bagian' => $bagian,
            'id_user' => Auth::id(),
            'qty_reject' => 0, // Default 0, bisa diupdate jika ada inputan
            'qty_rework' => 0, // Default 0, bisa diupdate jika ada inputan
            'ket_overshift_siang_kepagi' => '', // Kosongkan jika tidak ada inputan
            'ket_overshift_pagi_kesiang' => '', // Kosongkan jika tidak ada inputan
            'direct' => 0, // Default 0, bisa diupdate jika ada inputan
        ]);
        // Redirect atau kembalikan response
        return redirect()->back()->with('success', 'Data berhasil disimpan');
    }

    public function storeSetting(Request $request, string $bagian)
    {
        // dd (Auth::user()->role, $bagian, $request->all());
        // Validasi input
        $validated = $request->validate([
            'tanggalCrossCheck' => 'required|date',
            'area' => 'required|string',
            'shift' => 'required|string',
            'erp' => 'required',
            'smv' => 'required',
            'keterangan_erp' => 'required|string',
            'keterangan_smv' => 'required|string',
            'qty_reject' => 'required|integer',
            'qty_rework' => 'required|integer',
            'keterangan_reject' => 'required|string',
            'keterangan_rework' => 'required|string',
            'total_mesin' => 'required|integer',
            'jalan_mesin' => 'required|integer',
            'ket_overshift_siang_kepagi' => 'nullable|string',
            'ket_overshift_pagi_kesiang' => 'nullable|string',
        ]);
        // Simpan data ke database
        tb_cekqty_rosset::create([
            'tanggal_input' => $validated['tanggalCrossCheck'],
            'area' => $validated['area'],
            'shift' => $validated['shift'],
            'qty_erp_rosset' => $validated['erp'],
            'qty_mis_rosset' => $validated['smv'],
            'ket_erp_rosset' => $validated['keterangan_erp'],
            'ket_mis_rosset' => $validated['keterangan_smv'],
            'qty_reject' => $validated['qty_reject'],
            'qty_rework' => $validated['qty_rework'],
            'ket_reject' => $validated['keterangan_reject'],
            'ket_rework' => $validated['keterangan_rework'],
            'ttl_mc' => $validated['total_mesin'],
            'jl_mc' => $validated['jalan_mesin'],
            'bagian' => $bagian,
            'id_user' => Auth::id(),
            'direct' => 0, // Default 0, bisa diupdate jika ada inputan
            'ket_overshift_siang_kepagi' => $validated['ket_overshift_siang_kepagi'] ?? '', // Kosongkan jika tidak ada inputan
            'ket_overshift_pagi_kesiang' => $validated['ket_overshift_pagi_kesiang'] ?? '', // Kosongkan jika tidak ada inputan
            // Tambahkan field lain sesuai kebutuhan
        ]);
        // Redirect atau kembalikan response
        return redirect()->back()->with('success', 'Data berhasil disimpan');
    }

    public function storeGudang(Request $request, string $bagian)
    {
        // dd (Auth::user()->role, $bagian, $request->all());
        // Validasi input
        $validated = $request->validate([
            'tanggalCrossCheck' => 'required|date',
            'area' => 'required|string',
            'shift' => 'required|string',
            'erp' => 'required',
            'aktual_permintaan_packing' => 'required',
            'keterangan_erp' => 'required|string',
            'keterangan_smv' => 'required|string',
            'qty_reject' => 'required|integer',
            'qty_rework' => 'required|integer',
            'keterangan_reject' => 'required|string',
            'keterangan_rework' => 'required|string',
            'total_mesin' => 'required|integer',
            'jalan_mesin' => 'required|integer',
        ]);
        // Simpan data ke database
        tb_cekqty_rosset::create([
            'tanggal_input' => $validated['tanggalCrossCheck'],
            'area' => $validated['area'],
            'shift' => $validated['shift'],
            'qty_erp_rosset' => $validated['erp'],
            'qty_mis_rosset' => $validated['aktual_permintaan_packing'],
            'ket_erp_rosset' => $validated['keterangan_erp'],
            'ket_mis_rosset' => $validated['keterangan_smv'],
            'qty_reject' => $validated['qty_reject'],
            'qty_rework' => $validated['qty_rework'],
            'ket_reject' => $validated['keterangan_reject'],
            'ket_rework' => $validated['keterangan_rework'],
            'ttl_mc' => $validated['total_mesin'],
            'jl_mc' => $validated['jalan_mesin'],
            'bagian' => $bagian,
            'id_user' => Auth::id(),
            'direct' => 0, // Default 0, bisa diupdate jika ada inputan
            'ket_overshift_siang_kepagi' => '', // Kosongkan jika tidak ada inputan
            'ket_overshift_pagi_kesiang' => '', // Kosongkan jika tidak ada inputan
            // Tambahkan field lain sesuai kebutuhan
        ]);
        // Redirect atau kembalikan response
        return redirect()->back()->with('success', 'Data berhasil disimpan');
    }

    public function storeHandprint(Request $request, string $bagian)
    {
        // dd (Auth::user()->role, $bagian, $request->all());
        // Validasi input
        $validated = $request->validate([
            'tanggalCrossCheck' => 'required|date',
            'area' => 'required|string',
            'shift' => 'required|string',
            'erp' => 'required',
            'smv' => 'required',
            'keterangan_erp' => 'required|string',
            'keterangan_smv' => 'required|string',
            'qty_reject' => 'required|integer',
            'qty_rework' => 'required|integer',
            'keterangan_reject' => 'required|string',
            'keterangan_rework' => 'required|string',
            'total_mesin' => 'required|integer',
            'jalan_mesin' => 'required|integer',
        ]);
        // Simpan data ke database
        tb_cekqty_rosset::create([
            'tanggal_input' => $validated['tanggalCrossCheck'],
            'area' => $validated['area'],
            'shift' => $validated['shift'],
            'qty_erp_rosset' => $validated['erp'],
            'qty_mis_rosset' => $validated['smv'],
            'ket_erp_rosset' => $validated['keterangan_erp'],
            'ket_mis_rosset' => $validated['keterangan_smv'],
            'qty_reject' => $validated['qty_reject'],
            'qty_rework' => $validated['qty_rework'],
            'ket_reject' => $validated['keterangan_reject'],
            'ket_rework' => $validated['keterangan_rework'],
            'ttl_mc' => $validated['total_mesin'],
            'jl_mc' => $validated['jalan_mesin'],
            'bagian' => $bagian,
            'id_user' => Auth::id(),
            'direct' => 0, // Default 0, bisa diupdate jika ada inputan
            'ket_overshift_siang_kepagi' => '', // Kosongkan jika tidak ada inputan
            'ket_overshift_pagi_kesiang' => '', // Kosongkan jika tidak ada inputan
            // Tambahkan field lain sesuai kebutuhan
        ]);
        // Redirect atau kembalikan response
        return redirect()->back()->with('success', 'Data berhasil disimpan');
    }

    public function storeJahit(Request $request, string $bagian)
    {
        // dd (Auth::user()->role, $bagian, $request->all());
        // Validasi input
        $validated = $request->validate([
            'tanggalCrossCheck' => 'required|date',
            'area' => 'required|string',
            'shift' => 'required|string',
            'erp' => 'required',
            'smv' => 'required',
            'keterangan_erp' => 'required|string',
            'keterangan_smv' => 'required|string',
            'qty_reject' => 'required|integer',
            'qty_rework' => 'required|integer',
            'keterangan_reject' => 'required|string',
            'keterangan_rework' => 'required|string',
            'total_mesin' => 'required|integer',
            'jalan_mesin' => 'required|integer',
        ]);
        // Simpan data ke database
        tb_cekqty_rosset::create([
            'tanggal_input' => $validated['tanggalCrossCheck'],
            'area' => $validated['area'],
            'shift' => $validated['shift'],
            'qty_erp_rosset' => $validated['erp'],
            'qty_mis_rosset' => $validated['smv'],
            'ket_erp_rosset' => $validated['keterangan_erp'],
            'ket_mis_rosset' => $validated['keterangan_smv'],
            'qty_reject' => $validated['qty_reject'],
            'qty_rework' => $validated['qty_rework'],
            'ket_reject' => $validated['keterangan_reject'],
            'ket_rework' => $validated['keterangan_rework'],
            'ttl_mc' => $validated['total_mesin'],
            'jl_mc' => $validated['jalan_mesin'],
            'bagian' => $bagian,
            'id_user' => Auth::id(),
            'direct' => 0, // Default 0, bisa diupdate jika ada inputan
            'ket_overshift_siang_kepagi' => '', // Kosongkan jika tidak ada inputan
            'ket_overshift_pagi_kesiang' => '', // Kosongkan jika tidak ada inputan
            // Tambahkan field lain sesuai kebutuhan
        ]);
        // Redirect atau kemb alikan response
        return redirect()->back()->with('success', 'Data berhasil disimpan');
    }

    public function storePerbaikan(Request $request, string $bagian)
    {
        // dd (Auth::user()->role, $bagian, $request->all());
        // Validasi input
        $validated = $request->validate([
            'tanggalCrossCheck' => 'required|date',
            'area' => 'required|string',
            'shift' => 'required|string',
            'erp' => 'required',
            'smv' => 'required',
            'direct' => 'required|integer',
            'keterangan_erp' => 'required|string',
            'keterangan_smv' => 'required|string',
            'qty_reject' => 'required|integer',
            'qty_rework' => 'required|integer',
            'keterangan_reject' => 'required|string',
            'keterangan_rework' => 'required|string',
            'total_mesin' => 'required|integer',
            'jalan_mesin' => 'required|integer',
        ]);
        // Simpan data ke database
        tb_cekqty_rosset::create([
            'tanggal_input' => $validated['tanggalCrossCheck'],
            'area' => $validated['area'],
            'shift' => $validated['shift'],
            'qty_erp_rosset' => $validated['erp'],
            'qty_mis_rosset' => $validated['smv'],
            'ket_erp_rosset' => $validated['keterangan_erp'],
            'ket_mis_rosset' => $validated['keterangan_smv'],
            'qty_reject' => $validated['qty_reject'],
            'qty_rework' => $validated['qty_rework'],
            'ket_reject' => $validated['keterangan_reject'],
            'ket_rework' => $validated['keterangan_rework'],
            'ttl_mc' => $validated['total_mesin'],
            'jl_mc' => $validated['jalan_mesin'],
            'bagian' => $bagian,
            'id_user' => Auth::id(),
            'direct' => $validated['direct'], // Ambil dari inputan
            'ket_overshift_siang_kepagi' => '', // Kosongkan jika tidak ada inputan
            'ket_overshift_pagi_kesiang' => '', // Kosongkan jika tidak ada inputan
            // Tambahkan field lain sesuai kebutuhan
        ]);
        // Redirect atau k
        return redirect()->back()->with('success', 'Data berhasil disimpan');
    }
}

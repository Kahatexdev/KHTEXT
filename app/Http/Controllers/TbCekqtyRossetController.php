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

    public function reportData()
    {
        $bagian = tb_cekqty_rosset::select('bagian')->distinct()->get();
        return view('bagian.index', [
            'bagian' => $bagian,
        ]);
    }

    

    public function index(Request $request, string $bagian)
    {
        // Validasi bagian yang diizinkan
        // validasi bagian
        $allowedBagian = Auth::user()->role === 'monitoring'
            ? ['mesin', 'rosso', 'setting', 'gudang', 'handprint', 'jahit', 'perbaikan']
            : [Auth::user()->bagian_area];

        if (! in_array($bagian, $allowedBagian)) {
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
            'tanggal' => 'required|date',
            'area' => 'required|string',
            'shift' => 'required|string',
            'erp' => 'required',
            'smv' => 'required',
            'keterangan_erp' => 'string',
            'keterangan_smv' => 'string',
            'qty_reject' => 'integer',
            'qty_rework' => 'integer',
            'keterangan_reject' => 'string',
            'keterangan_rework' => 'string',
            'total_mesin' => 'integer',
            'jalan_mesin' => 'integer',
            'ket_ovh_pagi' => 'string',
            'ket_ovh_siang' => 'string',
            'ket_reject' => 'string',
            'ket_rework' => 'string',
            'direct' => 'integer', 
        ]);
        // dd ($validated);
        // Simpan data ke database
        tb_cekqty_rosset::create([
            'tanggal_input' => $validated['tanggal'],
            'area' => $validated['area'],
            'shift' => $validated['shift'],
            'qty_erp_rosset' => $validated['erp'],
            'qty_mis_rosset' => $validated['smv'],
            'ket_erp_rosset' => $validated['keterangan_erp'] ?? '',
            'ket_mis_rosset' => $validated['keterangan_smv'] ?? '',
            'ttl_mc' => $validated['total_mesin'] ?? '',
            'jl_mc' => $validated['jalan_mesin'] ?? '',
            'bagian' => $bagian,
            'id_user' => Auth::id(),
            'qty_reject' => $validated['qty_reject'] ?? '',
            'qty_rework' => $validated['qty_rework'] ?? '',
            'ket_reject' => $validated['ket_reject'] ?? '',
            'ket_rework' => $validated['ket_rework'] ?? '',
            'ket_overshift_siang_kepagi' => $validated['ket_ovh_siang'] ?? '', // Kosongkan jika tidak ada inputan
            'ket_overshift_pagi_kesiang' => $validated['ket_ovh_pagi'] ?? '', // Kosongkan jika tidak ada inputan
            'direct' => $validated['direct'] ?? 0, // Default ke 0 jika tidak ada inputan
        ]);
        // Redirect atau kembalikan response
        return redirect()->to(route('reportDatabyBagian', ['bagian' => $bagian]))
            ->with('success', 'Data berhasil disimpan');
    }

    public function dataByBagian(string $bagian)
    {
        // Validasi bagian yang diizinkan
        $allowedBagian = ['mesin', 'rosso', 'setting', 'gudang', 'handprint', 'jahit', 'perbaikan'];
        // jika role monitoring, izinkan semua bagian
        if (Auth::user()->role === 'monitoring') {
            $allowedBagian = ['mesin', 'rosso', 'setting', 'gudang', 'handprint', 'jahit', 'perbaikan'];
        } else if (Auth::user()->role === 'user') {
            // jika role user, hanya izinkan bagian sesuai bagian_area user
            $allowedBagian = [Auth::user()->bagian_area];
        }
        if (!in_array($bagian, $allowedBagian)) {
            abort(404, 'Bagian tidak ditemukan');
        }

        // Ambil data berdasarkan bagian
        $data = tb_cekqty_rosset::where('bagian', $bagian)
            ->orderBy('tanggal_input', 'desc')
            ->get();

        // Kembalikan view dengan data
        return view('bagian.report.tabel', [
            'data' => $data,
            'bagian' => $bagian,
        ]);
    }

    public function inputErp()
    {
        return view($this->role . '.bagian.input-erp');
    }

    public function edit(string $bagian, int $id)
    {
        // validasi bagian
        $allowed = Auth::user()->role === 'monitoring'
            ? ['mesin', 'rosso', 'setting', 'gudang', 'handprint', 'jahit', 'perbaikan']
            : [Auth::user()->bagian_area];

        if (! in_array($bagian, $allowed)) {
            abort(404, 'Bagian tidak ditemukan');
        }

        // Ambil data berdasarkan PK
        $item = tb_cekqty_rosset::findOrFail($id);

        return view('bagian.' . $bagian, [
            'item'    => $item,
            'bagian' => $bagian,
        ]);
    }

    public function update(Request $request, string $bagian, int $id)
    {
        // dd (Auth::user()->role, $bagian, $request->all());
        // validasi bagian
        $allowed = Auth::user()->role === 'monitoring'
            ? ['mesin', 'rosso', 'setting', 'gudang', 'handprint', 'jahit', 'perbaikan']
            : [Auth::user()->bagian_area];

        if (! in_array($bagian, $allowed)) {
            abort(404, 'Bagian tidak ditemukan');
        }

        // Validasi input
        $validated = $request->validate([
            'tanggal' => 'required|date',
            'area' => 'required|string',
            'shift' => 'required|string',
            'erp' => 'required',
            'smv' => 'required',
            'keterangan_erp' => 'string',
            'keterangan_smv' => 'string',
            'qty_reject' => 'integer',
            'qty_rework' => 'integer',
            'total_mesin' => 'integer',
            'jalan_mesin' => 'integer',
            'ket_ovh_pagi' => 'string',
            'ket_ovh_siang' => 'string',
        ]);
        // dd ($validated);
        // Update data berdasarkan PK
        tb_cekqty_rosset::where('id_cekqty_rosset', $id)->update([
            'tanggal_input' => $validated['tanggal'],
            'area' => $validated['area'],
            'shift' => $validated['shift'],
            'qty_erp_rosset' => $validated['erp'],
            'qty_mis_rosset' => $validated['smv'],
            'ket_erp_rosset' => $validated['keterangan_erp'] ?? '',
            'ket_mis_rosset' => $validated['keterangan_smv'] ?? '',
            'qty_reject' => $validated['qty_reject'] ?? '',
            'qty_rework' => $validated['qty_rework' ?? ''],
            'ttl_mc' => $validated['total_mesin'] ?? '',
            'jl_mc' => $validated['jalan_mesin'] ?? '',
            'ket_overshift_siang_kepagi' => $validated['ket_ovh_siang'] ?? '',
            'ket_overshift_pagi_kesiang' => $validated['ket_ovh_pagi'] ?? '',
        ]);

        return redirect()->to(route('reportDatabyBagian', ['bagian' => $bagian]))
            ->with('success', 'Data berhasil diperbarui');
    }

    public function destroy(string $bagian, int $id)
    {
        // validasi bagian
        $allowed = Auth::user()->role === 'monitoring'
            ? ['mesin', 'rosso', 'setting', 'gudang', 'handprint', 'jahit', 'perbaikan']
            : [Auth::user()->bagian_area];

        if (! in_array($bagian, $allowed)) {
            abort(404, 'Bagian tidak ditemukan');
        }

        // Hapus row berdasarkan PK
        tb_cekqty_rosset::where('id_cekqty_rosset', $id)->delete();

        return back()->with('success', 'Data berhasil dihapus');
    }
}

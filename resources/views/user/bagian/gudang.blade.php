@extends('layouts.app')
@section('title', 'Bagian Gudang')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <div class="flex justify-between items-center px-6 py-4 border-b">
            <h2 class="text-xl font-bold">User Gudang</h2>
        </div>
        <div class="px-6 py-4">
            <form action="">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label for="tanggalCrossCheck" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Cross Check</label>
                        <input type="date" id="tanggalCrossCheck" name="tanggalCrossCheck"
                            class="w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm" required>
                    </div>
                    <div>
                        <label for="area" class="block text-sm font-medium text-gray-700 mb-1">Packing</label>
                        <select name="area" id="area"
                            class="w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm" required>
                            <option value="">Pilih Packing</option>
                            <option value="PK1">PK1</option>
                            <option value="PK2">PK2</option>
                            <option value="PK5">PK5</option>
                            <option value="PK7">PK7</option>
                            <option value="PK8">PK8</option>
                            <option value="PK11">PK11</option>
                            <option value="PKIDP">PKIDP</option>
                        </select>
                    </div>
                    <div>
                        <label for="shift" class="block text-sm font-medium text-gray-700 mb-1">Shift</label>
                        <select name="shift" id="shift"
                            class="w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm" required>
                            <option value="">Pilih Shift</option>
                            <option value="PAGI">PAGI</option>
                            <option value="SIANG">SIANG</option>
                        </select>
                    </div>
                </div>

                <h4 class="font-semibold text-slate-900 mt-3">Cross Check Qty Rosso</h4>
                <div class="grid grid-cols-2 gap-2">
                    <div>
                        <label for="erp" class="block text-sm font-medium text-gray-700 mb-1">ERP</label>
                        <input type="number" id="erp" name="erp"
                            class="w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm" required>
                    </div>
                    <div>
                        <label for="aktual_permintaan_packing" class="block text-sm font-medium text-gray-700 mb-1">Aktual Permintaan Packing</label>
                        <input type="number" id="aktual_permintaan_packing" name="aktual_permintaan_packing"
                            class="w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm" required>
                    </div>
                </div>
                <h4 class="font-semibold text-slate-900 mt-3">MIS</h4>
                <div class="grid grid-cols-2 gap-2">
                    <div>
                        <label for="selisih" class="block text-sm font-medium text-gray-700 mb-1">Selisih</label>
                        <input type="number" id="selisih" name="selisih"
                            class="w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm" readonly>
                    </div>
                    <div>
                        <label for="persamaan" class="block text-sm font-medium text-gray-700 mb-1">Persamaan</label>
                        <input type="number" id="persamaan" name="persamaan"
                            class="w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm" readonly>
                    </div>
                    <div>
                        <label for="keterangan_erp" class="block text-sm font-medium text-gray-700 mb-1">Keterangan ERP</label>
                        <textarea name="keterangan_erp" id="keterangan_erp" cols="30" rows="3"
                            class="w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm" required></textarea>
                    </div>
                    <div>
                        <label for="keterangan_smv" class="block text-sm font-medium text-gray-700 mb-1">Keterangan Aktual</label>
                        <textarea name="keterangan_smv" id="keterangan_smv" cols="30" rows="3"
                            class="w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm" required></textarea>
                    </div>
                </div>

                <h4 class="font-semibold text-slate-900 mt-3">Qty Reject & Rework</h4>
                <div class="grid grid-cols-2 gap-2">
                    <div>
                        <label for="qty_reject" class="block text-sm font-medium text-gray-700 mb-1">Qty Reject</label>
                        <input type="number" id="qty_reject" name="qty_reject"
                            class="w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm" required>
                    </div>
                    <div>
                        <label for="qty_rework" class="block text-sm font-medium text-gray-700 mb-1">Qty Rework</label>
                        <input type="number" id="qty_rework" name="qty_rework"
                            class="w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm" required>
                    </div>
                    <div>
                        <label for="total_mesin" class="block text-sm font-medium text-gray-700 mb-1">Total Mesin</label>
                        <input type="number" id="total_mesin" name="total_mesin"
                            class="w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm" required>
                    </div>
                    <div>
                        <label for="jalan_mesin" class="block text-sm font-medium text-gray-700 mb-1">Jalan Mesin</label>
                        <input type="number" id="jalan_mesin" name="jalan_mesin"
                            class="w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm" required>
                    </div>
                    
                </div>

                <h4 class="font-semibold text-slate-900 mt-3">Overshift</h4>
                <div class="grid grid-cols-2 gap-2">
                    <div>
                        <label for="keterangan_reject" class="block text-sm font-medium text-gray-700 mb-1">Dari Pagi</label>
                        <textarea name="keterangan_reject" id="keterangan_reject" cols="30" rows="3"
                            class="w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm" required></textarea>
                    </div>
                    <div>
                        <label for="keterangan_rework" class="block text-sm font-medium text-gray-700 mb-1">Dari Siang</label>
                        <textarea name="keterangan_rework" id="keterangan_rework" cols="30" rows="3"
                            class="w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm" required></textarea>
                    </div>
                </div>
                <div class="mt-4">
                    <button type="submit"
                        class="px-4 py-2 bg-blue-600 w-full text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@include('layouts.footer')
@endsection

@push('scripts')
@endpush
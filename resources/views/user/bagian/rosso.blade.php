@extends('layouts.app')
@section('title', 'Bagian Rosso')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <div class="flex justify-between items-center px-6 py-4 border-b">
            <h2 class="text-xl font-bold">User Rosso</h2>
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
                    <label for="area" class="block text-sm font-medium text-gray-700 mb-1">Area</label>
                    <select name="area" id="area"
                            class="w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm" required>
                        <option value="">Pilih Area</option>
                        <option value="KK1">KK1</option>
                        <option value="KK2">KK2</option>
                        <option value="KK5">KK5</option>
                        <option value="KK7">KK7</option>
                        <option value="KK8">KK8</option>
                        <option value="KK11">KK11</option>
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
                    <label for="smv" class="block text-sm font-medium text-gray-700 mb-1">SMV</label>
                    <input type="number" id="smv" name="smv"
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
                    <label for="keterangan_smv" class="block text-sm font-medium text-gray-700 mb-1">Keterangan SMV</label>
                    <textarea name="keterangan_smv" id="keterangan_smv" cols="30" rows="3"
                              class="w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm" required></textarea>
                </div>
            </div>

            <h4 class="font-semibold text-slate-900 mt-3">Reject & Rework ERP</h4>
            <div class="grid grid-cols-2 gap-2">
                <div>
                    <label for="selisih" class="block text-sm font-medium text-gray-700 mb-1">Qty Reject</label>
                    <input type="number" id="selisih" name="selisih"
                           class="w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm" required>
                </div>
                <div>
                    <label for="persamaan" class="block text-sm font-medium text-gray-700 mb-1">Qty Rework</label>
                    <input type="number" id="persamaan" name="persamaan"
                           class="w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm" required>
                </div>
                <div>
                    <label for="keterangan_reject" class="block text-sm font-medium text-gray-700 mb-1">Keterangan Reject</label>
                    <textarea name="keterangan_reject" id="keterangan_reject" cols="30" rows="3"
                              class="w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm" required></textarea>
                </div>
                <div>
                    <label for="keterangan_rework" class="block text-sm font-medium text-gray-700 mb-1">Keterangan Rework</label>
                    <textarea name="keterangan_rework" id="keterangan_rework" cols="30" rows="3"
                              class="w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm" required></textarea>
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
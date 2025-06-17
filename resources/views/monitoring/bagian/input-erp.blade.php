@extends('layouts.app')
@section('title', 'Bagian Mesin')

@section('content')
<div class="w-full px-2 sm:px-4 py-4 sm:py-6 mx-auto space-y-4 sm:space-y-6">
    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <div class="flex justify-between items-center px-6 py-4 border-b">
            <h2 class="text-xl font-bold">INPUT JAM SELESAI ERP MESIN</h2>
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
                            <option value="KK1A">KK1A</option>
                            <option value="KK1B">KK1B</option>
                            <option value="KK2A">KK2A</option>
                            <option value="KK2B">KK2B</option>
                            <option value="KK2C">KK2C</option>
                            <option value="KK5G">KK5G</option>
                            <option value="KK7K">KK7K</option>
                            <option value="KK7L">KK7L</option>
                            <option value="KK8D">KK8D</option>
                            <option value="KK8F">KK8F</option>
                            <option value="KK8J">KK8J</option>
                            <option value="KK8J4">KK8J4</option>
                            <option value="KK8J5">KK8J5</option>
                            <option value="KK8J6">KK8J6</option>
                            <option value="KK9D">KK9D</option>
                            <option value="KK10E">KK10E</option>
                            <option value="KK11M">KK11M</option>
                            <option value="KKMONITORING">KK MONITORING</option>
                        </select>
                </div>
                <div>
                    <label for="shift" class="block text-sm font-medium text-gray-700 mb-1">Shift</label>
                    <input type="text" id="shift" name="shift" placeholder="NON SHIFT"
                           class="w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm" readonly>
                </div>
            </div>

            
            <h4 class="font-semibold text-slate-900 mt-4">PERHATIKAN <strong>AM & PM</strong> SAAT PENGINPUTAN WAKTU</h4>
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

{{-- Custom Styles for enhanced visual appeal --}}
<style>
    @keyframes pulse-success {
        0%, 100% {
            background-color: rgb(220 252 231);
        }
        50% {
            background-color: rgb(187 247 208);
        }
    }
    
    @keyframes pulse-warning {
        0%, 100% {
            background-color: rgb(254 249 195);
        }
        50% {
            background-color: rgb(253 230 138);
        }
    }
    
    .animate-pulse-success {
        animation: pulse-success 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
    }
    
    .animate-pulse-warning {
        animation: pulse-warning 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
    }
    
    /* Smooth transitions for interactive elements */
    .transition-all {
        transition: all 0.3s ease-in-out;
    }
    
    /* Custom scrollbar for table */
    .overflow-x-auto::-webkit-scrollbar {
        height: 8px;
    }
    
    .overflow-x-auto::-webkit-scrollbar-track {
        background: #f1f5f9;
        border-radius: 4px;
    }
    
    .overflow-x-auto::-webkit-scrollbar-thumb {
        background: #cbd5e1;
        border-radius: 4px;
    }
    
    .overflow-x-auto::-webkit-scrollbar-thumb:hover {
        background: #94a3b8;
    }
    </style>
@include('layouts.footer')
@endsection

@push('scripts')
@endpush
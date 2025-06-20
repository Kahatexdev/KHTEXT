@extends('layouts.app')
@section('title', 'Bagian Mesin')
@section('page-title', 'Bagian Mesin')

@section('navbar-report-mesin')
<li class="relative flex items-center pl-4">
    <div class="relative">
        <button
            id="dropdownToggle"
            type="button"
            class="flex items-center px-3 py-2 font-semibold text-sm text-slate-600 hover:text-slate-800 focus:outline-none focus:ring focus:ring-slate-300 rounded-md transition">
            <span class="hidden sm:inline">Report</span>
            <svg class="-mr-1 size-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon">
                <path fill-rule="evenodd" d="M5.22 8.22a.75.75 0 0 1 1.06 0L10 11.94l3.72-3.72a.75.75 0 1 1 1.06 1.06l-4.25 4.25a.75.75 0 0 1-1.06 0L5.22 9.28a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
            </svg>
        </button>

        <div
            id="dropdownMenu"
            class="absolute right-0 mt-2 w-48 bg-white border rounded-lg shadow-lg z-50 py-2 opacity-0 scale-95 translate-y-1 pointer-events-none transition-all duration-200 ease-out">
            <a href="{{ route('mesin.inputErp')}}" class="block px-4 py-2 text-sm text-slate-700 hover:bg-gray-100">REPORT JAM SELESAI ERP</a>
        </div>
    </div>
</li>
@endsection

@section('content')
<div class="w-full px-2 sm:px-4 py-4 sm:py-6 mx-auto space-y-4 sm:space-y-6">
    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <div class="flex justify-between items-center px-6 py-4 border-b">
            <h2 class="text-xl font-bold">INPUT JAM SELESAI ERP MESIN</h2>
        </div>
        <div class="px-6 py-4">
            <form action="{{route('inputErp.store')}}" method="POST">
                @csrf
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label for="tanggal_input" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Cross Check</label>
                    <input type="date" id="tanggal_input" name="tanggal_input"
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
                    <input type="text" id="shift" name="shift" placeholder="NON SHIFT" value="NON SHIFT"
                           class="w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm" readonly>
                </div>
            </div>

            <div class="mt-3">
                <div class="relative bg-red-50 border border-red-200 rounded-lg p-4">
                    <div class="flex items-center space-x-3">
                        <div class="animate-pulse">
                            <i class="fas fa-clock text-red-500 text-lg"></i>
                        </div>
                        <div>
                            <p class="text-red-700 text-sm">
                                <span class="font-medium">Perhatikan</span>
                                <span class="inline-block bg-red-200 text-red-800 px-2 py-1 rounded-md text-xs font-bold">
                                    AM & PM
                                </span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-3 gap-3">
                <div class=" mt-2">
                    <label for="start_input" class="block text-sm font-medium text-gray-700 mb-1">Start Input</label>
                    <input type="time" id="start_input" name="start_input"
                           class="w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm" required>
                </div>
                <div class=" mt-2">
                    <label for="stop_input" class="block text-sm font-medium text-gray-700 mb-1">Stop Input</label>
                    <input type="time" id="stop_input" name="stop_input"
                           class="w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm" required>
                </div>
                <div class=" mt-2">
                    <label for="ttl_mc" class="block text-sm font-medium text-gray-700 mb-1">Total MC</label>
                    <input type="number" id="ttl_mc" name="ttl_mc"
                           class="w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm" required>
                </div>
            </div>
            <div class="grid grid-cols-2 gap-2">
                <div class=" mt-2">
                    <label for="jln_mc" class="block text-sm font-medium text-gray-700 mb-1">Jalan MC</label>
                    <input type="number" id="jln_mc" name="jln_mc"
                           class="w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm" required>
                </div>
                <div class=" mt-2">
                    <label for="prod_erp" class="block text-sm font-medium text-gray-700 mb-1">Prod ERP</label>
                    <input type="number" id="prod_erp" name="prod_erp" step="0.01"
                           class="w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm" required>
                </div>
            </div>
            <div class=" mt-2">
                <label for="ket" class="block text-sm font-medium text-gray-700 mb-1">Keterangan ERP</label>
                <textarea name="ket" id="ket" cols="30" rows="3"
                          class="w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm" required></textarea>
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
<script>
    const toggle = document.getElementById('dropdownToggle');
    const menu = document.getElementById('dropdownMenu');

    toggle.addEventListener('click', () => {
        menu.classList.toggle('opacity-0');
        menu.classList.toggle('scale-95');
        menu.classList.toggle('translate-y-1');
        menu.classList.toggle('pointer-events-none');
    });

    document.addEventListener('click', (e) => {
        if (!toggle.contains(e.target) && !menu.contains(e.target)) {
            menu.classList.add('opacity-0', 'scale-95', 'translate-y-1', 'pointer-events-none');
        }
    });
</script>
@endpush
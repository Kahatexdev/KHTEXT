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
            <h2 class="text-xl font-bold">
                @if(isset($item))
                EDIT JAM SELESAI ERP MESIN
                @else
                INPUT JAM SELESAI ERP MESIN
                @endif
            </h2>
        </div>
        <div class="px-6 py-4">
            @php
                $isEdit = isset($item);
                $formAction = $isEdit
                    ? route('inputErp.update', ['id' => $item->id_input])
                    : route('inputErp.store');
            @endphp
            <form action="{{ $formAction }}" method="POST">
                @csrf
                @if($isEdit)
                    @method('PUT')
                @endif
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label for="tanggal_input" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Cross Check</label>
                    <input type="date" id="tanggal_input" name="tanggal_input"
                    value="{{ old('tanggal_input', $item->tanggal_input ?? '') }}"
                           class="w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm" required>
                </div>
                <div>
                    <label for="area" class="block text-sm font-medium text-gray-700 mb-1">Area</label>
                        <select name="area" id="area"
                            class="w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm" required>
                            <option value="">Pilih Area</option>
                            <option value="KK1A" {{ old('area', $item->area ?? '') == 'KK1A' ? 'selected' : '' }}>KK1A</option>
                            <option value="KK1B" {{ old('area', $item->area ?? '') == 'KK1B' ? 'selected' : '' }}>KK1B</option>
                            <option value="KK2A" {{ old('area', $item->area ?? '') == 'KK2A' ? 'selected' : '' }}>KK2A</option>
                            <option value="KK2B" {{ old('area', $item->area ?? '') == 'KK2B' ? 'selected' : '' }}>KK2B</option>
                            <option value="KK2C" {{ old('area', $item->area ?? '') == 'KK2C' ? 'selected' : '' }}>KK2C</option>
                            <option value="KK5G" {{ old('area', $item->area ?? '') == 'KK5G' ? 'selected' : '' }}>KK5G</option>
                            <option value="KK7K" {{ old('area', $item->area ?? '') == 'KK7K' ? 'selected' : '' }}>KK7K</option>
                            <option value="KK7L" {{ old('area', $item->area ?? '') == 'KK7L' ? 'selected' : '' }}>KK7L</option>
                            <option value="KK8D" {{ old('area', $item->area ?? '') == 'KK8D' ? 'selected' : '' }}>KK8D</option>
                            <option value="KK8F" {{ old('area', $item->area ?? '') == 'KK8F' ? 'selected' : '' }}>KK8F</option>
                            <option value="KK8J" {{ old('area', $item->area ?? '') == 'KK8J' ? 'selected' : '' }}>KK8J</option>
                            <option value="KK8J4" {{ old('area', $item->area ?? '') == 'KK8J4' ? 'selected' : '' }}>KK8J4</option>
                            <option value="KK8J5" {{ old('area', $item->area ?? '') == 'KK8J5' ? 'selected' : '' }}>KK8J5</option>
                            <option value="KK8J6" {{ old('area', $item->area ?? '') == 'KK8J6' ? 'selected' : '' }}>KK8J6</option>
                            <option value="KK9D" {{ old('area', $item->area ?? '') == 'KK9D' ? 'selected' : '' }}>KK9D</option>
                            <option value="KK10E" {{ old('area', $item->area ?? '') == 'KK10E' ? 'selected' : '' }}>KK10E</option>
                            <option value="KK11M" {{ old('area', $item->area ?? '') == 'KK11M' ? 'selected' : '' }}>KK11M</option>
                            <option value="KKMONITORING" {{ old('area', $item->area ?? '') == 'KKMONITORING' ? 'selected' : '' }}>KK MONITORING</option>
                        </select>
                </div>
                <div>
                    <label for="shift" class="block text-sm font-medium text-gray-700 mb-1">Shift</label>
                    <select name="shift" id="shift" class="w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm" required>
                        <option value="">Pilih Shift</option>
                        <option value="SHIFT" {{ old('shift', $item->shift ?? '') == 'SHIFT' ? 'selected' : '' }}>SHIFT</option>
                        <option value="NON SHIFT" {{ old('shift', $item->shift ?? '') == 'NON SHIFT' ? 'selected' : '' }}>NON SHIFT</option>
                    </select>
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
                    value="{{ old('start_input', $item->start_input ?? '') }}"
                           class="w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm" required>
                </div>
                <div class=" mt-2">
                    <label for="stop_input" class="block text-sm font-medium text-gray-700 mb-1">Stop Input</label>
                    <input type="time" id="stop_input" name="stop_input"
                    value="{{ old('stop_input', $item->stop_input ?? '') }}"
                           class="w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm" required>
                </div>
                <div class=" mt-2">
                    <label for="ttl_mc" class="block text-sm font-medium text-gray-700 mb-1">Total MC</label>
                    <input type="number" id="ttl_mc" name="ttl_mc"
                    value="{{ old('ttl_mc', $item->ttl_mc ?? '') }}"
                           class="w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm" required>
                </div>
            </div>
            <div class="grid grid-cols-2 gap-2">
                <div class=" mt-2">
                    <label for="jln_mc" class="block text-sm font-medium text-gray-700 mb-1">Jalan MC</label>
                    <input type="number" id="jln_mc" name="jln_mc"
                    value="{{ old('jln_mc', $item->jln_mc ?? '') }}"
                           class="w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm" required>
                </div>
                <div class=" mt-2">
                    <label for="prod_erp" class="block text-sm font-medium text-gray-700 mb-1">Prod ERP</label>
                    <input type="number" id="prod_erp" name="prod_erp" step="0.01"
                    value="{{ old('prod_erp', $item->prod_erp ?? '') }}"
                           class="w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm" required>
                </div>
            </div>
            <div class=" mt-2">
                <label for="ket" class="block text-sm font-medium text-gray-700 mb-1">Keterangan ERP</label>
                <textarea name="ket" id="ket" cols="30" rows="3"
                          class="w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm" required>{{ old('ket', $item->ket ?? '') }}</textarea>
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
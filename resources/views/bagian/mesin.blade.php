@extends('layouts.app')
@section('title', 'Bagian Mesin')

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
            class="hidden absolute right-0 mt-2 w-48 bg-white border rounded-lg shadow-lg z-50 py-2 animate-fade-in-down">
            <a href="#" class="block px-4 py-2 text-sm text-slate-700 hover:bg-gray-100">Report Mesin</a>
            <a href="#" class="block px-4 py-2 text-sm text-slate-700 hover:bg-gray-100">Report Jam Input ERP</a>
        </div>
    </div>
</li>
@endsection

@section('content')
<div class="w-full px-2 sm:px-4 py-4 sm:py-6 mx-auto space-y-4 sm:space-y-6">
    <div class="bg-white shadow-md rounded-lg">
        <div class="flex justify-between items-center px-6 py-4 border-b">
            <h2 class="text-xl font-bold">User Mesin</h2>
        </div>
        <div class="px-6 py-4">
            <form action="{{ route('mesin.store') }}" method="POST">
                @csrf
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

                <div class="bg-white rounded-lg shadow-lg mt-4">
                    {{-- Header --}}
                    <div class="dark:bg-slate-800 rounded-tl-lg rounded-tr-lg px-6 py-4">
                        <h1 class="text-2xl font-bold text-white">Cross Check QTY</h1>
                    </div>

                    {{-- Main Table --}}
                    <div class="overflow-x-scroll">
                        <table class="w-full">
                            <thead>
                                <tr class="bg-gray-100">
                                    <th class="px-6 py-4 text-left text-sm font-semibold text-gray-900 border-r border-gray-200">
                                        {{-- Module --}}
                                    </th>
                                    <th class="px-6 py-4 text-center text-sm font-semibold text-gray-900 border-r border-gray-200" colspan="1">
                                        <div class="flex items-center justify-center space-x-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-3">
                                                <rect x="3" y="7" width="18" height="10" rx="2" ry="2"></rect>
                                                <path d="M5 11h14"></path>
                                            </svg>
                                            <span>INPUT</span>
                                        </div>
                                    </th>
                                    <th class="px-6 py-4 text-center text-sm font-semibold text-gray-900 border-r border-gray-200" colspan="2">
                                        <div class="flex items-center justify-center space-x-2">
                                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            <span>TIMTER</span>
                                        </div>
                                    </th>
                                    <th class="px-6 py-4 text-center text-sm font-semibold text-gray-900 border-r border-gray-200" colspan="2">
                                        <div class="flex items-center justify-center space-x-2">
                                            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                            </svg>
                                            <span>SUMMARY</span>
                                        </div>
                                    </th>
                                    <th class="px-6 py-4 text-center text-sm font-semibold text-gray-900 border-r border-gray-200" colspan="2">
                                        <div class="flex items-center justify-center space-x-2">
                                            <svg class="w-5 h-5 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                            </svg>
                                            <span>RUNNING</span>
                                        </div>
                                    </th>
                                    <th class="px-6 py-4 text-center text-sm font-semibold text-gray-900" colspan="2">
                                        <div class="flex items-center justify-center space-x-2">
                                            <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                            </svg>
                                            <span>CAPACITY</span>
                                        </div>
                                    </th>
                                    <th class="px-6 py-4 text-center text-sm font-semibold text-gray-900">
                                        Keterangan
                                    </th>
                                </tr>
                                <tr class="bg-gray-50 border-t">
                                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider border-r border-gray-200"></th>
                                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider border-r border-gray-200"></th>
                                    <th class="px-3 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider border-r border-gray-200">Selisih</th>
                                    <th class="px-3 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider border-r border-gray-200">Persamaan</th>
                                    <th class="px-3 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider border-r border-gray-200">Selisih</th>
                                    <th class="px-3 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider border-r border-gray-200">Persamaan</th>
                                    <th class="px-3 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider border-r border-gray-200">Selisih</th>
                                    <th class="px-3 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider border-r border-gray-200">Persamaan</th>
                                    <th class="px-3 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider border-r border-gray-200">Selisih</th>
                                    <th class="px-3 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider border-r border-gray-200">Persamaan</th>
                                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider"></th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                {{-- ERP Row --}}
                                <tr class="hover:bg-gray-50 transition-colors duration-150">
                                    <td class="px-6 py-4 whitespace-nowrap border-r border-gray-200">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10">
                                                <div class="h-10 w-10 rounded-full bg-green-100 flex items-center justify-center">
                                                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                    </svg>
                                                </div>
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">ERP</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-3 py-4 text-center border-r border-gray-200" colspan="1">
                                        <input type="number" name="input_erp" id="input_erp" class="w-full text-center border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm">
                                    </td>
                                    <td class="px-3 py-4 text-center border-r border-gray-200">
                                        <span id="selisih_erp_timter" class="text-sm text-gray-900"></span>
                                    </td>
                                    <td class="px-3 py-4 text-center border-r border-gray-200">
                                        <span id="persamaan_erp_timter" class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                        </span>
                                    </td>
                                    <td class="px-3 py-4 text-center border-r border-gray-200">
                                        <span id="selisih_erp_summary" class="text-sm text-gray-900"></span>
                                    </td>
                                    <td class="px-3 py-4 text-center border-r border-gray-200">
                                        <span id="persamaan_erp_summary" class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        </span>
                                    </td>
                                    <td class="px-3 py-4 text-center border-r border-gray-200">
                                        <span id="selisih_erp_running" class="text-sm text-gray-900"></span>
                                    </td>
                                    <td class="px-3 py-4 text-center border-r border-gray-200">
                                        <span id="persamaan_erp_running" class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <span id="selisih_erp_capacity" class="text-sm text-gray-900">
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <span id="persamaan_erp_capacity" class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        </span>
                                    </td>
                                    <td class="px-3 py-4 text-center border-r border-gray-200" colspan="2">
                                        <textarea name="ket_erp" id="ket_erp" rows="2"></textarea>
                                    </td>
                                </tr>

                                {{-- TIMTER Row --}}
                                <tr class="hover:bg-gray-50 transition-colors duration-150">
                                    <td class="px-6 py-4 whitespace-nowrap border-r border-gray-200">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10">
                                                <div class="h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center">
                                                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                    </svg>
                                                </div>
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">TIMTER</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-3 py-4 text-center border-r border-gray-200" colspan="1">
                                        <input type="number" name="input_timter" id="input_timter" class="w-full text-center border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm">
                                    </td>
                                    <td class="px-3 py-4 text-center border-r border-gray-200">
                                        <!-- Kosongkan -->
                                    </td>
                                    <td class="px-3 py-4 text-center border-r border-gray-200">
                                        <!-- Kosongkan -->
                                    </td>
                                    <td class="px-3 py-4 text-center border-r border-gray-200">
                                        <span id="selisih_timter_summary" class="text-sm text-gray-900"></span>
                                    </td>
                                    <td class="px-3 py-4 text-center border-r border-gray-200">
                                        <span id="persamaan_timter_summary" class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        </span>
                                    </td>
                                    <td class="px-3 py-4 text-center border-r border-gray-200">
                                        <span id="selisih_timter_running" class="text-sm text-gray-900"></span>
                                    </td>
                                    <td class="px-3 py-4 text-center border-r border-gray-200">
                                        <span id="persamaan_timter_running" class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <span id="selisih_timter_capacity" class="text-sm text-gray-900">
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <span id="persamaan_timter_capacity" class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        </span>
                                    </td>
                                    <td class="px-3 py-4 text-center border-r border-gray-200" colspan="2">
                                        <textarea name="ket_timter" id="ket_timter" rows="2"></textarea>
                                    </td>
                                </tr>

                                {{-- SUMMARY Row --}}
                                <tr class="hover:bg-gray-50 transition-colors duration-150">
                                    <td class="px-6 py-4 whitespace-nowrap border-r border-gray-200">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10">
                                                <div class="h-10 w-10 rounded-full bg-yellow-100 flex items-center justify-center">
                                                    <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                                    </svg>
                                                </div>
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">SUMMARY</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-3 py-4 text-center border-r border-gray-200" colspan="1">
                                        <input type="number" name="input_summary" id="input_summary" class="w-full text-center border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm">
                                    </td>
                                    <td class="px-3 py-4 text-center border-r border-gray-200">
                                        <!-- Kosongkan -->
                                    </td>
                                    <td class="px-3 py-4 text-center border-r border-gray-200">
                                        <!-- Kosongkan -->
                                    </td>
                                    <td class="px-3 py-4 text-center border-r border-gray-200">
                                        <!-- Kosongkan -->
                                    </td>
                                    <td class="px-3 py-4 text-center border-r border-gray-200">
                                        <!-- Kosongkan -->
                                    </td>
                                    <td class="px-3 py-4 text-center border-r border-gray-200">
                                        <span id="selisih_summary_running" class="text-sm text-gray-900"></span>
                                    </td>
                                    <td class="px-3 py-4 text-center border-r border-gray-200">
                                        <span id="persamaan_summary_running" class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <span id="selisih_summary_capacity" class="text-sm text-gray-900">
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <span id="persamaan_summary_capacity" class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        </span>
                                    </td>
                                    <td class="px-3 py-4 text-center border-r border-gray-200" colspan="2">
                                        <textarea name="ket_summary" id="ket_summary" rows="2"></textarea>
                                    </td>
                                </tr>

                                {{-- RUNNING Row --}}
                                <tr class="hover:bg-gray-50 transition-colors duration-150">
                                    <td class="px-6 py-4 whitespace-nowrap border-r border-gray-200">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10">
                                                <div class="h-10 w-10 rounded-full bg-green-100 flex items-center justify-center">
                                                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                                    </svg>
                                                </div>
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">RUNNING</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-3 py-4 text-center border-r border-gray-200" colspan="1">
                                        <input type="number" name="input_running" id="input_running" class="w-full text-center border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm">
                                    </td>
                                    <td class="px-3 py-4 text-center border-r border-gray-200">
                                        <!-- Kosongkan -->
                                    </td>
                                    <td class="px-3 py-4 text-center border-r border-gray-200">
                                        <!-- Kosongkan -->
                                    </td>
                                    <td class="px-3 py-4 text-center border-r border-gray-200">
                                        <!-- Kosongkan -->
                                    </td>
                                    <td class="px-3 py-4 text-center border-r border-gray-200">
                                        <!-- Kosongkan -->
                                    </td>
                                    <td class="px-3 py-4 text-center border-r border-gray-200">
                                        <!-- Kosongkan -->
                                    </td>
                                    <td class="px-3 py-4 text-center border-r border-gray-200">
                                        <!-- Kosongkan -->
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <span id="selisih_running_capacity" class="text-sm text-gray-900">
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <span id="persamaan_running_capacity" class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        </span>
                                    </td>
                                    <td class="px-3 py-4 text-center border-r border-gray-200" colspan="2">
                                        <textarea name="ket_running" id="ket_running" rows="2"></textarea>
                                    </td>
                                </tr>

                                {{-- APK CAPACITY Row --}}
                                <tr class="hover:bg-gray-50 transition-colors duration-150">
                                    <td class="px-6 py-4 whitespace-nowrap border-r border-gray-200">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10">
                                                <div class="h-10 w-10 rounded-full bg-purple-100 flex items-center justify-center">
                                                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                                    </svg>
                                                </div>
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">CAPACITY</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-3 py-4 text-center border-r border-gray-200" colspan="1">
                                        <input type="number" name="input_capacity" id="input_capacity" class="w-full text-center border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm">
                                    </td>
                                    <td class="px-3 py-4 text-center border-r border-gray-200">
                                        <!-- Kosongkan -->
                                    </td>
                                    <td class="px-3 py-4 text-center border-r border-gray-200">
                                        <!-- Kosongkan -->
                                    </td>
                                    <td class="px-3 py-4 text-center border-r border-gray-200">
                                        <!-- Kosongkan -->
                                    </td>
                                    <td class="px-3 py-4 text-center border-r border-gray-200">
                                        <!-- Kosongkan -->
                                    </td>
                                    <td class="px-3 py-4 text-center border-r border-gray-200">
                                        <!-- Kosongkan -->
                                    </td>
                                    <td class="px-3 py-4 text-center border-r border-gray-200">
                                        <!-- Kosongkan -->
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <!-- Kosongkan -->
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <!-- Kosongkan -->
                                    </td>
                                    <td class="px-3 py-4 text-center border-r border-gray-200" colspan="2">
                                        <textarea name="ket_capacity" id="ket_capacity" rows="2"></textarea>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <h4 class="font-semibold text-slate-900 mt-4">Reject & Rework ERP</h4>
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

@include('layouts.footer')
@endsection

@push('scripts')
<script>
    const toggleBtn = document.getElementById('dropdownToggle');
    const dropdown = document.getElementById('dropdownMenu');

    document.addEventListener('click', function(e) {
        if (toggleBtn.contains(e.target)) {
            dropdown.classList.toggle('hidden');
        } else if (!dropdown.contains(e.target)) {
            dropdown.classList.add('hidden');
        }
    });
</script>
<script>
    const erpInput      = document.getElementById('input_erp');
    const timterInput   = document.getElementById('input_timter');
    const summaryInput  = document.getElementById('input_summary');
    const runningInput  = document.getElementById('input_running');
    const capacityInput = document.getElementById('input_capacity');

    const selisihErpTimter   = document.getElementById('selisih_erp_timter');
    const selisihErpSummary  = document.getElementById('selisih_erp_summary');
    const selisihErpRunning  = document.getElementById('selisih_erp_running');
    const selisihErpCapacity = document.getElementById('selisih_erp_capacity');
    const selisihTimterSummary = document.getElementById('selisih_timter_summary');
    const selisihTimterRunning = document.getElementById('selisih_timter_running');
    const selisihTimterCapacity = document.getElementById('selisih_timter_capacity');
    const selisihSummaryRunning = document.getElementById('selisih_summary_running');
    const selisihSummaryCapacity = document.getElementById('selisih_summary_capacity');
    const selisihRunningCapacity = document.getElementById('selisih_running_capacity');

    const persamaanErpTimter   = document.getElementById('persamaan_erp_timter');
    const persamaanErpSummary  = document.getElementById('persamaan_erp_summary');
    const persamaanErpRunning  = document.getElementById('persamaan_erp_running');
    const persamaanErpCapacity = document.getElementById('persamaan_erp_capacity');
    const persamaanTimterSummary = document.getElementById('persamaan_timter_summary');
    const persamaanTimterRunning = document.getElementById('persamaan_timter_running');
    const persamaanTimterCapacity = document.getElementById('persamaan_timter_capacity');
    const persamaanSummaryRunning = document.getElementById('persamaan_summary_running');
    const persamaanSummaryCapacity = document.getElementById('persamaan_summary_capacity');
    const persamaanRunningCapacity = document.getElementById('persamaan_running_capacity');
  
    function updateErpTimter() {
      const erp    = erpInput.value.trim();
      const timter = timterInput.value.trim();
  
      if (!erp || !timter) {
        selisihErpTimter.textContent   = '';
        persamaanErpTimter.textContent = '';
        return;
      }

      const selisih   = timter - erp;
      const persen    = (timter !== 0) ? (erp / timter * 100) : 0;
  
      selisihErpTimter.textContent    = selisih;
      persamaanErpTimter.textContent = persen.toFixed(2) + '%';
      applyColor(persamaanErpTimter, Math.round(persen));
    }

    function updateErpSummary() {
      const erp    = erpInput.value.trim();
      const summary = summaryInput.value.trim();
  
      if (!erp || !summary) {
        selisihErpSummary.textContent   = '';
        persamaanErpSummary.textContent = '';
        return;
      }

      const selisih   = summary - erp;
      const persen    = (summary !== 0) ? (erp / summary * 100) : 0;
  
      selisihErpSummary.textContent    = selisih;
      persamaanErpSummary.textContent = persen.toFixed(2) + '%';
      applyColor(persamaanErpSummary, Math.round(persen));
    }

    function updateErpRunning() {
      const erp    = erpInput.value.trim();
      const running = runningInput.value.trim();
  
      if (!erp || !running) {
        selisihErpRunning.textContent   = '';
        persamaanErpRunning.textContent = '';
        return;
      }

      const selisih   = running - erp;
      const persen    = (running !== 0) ? (erp / running * 100) : 0;
  
      selisihErpRunning.textContent    = selisih;
      persamaanErpRunning.textContent = persen.toFixed(2) + '%';
      applyColor(persamaanErpRunning, Math.round(persen));
    }

    function updateErpCapacity() {
      const erp    = erpInput.value.trim();
      const capacity = capacityInput.value.trim();
  
      if (!erp || !capacity) {
        selisihErpCapacity.textContent   = '';
        persamaanErpCapacity.textContent = '';
        return;
      }

      const selisih   = capacity - erp;
      const persen    = (capacity !== 0) ? (erp / capacity * 100) : 0;
  
      selisihErpCapacity.textContent    = selisih;
      persamaanErpCapacity.textContent = persen.toFixed(2) + '%';
      applyColor(persamaanErpCapacity, Math.round(persen));
    }

    function updateTimterSummary() {
      const timter    = timterInput.value.trim();
      const summary   = summaryInput.value.trim();
  
      if (!timter || !summary) {
        selisihTimterSummary.textContent   = '';
        persamaanTimterSummary.textContent = '';
        return;
      }

      const selisih   = summary - timter;
      const persen    = (summary !== 0) ? (timter / summary * 100) : 0;
  
      selisihTimterSummary.textContent    = selisih;
      persamaanTimterSummary.textContent  = persen.toFixed(2) + '%';
      applyColor(persamaanTimterSummary, Math.round(persen));
    }

    function updateTimterRunning() {
      const timter    = timterInput.value.trim();
      const running   = runningInput.value.trim();
  
      if (!timter || !running) {
        selisihTimterRunning.textContent   = '';
        persamaanTimterRunning.textContent = '';
        return;
      }

      const selisih   = running - timter;
      const persen    = (running !== 0) ? (timter / running * 100) : 0;
  
      selisihTimterRunning.textContent    = selisih;
      persamaanTimterRunning.textContent  = persen.toFixed(2) + '%';
      applyColor(persamaanTimterRunning, Math.round(persen));
    }

    function updateTimterCapacity() {
      const timter    = timterInput.value.trim();
      const capacity   = capacityInput.value.trim();
  
      if (!timter || !capacity) {
        selisihTimterCapacity.textContent   = '';
        persamaanTimterCapacity.textContent = '';
        return;
      }

      const selisih   = capacity - timter;
      const persen    = (capacity !== 0) ? (timter / capacity * 100) : 0;
  
      selisihTimterCapacity.textContent    = selisih;
      persamaanTimterCapacity.textContent  = persen.toFixed(2) + '%';
      applyColor(persamaanTimterCapacity, Math.round(persen));
    }
    function updateSummaryRunning() {
      const summary   = summaryInput.value.trim();
      const running   = runningInput.value.trim();
  
      if (!summary || !running) {
        selisihSummaryRunning.textContent   = '';
        persamaanSummaryRunning.textContent = '';
        return;
      }

      const selisih   = running - summary;
      const persen    = (running !== 0) ? (summary / running * 100) : 0;
  
      selisihSummaryRunning.textContent    = selisih;
      persamaanSummaryRunning.textContent  = persen.toFixed(2) + '%';
      applyColor(persamaanSummaryRunning, Math.round(persen));
    }

    function updateSummaryCapacity() {
      const summary   = summaryInput.value.trim();
      const capacity   = capacityInput.value.trim();
  
      if (!summary || !capacity) {
        selisihSummaryCapacity.textContent   = '';
        persamaanSummaryCapacity.textContent = '';
        return;
      }

      const selisih   = capacity - summary;
      const persen    = (capacity !== 0) ? (summary / capacity * 100) : 0;
  
      selisihSummaryCapacity.textContent    = selisih;
      persamaanSummaryCapacity.textContent  = persen.toFixed(2) + '%';
      applyColor(persamaanSummaryCapacity, Math.round(persen));
    }

    function updateRunningCapacity() {
      const running   = runningInput.value.trim();
      const capacity   = capacityInput.value.trim();
  
      if (!running || !capacity) {
        selisihRunningCapacity.textContent   = '';
        persamaanRunningCapacity.textContent = '';
        return;
      }

      const selisih   = capacity - running;
      const persen    = (capacity !== 0) ? (running / capacity * 100) : 0;
  
      selisihRunningCapacity.textContent    = selisih;
      persamaanRunningCapacity.textContent  = persen.toFixed(2) + '%';
      applyColor(persamaanRunningCapacity, Math.round(persen));
    }
  
    function applyColor(span, persen) {
    // Hapus dulu semua kelas warna Tailwind yang lama
    span.classList.remove(
        'bg-gray-200','text-gray-800',
        'bg-red-100','text-red-800',
        'bg-yellow-100','text-yellow-800',
        'bg-green-100','text-green-800'
    );

    if (persen <= -1) {
        // <= -1% → abu
        span.classList.add('bg-gray-200','text-gray-800');
    }
    else if (persen >= 1 && persen <= 50) {
        // 1–50% → merah
        span.classList.add('bg-red-100','text-red-800');
    }
    else if (persen >= 51 && persen <= 99) {
        // 51–99% → kuning
        span.classList.add('bg-yellow-100','text-yellow-800');
    }
    else if (persen === 100) {
        // 100% → hijau
        span.classList.add('bg-green-100','text-green-800');
    }
    else if (persen >= 101) {
        // >=101% → abu lagi
        span.classList.add('bg-gray-200','text-gray-800');
    }
    // selain itu (0% atau NaN), biarkan tanpa warna
    }

    //Pasang event listener agar fungsi dipanggil setiap input berubah
    erpInput.addEventListener('input', updateErpTimter);
    erpInput.addEventListener('input', updateErpSummary);
    erpInput.addEventListener('input', updateErpRunning);
    erpInput.addEventListener('input', updateErpCapacity);

    timterInput.addEventListener('input', updateErpTimter);
    timterInput.addEventListener('input', updateTimterSummary);
    timterInput.addEventListener('input', updateTimterRunning);
    timterInput.addEventListener('input', updateTimterCapacity);

    summaryInput.addEventListener('input', updateErpSummary);
    summaryInput.addEventListener('input', updateTimterSummary);
    summaryInput.addEventListener('input', updateSummaryRunning);
    summaryInput.addEventListener('input', updateSummaryCapacity);

    runningInput.addEventListener('input', updateErpRunning);
    runningInput.addEventListener('input', updateTimterRunning);
    runningInput.addEventListener('input', updateSummaryRunning);
    runningInput.addEventListener('input', updateRunningCapacity);
    
    capacityInput.addEventListener('input', updateErpCapacity);
    capacityInput.addEventListener('input', updateTimterCapacity);
    capacityInput.addEventListener('input', updateSummaryCapacity);
    capacityInput.addEventListener('input', updateRunningCapacity);
</script>
  
@endpush
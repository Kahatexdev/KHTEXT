@extends('layouts.app')
@section('title', 'Bagian Mesin')

@section('content')
<div class="w-full px-2 sm:px-4 py-4 sm:py-6 mx-auto space-y-4 sm:space-y-6">
    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <div class="flex justify-between items-center px-6 py-4 border-b">
            <h2 class="text-xl font-bold">User Mesin</h2>
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

                <div class="bg-white rounded-lg shadow-lg overflow-hidden mt-4">
                    {{-- Header --}}
                    <div class="bg-gradient-to-r from-dark-600 to-dark-700 px-6 py-4">
                        <h1 class="text-2xl font-bold text-white">Cross Check QTY</h1>
                    </div>
            
                    {{-- Main Table --}}
                    <div class="overflow-x-auto">
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
                                        <span class="text-sm text-gray-900">-50</span>
                                    </td>
                                    <td class="px-3 py-4 text-center border-r border-gray-200">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                            200.00%
                                        </span>
                                    </td>
                                    <td class="px-3 py-4 text-center border-r border-gray-200">
                                        <span class="text-sm text-gray-900">0</span>
                                    </td>
                                    <td class="px-3 py-4 text-center border-r border-gray-200">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            100.00%
                                        </span>
                                    </td>
                                    <td class="px-3 py-4 text-center border-r border-gray-200">
                                        <span class="text-sm text-gray-900">0</span>
                                    </td>
                                    <td class="px-3 py-4 text-center border-r border-gray-200">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            100.00%
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <span class="text-sm text-gray-900">
                                           0
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <span class="text-sm text-gray-900">
                                           0
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
                                        <span class="text-sm text-gray-900">-50</span>
                                    </td>
                                    <td class="px-3 py-4 text-center border-r border-gray-200">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                            200.00%
                                        </span>
                                    </td>
                                    <td class="px-3 py-4 text-center border-r border-gray-200">
                                        <span class="text-sm text-gray-900">0</span>
                                    </td>
                                    <td class="px-3 py-4 text-center border-r border-gray-200">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            100.00%
                                        </span>
                                    </td>
                                    <td class="px-3 py-4 text-center border-r border-gray-200">
                                        <span class="text-sm text-gray-900">0</span>
                                    </td>
                                    <td class="px-3 py-4 text-center border-r border-gray-200">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            100.00%
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <span class="text-sm text-gray-900">
                                            0
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <span class="text-sm text-gray-900">
                                            0
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
                                        <input type="number" name="input_timter" id="input_timter" class="w-full text-center border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm">
                                    </td>
                                    <td class="px-3 py-4 text-center border-r border-gray-200">
                                        <span class="text-sm text-gray-900">50</span>
                                    </td>
                                    <td class="px-3 py-4 text-center border-r border-gray-200">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                            50.00%
                                        </span>
                                    </td>
                                    <td class="px-3 py-4 text-center border-r border-gray-200">
                                        <span class="text-sm text-gray-900">50</span>
                                    </td>
                                    <td class="px-3 py-4 text-center border-r border-gray-200">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                            50.00%
                                        </span>
                                    </td>
                                    <td class="px-3 py-4 text-center border-r border-gray-200">
                                        <span class="text-sm text-gray-900">0</span>
                                    </td>
                                    <td class="px-3 py-4 text-center border-r border-gray-200">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            100.00%
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <span class="text-sm text-gray-900">
                                            0
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <span class="text-sm text-gray-900">
                                            0
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
                                        <input type="number" name="input_timter" id="input_timter" class="w-full text-center border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm">
                                    </td>
                                    <td class="px-3 py-4 text-center border-r border-gray-200">
                                        <span class="text-sm text-gray-900">50</span>
                                    </td>
                                    <td class="px-3 py-4 text-center border-r border-gray-200">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                            50.00%
                                        </span>
                                    </td>
                                    <td class="px-3 py-4 text-center border-r border-gray-200">
                                        <span class="text-sm text-gray-900">50</span>
                                    </td>
                                    <td class="px-3 py-4 text-center border-r border-gray-200">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                            50.00%
                                        </span>
                                    </td>
                                    <td class="px-3 py-4 text-center border-r border-gray-200">
                                        <span class="text-sm text-gray-900">0</span>
                                    </td>
                                    <td class="px-3 py-4 text-center border-r border-gray-200">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            100.00%
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <span class="text-sm text-gray-900">
                                            0
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <span class="text-sm text-gray-900">
                                            0
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
                                        <input type="number" name="input_timter" id="input_timter" class="w-full text-center border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm">
                                    </td>
                                    <td class="px-3 py-4 text-center border-r border-gray-200">
                                        <span class="text-sm text-gray-900">50</span>
                                    </td>
                                    <td class="px-3 py-4 text-center border-r border-gray-200">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                            50.00%
                                        </span>
                                    </td>
                                    <td class="px-3 py-4 text-center border-r border-gray-200">
                                        <span class="text-sm text-gray-900">50</span>
                                    </td>
                                    <td class="px-3 py-4 text-center border-r border-gray-200">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                            50.00%
                                        </span>
                                    </td>
                                    <td class="px-3 py-4 text-center border-r border-gray-200">
                                        <span class="text-sm text-gray-900">0</span>
                                    </td>
                                    <td class="px-3 py-4 text-center border-r border-gray-200">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            100.00%
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <span class="text-sm text-gray-900">
                                            0
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <span class="text-sm text-gray-900">
                                            0
                                        </span>
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


@include('layouts.footer')
@endsection
@push('styles')
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
    @endpush
@push('scripts')
@endpush
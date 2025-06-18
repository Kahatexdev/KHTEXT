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
                    <label for="total_mc" class="block text-sm font-medium text-gray-700 mb-1">Total MC</label>
                    <input type="text" id="total_mc" name="total_mc"
                           class="w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm" required>
                </div>
            </div>
            <div class="grid grid-cols-2 gap-2">
                <div class=" mt-2">
                    <label for="jalan_mc" class="block text-sm font-medium text-gray-700 mb-1">Jalan MC</label>
                    <input type="text" id="jalan_mc" name="jalan_mc"
                           class="w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm" required>
                </div>
                <div class=" mt-2">
                    <label for="prod_erp" class="block text-sm font-medium text-gray-700 mb-1">Prod ERP</label>
                    <input type="text" id="prod_erp" name="prod_erp"
                           class="w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm" required>
                </div>
            </div>
            <div class=" mt-2">
                <label for="keterangan_erp" class="block text-sm font-medium text-gray-700 mb-1">Keterangan ERP</label>
                <textarea name="keterangan_erp" id="keterangan_erp" cols="30" rows="3"
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
@endpush
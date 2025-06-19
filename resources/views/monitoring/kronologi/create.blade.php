{{-- resources/views/formulir/barang.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
    <div class="bg-white shadow-lg rounded-lg">
        {{-- Header --}}
        <div class="bg-blue-600 text-white px-6 py-4 rounded-t-lg">
            <div class="flex justify-between items-center">
                <div class="flex items-center space-x-4">
                    <div class="w-12 h-12 bg-white rounded-full flex items-center justify-center">
                        <span class="text-blue-600 font-bold text-sm">LOGO</span>
                    </div>
                    <div>
                        <h1 class="text-xl font-bold">PT. KAHATEX</h1>
                        <p class="text-sm opacity-90">FORMULIR DEPARTEMEN KAOS KAKI</p>
                        <p class="text-sm opacity-90">KRONOLOGI KESALAHAN DATA FRP</p>
                    </div>
                </div>
                <div class="text-right">
                    <p class="text-sm">Tanggal Revisi: {{ date('d M Y') }}</p>
                    <p class="text-sm">Klasifikasi: Internal</p>
                </div>
            </div>
        </div>

        <form action="" method="POST" class="p-6">
            @csrf
            
            {{-- Document Info --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">No. Dokumen</label>
                    <input type="text" name="no_dokumen" value="FOR-KK-550/REV_01/HAL_1.1" 
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Nama User</label>
                    <input type="text" name="nama_user" 
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>
            </div>

            {{-- Main Data Section --}}
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                
                {{-- Data Barang Salah --}}
                <div class="bg-gray-50 p-6 rounded-lg">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4 text-center bg-blue-100 py-2 rounded">
                        DATA BARANG SALAH
                    </h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal</label>
                            <input type="date" name="tanggal_salah" 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">WIP</label>
                            <select name="wip_salah" 
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm">
                                <option value="">Pilih WIP</option>
                                <option value="SETTING">SETTING</option>
                                <option value="PRODUKSI">PRODUKSI</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Area</label>
                            <input type="text" name="area_salah" placeholder="KK1A" 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm">
                        </div>
                    </div>

                    <div class="space-y-4" id="barang-salah-container">
                        <div class="barang-salah-item bg-white p-4 rounded border">
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-3 mb-3">
                                <div>
                                    <label class="block text-xs font-medium text-gray-600 mb-1">No. Model</label>
                                    <input type="text" name="barang_salah[0][no_model]" 
                                           class="w-full px-2 py-1 border border-gray-300 rounded text-sm focus:outline-none focus:ring-1 focus:ring-blue-500">
                                </div>
                                <div>
                                    <label class="block text-xs font-medium text-gray-600 mb-1">Style</label>
                                    <input type="text" name="barang_salah[0][style]" 
                                           class="w-full px-2 py-1 border border-gray-300 rounded text-sm focus:outline-none focus:ring-1 focus:ring-blue-500">
                                </div>
                                <div>
                                    <label class="block text-xs font-medium text-gray-600 mb-1">Label</label>
                                    <input type="text" name="barang_salah[0][label]" 
                                           class="w-full px-2 py-1 border border-gray-300 rounded text-sm focus:outline-none focus:ring-1 focus:ring-blue-500">
                                </div>
                                <div>
                                    <label class="block text-xs font-medium text-gray-600 mb-1">No. MC</label>
                                    <input type="text" name="barang_salah[0][no_mc]" 
                                           class="w-full px-2 py-1 border border-gray-300 rounded text-sm focus:outline-none focus:ring-1 focus:ring-blue-500">
                                </div>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                <div>
                                    <label class="block text-xs font-medium text-gray-600 mb-1">KRJ</label>
                                    <input type="text" name="barang_salah[0][krj]" 
                                           class="w-full px-2 py-1 border border-gray-300 rounded text-sm focus:outline-none focus:ring-1 focus:ring-blue-500">
                                </div>
                                <div>
                                    <label class="block text-xs font-medium text-gray-600 mb-1">QTY</label>
                                    <input type="number" name="barang_salah[0][qty]" 
                                           class="w-full px-2 py-1 border border-gray-300 rounded text-sm focus:outline-none focus:ring-1 focus:ring-blue-500">
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <button type="button" onclick="addBarangSalah()" 
                            class="mt-3 w-full bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600 transition duration-200 text-sm font-medium">
                        + Tambah Data Barang Salah
                    </button>
                </div>

                {{-- Data Barang Benar --}}
                <div class="bg-gray-50 p-6 rounded-lg">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4 text-center bg-green-100 py-2 rounded">
                        DATA BARANG BENAR
                    </h3>
                    
                    <div class="space-y-4" id="barang-benar-container">
                        <div class="barang-benar-item bg-white p-4 rounded border">
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-3 mb-3">
                                <div>
                                    <label class="block text-xs font-medium text-gray-600 mb-1">No. Model</label>
                                    <input type="text" name="barang_benar[0][no_model]" 
                                           class="w-full px-2 py-1 border border-gray-300 rounded text-sm focus:outline-none focus:ring-1 focus:ring-blue-500">
                                </div>
                                <div>
                                    <label class="block text-xs font-medium text-gray-600 mb-1">Style</label>
                                    <input type="text" name="barang_benar[0][style]" 
                                           class="w-full px-2 py-1 border border-gray-300 rounded text-sm focus:outline-none focus:ring-1 focus:ring-blue-500">
                                </div>
                                <div>
                                    <label class="block text-xs font-medium text-gray-600 mb-1">Label</label>
                                    <input type="text" name="barang_benar[0][label]" 
                                           class="w-full px-2 py-1 border border-gray-300 rounded text-sm focus:outline-none focus:ring-1 focus:ring-blue-500">
                                </div>
                                <div>
                                    <label class="block text-xs font-medium text-gray-600 mb-1">No. MC</label>
                                    <input type="text" name="barang_benar[0][no_mc]" 
                                           class="w-full px-2 py-1 border border-gray-300 rounded text-sm focus:outline-none focus:ring-1 focus:ring-blue-500">
                                </div>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                <div>
                                    <label class="block text-xs font-medium text-gray-600 mb-1">KRJ</label>
                                    <input type="text" name="barang_benar[0][krj]" 
                                           class="w-full px-2 py-1 border border-gray-300 rounded text-sm focus:outline-none focus:ring-1 focus:ring-blue-500">
                                </div>
                                <div>
                                    <label class="block text-xs font-medium text-gray-600 mb-1">QTY</label>
                                    <input type="number" name="barang_benar[0][qty]" 
                                           class="w-full px-2 py-1 border border-gray-300 rounded text-sm focus:outline-none focus:ring-1 focus:ring-blue-500">
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <button type="button" onclick="addBarangBenar()" 
                            class="mt-3 w-full bg-green-500 text-white py-2 px-4 rounded hover:bg-green-600 transition duration-200 text-sm font-medium">
                        + Tambah Data Barang Benar
                    </button>
                </div>
            </div>

            {{-- Additional Info Section --}}
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mt-8">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Kategori</label>
                    <select name="kategori" 
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <option value="">Pilih Kategori</option>
                        <option value="Salah Storage">Salah Storage</option>
                        <option value="Salah Input">Salah Input</option>
                        <option value="Salah Proses">Salah Proses</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Keterangan</label>
                    <textarea name="keterangan" rows="3" 
                              class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                              placeholder="Masukkan keterangan..."></textarea>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Keterangan Maintenance</label>
                    <textarea name="keterangan_maintenance" rows="3" 
                              class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                              placeholder="Masukkan keterangan maintenance..."></textarea>
                </div>
            </div>

            <div class="mt-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">Username</label>
                <input type="text" name="username" 
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            </div>

            {{-- Submit Buttons --}}
            <div class="flex justify-end space-x-4 mt-8 pt-6 border-t border-gray-200">
                <button type="button" 
                        class="px-6 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50 transition duration-200">
                    Cancel
                </button>
                <button type="submit" 
                        class="px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition duration-200 font-medium">
                    Simpan Data
                </button>
            </div>
        </form>
    </div>
</div>

<script>
let barangSalahIndex = 1;
let barangBenarIndex = 1;

function addBarangSalah() {
    const container = document.getElementById('barang-salah-container');
    const newItem = document.createElement('div');
    newItem.className = 'barang-salah-item bg-white p-4 rounded border';
    newItem.innerHTML = `
        <div class="flex justify-between items-center mb-3">
            <span class="text-sm font-medium text-gray-600">Item ${barangSalahIndex + 1}</span>
            <button type="button" onclick="removeItem(this)" class="text-red-500 hover:text-red-700">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-3 mb-3">
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">No. Model</label>
                <input type="text" name="barang_salah[${barangSalahIndex}][no_model]" 
                       class="w-full px-2 py-1 border border-gray-300 rounded text-sm focus:outline-none focus:ring-1 focus:ring-blue-500">
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Style</label>
                <input type="text" name="barang_salah[${barangSalahIndex}][style]" 
                       class="w-full px-2 py-1 border border-gray-300 rounded text-sm focus:outline-none focus:ring-1 focus:ring-blue-500">
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Label</label>
                <input type="text" name="barang_salah[${barangSalahIndex}][label]" 
                       class="w-full px-2 py-1 border border-gray-300 rounded text-sm focus:outline-none focus:ring-1 focus:ring-blue-500">
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">No. MC</label>
                <input type="text" name="barang_salah[${barangSalahIndex}][no_mc]" 
                       class="w-full px-2 py-1 border border-gray-300 rounded text-sm focus:outline-none focus:ring-1 focus:ring-blue-500">
            </div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">KRJ</label>
                <input type="text" name="barang_salah[${barangSalahIndex}][krj]" 
                       class="w-full px-2 py-1 border border-gray-300 rounded text-sm focus:outline-none focus:ring-1 focus:ring-blue-500">
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">QTY</label>
                <input type="number" name="barang_salah[${barangSalahIndex}][qty]" 
                       class="w-full px-2 py-1 border border-gray-300 rounded text-sm focus:outline-none focus:ring-1 focus:ring-blue-500">
            </div>
        </div>
    `;
    container.appendChild(newItem);
    barangSalahIndex++;
}

function addBarangBenar() {
    const container = document.getElementById('barang-benar-container');
    const newItem = document.createElement('div');
    newItem.className = 'barang-benar-item bg-white p-4 rounded border';
    newItem.innerHTML = `
        <div class="flex justify-between items-center mb-3">
            <span class="text-sm font-medium text-gray-600">Item ${barangBenarIndex + 1}</span>
            <button type="button" onclick="removeItem(this)" class="text-red-500 hover:text-red-700">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-3 mb-3">
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">No. Model</label>
                <input type="text" name="barang_benar[${barangBenarIndex}][no_model]" 
                       class="w-full px-2 py-1 border border-gray-300 rounded text-sm focus:outline-none focus:ring-1 focus:ring-blue-500">
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Style</label>
                <input type="text" name="barang_benar[${barangBenarIndex}][style]" 
                       class="w-full px-2 py-1 border border-gray-300 rounded text-sm focus:outline-none focus:ring-1 focus:ring-blue-500">
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Label</label>
                <input type="text" name="barang_benar[${barangBenarIndex}][label]" 
                       class="w-full px-2 py-1 border border-gray-300 rounded text-sm focus:outline-none focus:ring-1 focus:ring-blue-500">
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">No. MC</label>
                <input type="text" name="barang_benar[${barangBenarIndex}][no_mc]" 
                       class="w-full px-2 py-1 border border-gray-300 rounded text-sm focus:outline-none focus:ring-1 focus:ring-blue-500">
            </div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">KRJ</label>
                <input type="text" name="barang_benar[${barangBenarIndex}][krj]" 
                       class="w-full px-2 py-1 border border-gray-300 rounded text-sm focus:outline-none focus:ring-1 focus:ring-blue-500">
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">QTY</label>
                <input type="number" name="barang_benar[${barangBenarIndex}][qty]" 
                       class="w-full px-2 py-1 border border-gray-300 rounded text-sm focus:outline-none focus:ring-1 focus:ring-blue-500">
            </div>
        </div>
    `;
    container.appendChild(newItem);
    barangBenarIndex++;
}

function removeItem(button) {
    button.closest('.barang-salah-item, .barang-benar-item').remove();
}
</script>
@endsection
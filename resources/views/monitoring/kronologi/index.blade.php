{{-- resources/views/monitoring/kronologi/index.blade.php --}}
@extends('layouts.app')
@section('title', 'Kronologi Kesalahan ERP')
@section('page-title', 'Kronologi')

@section('content')
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-4 sm:py-6 space-y-4 sm:space-y-6">
        {{-- Alert Messages --}}
        @if (session('success'))
            <div
                class="bg-green-100 border border-green-200 text-green-800 px-3 sm:px-4 py-2 sm:py-3 rounded text-sm sm:text-base">
                {{ session('success') }}
            </div>
        @endif

        {{-- Import Card --}}
        <div class="bg-white p-4 sm:p-6 rounded-lg shadow-md">
            <h2 class="text-xl sm:text-2xl font-semibold mb-3 sm:mb-4">Import Kronologi Kesalahan ERP</h2>
            <form action="{{ route('import.kronologi.process') }}" method="POST" enctype="multipart/form-data"
                class="space-y-4">
                @csrf
                <div class="flex flex-col sm:flex-row sm:items-end space-y-4 sm:space-y-0 sm:space-x-4">
                    <label for="file" class="flex-1">
                        <span class="block mb-1 font-medium text-sm sm:text-base">Pilih file Excel</span>
                        <div class="relative">
                            <input type="file" name="file" id="file"
                                class="opacity-0 absolute inset-0 w-full h-full cursor-pointer" />
                            <div
                                class="border border-gray-300 rounded-lg px-3 sm:px-4 py-2 bg-gray-50 hover:bg-gray-100 cursor-pointer transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="inline-block w-4 h-4 sm:w-5 sm:h-5 mr-2 text-blue-600" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 16v1a2 2 0 002 2h12a2 2 0 002-2v-1M12 12V3m0 0L8 7m4-4l4 4" />
                                </svg>
                                <span class="text-sm sm:text-base">Pilih file...</span>
                            </div>
                        </div>
                        @error('file')
                            <span class="text-red-600 text-xs sm:text-sm mt-1 block">{{ $message }}</span>
                        @enderror
                    </label>
                    <button type="submit"
                        class="w-full sm:w-auto bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 sm:px-6 py-2 rounded-lg shadow transition-colors text-sm sm:text-base">
                        Upload & Import
                    </button>
                </div>
            </form>
        </div>

        {{-- Data Table Card --}}
        @if (isset($kronologi) && $kronologi->count())
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <div class="p-4 sm:p-6 border-b border-gray-200">
                    <h2 class="text-xl sm:text-2xl font-semibold">Daftar Kronologi</h2>
                </div>

                {{-- Mobile Card View --}}
                <div class="block sm:hidden">
                    @foreach ($kronologi as $index => $item)
                        <div class="border-b border-gray-200 p-4 space-y-3">
                            <div class="flex justify-between items-start">
                                <span class="text-sm font-medium text-gray-900">#{{ $index + 1 }}</span>
                                <div class="flex space-x-2">
                                    <button type="button"
                                        class="edit-button px-2 py-1 bg-blue-500 text-white rounded text-xs"
                                        data-id="{{ $item->id }}" data-tanggal="{{ $item->tanggal }}"
                                        data-wip="{{ $item->wip }}" data-area="{{ $item->area }}"
                                        data-no_model_salah="{{ $item->no_model_salah }}"
                                        data-style_salah="{{ $item->style_salah }}" data-kategori="{{ $item->kategori }}"
                                        data-keterangan="{{ $item->keterangan }}"
                                        data-keterangan_maintenance="{{ $item->keterangan_maintenance }}"
                                        data-username="{{ $item->username }}">Edit</button>
                                    <button type="button"
                                        class="delete-button px-2 py-1 bg-red-500 text-white rounded text-xs"
                                        data-id="{{ $item->id }}">Hapus</button>
                                </div>
                            </div>
                            <div class="grid grid-cols-1 gap-2 text-sm">
                                <div><span class="font-medium text-gray-700">Tanggal:</span> <span
                                        class="text-gray-600">{{ $item->tanggal }}</span></div>
                                <div><span class="font-medium text-gray-700">WIP:</span> <span
                                        class="text-gray-600">{{ $item->wip }}</span></div>
                                <div><span class="font-medium text-gray-700">Area:</span> <span
                                        class="text-gray-600">{{ $item->area }}</span></div>
                                <div><span class="font-medium text-gray-700">PDK Fail:</span> <span
                                        class="text-gray-600">{{ $item->no_model_salah }}</span></div>
                                <div><span class="font-medium text-gray-700">Style Fail:</span> <span
                                        class="text-gray-600">{{ $item->style_salah }}</span></div>
                                <div><span class="font-medium text-gray-700">Kategori:</span> <span
                                        class="text-gray-600">{{ $item->kategori }}</span></div>
                                @if ($item->keterangan)
                                    <div><span class="font-medium text-gray-700">Keterangan:</span> <span
                                            class="text-gray-600">{{ Str::limit($item->keterangan, 50) }}</span></div>
                                @endif
                                @if ($item->keterangan_maintenance)
                                    <div><span class="font-medium text-gray-700">Ket Maintenance:</span> <span
                                            class="text-gray-600">{{ Str::limit($item->keterangan_maintenance, 50) }}</span>
                                    </div>
                                @endif
                                <div><span class="font-medium text-gray-700">User ERP:</span> <span
                                        class="text-gray-600">{{ $item->username }}</span></div>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- Desktop Table View --}}
                <div class="hidden sm:block overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th
                                    class="px-3 lg:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    No.</th>
                                <th
                                    class="px-3 lg:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Tanggal</th>
                                <th
                                    class="px-3 lg:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    WIP</th>
                                <th
                                    class="px-3 lg:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Area</th>
                                <th
                                    class="px-3 lg:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    PDK Fail</th>
                                <th
                                    class="px-3 lg:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Style Fail</th>
                                <th
                                    class="px-3 lg:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Kategori</th>
                                <th
                                    class="px-3 lg:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider hidden lg:table-cell">
                                    Keterangan</th>
                                <th
                                    class="px-3 lg:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider hidden lg:table-cell">
                                    Ket Maintenance</th>
                                <th
                                    class="px-3 lg:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    User ERP</th>
                                <th
                                    class="px-3 lg:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($kronologi as $index => $item)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-3 lg:px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $index + 1 }}</td>
                                    <td class="px-3 lg:px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $item->tanggal }}</td>
                                    <td class="px-3 lg:px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $item->wip }}</td>
                                    <td class="px-3 lg:px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $item->area }}</td>
                                    <td class="px-3 lg:px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $item->no_model_salah }}</td>
                                    <td class="px-3 lg:px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $item->style_salah }}</td>
                                    <td class="px-3 lg:px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $item->kategori }}</td>
                                    <td class="px-3 lg:px-6 py-4 text-sm text-gray-900 hidden lg:table-cell">
                                        <div class="max-w-xs truncate" title="{{ $item->keterangan }}">
                                            {{ $item->keterangan }}</div>
                                    </td>
                                    <td class="px-3 lg:px-6 py-4 text-sm text-gray-900 hidden lg:table-cell">
                                        <div class="max-w-xs truncate" title="{{ $item->keterangan_maintenance }}">
                                            {{ $item->keterangan_maintenance }}</div>
                                    </td>
                                    <td class="px-3 lg:px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $item->username }}</td>
                                    <td class="px-3 lg:px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <div class="flex space-x-2">
                                            <button type="button"
                                                class="edit-button px-2 py-1 bg-blue-500 hover:bg-blue-600 text-white rounded text-xs transition-colors"
                                                data-id="{{ $item->id }}"
                                                data-url="{{ route('kronologi.edit', $item->id) }}">Edit</button>
                                            <button type="button"
                                                class="delete-button px-2 py-1 bg-red-500 hover:bg-red-600 text-white rounded text-xs transition-colors"
                                                data-id="{{ $item->id }}">Hapus</button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @else
            <div class="bg-white rounded-lg shadow-md p-8 text-center">
                <div class="text-gray-500 text-sm sm:text-base">
                    Belum ada data kronologi. Silakan import file untuk menambahkan.
                </div>
            </div>
        @endif

        {{-- Edit Modal --}}
        <div
            class="modal-overlay fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden z-[9999] p-4">
            <div class="modal-content bg-white rounded-lg shadow-lg w-full max-w-lg max-h-[90vh] overflow-y-auto">
                <div class="p-4 sm:p-6">
                    <h3 class="text-lg font-semibold mb-4">Edit Kronologi</h3>
                    <form id="editForm" action="{{ route('kronologi.update', 0) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="id" id="editId">

                        {{-- tanggal --}}
                        <div class="mb-4">
                            <label for="editTanggal" class="block text-sm font-medium text-gray-700">Tanggal</label>
                            <input type="date" id="editTanggal" name="tanggal"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm"
                                required>
                        </div>
                        {{-- wip & area --}}
                        <div class="mb-4 grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label for="editWIP" class="block text-sm font-medium text-gray-700">WIP</label>
                                <input type="text" id="editWIP" name="wip"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm"
                                    required>
                            </div>
                            <div>
                                <label for="editArea" class="block text-sm font-medium text-gray-700">Area</label>
                                <select id="editArea" name="area"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm"
                                    required>
                                    <option value="">Pilih Area</option>
                                    @foreach (['KK1', 'KK2', 'KK5', 'KK7', 'KK8', 'KK11'] as $area)
                                        <option value="{{ $area }}">{{ $area }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        {{-- GRID: 2 columns --}}
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            {{-- LEFT: Salah --}}
                            <div>
                                <h4 class="font-medium mb-2">Nilai “Salah”</h4>
                                <div class="space-y-4">
                                    <div>
                                        <label for="editNoModelSalah" class="block text-sm font-medium text-gray-700">PDK
                                            Fail</label>
                                        <input type="text" id="editNoModelSalah" name="no_model_salah"
                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm"
                                            required>
                                    </div>
                                    <div>
                                        <label for="editStyleSalah" class="block text-sm font-medium text-gray-700">Style
                                            Fail</label>
                                        <input type="text" id="editStyleSalah" name="style_salah"
                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm"
                                            required>
                                    </div>
                                    {{-- label salah --}}
                                    <div>
                                        <label for="editlabelSalah" class="block text-sm font-medium text-gray-700">Label
                                            Salah</label>
                                        <input type="text" id="editlabelSalah" name="label_salah"
                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm"
                                            required>
                                    </div>
                                    {{-- no_mc_salah --}}
                                    <div>
                                        <label for="editNoMCSalah" class="block text-sm font-medium text-gray-700">No MC
                                            Salah</label>
                                        <input type="text" id="editNoMCSalah" name="no_mc_salah"
                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm"
                                            required>
                                    </div>
                                    {{-- krj_salah --}}
                                    <div>
                                        <label for="editKrjSalah" class="block text-sm font-medium text-gray-700">Kerja
                                            Salah</label>
                                        <input type="text" id="editKrjSalah" name="krj_salah"
                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm"
                                            required>
                                    </div>
                                    {{-- qty salah --}}
                                    <div>
                                        <label for="editQtySalah" class="block text-sm font-medium text-gray-700">Qty Salah</label>
                                        <input type="number" id="editQtySalah" name="qty_salah"
                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm"
                                            required>
                                    </div>
                                </div>
                            </div>

                            {{-- RIGHT: Benar --}}
                            <div>
                                <h4 class="font-medium mb-2">Nilai “Benar”</h4>
                                <div class="space-y-4">
                                    <div>
                                        <label for="editNoModelBenar" class="block text-sm font-medium text-gray-700">PDK
                                            Correct</label>
                                        <input type="text" id="editNoModelBenar" name="no_model_benar"
                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 text-sm"
                                            required>
                                    </div>
                                    <div>
                                        <label for="editStyleBenar" class="block text-sm font-medium text-gray-700">Style
                                            Correct</label>
                                        <input type="text" id="editStyleBenar" name="style_benar"
                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 text-sm"
                                            required>
                                    </div>
                                    {{-- label benar --}}
                                    <div>
                                        <label for="editLabelBenar" class="block text-sm font-medium text-gray-700">Label
                                            Benar</label>
                                        <input type="text" id="editLabelBenar" name="label_benar"
                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 text-sm"
                                            required>
                                    </div>
                                    {{-- no_mc_benar --}}
                                    <div>
                                        <label for="editNoMCBenar" class="block text-sm font-medium text-gray-700">No MC
                                            Benar</label>
                                        <input type="text" id="editNoMCBenar" name="no_mc_benar"
                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 text-sm"
                                            required>
                                    </div>
                                    {{-- krj_benar --}}
                                    <div>
                                        <label for="editKrjBenar" class="block text-sm font-medium text-gray-700">Kerja
                                            Benar</label>
                                        <input type="text" id="editKrjBenar" name="krj_benar"
                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 text-sm"
                                            required>
                                    </div>
                                    {{-- qty benar --}}
                                    <div>
                                        <label for="editQtyBenar" class="block text-sm font-medium text-gray-700">Qty Benar</label>
                                        <input type="number" id="editQtyBenar" name="qty_benar"
                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 text-sm"
                                            required>
                                    </div>
                                </div>
                            </div>

                            {{-- kategori --}}
                            <div class="col-span-2">
                                <label for="editKategori" class="block text-sm font-medium text-gray-700">Kategori</label>
                                <select id="editKategori" name="kategori"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm"
                                    required>
                                    <option value="">Pilih Kategori</option>
                                    <option value="Kualitas">Kualitas</option>
                                    <option value="Maintenance">Maintenance</option>
                                    <option value="Lainnya">Lainnya</option>
                                </select>
                            </div>
                            {{-- keterangan --}}
                            <div class="col-span-2">
                                <label for="editKeterangan"
                                    class="block text-sm font-medium text-gray-700">Keterangan</label>
                                <textarea id="editKeterangan" name="keterangan"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm"
                                    rows="3"></textarea>
                            </div>
                            {{-- keterangan maintenance --}}
                            <div class="col-span-2">
                                <label for="editKeteranganMaintenance"
                                    class="block text-sm font-medium text-gray-700">Keterangan Maintenance</label>
                                <textarea id="editKeteranganMaintenance" name="keterangan_maintenance"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm"
                                    rows="3"></textarea>
                            </div>

                            {{-- username --}}
                            <div class="col-span-2">
                                <label for="editUsername" class="block text-sm font-medium text-gray-700">User ERP</label>
                                <input type="text" id="editUsername" name="username"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm"
                                    required>
                            </div>
                        </div>

                        {{-- FOOTER --}}
                        <div class="flex flex-col sm:flex-row justify-end space-y-2 sm:space-y-0 sm:space-x-2 pt-6">
                            <button type="button" id="cancelEditButton"
                                class="w-full sm:w-auto px-4 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400 transition-colors">
                                Batal
                            </button>
                            <button type="submit"
                                class="w-full sm:w-auto px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition-colors">
                                Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


        {{-- Delete Confirmation Modal --}}
        <div
            class="modal-overlay-delete fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden z-50 p-4">
            <div class="modal-content bg-white rounded-lg shadow-lg w-full max-w-md">
                <div class="p-4 sm:p-6">
                    <h3 class="text-lg font-semibold mb-4">Konfirmasi Hapus</h3>
                    <p class="mb-6 text-gray-600">Apakah Anda yakin ingin menghapus kronologi ini?</p>
                    <form id="deleteForm" action="{{ route('kronologi.destroy', 0) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <input type="hidden" name="id" id="deleteId">
                        <div class="flex flex-col sm:flex-row justify-end space-y-2 sm:space-y-0 sm:space-x-2">
                            <button type="button" id="cancelDeleteButton"
                                class="w-full sm:w-auto px-4 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400 transition-colors">Batal</button>
                            <button type="submit"
                                class="w-full sm:w-auto px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700 transition-colors">Hapus</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const editOverlay = document.querySelector('.modal-overlay');
            const editForm = editOverlay.querySelector('#editForm');
            // store original action once
            const originalAction = editForm.dataset.originalAction || editForm.action;
            editForm.dataset.originalAction = originalAction;

            document.querySelectorAll('.edit-button').forEach(btn => {
                btn.addEventListener('click', () => {
                    const id = btn.dataset.id;
                    const url = btn.dataset.url; // /kronologi/{id}/edit

                    fetch(url)
                        .then(res => {
                            if (!res.ok) throw new Error(res.statusText);
                            return res.json();
                        })
                        .then(json => {
                            const d = json.data;

                            // reset and set form action
                            editForm.action = originalAction.replace(/\/\d+$/, `/${id}`);
                            editOverlay.querySelector('#editId').value = id;

                            editOverlay.querySelector('#editTanggal').value = d.tanggal || '';
                            editOverlay.querySelector('#editWIP').value = d.wip || '';
                            editOverlay.querySelector('#editArea').value = d.area || '';
                            // --- SALAH side ---
                            editOverlay.querySelector('#editNoModelSalah').value = d
                                .no_model_salah || '';
                            editOverlay.querySelector('#editStyleSalah').value = d
                                .style_salah || '';
                            editOverlay.querySelector('#editlabelSalah').value = d
                                .label_salah || '';
                            editOverlay.querySelector('#editNoMCSalah').value = d.no_mc_salah ||
                                '';
                            editOverlay.querySelector('#editKrjSalah').value = d.krj_salah ||
                            '';
                            editOverlay.querySelector('#editQtySalah').value = d.qty_salah ||
                                '';

                            // --- BENAR side ---
                            editOverlay.querySelector('#editNoModelBenar').value = d
                                .no_model_benar || '';
                            editOverlay.querySelector('#editStyleBenar').value = d
                                .style_benar || '';
                            editOverlay.querySelector('#editLabelBenar').value = d
                                .label_benar || '';
                            editOverlay.querySelector('#editNoMCBenar').value = d.no_mc_benar ||
                                '';
                            editOverlay.querySelector('#editKrjBenar').value = d.krj_benar ||
                            '';
                            editOverlay.querySelector('#editQtyBenar').value = d.qty_benar ||
                                '';

                            // --- shared fields ---
                            editOverlay.querySelector('#editKategori').value = d.kategori || '';
                            editOverlay.querySelector('#editKeterangan').value = d.keterangan ||
                                '';
                            editOverlay.querySelector('#editKeteranganMaintenance').value = d
                                .keterangan_maintenance || '';
                            editOverlay.querySelector('#editUsername').value = d.username || '';

                            // show modal
                            editOverlay.classList.remove('hidden');
                        })
                        .catch(err => {
                            console.error('Fetch error:', err);
                            alert('Gagal memuat data. Silakan coba lagi.');
                        });
                });
            });

            // cancel button
            editOverlay.querySelector('#cancelEditButton')
                .addEventListener('click', () => editOverlay.classList.add('hidden'));

            // click outside to close
            editOverlay.addEventListener('click', e => {
                if (e.target === editOverlay) editOverlay.classList.add('hidden');
            });
        });

        // Delete confirmation modal
        const deleteOverlay = document.querySelector('.modal-overlay-delete');
        const deleteForm = deleteOverlay.querySelector('#deleteForm');
        const originalDeleteAction = deleteForm.dataset.originalAction || deleteForm.action;
        deleteForm.dataset.originalAction = originalDeleteAction;
        document.querySelectorAll('.delete-button').forEach(btn => {
            btn.addEventListener('click', () => {
                const id = btn.dataset.id;
                deleteForm.action = originalDeleteAction.replace(/\/\d+$/, `/${id}`);
                deleteOverlay.querySelector('#deleteId').value = id;
                deleteOverlay.classList.remove('hidden');
            });
        });
        deleteOverlay.querySelector('#cancelDeleteButton')
            .addEventListener('click', () => deleteOverlay.classList.add('hidden'));
        deleteOverlay.addEventListener('click', e => {
            if (e.target === deleteOverlay) deleteOverlay.classList.add('hidden');
        }); 

        // Handle form submission
        deleteForm.addEventListener('submit', e => {
            e.preventDefault();
            const id = deleteOverlay.querySelector('#deleteId').value;
            Swal.fire({
                title: 'Yakin?',
                text: "Data ini akan dihapus secara permanen!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Hapus',
                cancelButtonText: 'Batal'
            }).then(result => {
                if (result.isConfirmed) {
                    deleteForm.submit();
                }
            });
        });
    </script>
@endpush

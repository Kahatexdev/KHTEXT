@extends('layouts.app')
@section('title', 'Create Flow Proses')
@section('page-title', 'Create Flow Proses')

@section('content')
    <div class="w-full px-2 sm:px-4 py-4 mx-auto space-y-4">
        <form action="{{ route('flowproses.store') }}" method="POST" class="space-y-4">
            @csrf

            {{-- Header Create Flow Proses --}}
            <div class="bg-white border border-gray-200 rounded-lg p-4 space-y-4">
                <h2 class="text-lg font-bold">Create Flow Proses</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                    {{-- No Model / Master Model --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Master Model</label>
                        <select id="mastermodel" name="mastermodel"
                            class="select2 mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200 focus:border-indigo-300">
                            <option value="">-- Pilih Model --</option>
                            @foreach ($model as $mode)
                                <option value="{{ $mode->mastermodel }}"
                                    {{ old('mastermodel') == $mode->mastermodel ? 'selected' : '' }}>
                                    {{ $mode->mastermodel }}
                                </option>
                            @endforeach
                        </select>
                        @error('mastermodel')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Inisial --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Inisial</label>
                        <select id="inisial" name="inisial"
                            class="select2-tags mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200 focus:border-indigo-300">
                            @if (old('inisial'))
                                <option value="{{ old('inisial') }}" selected>{{ old('inisial') }}</option>
                            @endif
                        </select>
                        @error('inisial')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    {{-- Tanggal --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Tanggal</label>
                        <input type="date" name="tanggal" value="{{ old('tanggal') }}"
                            class="mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200 focus:border-indigo-300" />
                        @error('tanggal')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            {{-- Detail Proses --}}
            <div class="bg-white border border-gray-200 rounded-lg p-4">
                <div class="flex items-center justify-between mb-3">
                    <h3 class="text-md font-semibold">Detail Proses</h3>
                    <button type="button" id="add-process" class="text-green-600 hover:text-green-700 text-xl"
                        title="Tambah Proses">
                        <i class="fas fa-plus-circle"></i>
                    </button>
                </div>

                <div id="detail-container" class="space-y-4">
                    {{-- Baris pertama Proses #1 --}}
                    <div
                        class="border border-gray-200 rounded-lg p-3 grid grid-cols-1 md:grid-cols-4 gap-3 items-end detail-row">
                        {{-- Step Order --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Proses #1</label>
                            <input type="number" name="detail[0][step_order]" value="{{ old('detail.0.step_order') }}"
                                min="1"
                                class="mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200 focus:border-indigo-300" />
                            @error('detail.0.step_order')
                                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        {{-- Select Master Proses --}}
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700">Master Proses</label>
                            <select name="detail[0][id_master_proses]"
                                class="mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200 focus:border-indigo-300">
                                <option value="">-- Pilih Proses --</option>
                                @foreach ($masterProses as $mp)
                                    <option value="{{ $mp->id_master_proses }}"
                                        {{ old('detail.0.id_master_proses') == $mp->id_master_proses ? 'selected' : '' }}>
                                        {{ $mp->nama_proses }}
                                    </option>
                                @endforeach
                            </select>
                            @error('detail.0.id_master_proses')
                                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        {{-- Tombol Hapus --}}
                        <div class="flex justify-end">
                            <button type="button" class="delete-process text-red-500 hover:text-red-600 text-xl"
                                title="Hapus Proses">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="flex justify-end gap-2 mt-4">
                    <a href="{{ route('flowproses.index') }}"
                        class="px-5 py-2 bg-gray-300 rounded hover:bg-gray-400 text-sm">Batal</a>
                    <button type="submit"
                        class="px-5 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700 text-sm">Simpan</button>
                </div>
            </div>
        </form>
    </div>

    {{-- JavaScript --}}
    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                // Inisialisasi Master Model
                $('#mastermodel').select2({
                    placeholder: "Pilih Model",
                    allowClear: true,
                    width: '100%'
                });

                // Inisialisasi Inisial (tags)
                $('#inisial').select2({
                    tags: true,
                    placeholder: "Ketik atau pilih inisial",
                    width: '100%'
                });

                $('#mastermodel').on('change', function() {
                    const model = $(this).val();
                    const url = "{{ route('flowproses.getInisialByModel') }}";

                    // kosongkan & disable dulu
                    $('#inisial').empty().trigger('change').prop('disabled', true);

                    if (!model) {
                        $('#inisial').prop('disabled', false);
                        return;
                    }

                    $.ajax({
                        url,
                        method: 'GET',
                        data: {
                            mastermodel: model
                        },
                        success(response) {
                            const items = response.inisial || [];
                            const opts = items.map(i => ({
                                id: i,
                                text: i
                            }));

                            $('#inisial')
                                .empty()
                                .select2({
                                    data: opts,
                                    tags: true,
                                    placeholder: "Pilih atau ketik inisial",
                                    width: '100%'
                                })
                                .prop('disabled', false)
                                .trigger('change');
                        },
                        error() {
                            console.error('Gagal mengambil inisial');
                            $('#inisial').prop('disabled', false);
                        }
                    });
                });

                // --------------------------
                // Script add/remove detail
                // --------------------------
                const container = document.getElementById('detail-container');
                const addBtn = document.getElementById('add-process');

                function bindDelete(btn) {
                    btn.addEventListener('click', () => {
                        const rows = container.querySelectorAll('.detail-row');
                        if (rows.length > 1) {
                            btn.closest('.detail-row').remove();
                            rows.forEach((r, i) => {
                                r.querySelector('label').textContent = `Proses #${i+1}`;
                                r.querySelectorAll('input, select').forEach(el => {
                                    el.name = el.name.replace(/detail\[\d+\]/, `detail[${i}]`);
                                });
                            });
                        }
                    });
                }

                container.querySelectorAll('.delete-process').forEach(bindDelete);

                addBtn.addEventListener('click', () => {
                    const rows = container.querySelectorAll('.detail-row');
                    const idx = rows.length;
                    const clone = rows[0].cloneNode(true);

                    // Reset nilai
                    clone.querySelectorAll('input[type="number"]').forEach(i => i.value = '');
                    clone.querySelectorAll('select').forEach(s => s.selectedIndex = 0);

                    // Update label & name
                    clone.querySelector('label').textContent = `Proses #${idx+1}`;
                    clone.querySelectorAll('input, select').forEach(el => {
                        el.name = el.name.replace(/detail\[\d+\]/, `detail[${idx}]`);
                    });

                    bindDelete(clone.querySelector('.delete-process'));
                    container.appendChild(clone);
                });
            });
        </script>
    @endpush
@endsection

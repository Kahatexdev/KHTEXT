@extends('layouts.app')
@section('title', ucfirst($bagian) . ' Form')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
    {{-- Alerts --}}
    @foreach (['success' => 'green', 'error' => 'red', 'warning' => 'yellow'] as $type => $color)
        @if (session($type))
            <div class="mb-4 px-4 py-3 rounded-lg bg-{{ $color }}-100 border border-{{ $color }}-400 text-{{ $color }}-700" role="alert">
                <strong class="font-bold capitalize">{{ $type }}!</strong>
                <span class="block sm:inline">{{ session($type) }}</span>
            </div>
        @endif
    @endforeach

    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <div class="flex justify-between items-center px-6 py-4 border-b">
            <h2 class="text-xl font-bold">
                @if(isset($item))
                    Edit {{ ucfirst($bagian) }}
                @else
                    Create {{ ucfirst($bagian) }}
                @endif
            </h2>
            <a href="{{ route('reportDatabyBagian', ['bagian' => $bagian]) }}" class="text-blue-600 hover:text-blue-800">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>
        <div class="px-6 py-4">
            @php
                $isEdit = isset($item);
                $formAction = $isEdit
                    ? route('reportData.update', ['bagian' => $bagian, 'id' => $item->id_cekqty_rosset])
                    : route('tb_cekqty_rosset.store', ['bagian' => $bagian]);
                $action = $formAction;
            @endphp

            <form action="{{ $action }}" method="POST" class="space-y-4">
                @csrf
                @if($isEdit)
                    @method('PUT')
                @endif

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label for="tanggal" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Cross Check</label>
                        <input type="date" id="tanggal" name="tanggal"
                            value="{{ old('tanggal', $item->tanggal_input ?? '') }}"
                            class="w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm" required>
                    </div>
                    <div>
                        <label for="area" class="block text-sm font-medium text-gray-700 mb-1">Area</label>
                        <select name="area" id="area"
                            class="w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm" required>
                            <option value="">Pilih Area</option>
                            @foreach(['KK1','KK2','KK5','KK7','KK8','KK11'] as $opt)
                                <option value="{{ $opt }}" {{ old('area', $item->area ?? '') === $opt ? 'selected' : '' }}>{{ $opt }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="shift" class="block text-sm font-medium text-gray-700 mb-1">Shift</label>
                        <select name="shift" id="shift"
                            class="w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm" required>
                            <option value="">Pilih Shift</option>
                            @foreach(['PAGI','SIANG'] as $opt)
                                <option value="{{ $opt }}" {{ old('shift', $item->shift ?? '') === $opt ? 'selected' : '' }}>{{ $opt }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <h4 class="font-semibold text-slate-900 mt-3">Cross Check Qty</h4>
                <div class="grid grid-cols-2 gap-2">
                    <div>
                        <label for="erp" class="block text-sm font-medium text-gray-700 mb-1">ERP</label>
                        <input type="number" id="erp" name="erp"
                            value="{{ old('erp', $item->qty_erp_rosset ?? '') }}"
                            class="w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm" required>
                    </div>
                    <div>
                        <label for="smv" class="block text-sm font-medium text-gray-700 mb-1">SMV</label>
                        <input type="number" id="smv" name="smv"
                            value="{{ old('smv', $item->qty_mis_rosset ?? '') }}"
                            class="w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm" required>
                    </div>
                </div>

                <h4 class="font-semibold text-slate-900 mt-3">MIS</h4>
                <div class="grid grid-cols-2 gap-2">
                    <div>
                        <label for="selisih" class="block text-sm font-medium text-gray-700 mb-1">Selisih</label>
                        <input type="number" id="selisih" name="selisih" readonly
                            class="w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm">
                    </div>
                    <div>
                        <label for="persentase" class="block text-sm font-medium text-gray-700 mb-1">Persentase</label>
                        <input type="text" id="persentase" name="persentase" readonly
                            class="w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm">
                    </div>
                </div>

                <h4 class="font-semibold text-slate-900 mt-3">Keterangan</h4>
                <div class="grid grid-cols-2 gap-2">
                    <div>
                        <label for="keterangan_erp" class="block text-sm font-medium text-gray-700 mb-1">Keterangan ERP</label>
                        <textarea name="keterangan_erp" id="keterangan_erp" rows="3" required
                            class="w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm">{{ old('keterangan_erp', $item->ket_erp_rosset ?? '') }}</textarea>
                    </div>
                    <div>
                        <label for="keterangan_smv" class="block text-sm font-medium text-gray-700 mb-1">Keterangan SMV</label>
                        <textarea name="keterangan_smv" id="keterangan_smv" rows="3" required
                            class="w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm">{{ old('keterangan_smv', $item->ket_mis_rosset ?? '') }}</textarea>
                    </div>
                </div>

                <h4 class="font-semibold text-slate-900 mt-3">Qty Reject & Rework</h4>
                <div class="grid grid-cols-2 gap-2">
                    <div>
                        <label for="qty_reject" class="block text-sm font-medium text-gray-700 mb-1">Qty Reject</label>
                        <input type="number" id="qty_reject" name="qty_reject"
                            value="{{ old('qty_reject', $item->qty_reject ?? '') }}"
                            class="w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm" required>
                    </div>
                    <div>
                        <label for="qty_rework" class="block text-sm font-medium text-gray-700 mb-1">Qty Rework</label>
                        <input type="number" id="qty_rework" name="qty_rework"
                            value="{{ old('qty_rework', $item->qty_rework ?? '') }}"
                            class="w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm" required>
                    </div>
                </div>

                <h4 class="font-semibold text-slate-900 mt-3">Total & Jalan Mesin</h4>
                <div class="grid grid-cols-2 gap-2">
                    <div>
                        <label for="total_mesin" class="block text-sm font-medium text-gray-700 mb-1">Total Mesin</label>
                        <input type="number" id="total_mesin" name="total_mesin"
                            value="{{ old('total_mesin', $item->ttl_mc ?? '') }}"
                            class="w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm" required>
                    </div>
                    <div>
                        <label for="jalan_mesin" class="block text-sm font-medium text-gray-700 mb-1">Jalan Mesin</label>
                        <input type="number" id="jalan_mesin" name="jalan_mesin"
                            value="{{ old('jalan_mesin', $item->jl_mc ?? '') }}"
                            class="w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm" required>
                    </div>
                </div>

                <h4 class="font-semibold text-slate-900 mt-3">Overshift</h4>
                <div class="grid grid-cols-2 gap-2">
                    <div>
                        <label for="ket_ovh_pagi" class="block text-sm font-medium text-gray-700 mb-1">Dari Pagi</label>
                        <textarea name="ket_ovh_pagi" id="ket_ovh_pagi" rows="3" required
                            class="w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm">{{ old('ket_ovh_pagi', $item->ket_overshift_pagi_kesiang ?? '') }}</textarea>
                    </div>
                    <div>
                        <label for="ket_ovh_siang" class="block text-sm font-medium text-gray-700 mb-1">Dari Siang</label>
                        <textarea name="ket_ovh_siang" id="ket_ovh_siang" rows="3" required
                            class="w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm">{{ old('ket_ovh_siang', $item->ket_overshift_siang_kepagi ?? '') }}</textarea>
                    </div>
                </div>

                <div class="mt-4">
                    <button type="submit" class="px-4 py-2 bg-blue-600 w-full text-white rounded-md hover:bg-blue-700">
                        {{ $isEdit ? 'Update' : 'Simpan' }}
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
    document.addEventListener('DOMContentLoaded', function() {
        const erpInput = document.getElementById('erp');
        const smvInput = document.getElementById('smv');
        const selisihInput = document.getElementById('selisih');
        const persentaseInput = document.getElementById('persentase');

        function calculate() {
            const erp = parseFloat(erpInput.value) || 0;
            const smv = parseFloat(smvInput.value) || 0;
            selisihInput.value = smv - erp;
            persentaseInput.value = smv ? ((erp / smv) * 100).toFixed(2) + '%' : '0%';
        }

        erpInput && erpInput.addEventListener('input', calculate);
        smvInput && smvInput.addEventListener('input', calculate);
        calculate();
    });
</script>
@endpush

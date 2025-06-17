@extends('layouts.app')
@section('title','Edit Flow Proses')

@section('content')
<div class="max-w-4xl mx-auto p-6 space-y-6">

  {{-- Header main_flowproses --}}
  <div class="bg-white shadow-lg rounded-2xl p-6 grid grid-cols-1 sm:grid-cols-2 gap-4">
    <div>
      <h2 class="text-2xl font-semibold mb-2">Edit Flow Proses</h2>
      <p class="text-gray-600">ID Style: <span class="font-medium">{{ $mainFlowproses->idapsperstyle }}</span></p>
    </div>
    <div class="space-y-2">
      <p><span class="font-medium">Model:</span> {{ $style['mastermodel'] }}</p>
      <p><span class="font-medium">Size:</span> {{ $style['size'] }}</p>
      <p><span class="font-medium">Inisial:</span> {{ $style['inisial'] }}</p>
      <p><span class="font-medium">Delivery:</span> {{ $style['delivery'] ?? '-' }}</p>
      <p><span class="font-medium">Area:</span> {{ $mainFlowproses->area }}</p>
      <p><span class="font-medium">Tanggal:</span> {{ \Carbon\Carbon::parse($mainFlowproses->tanggal)->format('Y-m-d') }}</p>
    </div>
  </div>

  {{-- Form update many detail --}}
  <form action="{{ route('flowproses.update', ['main_flowproses' => $mainFlowproses->id_main_flow]) }}" method="POST" class="space-y-6">
  @csrf
  @method('PUT')

    <div class="bg-white shadow-lg rounded-2xl p-6">
      <h3 class="text-lg font-semibold mb-4">Detail Proses</h3>

      <div class="space-y-6">
        @foreach($mainFlowproses->flowProses as $fp)
          <div class="border border-gray-200 rounded-lg p-4 grid grid-cols-1 md:grid-cols-3 gap-4 items-end">
            <input type="hidden" name="detail[{{ $fp->id_flow_proses }}][id]" value="{{ $fp->id_flow_proses }}">

            {{-- Step Order --}}
            <div class="col-span-1">
              <label class="block text-sm font-medium text-gray-700">Proses #{{ $loop->iteration }}</label>
              <input
                type="number"
                name="detail[{{ $fp->id_flow_proses }}][step_order]"
                value="{{ old("detail.{$fp->id_flow_proses}.step_order", $fp->step_order) }}"
                min="1"
                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200 focus:border-indigo-300"
              />
              @error("detail.{$fp->id_flow_proses}.step_order")
                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
              @enderror
            </div>

            {{-- Master Proses --}}
            <div class="col-span-2">
              <label class="block text-sm font-medium text-gray-700">Master Proses</label>
              <select
                name="detail[{{ $fp->id_flow_proses }}][id_master_proses]"
                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200 focus:border-indigo-300"
              >
                @foreach($masterProses as $mp)
                  <option
                    value="{{ $mp->id_master_proses }}"
                    {{ old("detail.{$fp->id_flow_proses}.id_master_proses", $fp->id_master_proses)==$mp->id_master_proses ? 'selected':'' }}
                  >
                    {{ $mp->nama_proses }}
                  </option>
                @endforeach
              </select>
              @error("detail.{$fp->id_flow_proses}.id_master_proses")
                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
              @enderror
            </div>
          </div>
        @endforeach
      </div>
    </div>

    {{-- Buttons --}}
    <div class="flex flex-col sm:flex-row justify-end gap-3">
      <a href="{{ route('flowproses.index') }}"
         class="px-6 py-2 bg-gray-300 rounded-lg text-center hover:bg-gray-400 transition">
         Batal
      </a>
      <button type="submit"
         class="px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition">
         Simpan Semua
      </button>
    </div>
  </form>
</div>
@endsection

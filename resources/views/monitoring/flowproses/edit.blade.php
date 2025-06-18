@extends('layouts.app')
@section('title','Edit Flow Proses')

@section('content')
<div class="w-full px-2 sm:px-4 py-4 sm:py-6 mx-auto space-y-4 sm:space-y-6">

  {{-- Header main_flowproses --}}
  <div class="bg-white border border-gray-200 rounded-lg p-6">
    <!-- Header -->
    <div class="flex items-center justify-between mb-4">
        <h2 class="text-xl font-bold text-black">Edit Flow Proses</h2>
        <span class="px-3 py-1 bg-gray-100 text-gray-600 text-sm rounded-full">
            ID Style <strong>{{ $mainFlowproses->idapsperstyle }}</strong>
        </span>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-3">
        <div class="space-y-2">
            <div class="flex">
                <span class="text-gray-500 w-20">Model</span>
                <span class="font-medium">{{ $style['mastermodel'] }}</span>
            </div>
            <div class="flex">
                <span class="text-gray-500 w-20">Size</span>
                <span class="font-medium">{{ $style['size'] }}</span>
            </div>
        </div>
        <div class="space-y-2">
          <div class="flex">
            <span class="text-gray-500 w-20">Inisial</span>
            <span class="font-medium">{{ $style['inisial'] }}</span>
        </div>
        <div class="flex">
          <span class="text-gray-500 w-20">Delivery</span>
          <span class="font-medium">{{ $style['delivery'] ?? '-' }}</span>
      </div>
        </div>
        <div class="space-y-2">
            <div class="flex">
                <span class="text-gray-500 w-20">Area</span>
                <span class="font-medium">{{ $mainFlowproses->area }}</span>
            </div>
            <div class="flex">
                <span class="text-gray-500 w-20">Tanggal</span>
                <span class="font-medium">{{ \Carbon\Carbon::parse($mainFlowproses->tanggal)->format('d M Y') }}</span>
            </div>
        </div>
    </div>
  </div>

  {{-- Form update many detail --}}
  <form action="{{ route('flowproses.update', ['main_flowproses' => $mainFlowproses->id_main_flow]) }}" method="POST" class="space-y-6">
  @csrf
  @method('PUT')

    <div class="bg-white border border-gray-200 shadow-lg rounded-2xl p-6">
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
      <div class="flex flex-col sm:flex-row justify-end gap-3 mt-3">
        <a href="{{ route('flowproses.index') }}"
           class="px-6 py-2 bg-gray-300 rounded-lg text-center hover:bg-gray-400 transition">
           Batal
        </a>
        <button type="submit"
           class="px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition">
           Simpan Semua
        </button>
      </div>
    </div>
  </form>
</div>
@endsection
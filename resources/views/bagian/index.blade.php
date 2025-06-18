@extends('layouts.app')
@section('title', 'Report Bagian')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        {{-- Alerts --}}
        @foreach (['success', 'error', 'warning'] as $msg)
            @if (session($msg))
                <div class="mb-4 px-4 py-3 rounded relative 
                    {{ $msg == 'success' ? 'bg-green-100 border-green-400 text-green-700' : '' }}
                    {{ $msg == 'error'   ? 'bg-red-100 border-red-400 text-red-700' : '' }}
                    {{ $msg == 'warning' ? 'bg-yellow-100 border-yellow-400 text-yellow-700' : '' }}
                    border"
                    role="alert"
                >
                    <strong class="font-bold capitalize">{{ $msg }}!</strong>
                    <span class="block sm:inline">{{ session($msg) }}</span>
                </div>
            @endif
        @endforeach

        <h2 class="text-2xl font-bold mb-6">Data Report per Bagian</h2>

        @if ($bagian->isEmpty())
            <p class="text-gray-500">Tidak ada data bagian yang tersedia.</p>
        @else
            @php
            $routeName = Auth::user()->role === 'monitoring' ? 'reportDatabyBagian' : 'user.DatareportbyBagian';
            @endphp
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach ($bagian as $item)
                <a href="{{ route($routeName, $item->bagian) }}"
                   class="bg-white shadow-md rounded-lg p-6 flex items-center justify-between hover:shadow-xl transition-shadow">
                <h2 class="text-lg font-semibold text-gray-800 uppercase">{{ $item->bagian }}</h2>
                {{-- Contoh icon, bisa ganti dengan heroicon atau image --}}
                <div class="w-10 h-10 bg-gradient-to-br from-blue-400 to-blue-600 rounded-lg flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none"
                     viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M9 17v-6a2 2 0 012-2h2a2 2 0 012 2v6m-6 0h6"/>
                    </svg>
                </div>
                </a>
            @endforeach
            </div>
        @endif
    </div>
    @include('layouts.footer')
@endsection

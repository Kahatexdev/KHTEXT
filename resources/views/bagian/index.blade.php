@extends('layouts.app')
@section('title', 'Report Bagian')

@section('content')
<div class="w-full px-2 sm:px-4 py-4 sm:py-6 mx-auto space-y-4 sm:space-y-6">
    <div class="bg-white shadow-md rounded-lg">
        <div class="flex justify-between items-center px-6 py-4 border-b">
            <h2 class="text-xl font-bold">Data Report Per Bagian</h2>
        </div>
        <div class="px-6 py-4">
            @php
            $routeName = 'reportDatabyBagian';
            @endphp
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                <a href="{{ route('mesin.index') }}"
                    class="bg-white shadow-md rounded-lg p-6 flex items-center justify-between hover:shadow-xl transition-shadow">
                    <h2 class="text-lg font-semibold text-gray-800 uppercase">Mesin</h2>
                    <div class="w-10 h-10 bg-gradient-to-br from-blue-400 to-blue-600 rounded-lg flex items-center justify-center">
                        <i class="fas fa-industry text-white"></i>
                    </div>
                </a>
                @foreach($bagian as $item)
                <a href="{{ route($routeName, $item) }}"
                    class="bg-white shadow-md rounded-lg p-6 flex items-center justify-between hover:shadow-xl transition-shadow">
                    <h2 class="text-lg font-semibold text-gray-800 uppercase">{{ ucfirst($item) }}</h2>
                    <div class="w-10 h-10 bg-gradient-to-br from-blue-400 to-blue-600 rounded-lg flex items-center justify-center">
                        <i class="fas fa-industry text-white"></i>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
    </div>
</div>
@include('layouts.footer')
@endsection
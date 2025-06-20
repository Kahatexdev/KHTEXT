@extends('layouts.app')
@section('title', 'Report Bagian')
@section('page-title', 'Report Bagian')

@section('content')
<div class="w-full px-2 sm:px-4 py-4 sm:py-6 mx-auto space-y-4 sm:space-y-6">
    <div class="bg-white shadow-sm rounded-xl border border-gray-100">
        <div class="flex justify-between items-center p-4 border-b border-gray-100">
            <h2 class="text-xl font-bold">DATA REPORT PER BAGIAN</h2>
        </div>
        <div class="p-4">
            @php
            $routeName = 'reportDatabyBagian';
            @endphp
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
                <!-- Mesin Card -->
                <a href="{{ route('mesin.index') }}"
                    class="group bg-white border border-gray-100 shadow-sm rounded-xl p-8 hover:shadow-lg hover:border-blue-200 transition-all duration-300 transform hover:-translate-y-1">
                    <div class="flex flex-col items-center text-center space-y-4">
                        <div class="w-16 h-16 bg-gradient-to-br from-blue-400 to-blue-600 rounded-2xl flex items-center justify-center shadow-lg group-hover:shadow-xl transition-shadow duration-300">
                            <i class="fas fa-industry text-white text-2xl"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-800 uppercase tracking-wide">Mesin</h3>
                    </div>
                </a>
                
                @foreach($bagian as $item)
                <a href="{{ route($routeName, $item) }}"
                    class="group bg-white border border-gray-100 shadow-sm rounded-xl p-8 hover:shadow-lg hover:border-blue-200 transition-all duration-300 transform hover:-translate-y-1">
                    <div class="flex flex-col items-center text-center space-y-4">
                        <div class="w-16 h-16 bg-gradient-to-br from-blue-400 to-blue-600 rounded-2xl flex items-center justify-center shadow-lg group-hover:shadow-xl transition-shadow duration-300">
                            <i class="fas fa-industry text-white text-2xl"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-800 uppercase tracking-wide">{{ ucfirst($item) }}</h3>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
    </div>
</div>
@include('layouts.footer')
@endsection
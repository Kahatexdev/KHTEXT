@extends('layouts.app')
@section('title', 'User Dashboard')

@php
    use Illuminate\Support\Str;
@endphp

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-100">
    <!-- Header Section -->
    <div class="px-4 sm:px-6 lg:px-8 pt-8 pb-6">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-8">
                <h1 class="text-3xl sm:text-4xl font-bold bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent mb-2">
                    Dashboard Overview
                </h1>
                <p class="text-gray-600 text-lg">Monitor your system performance and latest updates</p>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="px-4 sm:px-6 lg:px-8 mb-8">
        <div class="max-w-7xl mx-auto">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Total Users Card -->
                <div class="group relative overflow-hidden bg-white/80 backdrop-blur-sm rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 border border-white/20">
                    <div class="absolute inset-0 bg-gradient-to-r from-blue-500/10 to-indigo-500/10 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    <div class="relative p-6">
                        <div class="flex items-center justify-between mb-4">
                            <div class="p-3 rounded-xl bg-gradient-to-r from-blue-500 to-blue-600 shadow-lg">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                                </svg>
                            </div>
                            <div class="text-right">
                                <div class="text-2xl sm:text-3xl font-bold text-gray-900 mb-1">{{ $totalUsers ?? 0 }}</div>
                                <div class="text-xs text-green-600 font-medium">+12% dari bulan lalu</div>
                            </div>
                        </div>
                        <div>
                            <h3 class="text-sm font-semibold text-gray-600 uppercase tracking-wide">Total Pengguna</h3>
                            <p class="text-xs text-gray-500 mt-1">Pengguna aktif sistem</p>
                        </div>
                    </div>
                </div>

                <!-- Total Announcements Card -->
                <div class="group relative overflow-hidden bg-white/80 backdrop-blur-sm rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 border border-white/20">
                    <div class="absolute inset-0 bg-gradient-to-r from-green-500/10 to-emerald-500/10 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    <div class="relative p-6">
                        <div class="flex items-center justify-between mb-4">
                            <div class="p-3 rounded-xl bg-gradient-to-r from-green-500 to-emerald-600 shadow-lg">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-5 5v-5zM10.5 17H15v-5l-5 5zM14 7V3a1 1 0 00-1-1H5a1 1 0 00-1 1v4h10z"></path>
                                </svg>
                            </div>
                            <div class="text-right">
                                <div class="text-2xl sm:text-3xl font-bold text-gray-900 mb-1">{{ $pengumumanCount ?? 0 }}</div>
                                <div class="text-xs text-green-600 font-medium">+5% minggu ini</div>
                            </div>
                        </div>
                        <div>
                            <h3 class="text-sm font-semibold text-gray-600 uppercase tracking-wide">Total Pengumuman</h3>
                            <p class="text-xs text-gray-500 mt-1">Pengumuman aktif</p>
                        </div>
                    </div>
                </div>

                <!-- Total Chronology Card -->
                <div class="group relative overflow-hidden bg-white/80 backdrop-blur-sm rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 border border-white/20">
                    <div class="absolute inset-0 bg-gradient-to-r from-purple-500/10 to-violet-500/10 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    <div class="relative p-6">
                        <div class="flex items-center justify-between mb-4">
                            <div class="p-3 rounded-xl bg-gradient-to-r from-purple-500 to-violet-600 shadow-lg">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                            </div>
                            <div class="text-right">
                                <div class="text-2xl sm:text-3xl font-bold text-gray-900 mb-1">{{ $kronologiCount ?? 0 }}</div>
                                <div class="text-xs text-blue-600 font-medium">+8% hari ini</div>
                            </div>
                        </div>
                        <div>
                            <h3 class="text-sm font-semibold text-gray-600 uppercase tracking-wide">Total Kronologi</h3>
                            <p class="text-xs text-gray-500 mt-1">Catatan kronologi</p>
                        </div>
                    </div>
                </div>

                <!-- Total Files Card -->
                <div class="group relative overflow-hidden bg-white/80 backdrop-blur-sm rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 border border-white/20">
                    <div class="absolute inset-0 bg-gradient-to-r from-red-500/10 to-pink-500/10 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    <div class="relative p-6">
                        <div class="flex items-center justify-between mb-4">
                            <div class="p-3 rounded-xl bg-gradient-to-r from-red-500 to-pink-600 shadow-lg">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                                </svg>
                            </div>
                            <div class="text-right">
                                <div class="text-2xl sm:text-3xl font-bold text-gray-900 mb-1">{{ $fileCount ?? 0 }}</div>
                                <div class="text-xs text-green-600 font-medium">+3% minggu ini</div>
                            </div>
                        </div>
                        <div>
                            <h3 class="text-sm font-semibold text-gray-600 uppercase tracking-wide">Total File</h3>
                            <p class="text-xs text-gray-500 mt-1">File terupload</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="px-4 sm:px-6 lg:px-8 pb-8">
        <div class="max-w-7xl mx-auto">
            <div class="grid grid-cols-1 xl:grid-cols-3 gap-8">
                <!-- Chronology Table -->
                <div class="xl:col-span-2">
                    <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-lg border border-white/20 overflow-hidden">
                        <div class="px-6 py-5 border-b border-gray-100 bg-gradient-to-r from-gray-50 to-white">
                            <div class="flex items-center justify-between">
                                <div>
                                    <h3 class="text-xl font-bold text-gray-900">Kronologi Terbaru</h3>
                                    <p class="text-sm text-gray-600 mt-1">Data kronologi terkini dari sistem</p>
                                </div>
                                <div class="flex items-center space-x-2">
                                    <div class="w-3 h-3 bg-green-400 rounded-full animate-pulse"></div>
                                    <span class="text-sm text-gray-500">Live</span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="overflow-x-auto">
                            <table class="w-full">
                                <thead class="bg-gradient-to-r from-gray-50 to-blue-50">
                                    <tr>
                                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Tanggal</th>
                                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">WIP</th>
                                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Area</th>
                                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">PDK Fail</th>
                                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Style Fail</th>
                                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Kategori</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100">
                                    @foreach($kronologi as $index => $item)
                                    <tr class="hover:bg-gradient-to-r hover:from-blue-50 hover:to-indigo-50 transition-all duration-200 group">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="w-2 h-2 bg-blue-500 rounded-full mr-3 opacity-0 group-hover:opacity-100 transition-opacity duration-200"></div>
                                                <div>
                                                    <div class="text-sm font-semibold text-gray-900">{{ $item->tanggal }}</div>
                                                    <div class="text-xs text-gray-500">{{ $item->created_at->diffForHumans() }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                {{ $item->wip }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-medium text-gray-900">{{ $item->area }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">{{ $item->no_model_salah }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">{{ $item->style_salah }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                                {{ $item->kategori }}
                                            </span>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Announcements Sidebar -->
                <div class="xl:col-span-1">
                    <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-lg border border-white/20 overflow-hidden">
                        <div class="px-6 py-5 border-b border-gray-100 bg-gradient-to-r from-gray-50 to-white">
                            <div class="flex items-center justify-between">
                                <div>
                                    <h3 class="text-xl font-bold text-gray-900">Pengumuman</h3>
                                    <p class="text-sm text-gray-600 mt-1">Berita dan pengumuman terkini</p>
                                </div>
                                <div class="p-2 rounded-lg bg-gradient-to-r from-blue-500 to-indigo-600">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                        
                        <div class="p-6">
                            @if($pengumuman->isEmpty())
                                <div class="text-center py-12">
                                    <div class="mx-auto w-24 h-24 bg-gradient-to-r from-blue-100 to-indigo-100 rounded-full flex items-center justify-center mb-4">
                                        <svg class="w-12 h-12 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-5 5v-5z"></path>
                                        </svg>
                                    </div>
                                    <h4 class="text-lg font-semibold text-gray-900 mb-2">Belum Ada Pengumuman</h4>
                                    <p class="text-gray-500">Pengumuman baru akan muncul di sini</p>
                                </div>
                            @else
                                <div class="space-y-6 max-h-96 overflow-y-auto custom-scrollbar">
                                    @foreach($pengumuman as $item)
                                    <div class="group relative p-4 rounded-xl bg-gradient-to-r from-white to-gray-50 border border-gray-100 hover:shadow-lg transition-all duration-300">
                                        <div class="absolute left-0 top-0 w-1 h-full bg-gradient-to-b from-blue-500 to-indigo-600 rounded-l-xl"></div>
                                        
                                        <div class="pl-4">
                                            <div class="flex items-start justify-between mb-3">
                                                <h4 class="font-bold text-gray-900 text-sm leading-tight group-hover:text-blue-600 transition-colors duration-200">
                                                    {{ $item->judul_pengumuman }}
                                                </h4>
                                                <div class="ml-2 flex-shrink-0">
                                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                        Baru
                                                    </span>
                                                </div>
                                            </div>
                                            
                                            <div class="flex items-center text-xs text-gray-500 mb-3">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                </svg>
                                                {{ $item->created_at->format('d M Y, H:i') }}
                                            </div>
                                            
                                            <p class="text-sm text-gray-600 leading-relaxed mb-4">
                                                {{ Str::limit($item->isi_pengumuman, 120) }}
                                            </p>
                                            
                                            @if(!empty($item->gambar))
                                                <div class="mb-4">
                                                    <img src="{{ asset('storage/'.$item->gambar) }}" 
                                                         alt="Gambar Pengumuman" 
                                                         class="w-full h-32 object-cover rounded-lg border border-gray-200 group-hover:shadow-md transition-shadow duration-200">
                                                </div>
                                            @endif
                                            
                                            @if(!empty($item->file_attachment))
                                                <div class="pt-3 border-t border-gray-100">
                                                    <a href="{{ asset('storage/'.$item->file_attachment) }}" 
                                                       class="inline-flex items-center px-3 py-2 text-sm font-medium text-blue-600 bg-blue-50 rounded-lg hover:bg-blue-100 transition-colors duration-200" 
                                                       target="_blank">
                                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                                        </svg>
                                                        Download Lampiran
                                                    </a>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                
                                <div class="mt-6 pt-4 border-t border-gray-100">
                                    {{ $pengumuman->links() }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('layouts.footer')
</div>

@endsection
@push('styles')
    
<style>
    .custom-scrollbar::-webkit-scrollbar {
        width: 6px;
    }
    
    .custom-scrollbar::-webkit-scrollbar-track {
        background: #f1f5f9;
        border-radius: 10px;
    }
    
    .custom-scrollbar::-webkit-scrollbar-thumb {
        background: linear-gradient(to bottom, #3b82f6, #6366f1);
        border-radius: 10px;
    }
    
    .custom-scrollbar::-webkit-scrollbar-thumb:hover {
        background: linear-gradient(to bottom, #2563eb, #4f46e5);
    }
</style>
@endpush
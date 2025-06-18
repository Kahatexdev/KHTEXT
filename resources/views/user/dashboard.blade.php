@extends('layouts.app')
@section('title', 'User Dashboard')

@php
    use Illuminate\Support\Str;
@endphp

@section('content')
<div class="w-full px-6 py-6 mx-auto bg-gradient-to-br from-slate-50 to-blue-50 min-h-screen">
    <!-- Welcome Header -->
    <div class="mb-8">
        <div class="bg-gradient-to-r from-blue-600 via-purple-600 to-cyan-500 rounded-2xl p-8 text-white relative overflow-hidden">
            <div class="absolute inset-0 bg-black/10"></div>
            <div class="relative z-10">
                <h1 class="text-3xl font-bold mb-2">Welcome Back! 👋</h1>
                <p class="text-blue-100 text-lg">Here's what's happening with your business today.</p>
            </div>
            <!-- Decorative elements -->
            <div class="absolute -top-4 -right-4 w-24 h-24 bg-white/10 rounded-full blur-xl"></div>
            <div class="absolute -bottom-8 -left-8 w-32 h-32 bg-purple-300/20 rounded-full blur-2xl"></div>
        </div>
    </div>

    <!-- Statistics Row -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        @foreach([ 
            ['label'=>"Today's Money", 'value'=>'$53,000', 'change'=>'+55%', 'color'=>'emerald', 'icon'=>'ni-money-coins', 'bg'=>'from-emerald-500 to-teal-400'],
            ['label'=>"Today's Users", 'value'=>'2,300', 'change'=>'+3%',  'color'=>'blue', 'icon'=>'ni-world', 'bg'=>'from-blue-500 to-cyan-400'],
            ['label'=>"New Clients",   'value'=>'+3,462','change'=>'-2%',  'color'=>'red',  'icon'=>'ni-paper-diploma', 'bg'=>'from-orange-500 to-red-400'],
            ['label'=>"Sales",         'value'=>'$103,430','change'=>'+5%', 'color'=>'purple', 'icon'=>'ni-cart', 'bg'=>'from-purple-500 to-pink-400'],
        ] as $index => $stat)
        <div class="group bg-white/80 backdrop-blur-sm shadow-lg hover:shadow-2xl rounded-2xl p-6 transition-all duration-300 hover:-translate-y-2 border border-white/20 relative overflow-hidden" 
             style="animation-delay: {{ $index * 0.1 }}s">
            <!-- Subtle background pattern -->
            <div class="absolute inset-0 bg-gradient-to-br from-transparent to-gray-50/50 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
            
            <div class="relative z-10 flex items-center justify-between">
                <div class="flex-1">
                    <p class="text-sm font-medium text-gray-600 mb-1">{{ $stat['label'] }}</p>
                    <div class="flex items-baseline">
                        <h3 class="text-2xl font-bold text-gray-800 mr-2 group-hover:text-{{ $stat['color'] }}-600 transition-colors duration-300">
                            {{ $stat['value'] }}
                        </h3>
                        <span class="text-sm px-2 py-1 rounded-full bg-{{ $stat['color'] }}-50 text-{{ $stat['color'] }}-600 font-semibold border border-{{ $stat['color'] }}-200">
                            {{ $stat['change'] }}
                        </span>
                    </div>
                </div>
                <div class="p-4 rounded-2xl bg-gradient-to-br {{ $stat['bg'] }} text-white shadow-lg group-hover:scale-110 transition-transform duration-300">
                    <i class="ni {{ $stat['icon'] }} text-2xl"></i>
                </div>
            </div>
            
            <!-- Animated border -->
            <div class="absolute inset-0 rounded-2xl bg-gradient-to-r {{ $stat['bg'] }} opacity-0 group-hover:opacity-20 transition-opacity duration-300 -m-0.5 -z-10"></div>
        </div>
        @endforeach
    </div>

    <!-- Main Content Grid -->
    <div class="grid grid-cols-1 xl:grid-cols-3 gap-8">
        <!-- Projects Table (2/3 width) -->
        <div class="xl:col-span-2">
            <div class="bg-white/90 backdrop-blur-sm shadow-xl rounded-2xl overflow-hidden border border-white/20">
                <div class="px-8 py-6 bg-gradient-to-r from-slate-50 to-blue-50 border-b border-gray-100">
                    <div class="flex items-center justify-between">
                        <h6 class="text-xl font-bold text-gray-800 flex items-center">
                            <span class="w-2 h-8 bg-gradient-to-b from-blue-500 to-purple-500 rounded-full mr-3"></span>
                            Active Projects
                        </h6>
                        <span class="px-3 py-1 bg-blue-100 text-blue-700 text-sm font-medium rounded-full">8 Active</span>
                    </div>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm">
                        <thead class="bg-gradient-to-r from-gray-50 to-slate-100">
                            <tr>
                                <th class="px-6 py-4 font-semibold text-gray-700">Company</th>
                                <th class="px-6 py-4 font-semibold text-gray-700">Members</th>
                                <th class="px-6 py-4 font-semibold text-gray-700">Budget</th>
                                <th class="px-6 py-4 font-semibold text-gray-700">Completion</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- Sample rows with better styling --}}
                            @foreach([
                                ['name' => 'Soft UI XD Version', 'members' => 'Ryan, Romina, Alex', 'budget' => '$14,000', 'progress' => 60],
                                ['name' => 'Mobile App Development', 'members' => 'Sarah, Mike, John', 'budget' => '$28,500', 'progress' => 75],
                                ['name' => 'Website Redesign', 'members' => 'Emma, David', 'budget' => '$8,200', 'progress' => 40],
                                ['name' => 'Marketing Campaign', 'members' => 'Lisa, Tom, Anna', 'budget' => '$12,800', 'progress' => 90]
                            ] as $project)
                            <tr class="border-t border-gray-100 hover:bg-gradient-to-r hover:from-blue-50/50 hover:to-transparent transition-all duration-200 group">
                                <td class="px-6 py-4">
                                    <div class="font-medium text-gray-800 group-hover:text-blue-700 transition-colors">
                                        {{ $project['name'] }}
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex -space-x-2">
                                        @foreach(explode(', ', $project['members']) as $member)
                                        <div class="w-8 h-8 bg-gradient-to-br from-blue-400 to-purple-500 rounded-full flex items-center justify-center text-white text-xs font-semibold border-2 border-white">
                                            {{ substr($member, 0, 1) }}
                                        </div>
                                        @endforeach
                                    </div>
                                    <div class="text-xs text-gray-500 mt-1">{{ $project['members'] }}</div>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="font-semibold text-gray-800">{{ $project['budget'] }}</span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="w-full bg-gray-200 rounded-full h-3 overflow-hidden">
                                        <div class="h-full rounded-full bg-gradient-to-r from-blue-500 to-cyan-400 transition-all duration-1000 ease-out" 
                                             style="width: {{ $project['progress'] }}%"></div>
                                    </div>
                                    <span class="text-xs text-gray-600 mt-1 inline-block">{{ $project['progress'] }}% Complete</span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Announcements Sidebar (1/3 width) -->
        <div class="xl:col-span-1">
            <div class="bg-white/90 backdrop-blur-sm shadow-xl rounded-2xl p-8 border border-white/20 h-fit">
                <div class="flex items-center justify-between mb-6">
                    <h6 class="text-xl font-bold text-gray-800 flex items-center">
                        <span class="w-2 h-8 bg-gradient-to-b from-purple-500 to-pink-500 rounded-full mr-3"></span>
                        Pengumuman Terbaru
                    </h6>
                    <div class="w-3 h-3 bg-green-400 rounded-full animate-pulse"></div>
                </div>
                
                @if($pengumuman->isEmpty())
                    <div class="text-center py-12">
                        <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="ni ni-bell text-2xl text-gray-400"></i>
                        </div>
                        <p class="text-gray-500">Belum ada pengumuman.</p>
                    </div>
                @else
                    <div class="space-y-6 max-h-96 overflow-y-auto custom-scrollbar">
                        @foreach($pengumuman as $index => $item)
                        <div class="group p-4 rounded-xl bg-gradient-to-br from-gray-50/80 to-white border border-gray-100 hover:shadow-md transition-all duration-300" 
                             style="animation-delay: {{ $index * 0.1 }}s">
                            <div class="flex items-start">
                                <div class="w-3 h-3 rounded-full bg-gradient-to-br from-blue-400 to-purple-500 mt-2 mr-4 flex-shrink-0 group-hover:scale-125 transition-transform"></div>
                                <div class="flex-1 min-w-0">
                                    <h6 class="text-sm font-semibold text-gray-800 mb-1 group-hover:text-blue-700 transition-colors truncate">
                                        {{ $item->judul_pengumuman }}
                                    </h6>
                                    <p class="text-xs text-gray-500 mb-2 flex items-center">
                                        <i class="ni ni-calendar-grid-58 mr-1"></i>
                                        {{ $item->created_at->format('d M Y, H:i') }}
                                    </p>
                                    <p class="text-sm text-gray-600 leading-relaxed">
                                        {{ Str::limit($item->isi_pengumuman, 80) }}
                                    </p>
                                    
                                    @if(!empty($item->gambar))
                                        <div class="mt-3">
                                            <img src="{{ asset('storage/'.$item->gambar) }}" 
                                                 alt="Gambar Pengumuman" 
                                                 class="w-full h-24 object-cover rounded-lg shadow-sm hover:shadow-md transition-shadow">
                                        </div>
                                    @endif
                                    
                                    @if(!empty($item->file_attachment))
                                        <div class="mt-3">
                                            <a href="{{ asset('storage/'.$item->file_attachment) }}" 
                                               class="inline-flex items-center px-3 py-1 bg-blue-50 text-blue-600 rounded-full text-xs font-medium hover:bg-blue-100 transition-colors" 
                                               target="_blank">
                                                <i class="ni ni-cloud-download-95 mr-1"></i>
                                                Download
                                            </a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    
                    <div class="mt-6 flex justify-center">
                        {{ $pengumuman->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>

    @include('layouts.footer')
</div>

@push('styles')
<style>
    .custom-scrollbar::-webkit-scrollbar {
        width: 6px;
    }
    .custom-scrollbar::-webkit-scrollbar-track {
        background: #f1f5f9;
        border-radius: 6px;
    }
    .custom-scrollbar::-webkit-scrollbar-thumb {
        background: linear-gradient(180deg, #3b82f6, #8b5cf6);
        border-radius: 6px;
    }
    .custom-scrollbar::-webkit-scrollbar-thumb:hover {
        background: linear-gradient(180deg, #2563eb, #7c3aed);
    }
    
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .group:hover .animate-pulse {
        animation: none;
    }
</style>
@endpush
@endsection
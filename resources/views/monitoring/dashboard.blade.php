@extends('layouts.app')
@section('title', 'User Dashboard')

@php
    use Illuminate\Support\Str;
@endphp

@section('content')
<div class="w-full px-6 py-6 mx-auto bg-gray-50 min-h-screen">
    <!-- Statistics Row -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-5 hover:shadow-md transition-shadow duration-200">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600 font-medium">Total Pengguna</p>
                    <h3 class="text-2xl font-bold text-gray-900 mt-1">{{ $totalUsers ?? 0 }}</h3>
                    <span class="inline-flex items-center text-sm font-medium mt-2 text-blue-600 bg-blue-50 px-2 py-1 rounded-full">
                        {{ $userChange ?? '+0%' }} dari kemarin
                    </span>
                </div>
                <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                    <i class="ni ni-single-02 text-xl"></i>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-5 hover:shadow-md transition-shadow duration-200">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600 font-medium">Total Pengumuman</p>
                    <h3 class="text-2xl font-bold text-gray-900 mt-1">{{ $pengumumanCount ?? 0 }}</h3>
                    <span class="inline-flex items-center text-sm font-medium mt-2 text-green-600 bg-green-50 px-2 py-1 rounded-full">
                        {{ $pengumumanChange ?? '+0%' }} dari kemarin
                    </span>
                </div>
                <div class="p-3 rounded-full bg-green-100 text-green-600">
                    <i class="ni ni-bell-55 text-xl"></i>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-5 hover:shadow-md transition-shadow duration-200">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600 font-medium">Total Kronologi</p>
                    <h3 class="text-2xl font-bold text-gray-900 mt-1">{{ $kronologiCount ?? 0 }}</h3>
                    <span class="inline-flex items-center text-sm font-medium mt-2 text-purple-600 bg-purple-50 px-2 py-1 rounded-full">
                        {{ $kronologiChange ?? '+0%' }} dari kemarin
                    </span>
                </div>
                <div class="p-3 rounded-full bg-purple-100 text-purple-600">
                    <i class="ni ni-collection text-xl"></i>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-5 hover:shadow-md transition-shadow duration-200">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600 font-medium">Total File Terupload</p>
                    <h3 class="text-2xl font-bold text-gray-900 mt-1">{{ $fileCount ?? 0 }}</h3>
                    <span class="inline-flex items-center text-sm font-medium mt-2 text-red-600 bg-red-50 px-2 py-1 rounded-full">
                        {{ $fileChange ?? '+0%' }} dari kemarin
                    </span>
                </div>
                <div class="p-3 rounded-full bg-red-100 text-red-600">
                    <i class="ni ni-cloud-upload-96 text-xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Projects Table -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">Kronologi Terbaru</h3>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Company</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Members</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Budget</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Completion</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            {{-- Sample data --}}
                            @foreach([
                                ['name' => 'Soft UI XD Version', 'members' => 'Ryan, Romina, Alex', 'budget' => '$14,000', 'progress' => 60],
                                ['name' => 'Mobile App Development', 'members' => 'Sarah, Mike, John', 'budget' => '$28,500', 'progress' => 75],
                                ['name' => 'Website Redesign', 'members' => 'Emma, David', 'budget' => '$8,200', 'progress' => 40]
                            ] as $project)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">{{ $project['name'] }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-600">{{ $project['members'] }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">{{ $project['budget'] }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="w-full bg-gray-200 rounded-full h-2 mr-3">
                                            <div class="h-2 rounded-full bg-blue-600" style="width: {{ $project['progress'] }}%"></div>
                                        </div>
                                        <span class="text-sm text-gray-600 min-w-max">{{ $project['progress'] }}%</span>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Announcements -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Pengumuman Terbaru</h3>
                
                @if($pengumuman->isEmpty())
                    <div class="text-center py-8">
                        <div class="text-gray-400 mb-2">
                            <i class="ni ni-bell text-3xl"></i>
                        </div>
                        <p class="text-gray-500">Belum ada pengumuman.</p>
                    </div>
                @else
                    <div class="space-y-4 max-h-96 overflow-y-auto">
                        @foreach($pengumuman as $item)
                        <div class="border-l-4 border-blue-500 pl-4 py-2">
                            <h4 class="font-medium text-gray-900 text-sm">{{ $item->judul_pengumuman }}</h4>
                            <p class="text-xs text-gray-500 mt-1">{{ $item->created_at->format('d M Y, H:i') }}</p>
                            <p class="text-sm text-gray-600 mt-2">{{ Str::limit($item->isi_pengumuman, 100) }}</p>
                            
                            @if(!empty($item->gambar))
                                <div class="mt-3">
                                    <img src="{{ asset('storage/'.$item->gambar) }}" alt="Gambar Pengumuman" 
                                         class="w-full h-32 object-cover rounded border">
                                </div>
                            @endif
                            
                            @if(!empty($item->file_attachment))
                                <div class="mt-2">
                                    <a href="{{ asset('storage/'.$item->file_attachment) }}" 
                                       class="inline-flex items-center text-blue-600 hover:text-blue-800 text-sm" 
                                       target="_blank">
                                        <i class="ni ni-cloud-download-95 mr-1"></i>
                                        Download Lampiran
                                    </a>
                                </div>
                            @endif
                        </div>
                        @endforeach
                    </div>
                    
                    <div class="mt-4">
                        {{ $pengumuman->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>

    @include('layouts.footer')
</div>
@endsection
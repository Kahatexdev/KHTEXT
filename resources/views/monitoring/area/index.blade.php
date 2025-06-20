{{-- resources/views/monitoring/area/index.blade.php --}}
@extends('layouts.app')
@section('title', 'Area')
@section('page-title', 'Area')

@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-100">
        <!-- Success Alert -->
        @if (session('success'))
            <div class="fixed top-4 right-4 z-50 animate-slideInDown">
                <div class="bg-gradient-to-r from-green-500 to-emerald-600 text-white px-6 py-4 rounded-xl shadow-lg border border-white/20 backdrop-blur-sm">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        {{ session('success') }}
                    </div>
                </div>
            </div>
        @endif

        <div class="px-4 sm:px-6 lg:px-8 py-8">
            <div class="max-w-7xl mx-auto space-y-8">
                
                <!-- Header Section -->
                <div class="text-center mb-8">
                    <h1 class="text-3xl sm:text-4xl font-bold bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent mb-2">
                        Manajemen Area
                    </h1>
                    <p class="text-gray-600 text-lg">Kelola dan monitor semua area dengan mudah</p>
                </div>

                <!-- Action Header -->
                <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-lg border border-white/20 p-6">
                    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                        <div class="flex items-center space-x-4">
                            <div class="p-3 rounded-xl bg-gradient-to-r from-blue-500 to-indigo-600 shadow-lg">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-4m-5 0H9m0 0H5m0 0h2M7 16l1-4h8l1 4M7 8h10"></path>
                                </svg>
                            </div>
                            <div>
                                <h2 class="text-xl font-bold text-gray-900">Data Area</h2>
                                <p class="text-sm text-gray-600">{{ $data->total() }} area terdaftar</p>
                            </div>
                        </div>
                        
                        <div class="flex items-center space-x-3 w-full sm:w-auto">
                            <!-- Search Box -->
                            <div class="relative flex-1 sm:w-64">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                    </svg>
                                </div>
                                <input type="text" id="searchBox" placeholder="Cari area..." 
                                       class="block w-full pl-10 pr-3 py-2.5 border border-gray-200 rounded-xl bg-white/70 backdrop-blur-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm transition-all duration-200">
                            </div>
                            
                            <!-- Add Button -->
                            <button id="openModal" 
                                    class="group relative overflow-hidden bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white px-6 py-2.5 rounded-xl font-semibold transition-all duration-300 shadow-lg hover:shadow-xl flex items-center space-x-2">
                                <div class="absolute inset-0 bg-white/20 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                                <svg class="w-5 h-5 relative z-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                </svg>
                                <span class="relative z-10">Tambah Area</span>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Data Table -->
                <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-lg border border-white/20 overflow-hidden">
                    <!-- Table Header -->
                    <div class="px-6 py-4 border-b border-gray-100 bg-gradient-to-r from-gray-50 to-white">
                        <div class="flex items-center justify-between">
                            <h3 class="text-lg font-semibold text-gray-900">Daftar Area</h3>
                            <div class="flex items-center space-x-2">
                                <div class="w-3 h-3 bg-green-400 rounded-full animate-pulse"></div>
                                <span class="text-sm text-gray-500">Live Data</span>
                            </div>
                        </div>
                    </div>

                    <!-- Responsive Table Wrapper -->
                    <div class="overflow-x-auto">
                        <div class="min-w-full">
                            <!-- Mobile Card View (Hidden on Desktop) -->
                            <div class="block sm:hidden">
                                @foreach ($data as $item)
                                <div class="border-b border-gray-100 p-4 hover:bg-gradient-to-r hover:from-blue-50 hover:to-indigo-50 transition-all duration-200">
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center space-x-3">
                                            <div class="w-10 h-10 rounded-full bg-gradient-to-r from-blue-500 to-indigo-600 flex items-center justify-center text-white font-semibold text-sm">
                                                {{ $loop->iteration + ($data->currentPage() - 1) * $data->perPage() }}
                                            </div>
                                            <div>
                                                <h4 class="font-semibold text-gray-900">{{ $item->nama_area }}</h4>
                                                <p class="text-sm text-gray-500">Area #{{ $item->nama_area }}</p>
                                            </div>
                                        </div>
                                        <div class="flex items-center space-x-2">
                                            <button type="button"
                                                    class="deleteBtn p-2 bg-gradient-to-r from-red-500 to-rose-600 hover:from-red-600 hover:to-rose-700 text-white rounded-lg transition-all duration-200 shadow-sm hover:shadow-md"
                                                    data-nama="{{ $item->nama_area }}"
                                                    data-url="{{ route('area.destroy', $item->nama_area) }}">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>

                            <!-- Desktop Table View (Hidden on Mobile) -->
                            <table class="hidden sm:table min-w-full" id="areaTable">
                                <thead class="bg-gradient-to-r from-gray-50 to-blue-50">
                                    <tr>
                                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">
                                            <div class="flex items-center space-x-2">
                                                <span>No</span>
                                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4"></path>
                                                </svg>
                                            </div>
                                        </th>
                                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">
                                            <div class="flex items-center space-x-2">
                                                <span>Nama Area</span>
                                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-4m-5 0H9m0 0H5m0 0h2M7 16l1-4h8l1 4M7 8h10"></path>
                                                </svg>
                                            </div>
                                        </th>
                                        <th class="px-6 py-4 text-right text-xs font-bold text-gray-600 uppercase tracking-wider">
                                            <div class="flex items-center justify-end space-x-2">
                                                <span>Aksi</span>
                                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"></path>
                                                </svg>
                                            </div>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100">
                                    @foreach ($data as $item)
                                        <tr class="hover:bg-gradient-to-r hover:from-blue-50 hover:to-indigo-50 transition-all duration-200 group">
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <div class="w-2 h-2 bg-blue-500 rounded-full mr-3 opacity-0 group-hover:opacity-100 transition-opacity duration-200"></div>
                                                    <div class="w-8 h-8 rounded-lg bg-gradient-to-r from-blue-500 to-indigo-600 flex items-center justify-center text-white font-semibold text-sm">
                                                        {{ $loop->iteration + ($data->currentPage() - 1) * $data->perPage() }}
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <div class="mr-4">
                                                        <div class="w-10 h-10 rounded-xl bg-gradient-to-r from-gray-100 to-gray-200 flex items-center justify-center">
                                                            <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-4m-5 0H9m0 0H5m0 0h2M7 16l1-4h8l1 4M7 8h10"></path>
                                                            </svg>
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <div class="text-sm font-semibold text-gray-900">{{ $item->nama_area }}</div>
                                                        <div class="text-xs text-gray-500">Area ID: {{ $item->nama_area }}</div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-right">
                                                <div class="flex items-center justify-end space-x-2">
                                                    <button type="button"
                                                            class="deleteBtn group relative overflow-hidden bg-gradient-to-r from-red-500 to-rose-600 hover:from-red-600 hover:to-rose-700 text-white px-4 py-2 rounded-lg font-medium transition-all duration-300 shadow-sm hover:shadow-md flex items-center space-x-2"
                                                            data-nama="{{ $item->nama_area }}"
                                                            data-url="{{ route('area.destroy', $item->nama_area) }}">
                                                        <div class="absolute inset-0 bg-white/20 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                                                        <svg class="w-4 h-4 relative z-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                        </svg>
                                                        <span class="relative z-10 hidden sm:inline">Hapus</span>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Enhanced Pagination -->
                    @if($data->hasPages())
                    <div class="px-6 py-4 border-t border-gray-100 bg-gradient-to-r from-white to-gray-50">
                        <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
                            <div class="text-sm text-gray-600">
                                Menampilkan {{ $data->firstItem() }} - {{ $data->lastItem() }} dari {{ $data->total() }} data
                            </div>
                            <div class="flex items-center space-x-2">
                                {{ $data->links() }}
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    {{-- Enhanced Modal Create/Edit --}}
    <div id="modalOverlay"
        class="fixed inset-0 flex hidden items-center justify-center bg-black/60 backdrop-blur-sm z-[9999] transition-all duration-300 p-4">
        <div class="bg-white rounded-3xl w-full max-w-lg relative shadow-2xl border border-white/20 animate-fadeIn max-h-[90vh] overflow-y-auto">
            <!-- Modal Header -->
            <div class="px-8 py-6 border-b border-gray-100 bg-gradient-to-r from-blue-50 to-indigo-50 rounded-t-3xl">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <div class="p-2 rounded-xl bg-gradient-to-r from-blue-500 to-indigo-600 shadow-lg">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                        </div>
                        <h3 id="modalTitle" class="text-xl font-bold text-gray-900"></h3>
                    </div>
                    <button id="closeX" class="p-2 hover:bg-white/50 rounded-lg transition-colors duration-200">
                        <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Modal Body -->
            <div class="p-8">
                <form id="areaForm" method="POST" class="space-y-6">
                    @csrf
                    <div class="space-y-2">
                        <label class="block text-sm font-semibold text-gray-700">
                            Nama Area <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-4m-5 0H9m0 0H5m0 0h2M7 16l1-4h8l1 4M7 8h10"></path>
                                </svg>
                            </div>
                            <input type="text" name="nama_area" placeholder="Masukkan nama area..."
                                class="block w-full pl-10 pr-3 py-3 border border-gray-200 rounded-xl bg-gray-50 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:bg-white transition-all duration-200"
                                required>
                        </div>
                        <div class="text-red-500 text-sm mt-1 hidden" id="error-nama_area"></div>
                    </div>
                </form>
            </div>

            <!-- Modal Footer -->
            <div class="px-8 py-6 border-t border-gray-100 bg-gray-50 rounded-b-3xl">
                <div class="flex flex-col sm:flex-row gap-3 sm:gap-0 sm:justify-end sm:space-x-3">
                    <button type="button" id="closeModal"
                        class="order-2 sm:order-1 px-6 py-3 bg-white border border-gray-200 rounded-xl hover:bg-gray-50 text-gray-700 font-semibold transition-all duration-200 shadow-sm hover:shadow-md">
                        Batal
                    </button>
                    <button type="submit" form="areaForm" id="saveBtn"
                        class="order-1 sm:order-2 px-8 py-3 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white rounded-xl font-semibold shadow-lg hover:shadow-xl transition-all duration-300 disabled:opacity-50 disabled:cursor-not-allowed">
                        <span class="btn-text">Simpan Area</span>
                        <span class="btn-loading hidden">
                            <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white inline" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            Menyimpan...
                        </span>
                    </button>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('styles')
<style>
    @keyframes slideInDown {
        from {
            transform: translate3d(0, -100%, 0);
            visibility: visible;
        }
        to {
            transform: translate3d(0, 0, 0);
        }
    }
    
    @keyframes fadeIn {
        from { opacity: 0; transform: scale(0.9); }
        to { opacity: 1; transform: scale(1); }
    }
    
    .animate-slideInDown {
        animation: slideInDown 0.5s ease-out;
    }
    
    .animate-fadeIn {
        animation: fadeIn 0.3s ease-out;
    }
    
    /* Custom Scrollbar */
    .overflow-y-auto::-webkit-scrollbar {
        width: 6px;
    }
    
    .overflow-y-auto::-webkit-scrollbar-track {
        background: #f1f5f9;
        border-radius: 10px;
    }
    
    .overflow-y-auto::-webkit-scrollbar-thumb {
        background: linear-gradient(to bottom, #3b82f6, #6366f1);
        border-radius: 10px;
    }
    
    .overflow-y-auto::-webkit-scrollbar-thumb:hover {
        background: linear-gradient(to bottom, #2563eb, #4f46e5);
    }
</style>
@endpush

@push('scripts')
    <script>
        $(function() {
            const overlay = $('#modalOverlay');
            const form = $('#areaForm')[0];
            const $form = $('#areaForm');
            const title = $('#modalTitle');
            const saveBtn = $('#saveBtn');
            const btnText = saveBtn.find('.btn-text');
            const btnLoading = saveBtn.find('.btn-loading');
            const deleteBtn = $('.deleteBtn');
            const searchBox = $('#searchBox');

            function openModal() {
                overlay.removeClass('hidden');
                $('body').css('overflow', 'hidden');
                // Focus on input after animation
                setTimeout(() => {
                    $form.find('input[name="nama_area"]').focus();
                }, 300);
            }

            function closeModal() {
                overlay.addClass('hidden');
                $('body').css('overflow', 'auto');
                form.reset();
                clearErrors();
                $form.find('input[name="_method"]').remove();
                setLoading(false);
            }

            function setLoading(loading) {
                if (loading) {
                    saveBtn.prop('disabled', true);
                    btnText.addClass('hidden');
                    btnLoading.removeClass('hidden');
                } else {
                    saveBtn.prop('disabled', false);
                    btnText.removeClass('hidden');
                    btnLoading.addClass('hidden');
                }
            }

            function clearErrors() {
                $('[id^="error-"]').addClass('hidden').text('');
                $('.border-red-500').removeClass('border-red-500').addClass('border-gray-200');
            }

            function showErrors(errs) {
                clearErrors();
                $.each(errs, (f, msgs) => {
                    $('#error-' + f).removeClass('hidden').text(msgs[0]);
                    $form.find('[name="' + f + '"]').removeClass('border-gray-200').addClass('border-red-500');
                });
            }

            // Enhanced search functionality
            let searchTimeout;
            searchBox.on('input', function() {
                clearTimeout(searchTimeout);
                const query = $(this).val().toLowerCase();
                
                searchTimeout = setTimeout(() => {
                    $('tbody tr, .block.sm\\:hidden > div').each(function() {
                        const areaName = $(this).find('td:nth-child(2), h4').text().toLowerCase();
                        if (areaName.includes(query)) {
                            $(this).show().addClass('animate-fadeIn');
                        } else {
                            $(this).hide().removeClass('animate-fadeIn');
                        }
                    });
                }, 300);
            });

            // Open Create Modal
            $('#openModal').on('click', () => {
                clearErrors();
                title.text('Tambah Area Baru');
                $form.attr('action', '{{ route('area.store') }}');
                $form.find('input[name="_method"]').remove();
                openModal();
            });

            // Submit Form
            $form.on('submit', e => {
                e.preventDefault();
                setLoading(true);
                clearErrors();
                
                const formData = new FormData(form);
                const url = $form.attr('action');
                
                $.ajax({
                    url,
                    method: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function() {
                        closeModal();
                        Swal.fire({
                            title: 'Berhasil!',
                            text: 'Area berhasil disimpan.',
                            icon: 'success',
                            timer: 2000,
                            showConfirmButton: false,
                            toast: true,
                            position: 'top-end',
                            background: 'linear-gradient(to right, #10b981, #059669)',
                            color: 'white'
                        }).then(() => {
                            location.reload();
                        });
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) {
                            showErrors(xhr.responseJSON.errors);
                            Swal.fire({
                                title: 'Validasi Error',
                                text: 'Silakan periksa input Anda.',
                                icon: 'warning',
                                confirmButtonColor: '#3b82f6'
                            });
                        } else {
                            Swal.fire({
                                title: 'Gagal!',
                                text: 'Terjadi kesalahan. Silakan coba lagi.',
                                icon: 'error',
                                confirmButtonColor: '#ef4444'
                            });
                        }
                    },
                    complete: function() {
                        setLoading(false);
                    }
                });
            });

            // Close modal events
            $('#closeModal, #closeX').on('click', closeModal);
            overlay.on('click', function(e) {
                if (e.target === this) closeModal();
            });

            // Enhanced Delete functionality
            $(document).on('click', '.deleteBtn', function() {
                const nama = $(this).data('nama');
                const url = $(this).data('url');
                
                Swal.fire({
                    title: 'Konfirmasi Hapus',
                    html: `Apakah Anda yakin ingin menghapus area <br><strong>"${nama}"</strong>?`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#ef4444',
                    cancelButtonColor: '#6b7280',
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal',
                    reverseButtons: true,
                    focusCancel: true,
                    background: '#ffffff',
                    customClass: {
                        popup: 'rounded-2xl shadow-2xl',
                        confirmButton: 'rounded-lg px-6 py-2.5 bg-red-600 text-white font-semibold hover:bg-red-700 transition-colors duration-200',
                        cancelButton: 'rounded-lg px-6 py-2.5 bg-gray-200 text-gray-800 font-semibold hover:bg-gray-300 transition-colors duration-200'
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: url,
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function() {
                                Swal.fire({
                                    title: 'Berhasil!',
                                    text: `Area "${nama}" berhasil dihapus.`,
                                    icon: 'success',
                                    timer: 2000,
                                    showConfirmButton: false,
                                    toast: true,
                                    position: 'top-end',
                                    background: 'linear-gradient(to right, #10b981, #059669)',
                                    color: 'white'
                                }).then(() => {
                                    location.reload();
                                });
                            },
                            error: function(xhr) {
                                Swal.fire({
                                    title: 'Gagal!',
                                    text: 'Terjadi kesalahan saat menghapus area.',
                                    icon: 'error',
                                    confirmButtonColor: '#ef4444'
                                });
                            }
                        });
                    }
                });
            });
        });
    </script>
@endpush
{{-- resources/views/kategori_kronologi/index.blade.php --}}
@extends('layouts.app')
@section('title', 'Flow Proses')

@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 space-y-6">
        {{-- Pesan sukses --}}
        @if (session('success'))
            <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">
                {{ session('success') }}
            </div>
        @endif

        {{-- Header --}}
        <div class="flex items-center justify-between bg-white p-4 rounded-xl shadow">
            <div>
                <h2 class="text-2xl font-semibold text-gray-800">Flow Proses</h2>
                <p class="text-sm text-gray-600">Kelola Flow Proses</p>
            </div>
            <div>
                <button id="openImportModalButton"
                    class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 transition">
                    Import Excel
                </button>
            </div>
        </div>

        {{-- Tabel responsif dengan DataTables --}}
        <div class="bg-white shadow rounded-lg overflow-x-auto">
            <table id="flowTable" class="display responsive nowrap w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th>#</th>
                        {{-- <th>APS Style ID</th> --}}
                        <th>Model</th>
                        <th>Area</th>
                        <th>Size</th>
                        <th>Inisial</th>
                        <th>Tanggal</th>
                        <th>Jumlah Proses</th>
                        <th>Detail Proses</th>
                        <th>Admin</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($flows as $i => $flow)
                        @php $style = $styles[$flow->idapsperstyle] ?? null; @endphp
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            {{-- <td>{{ $flow->idapsperstyle }}</td> --}}
                            <td>{{ $style['mastermodel'] ?? '-' }}</td>
                            <td>{{ $flow->area }}</td>
                            <td>{{ $style['size'] ?? '-' }}</td>
                            <td>{{ $style['inisial'] ?? '-' }}</td>
                            <td>{{ \Carbon\Carbon::parse($flow->tanggal)->format('Y-m-d') }}</td>
                            <td class="text-center">{{ $flow->flowProses->count() }}</td>
                            <td>
                                <ul class="list-disc list-inside space-y-1">
                                    @foreach ($flow->flowProses as $fp)
                                        <li>[{{ $fp->step_order }}] {{ $fp->masterProses->nama_proses }}</li>
                                    @endforeach
                                </ul>
                            </td>
                            <td class="text-center">{{ $flow->user->name ?? '-' }}</td>
                            <td class="text-center space-x-2">
                                <a href="{{ route('flowproses.edit', $flow->id_main_flow) }}"
                                    class="bg-yellow-600 hover:bg-yellow-700 text-white px-4 py-2 rounded text-sm font-medium"><i
                                        class="fas fa-edit mr-2"></i> Edit</a>
                                <form
                                    action="{{ route('flowproses.destroy', ['main_flowproses' => $flow->id_main_flow]) }}"
                                    method="POST" class="inline delete-form">
                                    @csrf @method('DELETE')
                                    <button type="button"
                                        class="btn-delete inline-flex items-center bg-red-600 hover:bg-red-700 text-white px-4 py-2 text-sm rounded font-medium">
                                        <i class="fas fa-trash-alt mr-2"></i> Hapus
                                    </button>
                                </form>

                            </td>
                        </tr>
                    @endforeach
                    @if ($flows->isEmpty())
                        <tr>
                            <td colspan="11" class="text-center py-4 text-gray-500">Belum ada data flow proses.</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>

    {{-- Modal Import Excel --}}
    <div id="importModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden z-50">
        <div class="bg-white rounded-xl shadow-lg w-full max-w-md p-6 relative">
            <button id="closeImportModalButton"
                class="absolute top-3 right-3 text-gray-500 hover:text-gray-700">&times;</button>
            <h3 class="text-lg font-medium text-gray-800 mb-4">Import Flow Proses</h3>
            <form action="{{ route('flowproses.import') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                <div>
                    <label for="import_date" class="block text-sm font-medium text-gray-700">Tanggal <span
                            class="text-red-500">*</span></label>
                    <input type="date" name="import_date" id="import_date" required
                        class="mt-1 w-full border-gray-300 rounded-md" />
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">File Attachment <span
                            class="text-red-500">*</span></label>
                    <input type="file" name="file_attachment" accept=".xlsx,.xls"
                        class="mt-1 w-full border-gray-300 rounded-lg" />
                    <p class="text-xs text-gray-500">Format: XLSX, XLS. Maks 5MB</p>
                </div>
                <div class="flex justify-end space-x-2">
                    <button type="button" id="cancelImportButton"
                        class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">Batal</button>
                    <button type="submit"
                        class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">Import</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        const importModal = document.getElementById('importModal');
        document.getElementById('openImportModalButton').addEventListener('click', () => importModal.classList.remove(
            'hidden'));
        document.getElementById('closeImportModalButton').addEventListener('click', () => importModal.classList.add(
            'hidden'));
        document.getElementById('cancelImportButton').addEventListener('click', () => importModal.classList.add('hidden'));
        $(function() {
            // 1. Inisialisasi DataTable dulu
            const table = $('#flowTable').DataTable({
                responsive: true,
                autoWidth: false,
                language: {
                    search: "Cari:",
                    lengthMenu: "Tampilkan _MENU_ data",
                    info: "Menampilkan _START_ hingga _END_ dari _TOTAL_ data",
                    paginate: {
                        first: "Awal",
                        last: "Akhir",
                        next: "›",
                        previous: "‹"
                    },
                    emptyTable: "Tidak ada data tersedia",
                    zeroRecords: "Data tidak ditemukan"
                }
            });

            // 2. Event delegation untuk tombol Hapus
            $('#flowTable tbody').on('click', '.btn-delete', function(e) {
                e.preventDefault();
                const form = $(this).closest('form');
                Swal.fire({
                    title: 'Yakin?',
                    text: "Semua detail akan ikut terhapus!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#dc2626', // Tailwind bg-red-600
                    cancelButtonColor: '#6b7280',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal',
                    customClass: {
                        confirmButton: 'swal2-confirm bg-red-600 text-white hover:bg-red-700 mr-5',
                        cancelButton: 'swal2-cancel bg-gray-400 text-white hover:bg-gray-500'
                    },
                    buttonsStyling: false // agar customClass dipakai
                }).then(result => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    </script>
@endpush

{{-- resources/views/kategori_kronologi/index.blade.php --}}
@extends('layouts.app')
@section('title', 'Flow Proses')

@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <div class="w-full px-2 sm:px-4 py-4 sm:py-6 mx-auto space-y-4 sm:space-y-6">
        {{-- Header --}}
        <div class="flex items-center justify-between bg-white p-4 rounded-xl shadow">
            <div>
                <h2 class="text-2xl font-semibold text-gray-800">Flow Proses</h2>
                <p class="text-sm text-gray-600">Kelola Flow Proses</p>
            </div>
            <div>
                <a href="{{ route('flowproses.create') }}"
                    class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition inline-flex items-center">
                    <i class="fas fa-plus mr-2"></i>Tambah Flow Proses
                </a>
                <button id="openImportModalButton"
                    class="bg-emerald-600 hover:bg-emerald-700 text-white px-6 py-3 rounded-lg font-medium transition-all duration-200 shadow-sm hover:shadow-md">
                    <i class="fas fa-file-import mr-2"></i>Import Excel
                </button>
            </div>
        </div>

        {{-- Tabel responsif dengan DataTables --}}
        <div class="bg-white shadow rounded-lg overflow-x-auto">
            <table id="flowTable" class="display responsive nowrap w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th>No</th>
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
                            <td class="px-4 py-2">
                                <div class="flex items-center justify-center gap-2 h-full">
                                <a href="{{ route('flowproses.edit', $flow->id_main_flow) }}"
                                    class="bg-orange-600 hover:bg-orange-700 text-white px-4 py-2 rounded-lg font-medium transition-all duration-200 shadow-sm hover:shadow-md"><i
                                        class="fas fa-edit"></i></a>
                                <form
                                    action="{{ route('flowproses.destroy', ['main_flowproses' => $flow->id_main_flow]) }}"
                                    method="POST" class="inline delete-form">
                                    @csrf @method('DELETE')
                                    <button type="button"
                                        class="bg-rose-600 hover:bg-rose-700 text-white px-4 py-2 rounded-lg font-medium transition-all duration-200 shadow-sm hover:shadow-md">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                                </div>
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
                        class="mt-1 w-full border border-gray-300 rounded-lg text-sm text-gray-600 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100" />
                    <p class="text-xs text-gray-500 mt-1">Format: XLSX, XLS. Maks 5MB</p>
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
@if(session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Berhasil!',
        text: '{{ session("success") }}',
        showConfirmButton: false,
        timer: 2000
    });
</script>
@endif
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
                        confirmButton: 'swal2-confirm bg-red-600 text-white hover:bg-red-700',
                        cancelButton: 'swal2-cancel bg-gray-400 text-white hover:bg-gray-500'
                    },
                    buttonsStyling: true // agar customClass dipakai
                }).then(result => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    </script>
@endpush

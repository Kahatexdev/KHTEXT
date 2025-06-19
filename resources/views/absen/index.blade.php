<!-- resources/views/absensi/index.blade.php -->
@extends('layouts.app')
@section('title', 'Data Absensi')

@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <div class="w-full px-2 sm:px-4 py-4 sm:py-6 mx-auto space-y-4 sm:space-y-6">
        {{-- alert --}}
        @if (session('success'))
            <div class="bg-green-100 text-green-800 p-4 rounded-lg mb-4">
                <i class="fas fa-check-circle mr-2"></i> {{ session('success') }}
            </div>
        @elseif (session('error'))
            <div class="bg-red-100 text-red-800 p-4 rounded-lg mb-4">
                <i class="fas fa-exclamation-circle mr-2"></i> {{ session('error') }}
            </div>
        @endif
        <!-- Header -->
        <div class="flex items-center justify-between bg-white p-4 rounded-xl shadow">
            <div>
                <h2 class="text-2xl font-semibold text-gray-800">Data Absensi</h2>
                <p class="text-sm text-gray-600">Kelola dan pantau presensi karyawan</p>
            </div>
            <div class="flex space-x-2">
                <button id="openAbsensiModalButton"
                    class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 inline-flex items-center">
                    <i class="fas fa-clock mr-2"></i>Absen Sekarang
                </button>
                <a href="{{ route('absen.export') }}"
                    class="px-4 py-2 bg-purple-600 text-white rounded hover:bg-purple-700 transition inline-flex items-center">
                    <i class="fas fa-file-export mr-2"></i>Export Data
                </a>
            </div>
        </div>

        <!-- Filter Section -->
        <div class="bg-white p-4 rounded-xl shadow">
            <form method="GET" action="{{ route('absen.index') }}" class="flex flex-wrap items-end gap-4">
                <div class="flex-1 min-w-48">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal</label>
                    <input type="date" name="tanggal" id="filterTanggal" value="{{ request('tanggal', date('Y-m-d')) }}"
                        class="w-full border-gray-300 rounded-md text-sm">
                </div>
                
                <div>
                    <button type="submit" id="applyFilter"
                        class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 inline-flex items-center">
                        <i class="fas fa-filter mr-2"></i>Filter
                    </button>
                </div>
            </form>
        </div>

        <!-- Summary Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4">
            @foreach (['hadir' => 'check-circle', 'mangkir' => 'clock', 'cuti' => 'times-circle', 'sakit' => 'file-medical', 'izin' => 'user-clock'] as $key => $icon)
                <div class="bg-white p-4 rounded-xl shadow">
                    <div class="flex items-center">
                        <div
                            class="p-3 rounded-full bg-{{ $key == 'mangkir' ? 'red' : 'green' }}-100 text-{{ $key == 'mangkir' ? 'red' : 'green' }}-600">
                            <i class="fas fa-{{ $icon }} text-xl"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600">{{ ucfirst($key) }}</p>
                            <p class="text-2xl font-semibold text-gray-900">{{ $summary[$key] ?? 0 }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Tabel Absensi -->
        <div class="bg-white shadow rounded-lg overflow-x-auto">
            <table id="absensiTable" class="display responsive nowrap w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Tanggal</th>
                        <th>Jam Masuk</th>
                        <th>Keterangan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($absens as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->user->name ?? '-' }}</td>
                            <td>{{ \Carbon\Carbon::parse($item->tanggal)->format('d/m/Y') }}</td>
                            <td>{{ $item->jam_masuk ? \Carbon\Carbon::parse($item->jam_masuk)->format('H:i') : '-' }}</td>
                            <td>{{ $item->keterangan ?? '-' }}</td>
                            @if (Auth::user()->role == 'monitoring')
                                <td class="px-4 py-2">
                                    <div class="flex items-center justify-center gap-2">
                                        <button onclick="editAbsensi({{ $item->id_absen }})"
                                            class="bg-yellow-600 hover:bg-yellow-700 text-white px-3 py-1 rounded text-sm inline-flex items-center">
                                            <i class="fas fa-edit mr-1"></i>Edit
                                        </button>
                                        <form action="{{ route('absen.destroy', $item->id_absen) }}" method="POST"
                                            class="inline delete-form">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded text-sm inline-flex items-center">
                                                <i class="fas fa-trash mr-1"></i>Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            @else
                                <td></td>
                            @endif
                        </tr>
                    @empty
                        <tr>
                            <td colspan="11" class="text-center py-4 text-gray-500">Belum ada data absen.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal Absensi -->
    <div id="absensiModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden z-50">
        <div class="bg-white rounded-xl shadow-lg w-full max-w-md p-6 relative">
            <button id="closeAbsensiModalButton"
                class="absolute top-3 right-3 text-gray-500 hover:text-gray-700 text-2xl">&times;</button>
            <h3 class="text-lg font-medium text-gray-800 mb-4">Absensi Karyawan</h3>
            <form action="{{ route('absen.store') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label for="user_id" class="block text-sm font-medium text-gray-700">Karyawan <span
                            class="text-red-500">*</span></label>
                    @if (Auth::user()->role == 'monitoring')
                        <select name="user_id" id="user_id" required class="mt-1 w-full border-gray-300 rounded-md">
                            <option value="">Pilih Karyawan</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                    @else
                        <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                    @endif
                </div>
                <div>
                    <label for="tanggal" class="block text-sm font-medium text-gray-700">Tanggal <span
                            class="text-red-500">*</span></label>
                    <input type="date" name="tanggal" id="tanggal" value="{{ date('Y-m-d') }}" required
                        class="mt-1 w-full border-gray-300 rounded-md" />
                </div>
                <div class="grid grid-cols-1 gap-4">
                    <div>
                        <label for="jam_masuk" class="block text-sm font-medium text-gray-700">Jam Masuk</label>
                        <input type="time" name="jam_masuk" id="jam_masuk"
                            class="mt-1 w-full border-gray-300 rounded-md" />
                    </div>
                </div>
                <div>
                    <label for="keterangan" class="block text-sm font-medium text-gray-700">keterangan <span
                            class="text-red-500">*</span></label>
                    <select name="keterangan" id="keterangan" required class="mt-1 w-full border-gray-300 rounded-md">
                        <option value="">Pilih Keterangan</option>
                        @foreach (['hadir', 'cuti(T)', 'mangkir(M)', 'izin(MI)', 'sakit(SI)'] as $st)
                            <option value="{{ $st }}">{{ ucfirst($st) }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex justify-end space-x-2">
                    <button type="button" id="cancelAbsensiButton"
                        class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">Batal</button>
                    <button type="submit"
                        class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Simpan</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#absensiTable').DataTable({
                responsive: true,
            });

            // Delete confirmation
            $('.delete-form').on('submit', function(e) {
                e.preventDefault();
                if (confirm('Apakah Anda yakin ingin menghapus data absensi ini?')) this.submit();
            });

            // Auto set current time for jam masuk
            const now = new Date();
            $('#jam_masuk').val(now.toTimeString().slice(0, 5));
        });

        $(function() {
            const absensiModal = $('#absensiModal');
            const importModal = $('#importModal');
            const openAbsensiModalButton = $('#openAbsensiModalButton');
            const openImportModalButton = $('#openImportModalButton');

            // Open Absensi Modal
            openAbsensiModalButton.on('click', function() {
                absensiModal.removeClass('hidden');
            });
            // Close Absensi Modal
            $('#closeAbsensiModalButton, #cancelAbsensiButton').on('click', function() {
                absensiModal.addClass('hidden');
            });
            // Open Import Modal
            openImportModalButton.on('click', function() {
                importModal.removeClass('hidden');
            });
            // Close Import Modal
            $('#closeImportModalButton, #cancelImportButton').on('click', function() {
                importModal.addClass('hidden');
            });
        });

        function editAbsensi(id) {
            window.location.href = `/absensi/${id}/edit`;
        }
    </script>
@endpush

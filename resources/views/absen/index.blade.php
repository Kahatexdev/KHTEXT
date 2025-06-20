<!-- resources/views/absensi/index.blade.php -->
@extends('layouts.app')
@section('title', 'Data Absensi')
@section('page-title', 'Data Absensi')

@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <div class="w-full px-4 py-6 mx-auto space-y-6">
        {{-- Alert Messages --}}
        @if (session('success'))
            <div class="bg-green-100 text-green-800 px-4 py-3 rounded-lg" role="alert">
                <strong class="font-bold">Sukses!</strong>
                <span class="block">{{ session('success') }}</span>
            </div>
        @elseif(session('error'))
            <div class="bg-red-100 text-red-800 px-4 py-3 rounded-lg" role="alert">
                <strong class="font-bold">Error!</strong>
                <span class="block">{{ session('error') }}</span>
            </div>
        @endif

        <!-- Header & Actions -->
        <div class="flex flex-col md:flex-row items-start md:items-center justify-between bg-white p-4 rounded-xl shadow">
            <div>
                <h2 class="text-2xl font-semibold text-gray-800">Data Absensi</h2>
                <p class="text-sm text-gray-600">Kelola dan pantau presensi karyawan</p>
            </div>
            <div class="mt-4 md:mt-0 flex space-x-2">
                <button id="openAbsensiModalButton"
                    class="flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                    <i class="fas fa-clock mr-2"></i>Absen Sekarang
                </button>
                <a href="{{ route('absen.export') }}"
                    class="flex items-center px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition">
                    <i class="fas fa-file-export mr-2"></i>Export Data
                </a>
            </div>
        </div>

        <!-- Filter Section -->
        <div class="bg-white p-4 rounded-xl shadow">
            <form method="GET" action="{{ route('absen.index') }}" class="flex flex-wrap items-end gap-4">
                <div class="w-full md:w-1/3">
                    <label for="filterTanggal" class="block text-sm font-medium text-gray-700 mb-1">Tanggal</label>
                    <input type="date" name="tanggal" id="filterTanggal" value="{{ request('tanggal', date('Y-m-d')) }}"
                        class="w-full border border-gray-300 rounded-lg p-2 text-sm" />
                </div>
                <div class="flex items-end">
                    <button type="submit"
                        class="flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                        <i class="fas fa-filter mr-2"></i>Filter
                    </button>
                </div>
            </form>
        </div>

        <!-- Summary Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4">
            @foreach (['hadir' => 'check-circle', 'mangkir' => 'clock', 'cuti' => 'times-circle', 'sakit' => 'file-medical', 'izin' => 'user-clock'] as $key => $icon)
                <div class="bg-white p-4 rounded-xl shadow flex items-center">
                    <div
                        class="p-3 rounded-full bg-{{ $key == 'mangkir' ? 'red' : 'green' }}-100 text-{{ $key == 'mangkir' ? 'red' : 'green' }}-600">
                        <i class="fas fa-{{ $icon }} text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">{{ ucfirst($key) }}</p>
                        <p class="text-2xl font-semibold text-gray-900">{{ $summary[$key] ?? 0 }}</p>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Absensi Table -->
        <div class="bg-white shadow rounded-lg overflow-x-auto">
            <table id="absensiTable" class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">No</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tanggal</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Jam Masuk</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Keterangan</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($absens as $item)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $loop->iteration }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $item->user->name ?? '-' }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                {{ \Carbon\Carbon::parse($item->tanggal)->format('d/m/Y') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                {{ $item->jam_masuk ? \Carbon\Carbon::parse($item->jam_masuk)->format('H:i') : '-' }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $item->keterangan ?? '-' }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-center space-x-2">
                                @if (Auth::user()->role === 'monitoring')
                                    <button onclick="openEditAbsensiModal({{ $item->id_absen }})"
                                        class="px-3 py-1 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600 transition inline-flex items-center">
                                        <i class="fas fa-edit mr-1"></i>Edit
                                    </button>
                                    <form action="{{ route('absen.destroy', $item->id_absen) }}" method="POST"
                                        class="inline-block delete-form">
                                        @csrf @method('DELETE')
                                        <button type="submit"
                                            class="px-3 py-1 bg-red-600 text-white rounded-lg hover:bg-red-700 transition inline-flex items-center">
                                            <i class="fas fa-trash mr-1"></i>Hapus
                                        </button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-4 text-center text-gray-500">Belum ada data absen.</td>
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
            <h3 id="modalTitle" class="text-lg font-medium text-gray-800 mb-4">Tambah Absensi</h3>
            <form id="absensiForm" method="POST" action="" class="space-y-4">
                @csrf
                <input type="hidden" name="_method" id="absensiFormMethod" value="POST">

                {{-- User Select --}}
                @if (Auth::user()->role === 'monitoring')
                    <div>
                        <label for="id_user" class="block text-sm font-medium text-gray-700">Karyawan <span
                                class="text-red-500">*</span></label>
                        <select name="id_user" id="id_user" required
                            class="mt-1 block w-full border border-gray-300 rounded-lg p-2">
                            <option value="">Pilih Karyawan</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                @else
                    <input type="hidden" name="id_user" value="{{ auth()->user()->id }}">
                @endif

                {{-- Tanggal --}}
                <div>
                    <label for="tanggal" class="block text-sm font-medium text-gray-700">Tanggal <span
                            class="text-red-500">*</span></label>
                    <input type="date" name="tanggal" id="tanggal" required
                        class="mt-1 block w-full border border-gray-300 rounded-lg p-2" />
                </div>

                {{-- Jam Masuk --}}
                <div>
                    <label for="jam_masuk" class="block text-sm font-medium text-gray-700">Jam Masuk</label>
                    <input type="time" name="jam_masuk" id="jam_masuk"
                        class="mt-1 block w-full:border border-gray-300 rounded-lg p-2" />
                </div>

                {{-- Keterangan --}}
                <div>
                    <label for="keterangan" class="block text-sm font-medium text-gray-700">Keterangan <span
                            class="text-red-500">*</span></label>
                    <select name="keterangan" id="keterangan" required
                        class="mt-1 block w-full border border-gray-300 rounded-lg p-2">
                        <option value="">Pilih Keterangan</option>
                        @foreach (['HADIR', '(T)', '(M)', '(MI)', '(SI)'] as $st)
                            <option value="{{ $st }}">{{ ucfirst($st) }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="flex justify-end space-x-2">
                    <button type="button" id="cancelAbsensiButton"
                        class="px-4 py-2 bg-gray-300 rounded-lg hover:bg-gray-400 transition">Batal</button>
                    <button type="submit" id="submitAbsensiButton"
                        class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">Simpan</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(function() {
            // DataTable init
            $('#absensiTable').DataTable({
                responsive: true
            });
            // Delete confirm
            $('.delete-form').on('submit', function(e) {
                e.preventDefault();
                if (confirm('Yakin hapus data?')) this.submit();
            });

            // Modal elements
            const modal = $('#absensiModal');
            const form = $('#absensiForm');
            const title = $('#modalTitle');
            const methodInput = $('#absensiFormMethod');

            // Open Create
            $('#openAbsensiModalButton').on('click', function() {
                title.text('Tambah Absensi');
                form.trigger('reset');
                form.attr('action', '{{ route('absen.store') }}');
                methodInput.val('POST');
                $('#jam_masuk').val(new Date().toTimeString().slice(0, 5));
                modal.removeClass('hidden');
            });

            // Open Edit
            window.openEditAbsensiModal = function(id) {
                $.get(`/absen/${id}/edit`, function(data) {
                    title.text('Edit Absensi');
                    form.trigger('reset');
                    form.attr('action', `/absen/${id}`);
                    methodInput.val('PUT');
                    // <-- gunakan data.absen
                    $('#id_user').val(data.absen.id_user);
                    $('#tanggal').val(data.absen.tanggal);
                    $('#jam_masuk').val(data.absen.jam_masuk ? data.absen.jam_masuk.slice(0, 5) : '');
                    $('#keterangan').val(data.absen.keterangan);
                    modal.removeClass('hidden');
                }).fail(function() {
                    alert('Gagal memuat data.');
                });
            };

            // Close
            $('#closeAbsensiModalButton, #cancelAbsensiButton').on('click', function() {
                modal.addClass('hidden');
            });
        });
    </script>
@endpush

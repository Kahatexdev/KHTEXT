@extends('layouts.app')
@section('title', 'Master Proses')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <div class="flex justify-between items-center px-6 py-4 border-b">
            <h2 class="text-lg font-semibold text-gray-800">Master Proses</h2>
            <button onclick="openModal()" class="inline-flex items-center bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded text-sm font-medium">
                <i class="fas fa-plus mr-2"></i> Tambah Proses
            </button>
        </div>

        <div class="px-6 py-4">
            @if($masterProses->count() > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 text-sm">
                    <thead class="bg-gray-50 text-gray-700">
                        <tr>
                            <th class="px-4 py-2 text-left">No</th>
                            <th class="px-4 py-2 text-left">Nama Proses</th>
                            <th class="px-4 py-2 text-left">Dibuat</th>
                            <th class="px-4 py-2 text-left">Diupdate</th>
                            <th class="px-4 py-2 text-left">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 text-gray-700">
                        @php $no = 1; @endphp
                        @foreach($masterProses as $proses)
                        <tr>
                            <td class="px-4 py-2">{{ $no++ }}</td>
                            <td class="px-4 py-2">{{ $proses->nama_proses }}</td>
                            <td class="px-4 py-2">{{ $proses->created_at }}</td>
                            <td class="px-4 py-2">{{ $proses->updated_at }}</td>
                            <td class="px-4 py-2 flex gap-2">
                                <button
                                    type="button"
                                    onclick="openEditModal('{{ $proses->id_master_proses }}', '{{ $proses->nama_proses }}')"
                                    class="inline-flex items-center bg-yellow-600 hover:bg-yellow-700 text-white px-4 py-2 rounded text-sm font-medium">
                                    <i class="fas fa-edit mr-2"></i> Edit
                                </button>
                                <div x-data="{ showModal: false }">
                                    <button
                                        @click.prevent="showModal = true"
                                        class="inline-flex items-center bg-red-600 hover:bg-red-700 text-white px-4 py-2 text-sm rounded font-medium">
                                        <i class="fas fa-trash-alt mr-2"></i> Hapus
                                    </button>
                                    <!-- Modal Konfirmasi Hapus -->
                                    <div
                                        x-show="showModal"
                                        x-transition
                                        class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50"
                                        style="display: none;">
                                        <div
                                            @click.away="showModal = false"
                                            class="bg-white rounded-lg shadow-lg w-11/12 max-w-md p-6">
                                            <h2 class="text-xl font-semibold mb-4">Konfirmasi Hapus</h2>
                                            <p class="mb-6">Apakah Anda yakin ingin menghapus data ini?</p>
                                            <div class="flex justify-end space-x-3">
                                                <button
                                                    @click="showModal = false"
                                                    class="px-4 py-2 bg-gray-300 hover:bg-gray-400 rounded text-gray-800">
                                                    Batal
                                                </button>
                                                <form
                                                    action="{{ route('masterproses.destroy', $proses->id_master_proses) }}"
                                                    method="POST"
                                                    class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button
                                                        type="submit"
                                                        class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded">
                                                        Ya, Hapus
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
            <div class="text-center text-gray-500 py-10">
                <i class="fas fa-inbox text-4xl mb-3"></i>
                <p class="text-lg font-medium">Belum ada data master proses.</p>
            </div>
            @endif
        </div>
    </div>
</div>

<!-- Modal Tambah Proses -->
<div id="modalTambah" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden justify-center items-center">
    <div class="bg-white w-full max-w-md rounded-lg shadow-lg p-6 relative">
        <h2 class="text-lg font-semibold mb-4 text-gray-700">Tambah Proses</h2>
        <form action="{{ route('masterproses.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="nama_proses" class="block text-sm font-medium text-gray-700">Nama Proses</label>
                <input type="text" name="nama_proses" id="nama_proses" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
            </div>
            <div class="flex justify-end gap-2 mt-6">
                <button type="button" onclick="closeModal()" class="px-4 py-2 bg-gray-300 text-gray-800 rounded hover:bg-gray-400">Batal</button>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Simpan</button>
            </div>
        </form>
        <!-- Close icon -->
        <button onclick="closeModal()" class="absolute top-2 right-2 text-gray-400 hover:text-gray-600">
            &times;
        </button>
    </div>
</div>

<!-- Modal Edit -->
<div id="editModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6 relative">
        <h2 class="text-xl font-bold mb-4">Edit Data Proses</h2>

        <form id="editForm" method="POST">
            @csrf
            @method('PUT')

            <input type="hidden" name="id_master_proses" id="edit_id">

            <!-- Nama Proses -->
            <div class="mb-4">
                <label for="edit_nama_proses" class="block text-sm font-medium text-gray-700">Nama Proses</label>
                <input type="text" id="edit_nama_proses" name="nama_proses" required
                    class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2">
            </div>

            <!-- Tombol -->
            <div class="flex justify-end space-x-3">
                <button type="button" onclick="closeEditModal()"
                    class="px-4 py-2 bg-gray-300 hover:bg-gray-400 rounded">Batal</button>
                <button type="submit"
                    class="px-4 py-2 bg-info-600 hover:bg-primary-700 text-white rounded">Simpan</button>
            </div>
        </form>
    </div>
</div>

@include('layouts.footer')
@endsection

@push('scripts')
<script>
    function openModal() {
        const modal = document.getElementById('modalTambah');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function closeModal() {
        const modal = document.getElementById('modalTambah');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }
</script>

<script>
    function openEditModal(id, nama_proses) {
        // Set value ke form
        document.getElementById('edit_id').value = id;
        document.getElementById('edit_nama_proses').value = nama_proses;
        const role = "{{ auth()->user()->role }}";

        // Set action form
        const form = document.getElementById('editForm');
        form.action = `/${role}/masterproses/${id}`; // ← penting!

        // Tampilkan modal
        document.getElementById('editModal').classList.remove('hidden');
    }

    function closeEditModal() {
        document.getElementById('editModal').classList.add('hidden');
    }
</script>

<script>
    function confirmDelete(id) {
        Swal.fire({
            title: 'Apakah kamu yakin?',
            text: "Data ini akan dihapus permanen!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc2626', // Tailwind red-600
            cancelButtonColor: '#6b7280', // Tailwind gray-500
            confirmButtonText: 'Ya, hapus',
            cancelButtonText: 'Batal',
            focusConfirm: false,
            // allowOutsideClick: true, // bisa disesuaikan
            allowEscapeKey: true,
            customClass: {
                actions: 'flex justify-center gap-4', // opsional untuk tata letak lebih rapi
                confirmButton: 'swal2-confirm-button',
                cancelButton: 'swal2-cancel-button'
            }
        })
    }
</script>


@endpush
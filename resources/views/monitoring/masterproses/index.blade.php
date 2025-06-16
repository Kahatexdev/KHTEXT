@extends('layouts.app')
@section('title', 'Master Proses')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <div class="flex justify-between items-center px-6 py-4 border-b">
            <h2 class="text-lg font-bold">Master Proses</h2>
            <button id="tambahTrigger" class="inline-flex items-center bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded text-sm font-medium">
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
                                <button type="button" onclick="openEditModal('{{ $proses->id_master_proses }}', '{{ $proses->nama_proses }}')" class="bg-yellow-600 hover:bg-yellow-700 text-white px-4 py-2 rounded text-sm font-medium">
                                    <i class="fas fa-edit mr-2"></i> Edit
                                </button>
                                <button type="button" onclick="openDeleteModal('{{ $proses->id_master_proses }}')" class="inline-flex items-center bg-red-600 hover:bg-red-700 text-white px-4 py-2 text-sm rounded font-medium">
                                    <i class="fas fa-trash-alt mr-2"></i> Hapus
                                </button>
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

<!-- Modal Tambah -->
<div id="tambahModal" class="hidden fixed inset-0 flex items-center justify-center bg-gray-600 bg-opacity-30 backdrop-blur-sm" style="z-index: 99999;">
    <div id="tambahModalContent" class="bg-white rounded-lg shadow-xl p-6 w-11/12 max-w-md mx-4 transform transition-all duration-300 scale-95 opacity-0 relative" style="z-index: 100000;">

        <!-- Modal Header -->
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-lg font-semibold text-gray-900">Tambah Proses</h3>
            <button type="button" id="closeTambahModalX" class="text-gray-400 hover:text-gray-600 focus:outline-none">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <!-- Modal Body -->
        <form action="{{ route('masterproses.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="nama_proses" class="block text-sm font-medium text-gray-700">Nama Proses</label>
                <input type="text" name="nama_proses" id="nama_proses" required class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2 focus:ring-blue-500 focus:border-blue-500">
            </div>

            <!-- Modal Footer -->
            <div class="flex flex-col-reverse sm:flex-row sm:justify-end gap-3 mt-6">
                <button type="button" id="cancelTambah" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-md hover:bg-gray-200 w-full sm:w-auto">
                    Batal
                </button>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 w-full sm:w-auto">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Edit -->
<div id="editModal" class="hidden fixed inset-0 flex items-center justify-center bg-gray-600 bg-opacity-30 backdrop-blur-sm" style="z-index: 99999;">
    <div id="editModalContent" class="bg-white rounded-lg shadow-xl p-6 w-11/12 max-w-md mx-4 transform transition-all duration-300 scale-95 opacity-0 relative" style="z-index: 100000;">

        <!-- Modal Header -->
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-lg font-semibold text-gray-900">Edit Proses</h3>
            <button type="button" id="closeEditModalX" class="text-gray-400 hover:text-gray-600 focus:outline-none">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <!-- Modal Body -->
        <form id="editForm" method="POST">
            @csrf
            @method('PUT')
            <input type="hidden" name="id_master_proses" id="edit_id">

            <div class="mb-4">
                <label for="edit_nama_proses" class="block text-sm font-medium text-gray-700">Nama Proses</label>
                <input type="text" name="nama_proses" id="edit_nama_proses" required class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2 focus:ring-blue-500 focus:border-blue-500">
            </div>

            <!-- Modal Footer -->
            <div class="flex flex-col-reverse sm:flex-row sm:justify-end gap-3 mt-6">
                <button type="button" id="cancelEdit" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-md hover:bg-gray-200 w-full sm:w-auto">Batal</button>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 w-full sm:w-auto">Simpan</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Delete -->
<div id="deleteModal" class="hidden fixed inset-0 flex items-center justify-center bg-gray-600 bg-opacity-30 backdrop-blur-sm" style="z-index: 99999;">
    <div id="deleteModalContent" class="bg-white rounded-lg shadow-xl p-6 w-11/12 max-w-md mx-4 transform transition-all duration-300 scale-95 opacity-0 relative" style="z-index: 100000;">

        <!-- Modal Header -->
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-lg font-semibold text-gray-900">Konfirmasi Hapus</h3>
            <button type="button" id="closeDeleteModalX" class="text-gray-400 hover:text-gray-600 focus:outline-none">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <!-- Modal Body -->
        <div class="mb-6">
            <p class="text-gray-600">Apakah Anda yakin ingin menghapus proses ini?</p>
        </div>

        <!-- Modal Footer -->
        <div class="flex flex-col-reverse sm:flex-row sm:justify-end gap-3">
            <button type="button" id="cancelDelete" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-md hover:bg-gray-200 w-full sm:w-auto">
                Batal
            </button>
            <form id="deleteForm" method="POST" class="w-full sm:w-auto">
                @csrf
                @method('DELETE')
                <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 w-full sm:w-auto">
                    Ya, Hapus
                </button>
            </form>
        </div>
    </div>
</div>

@include('layouts.footer')
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
    document.addEventListener('DOMContentLoaded', function() {
        const trigger = document.getElementById('tambahTrigger');
        const modal = document.getElementById('tambahModal');
        const modalContent = document.getElementById('tambahModalContent');
        const cancel = document.getElementById('cancelTambah');
        const closeX = document.getElementById('closeTambahModalX');

        function showModal() {
            modal.classList.remove('hidden');
            modal.offsetHeight; // Trigger reflow
            modalContent.classList.remove('scale-95', 'opacity-0');
            modalContent.classList.add('scale-100', 'opacity-100');
            document.body.style.overflow = 'hidden';
        }

        function hideModal() {
            modalContent.classList.remove('scale-100', 'opacity-100');
            modalContent.classList.add('scale-95', 'opacity-0');
            setTimeout(() => {
                modal.classList.add('hidden');
                document.body.style.overflow = '';
            }, 300);
        }

        trigger.addEventListener('click', function(e) {
            e.preventDefault();
            showModal();
        });

        cancel.addEventListener('click', hideModal);
        closeX.addEventListener('click', hideModal);

        modal.addEventListener('click', function(e) {
            if (e.target === modal) hideModal();
        });

        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && !modal.classList.contains('hidden')) hideModal();
        });
    });
</script>

<script>
    function openEditModal(id, nama_proses) {
        const modal = document.getElementById('editModal');
        const modalContent = document.getElementById('editModalContent');

        document.getElementById('edit_id').value = id;
        document.getElementById('edit_nama_proses').value = nama_proses;

        const form = document.getElementById('editForm');
        form.action = `/monitoring/masterproses/${id}`; // Ganti 'admin' sesuai kebutuhan

        modal.classList.remove('hidden');
        modal.offsetHeight;
        modalContent.classList.remove('scale-95', 'opacity-0');
        modalContent.classList.add('scale-100', 'opacity-100');
        document.body.style.overflow = 'hidden';
    }

    function closeEditModal() {
        const modal = document.getElementById('editModal');
        const modalContent = document.getElementById('editModalContent');

        modalContent.classList.remove('scale-100', 'opacity-100');
        modalContent.classList.add('scale-95', 'opacity-0');

        setTimeout(() => {
            modal.classList.add('hidden');
            document.body.style.overflow = '';
        }, 300);
    }

    document.addEventListener('DOMContentLoaded', function() {
        const cancel = document.getElementById('cancelEdit');
        const closeX = document.getElementById('closeEditModalX');
        const modal = document.getElementById('editModal');

        cancel.addEventListener('click', closeEditModal);
        closeX.addEventListener('click', closeEditModal);
        modal.addEventListener('click', function(e) {
            if (e.target === modal) closeEditModal();
        });
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && !modal.classList.contains('hidden')) closeEditModal();
        });
    });
</script>
<script>
    function openDeleteModal(id) {
        const modal = document.getElementById('deleteModal');
        const modalContent = document.getElementById('deleteModalContent');
        const form = document.getElementById('deleteForm');

        form.action = `/monitoring/masterproses/${id}`;

        // Tampilkan modal
        modal.classList.remove('hidden');
        modal.offsetHeight;
        modalContent.classList.remove('scale-95', 'opacity-0');
        modalContent.classList.add('scale-100', 'opacity-100');
        document.body.style.overflow = 'hidden';
    }

    function closeDeleteModal() {
        const modal = document.getElementById('deleteModal');
        const modalContent = document.getElementById('deleteModalContent');

        modalContent.classList.remove('scale-100', 'opacity-100');
        modalContent.classList.add('scale-95', 'opacity-0');

        setTimeout(() => {
            modal.classList.add('hidden');
            document.body.style.overflow = '';
        }, 300);
    }

    document.addEventListener('DOMContentLoaded', function() {
        const cancel = document.getElementById('cancelDelete');
        const closeX = document.getElementById('closeDeleteModalX');
        const modal = document.getElementById('deleteModal');

        cancel.addEventListener('click', closeDeleteModal);
        closeX.addEventListener('click', closeDeleteModal);
        modal.addEventListener('click', function(e) {
            if (e.target === modal) closeDeleteModal();
        });
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && !modal.classList.contains('hidden')) closeDeleteModal();
        });
    });
</script>
@endpush
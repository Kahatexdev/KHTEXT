@extends('layouts.app')
@section('title', 'Users')
@section('page-title', 'Users')

@section('content')
<div class="w-full px-2 sm:px-4 py-4 sm:py-6 mx-auto space-y-4 sm:space-y-6">
    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <div class="flex justify-between items-center px-6 py-4 border-b">
            <h2 class="text-xl font-bold">Daftar Users</h2>
            <button onclick="openModal()" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                <i class="fas fa-plus mr-2"></i> Tambah User
            </button>
        </div>
        <div class="px-6 py-4">
            <table id="usersTable" class="min-w-full bg-white rounded">
                <thead>
                    <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                        <th class="py-3 px-6 text-left">#</th>
                        <th class="py-3 px-6 text-left">Nama</th>
                        <th class="py-3 px-6 text-left">Email</th>
                        <th class="py-3 px-6 text-left">Bagian</th>
                        <th class="py-3 px-6 text-left">Role</th>
                        <th class="py-3 px-6 text-left">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $no => $user)
                    <tr class="border-b border-gray-200 text-sm">
                        <td class="py-3 px-6">{{ $no + 1 }}</td>
                        <td class="py-3 px-6">{{ $user->name }}</td>
                        <td class="py-3 px-6">{{ $user->email }}</td>
                        <td class="py-3 px-6">{{ $user->bagian_area }}</td>
                        <td class="py-3 px-6">{{ $user->role }}</td>
                        <td class="py-3 px-6">
                            <div class="flex gap-2 h-full">
                            <button onclick="editUser({{ $user }})" class="bg-yellow-600 hover:bg-yellow-700 text-white px-4 py-2 rounded text-sm font-medium"><i class="fas fa-edit mr-2"></i>Edit</button>
                            {{-- <form method="POST" action="{{ route('users.destroy', $user->id) }}" class="inline delete-form">
                                @csrf @method('DELETE')
                                <button type="button"
                                        class="inline-flex items-center bg-red-600 hover:bg-red-700 text-white px-4 py-2 text-sm rounded font-medium" data-id="{{ $user->id }}">
                                        <i class="fas fa-trash-alt mr-2"></i> Hapus
                                </button>
                            </form> --}}

                            <form method="POST" action="{{ route('users.destroy', $user->id) }}" class="inline delete-form">
                                @csrf
                                @method('DELETE')
                                <button type="button"
                                    class="delete-button inline-flex items-center bg-red-600 hover:bg-red-700 text-white px-4 py-2 text-sm rounded font-medium"
                                    data-id="{{ $user->id }}">
                                    <i class="fas fa-trash-alt mr-2"></i> Hapus
                                </button>
                            </form>
                            
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal -->
<div id="userModal" class="hidden fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50 backdrop-blur-sm z-50">
    <div class="bg-white p-6 rounded-lg w-full max-w-md relative">
        <h3 class="text-lg font-semibold mb-4" id="modalTitle">Tambah User</h3>
        <form id="userForm" method="POST" action="{{ route('users.store') }}">
            @csrf
            <input type="hidden" name="id" id="userId">

            <div class="mb-4">
                <label class="block mb-1 text-sm">Nama</label>
                <input type="text" name="name" id="name" class="w-full border px-3 py-2 rounded" required>
            </div>
            <div class="mb-4">
                <label class="block mb-1 text-sm">Email</label>
                <input type="email" name="email" id="email" class="w-full border px-3 py-2 rounded" required>
            </div>
            <div class="mb-4" id="passwordGroup">
                <label class="block mb-1 text-sm">Password</label>
                <input type="password" name="password" id="password" class="w-full border px-3 py-2 rounded" required>
            </div>
            <div class="mb-4">
                <label class="block mb-1 text-sm">Bagian</label>
                <select name="bagian_area" id="bagian_area" class="w-full border px-3 py-2 rounded" required>
                    <option value="">Pilih Bagian</option>
                    <option value="mesin">Mesin</option>
                    <option value="rosso">Rosso</option>
                    <option value="setting">Setting</option>
                    <option value="gudang">Gudang</option>
                    <option value="handprint">Handprint</option>
                    <option value="jahit">Jahit</option>
                    <option value="perbaikan">Perbaikan</option>
                    <option value="-">-</option>
                </select>
            </div>
            <div class="mb-4">
                <label class="block mb-1 text-sm">Role</label>
                <select name="role" id="role" class="w-full border px-3 py-2 rounded" required>
                    <option value="">Pilih Role</option>
                    <option value="monitoring">Monitoring</option>
                    <option value="user">User</option>
                </select>
            </div>
            <div class="flex justify-end">
                <button type="button" onclick="closeModal()" class="mr-2 bg-gray-300 px-4 py-2 rounded">Batal</button>
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">Simpan</button>
            </div>
        </form>
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
    $(document).ready(function () {
        $('#usersTable').DataTable();
    });

    function openModal() {
        resetForm();
        $('#modalTitle').text('Tambah User');
        $('#userForm').attr('action', "{{ route('users.store') }}");
        $('#userModal').removeClass('hidden');
    }

    function closeModal() {
        $('#userModal').addClass('hidden');
    }

    function editUser(user) {
        $('#modalTitle').text('Edit User');
        $('#userId').val(user.id);
        $('#name').val(user.name);
        $('#email').val(user.email);
        $('#passwordGroup').hide();
        $('#password').removeAttr('required');
        $('#bagian_area').val(user.bagian_area);
        $('#role').val(user.role);
        $('#userForm').attr('action', `{{ url($role . '/users') }}/${user.id}`);
        $('<input>').attr({
            type: 'hidden',
            name: '_method',
            value: 'PUT'
        }).appendTo('#userForm');
        $('#userModal').removeClass('hidden');
    }

    function resetForm() {
        $('#userId').val('');
        $('#name').val('');
        $('#email').val('');
        $('#password').val('');
        $('#passwordGroup').show();
        $('#bagian_area').val('');
        $('#role').val('');
        $('#userForm input[name="_method"]').remove();
    }
</script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.delete-button').forEach(button => {
            button.addEventListener('click', function () {
                const form = this.closest('form');
                const userId = this.getAttribute('data-id');
    
                Swal.fire({
                    title: 'Apakah kamu yakin?',
                    text: 'Data user ini akan dihapus permanen!',
                    icon: 'warning',
                    showCancelButton: true,
                    customClass: {
                        confirmButton: 'swal2-confirm bg-red-600 text-white hover:bg-red-700',
                        cancelButton: 'swal2-cancel bg-gray-400 text-white hover:bg-gray-500'
                    },
                    buttonsStyling: true,
                    confirmButtonColor: '#dc2626', // red-600
                    cancelButtonColor: '#6b7280', // gray-500
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal',
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    });
    </script>
    
@endpush
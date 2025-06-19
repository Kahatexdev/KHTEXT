{{-- resources/views/kategori_kronologi/index.blade.php --}}
@extends('layouts.app')
@section('title', 'Kategori Kronologi')

@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <div class="w-full px-2 sm:px-4 py-4 sm:py-6 mx-auto space-y-4 sm:space-y-6">
        @if (session('success'))
            <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">
                {{ session('success') }}
            </div>
        @endif
        {{-- Header --}}
        <div class="flex items-center justify-between bg-white p-4 rounded-xl shadow">
            <div>
                <h2 class="text-xl font-bold">Data Kategori Kronologi</h2>
                <p class="text-sm text-gray-500">Kelola semua kategori kronologi di sini</p>
            </div>
            <button id="openModal" class="bg-sky-600 hover:bg-sky-700 text-white px-4 py-2 rounded-lg font-medium transition-all duration-200 shadow-sm hover:shadow-md">
                <i class="fas fa-plus mr-1"></i>Tambah
              </button>
        </div>

        <div class="bg-white shadow rounded-lg overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200" id="kategoriTable">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">#</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Nama</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Keterangan</th>
                        <th class="px-6 py-3 text-right text-xs font-semibold text-gray-500 uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($data as $item)
                        <tr>
                            <td class="px-6 py-4 text-sm text-gray-700">
                                {{ $loop->iteration + 1 }}</td>
                            <td class="px-6 py-4 text-sm text-gray-900">{{ $item->nama_kategori }}</td>
                            <td class="px-6 py-4 text-sm text-gray-700">{{ $item->ket_kategori }}</td>
                            <td class="px-6 py-4 text-sm text-gray-700 space-x-2">
                                <button
                                    class="editBtn bg-orange-600 hover:bg-orange-700 text-white px-4 py-2 rounded-lg font-medium transition-all duration-200 shadow-sm hover:shadow-md"
                                    data-id="{{ $item->id_kategori }}" data-nama="{{ $item->nama_kategori }}"
                                    data-ket="{{ $item->ket_kategori }}">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button type="button"
                                    class="deleteBtn bg-rose-600 hover:bg-rose-700 text-white px-4 py-2 rounded-lg font-medium transition-all duration-200 shadow-sm hover:shadow-md"
                                    data-id="{{ $item->id_kategori }}"
                                    data-url="{{ route('kategori_kronologi.destroy', $item->id_kategori) }}">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- Modal Create/Edit --}}
    <div id="modalOverlay"
        class="fixed inset-0 flex hidden items-center justify-center bg-black bg-opacity-50 z-[9999] transition-all duration-300">
        <div
            class="bg-white rounded-2xl w-full max-w-lg p-8 relative z-[10000] shadow-2xl border border-gray-200 animate-fadeIn max-h-[90vh] overflow-y-auto">
            <h3 id="modalTitle" class="text-2xl font-bold mb-6 text-gray-800"></h3>
            <form id="kategoriForm" method="POST" class="space-y-5">
                @csrf
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Nama Kategori <span
                            class="text-red-500">*</span></label>
                    <input type="text" name="nama_kategori"
                        class="mt-1 block w-full rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-400 focus:border-blue-400 transition px-3 py-2"
                        required>
                    <div class="text-red-500 text-sm mt-1 hidden" id="error-nama_kategori"></div>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Keterangan <span
                            class="text-red-500">*</span></label>
                    <textarea name="ket_kategori" rows="4"
                        class="mt-1 block w-full rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-400 focus:border-blue-400 transition px-3 py-2 resize-none"
                        required></textarea>
                    <div class="text-red-500 text-sm mt-1 hidden" id="error-ket_kategori"></div>
                </div>
                <div class="mt-8 flex justify-end space-x-3">
                    <button type="button" id="closeModal"
                        class="px-5 py-2 bg-gray-200 rounded-lg hover:bg-gray-300 text-gray-700 font-semibold transition-colors">Batal</button>
                    <button type="submit" id="saveBtn"
                        class="flex-1 px-6 py-2.5 bg-blue-600 text-white rounded-lg hover:bg-blue-700 font-semibold shadow-sm transition-colors disabled:opacity-50 disabled:cursor-not-allowed">
                        <span class="btn-text">Simpan</span>
                        <span class="btn-loading" style="display:none;">
                            <i class="fas fa-spinner fa-spin mr-2"></i>Menyimpan...
                        </span>
                    </button>
                </div>
            </form>
            <button id="closeX"
                class="absolute top-4 right-4 text-gray-400 hover:text-gray-700 text-3xl transition">&times;</button>
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        $(document).ready(function () {
        $('#kategoriTable').DataTable();
    });
        $(function() {
            const overlay = $('#modalOverlay');
            const form = $('#kategoriForm')[0];
            const $form = $('#kategoriForm');
            const title = $('#modalTitle');
            const saveBtn = $('#saveBtn');
            const btnText = saveBtn.find('.btn-text');
            const btnLoading = saveBtn.find('.btn-loading');
            const deleteBtn = $('.deleteBtn');

            function openModal() {
                overlay.removeClass('hidden');
                $('body').css('overflow', 'hidden');
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
                    btnText.hide();
                    btnLoading.show();
                } else {
                    saveBtn.prop('disabled', false);
                    btnText.show();
                    btnLoading.hide();
                }
            }

            function resetButton() {
                setLoading(false);
            }

            function clearErrors() {
                $('[id^="error-"]').addClass('hidden').text('');
                $('.border-red-500').removeClass('border-red-500').addClass('border-gray-300');
            }

            function showErrors(errs) {
                clearErrors();
                $.each(errs, (f, msgs) => {
                    $('#error-' + f).removeClass('hidden').text(msgs[0]);
                    $form.find('[name="' + f + '"]').removeClass('border-gray-300').addClass(
                        'border-red-500');
                });
            }

            // Open Create
            $('#openModal').on('click', () => {
                clearErrors();
                title.text('Tambah Kategori');
                $form.attr('action', '{{ route('kategori_kronologi.store') }}');
                $form.find('input[name="_method"]').remove();
                openModal();
            });

            // Open Edit
            $(document).on('click', '.editBtn', function() {
                const id = $(this).data('id');
                setLoading(true);
                clearErrors();
                $.get(`/monitoring/kategori_kronologi/${id}/edit`, data => {
                        title.text('Edit Kategori');
                        $form.attr('action', `/monitoring/kategori_kronologi/${id}`);
                        $form.find('input[name="_method"]').remove();
                        $form.append('<input type="hidden" name="_method" value="PUT">');
                        $form.find('[name="nama_kategori"]').val(data.nama_kategori);
                        $form.find('[name="ket_kategori"]').val(data.ket_kategori);
                        openModal();
                    })
                    .fail(() => alert('Gagal memuat data.'))
                    .always(() => setLoading(false));
            });

            // Submit
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
                            title: 'Berhasil',
                            text: 'Kategori berhasil disimpan.',
                            icon: 'success',
                            timer: 1500,
                            showConfirmButton: false
                        }).then(() => {
                            location.reload();
                        });
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) {
                            showErrors(xhr.responseJSON.errors);
                        } else {
                            Swal.fire({
                                title: 'Gagal!',
                                text: 'Terjadi kesalahan. Silakan coba lagi.',
                                icon: 'error'
                            });
                        }
                    },
                    complete: function() {
                        setLoading(false);
                    }
                });
            });
            // Close modal
            $('#closeModal, #closeX').on('click', closeModal);

            overlay.on('click', function(e) {
                if (e.target === this) closeModal();
            });

            // Delete kategori kronologi
            deleteBtn.on('click', function() {
                const id = $(this).data('id');
                const url = $(this).data('url');
                Swal.fire({
                    title: 'Hapus kategori kronologi?',
                    text: 'Apakah Anda yakin ingin menghapus kategori kronologi ini?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: '<span class="swal2-confirm btn bg-red-600 hover:bg-red-700 text-white font-semibold px-4 py-2 rounded-lg me-5">Ya, hapus!</span>',
                    cancelButtonText: '<span class="swal2-cancel btn bg-gray-200 hover:bg-gray-300 text-gray-700 font-semibold px-4 py-2 rounded-lg">Batal</span>',
                    focusCancel: true,
                    customClass: {
                        confirmButton: '',
                        cancelButton: '',
                    },
                    buttonsStyling: false
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: url,
                            type: 'POST',
                            data: {
                                _method: 'DELETE'
                            },
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function() {
                                Swal.fire({
                                    title: 'Berhasil!',
                                    text: 'Kategori Kronologi berhasil dihapus.',
                                    icon: 'success',
                                    timer: 1500,
                                    showConfirmButton: false
                                }).then(() => {
                                    location.reload();
                                });
                            },
                            error: function(xhr) {
                                Swal.fire({
                                    title: 'Gagal!',
                                    text: 'Terjadi kesalahan. Silakan coba lagi.',
                                    icon: 'error'
                                });
                            }
                        });
                    }
                });
            });

        });
    </script>
@endpush

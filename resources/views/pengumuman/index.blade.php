{{-- resources/views/pengumuman/index.blade.php --}}
@extends('layouts.app')
@section('title', 'Pengumuman')

@section('content')
    <div class="w-full px-2 sm:px-4 py-4 sm:py-6 mx-auto space-y-4 sm:space-y-6">
        {{-- Header --}}
        <div class="flex items-center justify-between bg-white p-4 rounded-xl shadow">
            <div>
                <h2 class="text-2xl font-semibold text-gray-800">Data Pengumuman</h2>
                <p class="text-sm text-gray-500">Kelola semua pengumuman di sini</p>
            </div>
            <button id="openCreateModal"
                class="bg-sky-600 hover:bg-sky-700 text-white px-4 py-2 rounded-lg font-medium transition-all duration-200 shadow-sm hover:shadow-md  px-3 py-2">
                <i class="fas fa-plus mr-1"></i>
                Tambah
            </button>
        </div>

        {{-- Table --}}
        <div class="mt-6 bg-white shadow-sm rounded-xl overflow-hidden border border-gray-100">
            <div class="overflow-x-auto">
                <table class="min-w-full" id="pengumumanTable">
                    <thead class="bg-gradient-to-r from-gray-50 to-gray-100">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">#
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Judul</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Isi
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Gambar</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                File</th>
                            <th class="px-6 py-4 text-right text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white">
                        @forelse($pengumuman as $item)
                            <tr class="hover:bg-gray-50 transition-colors duration-200 border-b border-gray-100">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                    <span
                                        class="font-medium">{{ $loop->iteration + ($pengumuman->currentPage() - 1) * $pengumuman->perPage() }}</span>
                                </td>
                                <td class="px-6 py-4 text-sm">
                                    <div class="font-semibold text-gray-900 leading-tight">
                                        {{ Str::limit($item->judul_pengumuman, 40) }}</div>
                                    <div class="text-xs text-gray-500 mt-1">
                                        <i class="far fa-calendar-alt mr-1"></i>
                                        {{ $item->created_at->diffForHumans() }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-600">
                                    <div class="max-w-xs">
                                        <p class="truncate">{{ Str::limit($item->isi_pengumuman, 80) }}</p>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if ($item->gambar)
                                        <div class="relative group">
                                            <img src="{{ asset('storage/' . $item->gambar) }}"
                                                class="h-14 w-14 object-cover rounded-lg cursor-pointer transition-all duration-200 group-hover:scale-105 group-hover:shadow-md"
                                                alt="Gambar Pengumuman"
                                                onclick="showImageModal('{{ asset('storage/' . $item->gambar) }}')">
                                            <div
                                                class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-20 rounded-lg transition-all duration-200 flex items-center justify-center">
                                                <i
                                                    class="fas fa-search-plus text-white opacity-0 group-hover:opacity-100 transition-opacity duration-200"></i>
                                            </div>
                                        </div>
                                    @else
                                        <div class="h-14 w-14 bg-gray-100 rounded-lg flex items-center justify-center">
                                            <i class="fas fa-image text-gray-400"></i>
                                        </div>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if ($item->file_attachment)
                                        <a href="{{ asset('storage/' . $item->file_attachment) }}" target="_blank"
                                            class="inline-flex items-center px-3 py-1.5 bg-green-50 text-green-700 rounded-full text-sm font-medium hover:bg-green-100 transition-colors">
                                            <i class="fas fa-download mr-1.5 text-xs"></i>
                                            Unduh
                                        </a>
                                    @else
                                        <span
                                            class="inline-flex items-center px-3 py-1.5 bg-gray-50 text-gray-500 rounded-full text-sm">
                                            <i class="fas fa-minus mr-1.5 text-xs"></i>
                                            Tidak ada
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex justify-content space-x-2">
                                        <button data-id="{{ $item->id_pengumuman }}"
                                            class="editBtn bg-orange-600 hover:bg-orange-700 text-white px-4 py-2 rounded-lg font-medium transition-all duration-200 shadow-sm hover:shadow-md">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button type="button"
                                            class="deleteBtn bg-rose-600 hover:bg-rose-700 text-white px-4 py-2 rounded-lg font-medium transition-all duration-200 shadow-sm hover:shadow-md"
                                            data-id="{{ $item->id_pengumuman }}"
                                            data-url="{{ route('pengumuman.destroy', $item->id_pengumuman) }}">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-16 text-center">
                                    <div class="flex flex-col items-center">
                                        <div
                                            class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                                            <i class="fas fa-inbox text-2xl text-gray-400"></i>
                                        </div>
                                        <p class="text-gray-500 font-medium">Belum ada pengumuman</p>
                                        <p class="text-gray-400 text-sm mt-1">Klik tombol "Buat Pengumuman" untuk menambah
                                            data</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if ($pengumuman->hasPages())
                <div class="px-6 py-4 bg-gray-50 border-t border-gray-200">
                    {{ $pengumuman->links() }}
                </div>
            @endif
        </div>
    </div>

    {{-- Create/Edit Modal --}}
    <div id="modalOverlay"
        class="fixed inset-0 flex hidden items-center justify-center bg-black bg-opacity-50 z-[9999] transition-opacity duration-300">
        <div
            class="bg-white rounded-2xl w-full max-w-lg p-8 relative z-[10000] shadow-2xl border border-gray-200 animate-slideIn max-h-[90vh] overflow-y-auto">
            <h3 id="modalTitle" class="text-2xl font-bold mb-6 text-gray-800"></h3>
            <form id="pengumumanForm" method="POST" enctype="multipart/form-data" class="space-y-5">
                @csrf
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Judul Pengumuman <span
                                class="text-red-500">*</span></label>
                        <input type="text" name="judul_pengumuman"
                            class="mt-1 block w-full rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-400 focus:border-blue-400 transition-all px-4 py-3"
                            placeholder="Masukkan judul pengumuman" required>
                        <div class="text-red-500 text-sm mt-1 hidden" id="error-judul_pengumuman"></div>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Isi Pengumuman <span
                                class="text-red-500">*</span></label>
                        <textarea name="isi_pengumuman" rows="4"
                            class="mt-1 block w-full rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-400 focus:border-blue-400 transition-all px-4 py-3 resize-none"
                            placeholder="Masukkan isi pengumuman" required></textarea>
                        <div class="text-red-500 text-sm mt-1 hidden" id="error-isi_pengumuman"></div>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Gambar (opsional)</label>
                        <input type="file" name="gambar" accept="image/jpeg,image/png,image/jpg,image/gif"
                            class="mt-1 block w-full rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-400 focus:border-blue-400 transition-all px-4 py-3 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                        <p class="text-xs text-gray-500 mt-2">Format: JPEG, PNG, JPG, GIF. Maksimal 2MB</p>
                        <div class="text-red-500 text-sm mt-1 hidden" id="error-gambar"></div>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">File Attachment (opsional)</label>
                        <input type="file" name="file_attachment" accept=".pdf,.doc,.docx,.xlsx,.xls"
                            class="mt-1 block w-full rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-400 focus:border-blue-400 transition-all px-4 py-3 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-green-50 file:text-green-700 hover:file:bg-green-100">
                        <p class="text-xs text-gray-500 mt-2">Format: PDF, DOC, DOCX, XLSX, XLS. Maksimal 5MB</p>
                        <div class="text-red-500 text-sm mt-1 hidden" id="error-file_attachment"></div>
                    </div>
                </div>
                <div class="mt-8 flex space-x-3">
                    <button type="button" id="closeModal"
                        class="flex-1 px-6 py-2.5 bg-gray-100 rounded-lg hover:bg-gray-200 text-gray-700 font-semibold transition-colors">
                        Batal
                    </button>
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
                class="absolute top-4 right-4 text-gray-400 hover:text-gray-700 text-2xl transition-colors">&times;</button>
        </div>
    </div>

    {{-- Image Preview Modal --}}
    <div id="imageModal"
        class="fixed inset-0 flex hidden items-center justify-center bg-black bg-opacity-75 z-[9999] transition-opacity duration-300">
        <div class="relative max-w-4xl max-h-[90vh] p-4">
            <img id="previewImage" src="" alt="Preview"
                class="max-w-full max-h-full object-contain rounded-xl shadow-2xl">
            <button id="closeImageModal"
                class="absolute -top-2 -right-2 w-8 h-8 bg-white rounded-full text-gray-700 hover:text-gray-900 flex items-center justify-center shadow-lg transition-colors">&times;</button>
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        $(function() {
            const overlay = $('#modalOverlay');
            const form = $('#pengumumanForm')[0];
            const $form = $('#pengumumanForm');
            const title = $('#modalTitle');
            const saveBtn = $('#saveBtn');
            const btnText = saveBtn.find('.btn-text');
            const btnLoading = saveBtn.find('.btn-loading');
            const closeModalBtn = $('#closeModal');
            const closeXBtn = $('#closeX');
            const imageModal = $('#imageModal');
            const previewImage = $('#previewImage');
            const closeImageModalBtn = $('#closeImageModal');
            const deleteBtn = $('.deleteBtn');
            const asset = (path) => '{{ asset('') }}' + path;


            // Modal functions
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
                resetButton();
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

            function showErrors(errors) {
                clearErrors();
                $.each(errors, function(field, messages) {
                    $('#error-' + field).removeClass('hidden').text(messages[0]);
                    $('[name="' + field + '"]').removeClass('border-gray-300').addClass('border-red-500');
                });
            }

            // Open create modal
            $('#openCreateModal').on('click', function() {
                form.reset();
                clearErrors();
                title.text('Tambah Pengumuman');
                $form.attr('action', '{{ route('pengumuman.store') }}');
                $form.find('input[name="_method"]').remove();
                openModal();
            });

            // Edit modal
            $(document).on('click', '.editBtn', function() {
                const id = $(this).data('id');
                setLoading(true);
                $.get(`/monitoring/pengumuman/${id}/edit`, function(data) {
                    form.reset();
                    clearErrors();
                    title.text('Edit Pengumuman');
                    $form.attr('action', `/monitoring/pengumuman/${id}`);
                    $form.find('input[name="_method"]').remove();
                    $form.append('<input type="hidden" name="_method" value="PUT">');

                    $('[name="judul_pengumuman"]').val(data.judul_pengumuman);
                    $('[name="isi_pengumuman"]').val(data.isi_pengumuman);
                    if (data.gambar) {
                        $('[name="gambar"]').after(
                            `<p class="text-sm text-gray-500 mt-2">Gambar saat ini: <a href="${asset('storage/' + data.gambar)}" target="_blank" class="text-blue-600 hover:underline">Lihat Gambar</a></p>`
                        );
                    }
                    if (data.file_attachment) {
                        $('[name="file_attachment"]').after(
                            `<p class="text-sm text-gray-500 mt-2">File saat ini: <a href="${asset('storage/' + data.file_attachment)}" target="_blank" class="text-blue-600 hover:underline">Lihat File</a></p>`
                        );
                    }
                    openModal();
                }).fail(function() {
                    Swal.fire({
                        title: 'Gagal!',
                        text: 'Gagal memuat data pengumuman.',
                        icon: 'error'
                    });
                }).always(function() {
                    resetButton();
                });
            });

            // Submit form
            $form.on('submit', function(e) {
                e.preventDefault();
                setLoading(true);
                clearErrors();
                const formData = new FormData(form);
                const url = $form.attr('action');

                $.ajax({
                    url: url,
                    type: 'POST',
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
                            text: 'Pengumuman berhasil disimpan.',
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

            // Delete pengumuman
            deleteBtn.on('click', function() {
                const id = $(this).data('id');
                const url = $(this).data('url');
                Swal.fire({
                    title: 'Hapus Pengumuman?',
                    text: 'Apakah Anda yakin ingin menghapus pengumuman ini?',
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
                                    text: 'Pengumuman berhasil dihapus.',
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

            // Close modal
            $('#closeModal, #closeX').on('click', closeModal);

            overlay.on('click', function(e) {
                if (e.target === this) closeModal();
            });

            // Show image modal
            window.showImageModal = function(src) {
                $('#previewImage').attr('src', src);
                $('#imageModal').removeClass('hidden');
                $('body').css('overflow', 'hidden');
            }

            $('#closeImageModal').on('click', function() {
                $('#imageModal').addClass('hidden');
                $('body').css('overflow', 'auto');
            });

            // Initialize modern DataTable
            $('#pengumumanTable').DataTable({
                responsive: true,
                pageLength: 10,
                lengthMenu: [
                    [5, 10, 25, 50],
                    [5, 10, 25, 50]
                ],
                columnDefs: [{
                        targets: [2],
                        orderable: false
                    },
                    {
                        targets: [3, 4, 5],
                        orderable: false
                    }
                ],
                language: {
                    search: "Cari:",
                    lengthMenu: "Tampilkan _MENU_ data per halaman",
                    info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                    infoEmpty: "Menampilkan 0 sampai 0 dari 0 data",
                    infoFiltered: "(difilter dari _MAX_ total data)",
                    paginate: {
                        first: "Pertama",
                        last: "Terakhir",
                        next: "Selanjutnya",
                        previous: "Sebelumnya"
                    },
                    emptyTable: "Tidak ada data yang tersedia",
                    zeroRecords: "Tidak ada data yang cocok ditemukan"
                },

            });
        });
    </script>
@endpush

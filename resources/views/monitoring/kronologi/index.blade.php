@extends('layouts.app')
@section('title', 'Kronologi')

@section('content')
    <div class="w-full px-2 sm:px-4 py-4 sm:py-6 mx-auto space-y-4 sm:space-y-6">

        <!-- Header & Modal Trigger -->
        <div
            class="bg-white rounded-xl shadow-md p-4 sm:p-6 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
            <div class="w-full sm:w-auto">
                <h2 class="text-lg sm:text-xl font-semibold text-slate-700">Data Kronologi</h2>
                <p class="text-sm text-slate-500">Tools System</p>
            </div>
            <button id="openCreateModal"
                class="w-full sm:w-auto inline-flex items-center justify-center bg-sky-400 hover:bg-sky-700 text-white text-sm px-4 py-2 rounded-lg shadow-sm transition-all">
                <span class="text-lg mr-1">+</span> Tambah Kronologi
            </button>
        </div>

        <!-- Create Modal -->
        <div id="createKronologiModal"
            class="fixed inset-0 z-[9999] hidden overflow-y-auto bg-black bg-opacity-50 transition-opacity duration-300">
            <div class="min-h-screen flex items-center justify-center p-2 sm:p-4">
                <div class="bg-white rounded-lg shadow-xl w-full max-w-6xl max-h-[90vh] overflow-hidden transform transition-all duration-300 scale-95 opacity-0"
                    id="createModalContent">
                    <!-- Modal Header -->
                    <div class="flex justify-between items-center px-4 sm:px-6 py-4 border-b bg-white sticky top-0 z-10">
                        <h3 class="text-lg font-semibold text-gray-700">Tambah Kronologi</h3>
                        <button id="closeCreateModal"
                            class="text-gray-400 hover:text-gray-600 text-2xl leading-none p-1 rounded-full hover:bg-gray-100 transition-colors">
                            &times;
                        </button>
                    </div>

                    <!-- Modal Body -->
                    <div class="px-4 sm:px-6 py-4 overflow-y-auto max-h-[calc(90vh-140px)]">
                        <form method="POST" action="#" id="createForm">
                            @csrf

                            <!-- Grid 3 kolom - Responsive -->
                            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 mb-6">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal</label>
                                    <input type="date" name="tanggal"
                                        class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                        required>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">WIP</label>
                                    <select name="wip"
                                        class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                        required>
                                        <option value="">Pilih WIP</option>
                                        <option value="GS01">GS01</option>
                                        <option value="KK1A">KK1A</option>
                                        <option value="RS01">RS01</option>
                                        <option value="ST01">ST01</option>
                                    </select>
                                </div>
                                <div class="sm:col-span-2 lg:col-span-1">
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Kategori</label>
                                    <select name="kategori"
                                        class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                        required>
                                        <option value="">Pilih Kategori</option>
                                        @foreach($kategoriKronologi as $kategori)
                                            <option value="{{ $kategori->id_kategori }}"
                                                {{ old('kategori') == $kategori->id_kategori ? 'selected' : '' }}>
                                                {{ $kategori->nama_kategori }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <!-- Tabel Perbandingan - Mobile Friendly -->
                            <div class="mb-6">
                                <h4 class="text-center font-semibold mb-3 text-sm sm:text-base">Input Kronologi</h4>

                                <!-- Desktop Table View -->
                                <div class="hidden lg:block">
                                    <div class="overflow-x-auto">
                                        <table class="min-w-full border text-sm">
                                            <thead class="bg-gray-100 text-center text-blue-500 font-medium">
                                                <tr>
                                                    <th class="border px-2 py-2">Salah</th>
                                                    <th class="border px-2 py-2">Input</th>
                                                    <th class="border px-2 py-2">Benar</th>
                                                    <th class="border px-2 py-2">Input</th>
                                                </tr>
                                            </thead>
                                            <tbody class="text-gray-700">
                                                @php
                                                    $fields = [
                                                        'No Model',
                                                        'Inisial',
                                                        'JC',
                                                        'Area',
                                                        'Label',
                                                        'No Mc',
                                                        'No Box',
                                                        'Qty',
                                                    ];
                                                @endphp
                                                @foreach ($fields as $f)
                                                    <tr>
                                                        <td class="border px-2 py-2 whitespace-nowrap font-medium">
                                                            {{ $f }}</td>
                                                        <td class="border px-2 py-2">
                                                            <input type="text" name="salah[{{ Str::slug($f, '_') }}]"
                                                                class="w-full border border-gray-300 rounded px-2 py-1 text-sm focus:ring-1 focus:ring-blue-500">
                                                        </td>
                                                        <td class="border px-2 py-2 whitespace-nowrap font-medium">
                                                            {{ $f }}</td>
                                                        <td class="border px-2 py-2">
                                                            <input type="text" name="benar[{{ Str::slug($f, '_') }}]"
                                                                class="w-full border border-gray-300 rounded px-2 py-1 text-sm focus:ring-1 focus:ring-blue-500">
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                <tr>
                                                    <td colspan="2" class="border"></td>
                                                    <td class="border px-2 py-2 font-medium">Keterangan</td>
                                                    <td class="border px-2 py-2">
                                                        <textarea name="keterangan" rows="2"
                                                            class="w-full border border-gray-300 rounded px-2 py-1 text-sm focus:ring-1 focus:ring-blue-500"></textarea>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <!-- Mobile Card View -->
                                <div class="lg:hidden space-y-4">
                                    @php
                                        $fields = [
                                            'No Model',
                                            'Inisial',
                                            'JC',
                                            'Area',
                                            'Label',
                                            'No Mc',
                                            'No Box',
                                            'Qty',
                                        ];
                                    @endphp
                                    @foreach ($fields as $f)
                                        <div class="bg-gray-50 rounded-lg p-4 space-y-3">
                                            <h5 class="font-medium text-gray-700 text-center">{{ $f }}</h5>
                                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                                <div>
                                                    <label class="block text-xs font-medium text-red-600 mb-1">Data
                                                        Salah</label>
                                                    <input type="text" name="salah[{{ Str::slug($f, '_') }}]"
                                                        class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500">
                                                </div>
                                                <div>
                                                    <label class="block text-xs font-medium text-green-600 mb-1">Data
                                                        Benar</label>
                                                    <input type="text" name="benar[{{ Str::slug($f, '_') }}]"
                                                        class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500">
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach

                                    <!-- Keterangan -->
                                    <div class="bg-gray-50 rounded-lg p-4">
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Keterangan</label>
                                        <textarea name="keterangan" rows="3"
                                            class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500"
                                            placeholder="Masukkan keterangan..."></textarea>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                    <!-- Modal Footer -->
                    <div
                        class="flex flex-col sm:flex-row justify-end space-y-2 sm:space-y-0 sm:space-x-2 px-4 sm:px-6 py-4 border-t bg-gray-50">
                        <button type="button" id="cancelCreateModal"
                            class="w-full sm:w-auto px-4 py-2 bg-gray-200 hover:bg-gray-300 rounded-md text-sm font-medium transition-colors">
                            Batal
                        </button>
                        <button type="submit" form="createForm"
                            class="w-full sm:w-auto px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded-md text-sm font-medium transition-colors">
                            Simpan
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Edit Modal -->
        <div id="editKronologiModal"
            class="fixed inset-0 z-[9999] hidden overflow-y-auto bg-black bg-opacity-50 transition-opacity duration-300">
            <div class="min-h-screen flex items-center justify-center p-2 sm:p-4">
                <div class="bg-white rounded-lg shadow-xl w-full max-w-6xl max-h-[90vh] overflow-hidden transform transition-all duration-300 scale-95 opacity-0"
                    id="editModalContent">
                    <!-- Modal Header -->
                    <div class="flex justify-between items-center px-4 sm:px-6 py-4 border-b bg-white sticky top-0 z-10">
                        <h3 class="text-lg font-semibold text-gray-700">Edit Kronologi</h3>
                        <button id="closeEditModal"
                            class="text-gray-400 hover:text-gray-600 text-2xl leading-none p-1 rounded-full hover:bg-gray-100 transition-colors">
                            &times;
                        </button>
                    </div>

                    <!-- Modal Body -->
                    <div class="px-4 sm:px-6 py-4 overflow-y-auto max-h-[calc(90vh-140px)]">
                        <form method="POST" action="#" id="editForm">
                            @csrf
                            @method('PUT')

                            <!-- Same form content as create modal -->
                            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 mb-6">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal</label>
                                    <input type="date" name="tanggal"
                                        class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                        required>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">WIP</label>
                                    <select name="wip"
                                        class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                        required>
                                        <option value="">Pilih WIP</option>
                                        <option value="WIP1">WIP 1</option>
                                        <option value="WIP2">WIP 2</option>
                                    </select>
                                </div>
                                <div class="sm:col-span-2 lg:col-span-1">
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Kategori</label>
                                    <select name="kategori"
                                        class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                        required>
                                        <option value="">Pilih Kategori</option>
                                        <option value="1">Kategori 1</option>
                                        <option value="2">Kategori 2</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Same table content as create modal -->
                            <div class="mb-6">
                                <h4 class="text-center font-semibold mb-3 text-sm sm:text-base">Edit Kronologi</h4>

                                <!-- Desktop Table View -->
                                <div class="hidden lg:block">
                                    <div class="overflow-x-auto">
                                        <table class="min-w-full border text-sm">
                                            <thead class="bg-gray-100 text-center text-blue-500 font-medium">
                                                <tr>
                                                    <th class="border px-2 py-2">Salah</th>
                                                    <th class="border px-2 py-2">Input</th>
                                                    <th class="border px-2 py-2">Benar</th>
                                                    <th class="border px-2 py-2">Input</th>
                                                </tr>
                                            </thead>
                                            <tbody class="text-gray-700">
                                                @php
                                                    $fields = [
                                                        'No Model',
                                                        'Inisial',
                                                        'JC',
                                                        'Area',
                                                        'Label',
                                                        'No Mc',
                                                        'No Box',
                                                        'Qty',
                                                    ];
                                                @endphp
                                                @foreach ($fields as $f)
                                                    <tr>
                                                        <td class="border px-2 py-2 whitespace-nowrap font-medium">
                                                            {{ $f }}</td>
                                                        <td class="border px-2 py-2">
                                                            <input type="text" name="salah[{{ Str::slug($f, '_') }}]"
                                                                class="w-full border border-gray-300 rounded px-2 py-1 text-sm focus:ring-1 focus:ring-blue-500">
                                                        </td>
                                                        <td class="border px-2 py-2 whitespace-nowrap font-medium">
                                                            {{ $f }}</td>
                                                        <td class="border px-2 py-2">
                                                            <input type="text" name="benar[{{ Str::slug($f, '_') }}]"
                                                                class="w-full border border-gray-300 rounded px-2 py-1 text-sm focus:ring-1 focus:ring-blue-500">
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                <tr>
                                                    <td colspan="2" class="border"></td>
                                                    <td class="border px-2 py-2 font-medium">Keterangan</td>
                                                    <td class="border px-2 py-2">
                                                        <textarea name="keterangan" rows="2"
                                                            class="w-full border border-gray-300 rounded px-2 py-1 text-sm focus:ring-1 focus:ring-blue-500"></textarea>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <!-- Mobile Card View -->
                                <div class="lg:hidden space-y-4">
                                    @foreach ($fields as $f)
                                        <div class="bg-gray-50 rounded-lg p-4 space-y-3">
                                            <h5 class="font-medium text-gray-700 text-center">{{ $f }}</h5>
                                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                                <div>
                                                    <label class="block text-xs font-medium text-red-600 mb-1">Data
                                                        Salah</label>
                                                    <input type="text" name="salah[{{ Str::slug($f, '_') }}]"
                                                        class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500">
                                                </div>
                                                <div>
                                                    <label class="block text-xs font-medium text-green-600 mb-1">Data
                                                        Benar</label>
                                                    <input type="text" name="benar[{{ Str::slug($f, '_') }}]"
                                                        class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500">
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach

                                    <!-- Keterangan -->
                                    <div class="bg-gray-50 rounded-lg p-4">
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Keterangan</label>
                                        <textarea name="keterangan" rows="3"
                                            class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500"
                                            placeholder="Masukkan keterangan..."></textarea>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                    <!-- Modal Footer -->
                    <div
                        class="flex flex-col sm:flex-row justify-end space-y-2 sm:space-y-0 sm:space-x-2 px-4 sm:px-6 py-4 border-t bg-gray-50">
                        <button type="button" id="cancelEditModal"
                            class="w-full sm:w-auto px-4 py-2 bg-gray-200 hover:bg-gray-300 rounded-md text-sm font-medium transition-colors">
                            Batal
                        </button>
                        <button type="submit" form="editForm"
                            class="w-full sm:w-auto px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded-md text-sm font-medium transition-colors">
                            Update
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card + DataTable -->
        <div class="border-black/12.5 shadow-soft-xl relative flex flex-col break-words rounded-2xl bg-white">
            <div class="p-3 sm:p-6 pb-0">

                <!-- Mobile Cards View -->
                <div class="block lg:hidden">
                    <div class="mb-4">
                        <input type="text" id="mobileSearch" placeholder="Search..."
                            class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div class="space-y-4" id="mobileCards">
                        @php
                            $data = [
                                (object) [
                                    'tanggal' => '2023-10-01',
                                    'pdkfail' => 'L25067',
                                    'jc' => 'JC1',
                                    'wip' => 'WIP1',
                                    'kategori' => 'Kategori 1',
                                    'ketuser' => 'Keterangan 1',
                                    'user' => 'User 1',
                                    'status' => 'Aktif',
                                    'usermt' => 'User MT 1',
                                    'admininput' => 'Admin Input 1',
                                    'maintenance' => 'Maintenance 1',
                                ],
                                (object) [
                                    'tanggal' => '2023-10-02',
                                    'pdkfail' => 'L25068',
                                    'jc' => 'JC2',
                                    'wip' => 'WIP2',
                                    'kategori' => 'Kategori 2',
                                    'ketuser' => 'Keterangan 2',
                                    'user' => 'User 2',
                                    'status' => 'Aktif',
                                    'usermt' => 'User MT 2',
                                    'admininput' => 'Admin Input 2',
                                    'maintenance' => 'Maintenance 2',
                                ],
                            ];
                        @endphp
                        @foreach ($data as $row)
                            <div class="bg-white border border-gray-200 rounded-lg p-4 shadow-sm mobile-card">
                                <div class="flex justify-between items-start mb-3">
                                    <div class="flex-1">
                                        <h3 class="font-semibold text-gray-800 text-sm">{{ $row->pdkfail }}</h3>
                                        <p class="text-xs text-gray-500">{{ $row->tanggal }}</p>
                                    </div>
                                    <div class="flex space-x-2">
                                        <button class="text-blue-500 hover:text-blue-700 text-sm font-medium edit-btn">
                                            Edit
                                        </button>
                                        <button class="text-red-500 hover:text-red-700 text-sm font-medium"
                                            onclick="confirm('Are you sure?') ? alert('Delete functionality') : ''">
                                            Delete
                                        </button>
                                    </div>
                                </div>

                                <div class="grid grid-cols-2 gap-3 text-xs">
                                    <div>
                                        <span class="text-gray-500">Style:</span>
                                        <span class="font-medium ml-1">{{ $row->jc }}</span>
                                    </div>
                                    <div>
                                        <span class="text-gray-500">WIP:</span>
                                        <span class="font-medium ml-1">{{ $row->wip }}</span>
                                    </div>
                                    <div>
                                        <span class="text-gray-500">Kategori:</span>
                                        <span class="font-medium ml-1">{{ $row->kategori }}</span>
                                    </div>
                                    <div>
                                        <span class="text-gray-500">Status:</span>
                                        <span
                                            class="inline-block px-2 py-1 bg-green-100 text-green-800 rounded-full text-xs font-medium">{{ $row->status }}</span>
                                    </div>
                                </div>

                                <div class="mt-3 pt-3 border-t border-gray-100">
                                    <p class="text-xs text-gray-600">
                                        <span class="font-medium">User:</span> {{ $row->user }} |
                                        <span class="font-medium">Maintenance:</span> {{ $row->maintenance }}
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Desktop Table View -->
                <div class="hidden lg:block">
                    <div class="overflow-x-auto">
                        <table id="kronologiTable" class="min-w-full text-slate-500">
                            <thead class="bg-gray-300 text-slate-600">
                                <tr>
                                    <th class="px-4 py-3 text-left font-bold uppercase text-xs">NO</th>
                                    <th class="px-4 py-3 text-left font-bold uppercase text-xs">TANGGAL</th>
                                    <th class="px-4 py-3 text-center font-bold uppercase text-xs">PDK FAIL</th>
                                    <th class="px-4 py-3 text-center font-bold uppercase text-xs">STYLE</th>
                                    <th class="px-4 py-3 text-center font-bold uppercase text-xs">WIP</th>
                                    <th class="px-4 py-3 text-center font-bold uppercase text-xs">KATEGORI</th>
                                    <th class="px-4 py-3 text-center font-bold uppercase text-xs">KETERANGAN</th>
                                    <th class="px-4 py-3 text-center font-bold uppercase text-xs">USER</th>
                                    <th class="px-4 py-3 text-center font-bold uppercase text-xs">STATUS</th>
                                    <th class="px-4 py-3 text-center font-bold uppercase text-xs">USER MT</th>
                                    <th class="px-4 py-3 text-center font-bold uppercase text-xs">ADMIN</th>
                                    <th class="px-4 py-3 text-center font-bold uppercase text-xs">MAINTENANCE</th>
                                    <th class="px-4 py-3 text-center font-bold uppercase text-xs">AKSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $row)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-4 py-3 text-sm">{{ $loop->iteration }}</td>
                                        <td class="px-4 py-3 text-sm">{{ $row->tanggal }}</td>
                                        <td class="px-4 py-3 text-sm text-center font-medium">{{ $row->pdkfail }}</td>
                                        <td class="px-4 py-3 text-sm text-center">{{ $row->jc }}</td>
                                        <td class="px-4 py-3 text-sm text-center">{{ $row->wip }}</td>
                                        <td class="px-4 py-3 text-sm text-center">{{ $row->kategori }}</td>
                                        <td class="px-4 py-3 text-sm text-center">{{ $row->ketuser }}</td>
                                        <td class="px-4 py-3 text-sm text-center">{{ $row->user }}</td>
                                        <td class="px-4 py-3 text-sm text-center">
                                            <span
                                                class="inline-block px-2 py-1 bg-green-100 text-green-800 rounded-full text-xs font-medium">
                                                {{ $row->status }}
                                            </span>
                                        </td>
                                        <td class="px-4 py-3 text-sm text-center">{{ $row->usermt }}</td>
                                        <td class="px-4 py-3 text-sm text-center">{{ $row->admininput }}</td>
                                        <td class="px-4 py-3 text-sm text-center">{{ $row->maintenance }}</td>
                                        <td class="px-4 py-3 text-sm text-center">
                                            <div class="flex justify-center space-x-2">
                                                <button class="text-blue-500 hover:text-blue-700 font-medium edit-btn">
                                                    Edit
                                                </button>
                                                <button class="text-red-500 hover:text-red-700 font-medium"
                                                    onclick="confirm('Are you sure?') ? alert('Delete functionality') : ''">
                                                    Delete
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        @include('layouts.footer')
    </div>
@endsection

@push('scripts')
    <script>
        // Initialize DataTable
        $(document).ready(function() {
            $('#kronologiTable').DataTable({
                responsive: true,
                searching: false,
                paging: true,
                info: false,
                order: [[1, 'desc']],
            });
          } );
          
    </script>
    <script>
        // Modal functionality
        document.addEventListener('DOMContentLoaded', function() {

            // Function to show modal with animation
            function showModal(modalId, contentId) {
                const modal = document.getElementById(modalId);
                const content = document.getElementById(contentId);

                if (modal && content) {
                    modal.classList.remove('hidden');
                    document.body.style.overflow = 'hidden';

                    // Trigger animation
                    setTimeout(() => {
                        modal.classList.add('opacity-100');
                        content.classList.remove('scale-95', 'opacity-0');
                        content.classList.add('scale-100', 'opacity-100');
                    }, 10);
                }
            }

            // Function to hide modal with animation
            function hideModal(modalId, contentId) {
                const modal = document.getElementById(modalId);
                const content = document.getElementById(contentId);

                if (modal && content) {
                    modal.classList.remove('opacity-100');
                    content.classList.remove('scale-100', 'opacity-100');
                    content.classList.add('scale-95', 'opacity-0');

                    setTimeout(() => {
                        modal.classList.add('hidden');
                        document.body.style.overflow = 'auto';
                    }, 300);
                }
            }

            // Create Modal Events
            const openCreateBtn = document.getElementById('openCreateModal');
            const closeCreateBtn = document.getElementById('closeCreateModal');
            const cancelCreateBtn = document.getElementById('cancelCreateModal');
            const createModal = document.getElementById('createKronologiModal');

            if (openCreateBtn) {
                openCreateBtn.addEventListener('click', () => {
                    showModal('createKronologiModal', 'createModalContent');
                });
            }

            if (closeCreateBtn) {
                closeCreateBtn.addEventListener('click', () => {
                    hideModal('createKronologiModal', 'createModalContent');
                });
            }

            if (cancelCreateBtn) {
                cancelCreateBtn.addEventListener('click', () => {
                    hideModal('createKronologiModal', 'createModalContent');
                });
            }

            // Edit Modal Events
            const editBtns = document.querySelectorAll('.edit-btn');
            const closeEditBtn = document.getElementById('closeEditModal');
            const cancelEditBtn = document.getElementById('cancelEditModal');
            const editModal = document.getElementById('editKronologiModal');
            const editModalContent = document.getElementById('editModalContent');
            if (editBtns.length > 0) {
                editBtns.forEach(btn => {
                    btn.addEventListener('click', () => {
                        showModal('editKronologiModal', 'editModalContent');
                        // Populate edit form with data (this is just a placeholder)
                        document.getElementById('editForm').reset();
                    });
                });
            }
            if (closeEditBtn) {
                closeEditBtn.addEventListener('click', () => {
                    hideModal('editKronologiModal', 'editModalContent');
                });
            }
            if (cancelEditBtn) {
                cancelEditBtn.addEventListener('click', () => {
                    hideModal('editKronologiModal', 'editModalContent');
                });
            }
            // Close modal when clicking outside content
            if (createModal) {
                createModal.addEventListener('click', (e) => {
                    if (e.target === createModal) {
                        hideModal('createKronologiModal', 'createModalContent');
                    }
                });
            }
            if (editModal) {
                editModal.addEventListener('click', (e) => {
                    if (e.target === editModal) {
                        hideModal('editKronologiModal', 'editModalContent');
                    }
                });
            }
        });
    </script>


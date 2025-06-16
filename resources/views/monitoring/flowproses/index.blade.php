{{-- resources/views/kategori_kronologi/index.blade.php --}}
@extends('layouts.app')
@section('title', 'Flow Proses')

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
                <h2 class="text-2xl font-semibold text-gray-800">Flow Proses</h2>
                <p class="text-sm text-gray-600">Kelola Flow Proses</p>
            </div>
            <div class="space-x-2">
                <button id="openImportModalButton"
                    class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 transition">
                    Import Excel
                </button>
            </div>
        </div>

        <div class="bg-white shadow rounded-lg overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">#</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">APS Style ID</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Model</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Area</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Size</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Inisial</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Tanggal</th>
                        <th class="px-6 py-3 text-center text-xs font-semibold text-gray-500 uppercase">Jumlah Proses</th>
                        <th class="px-6 py-3 text-center text-xs font-semibold text-gray-500 uppercase">Detail Proses</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($flows as $i => $flow)
                        @php
                            // Cari style berdasarkan idapsperstyle
                            $style = $styles[$flow->idapsperstyle] ?? null;
                        @endphp
                        <tr class="{{ $i % 2 ? 'bg-gray-50' : '' }}">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $loop->iteration }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $flow->idapsperstyle }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $style['mastermodel'] ?? '-' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $flow->area }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $style['size'] ?? '-' }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $style['inisial'] ?? '-' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                {{ \Carbon\Carbon::parse($flow->tanggal)->format('Y-m-d') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium text-gray-900">
                                {{ $flow->flowProses->count() }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                {{-- Tampilkan list kecil proses --}}
                                <ul class="list-disc list-inside space-y-1">
                                    @foreach ($flow->flowProses as $fp)
                                        <li>
                                            [{{ $fp->step_order }}] {{ $fp->masterProses->nama_proses }}
                                        </li>
                                    @endforeach
                                </ul>
                            </td>
                        </tr>
                    @endforeach

                    @if ($flows->isEmpty())
                        <tr>
                            <td colspan="9" class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-500">
                                Belum ada data flow proses.
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>

    {{-- Modal Import Excel + Date --}}
    <div id="importModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden z-[9999]">
        <div class="bg-white rounded-xl shadow-lg w-full max-w-md p-6 relative">
            <button id="closeImportModalButton" class="absolute top-3 right-3 text-gray-500 hover:text-gray-700">
                &times;
            </button>
            <h3 class="text-lg font-medium text-gray-800 mb-4">Import Flow Proses</h3>
            <form action="{{ route('flowproses.import') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                {{-- Tanggal --}}
                <div>
                    <label for="import_date" class="block text-sm font-medium text-gray-700">Tanggal <span
                            class="text-red-500">*</span></label>
                    <input type="date" name="import_date" id="import_date" required
                        class="mt-1 block w-full border-gray-300 rounded-md" />
                </div>
                {{-- File Excel --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">File Attachment <span
                            class="text-red-500">*</span></label>
                    <input type="file" name="file_attachment" accept=".xlsx,.xls"
                        class="mt-1 block w-full rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-400 focus:border-blue-400 transition-all px-4 py-3 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-green-50 file:text-green-700 hover:file:bg-green-100">
                    <p class="text-xs text-gray-500 mt-2">Format: XLSX, XLS. Maksimal 5MB</p>
                    <div class="text-red-500 text-sm mt-1 hidden" id="error-file_attachment"></div>
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
        document.getElementById('openImportModalButton').addEventListener('click', () => {
            importModal.classList.remove('hidden');
        });
        document.getElementById('closeImportModalButton').addEventListener('click', () => {
            importModal.classList.add('hidden');
        });
        document.getElementById('cancelImportButton').addEventListener('click', () => {
            importModal.classList.add('hidden');
        });
    </script>
@endpush

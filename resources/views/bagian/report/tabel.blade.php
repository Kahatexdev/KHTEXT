@extends('layouts.app')
@section('title', 'Report Bagian')

@push('styles')
    <!-- DataTables Tailwind CSS integration -->
    <link href="https://cdn.datatables.net/1.13.6/css/dataTables.tailwindcss.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css" rel="stylesheet">
@endpush

@section('content')
<div class="w-full px-2 sm:px-4 py-4 sm:py-6 mx-auto space-y-4 sm:space-y-6">

        {{-- Alerts --}}
        @foreach (['success' => 'green', 'error' => 'red', 'warning' => 'yellow'] as $type => $color)
            @if (session($type))
                <div
                    class="flex items-center p-4 rounded-lg bg-{{ $color }}-50 border border-{{ $color }}-200 text-{{ $color }}-700">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        @if ($type == 'success')
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm-1-7V7h2v4h-2zm0 2h2v2h-2z"
                                clip-rule="evenodd" />
                        @elseif($type == 'error')
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm-1-9h2v6h-2V9zm0-2h2v2h-2V7z"
                                clip-rule="evenodd" />
                        @else
                            <path fill-rule="evenodd"
                                d="M8.257 3.099c.765-1.36 2.722-1.36 3.487 0l5.516 9.803c.75 1.332-.213 2.998-1.744 2.998H4.485c-1.531 0-2.494-1.666-1.744-2.998L8.257 3.1zM11 13h-2v-2h2v2zm0-4h-2V7h2v2z"
                                clip-rule="evenodd" />
                        @endif
                    </svg>
                    <div>
                        <p class="font-semibold capitalize">{{ $type }}!</p>
                        <p>{{ session($type) }}</p>
                    </div>
                </div>
            @endif
        @endforeach

        {{-- Header --}}
        <div class="flex items-center justify-between p-4">
            <h2 class="text-xl font-bold">REPORT DATA  {{ strtoupper($bagian) }}</h2>
            <div class="flex items-center space-x-2">
            <a href="{{ route('tb_cekqty_rosset.index', ['bagian' => $bagian]) }}" class="bg-sky-600 hover:bg-sky-700 text-white px-4 py-2 rounded-lg font-medium transition-all duration-200 shadow-sm hover:shadow-md  px-3 py-2">
                <i class="fas fa-plus mr-1"></i>Tambah
            </a>
            <a href="{{ route('reportData.exportExcel', ['bagian' => $bagian]) }}" class="bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2 rounded-lg font-medium transition-all duration-200 shadow-sm hover:shadow-md">
                <i class="fas fa-file-excel mr-1"></i>Export
            </a>
            </div>
        </div>

        @if ($data->isEmpty())
            <div class="text-center py-20 text-gray-500">
                <svg class="mx-auto mb-4 w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7h18M3 12h18M3 17h18" />
                </svg>
                <p>Tidak ada data report untuk bagian ini.</p>
            </div>
        @else
            <div class="bg-white shadow-lg rounded-2xl overflow-hidden">
                <div class="p-4 overflow-x-auto">
                    {{-- Siapkan array kolom --}}
                    @php
                        $baseCols = ['#', 'Area', 'Tanggal'];
                        $rossoCols = [
                            'ERP',
                            'SMV',
                            'Keterangan ERP',
                            'Keterangan SMV',
                            'Reject',
                            'Rework',
                            'Total MC',
                            'Jalan MC',
                            'Shift',
                            'Admin',
                            'Aksi',
                        ];
                        $settingCols = [
                            'ERP',
                            'SMV',
                            'Keterangan ERP',
                            'OVERSIHFT PAGI KE KE SIANG',
                            'OVERSIHFT SIANG KE KE PAGI',
                            'Total MC',
                            'Jalan MC',
                            'Shift',
                            'Admin',
                            'Aksi',
                        ];
                        $gudangCols = [
                            'ERP',
                            'Rework',
                            'Reject',
                            'QTY AKTUAL PERMINTAAN PACKING',
                            'OVERSIHFT PAGI KE KE SIANG',
                            'OVERSIHFT SIANG KE KE PAGI',
                            'Shift',
                            'Admin',
                            'Aksi',
                        ];
                        $handprintCols = [
                            'ERP',
                            'SMV',
                            'KET ERP',
                            'KET SMV',
                            'Reject',
                            'Rework',
                            'Shift',
                            'Admin',
                            'Aksi',
                        ];
                        $jahitCols = [
                            'ERP',
                            'SMV',
                            'KET ERP',
                            'KET SMV',
                            'Reject',
                            'Rework',
                            'Total MC',
                            'Jalan MC',
                            'Shift',
                            'Admin',
                            'Aksi',
                        ];
                        $perbaikanCols = [
                            'QTY OUT',
                            'QTY IN',
                            'KET OUT',
                            'KET IN',
                            'DIRECT',
                            'Reject',
                            'Rework',
                            'Shift',
                            'Admin',
                            'Aksi',
                        ];
                        $extraCols = [];
                        $allCols = [];
                        switch ($bagian) {
                            case 'rosso':
                                $allCols = array_merge($baseCols, $rossoCols);
                                break;
                            case 'setting':
                                $allCols = array_merge($baseCols, $settingCols);
                                break;
                            case 'gudang':
                                $allCols = array_merge($baseCols, $gudangCols);
                                break;
                            case 'handprint':
                                $allCols = array_merge($baseCols, $handprintCols);
                                break;
                            case 'jahit':
                                $allCols = array_merge($baseCols, $jahitCols);
                                break;
                            case 'perbaikan':
                                $allCols = array_merge($baseCols, $perbaikanCols);
                                break;
                            default:
                                $allCols = $baseCols; // Default fallback
                        }
                    @endphp

                    <table id="reportTable" class="min-w-full stripe hover row-border nowrap">
                        <thead class="bg-gray-50">
                            <tr>
                                @foreach ($allCols as $col)
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        {{ $col }}
                                    </th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-100">
                            @foreach ($data as $item)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $loop->iteration }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $item->area }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $item->tanggal_input }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $item->qty_erp_rosset }}</td>

                                    @if ($bagian == 'rosso')
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $item->qty_mis_rosset }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $item->ket_erp_rosset }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $item->ket_mis_rosset }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $item->qty_reject }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $item->qty_rework }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $item->ttl_mc }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $item->jl_mc }}</td>
                                    @elseif ($bagian == 'setting')
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $item->qty_mis_rosset }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $item->ket_erp_rosset }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $item->ket_overshift_pagi_kesiang }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $item->ket_overshift_siang_kepagi }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $item->ttl_mc }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $item->jl_mc }}</td>
                                    @elseif ($bagian == 'gudang')
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $item->qty_rework }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $item->qty_reject }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $item->qty_mis_rosset }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $item->ket_overshift_pagi_kesiang }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $item->ket_overshift_siang_kepagi }}</td>
                                    @elseif ($bagian == 'handprint')
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $item->qty_mis_rosset }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $item->ket_erp_rosset }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $item->ket_mis_rosset }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $item->qty_reject }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $item->qty_rework }}</td>
                                    @elseif ($bagian == 'jahit')
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $item->qty_mis_rosset }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $item->ket_erp_rosset }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $item->ket_mis_rosset }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $item->qty_reject }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $item->qty_rework }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $item->ttl_mc }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $item->jl_mc }}</td>
                                    @elseif ($bagian == 'perbaikan')
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $item->qty_mis_rosset }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $item->ket_erp_rosset }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $item->ket_mis_rosset }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $item->direct }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $item->qty_reject }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $item->qty_rework }}</td>
                                    @endif
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $item->shift }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $item->user->name }}</td>
                                    <td class="px-6 py-4 flex gap-2">
                                        <a href="{{ route('reportData.edit', ['bagian' => $bagian, 'id' => $item->id_cekqty_rosset]) }}" class="bg-orange-600 hover:bg-orange-700 text-white px-4 py-2 rounded-lg font-medium transition-all duration-200 shadow-sm hover:shadow-md mr-2">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('reportData.destroy', ['bagian'=>$bagian, 'id'=>$item->id_cekqty_rosset]) }}" method="POST"
                                            class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-rose-600 hover:bg-rose-700 text-white px-4 py-2 rounded-lg font-medium transition-all duration-200 shadow-sm hover:shadow-md"
                                                onclick="return confirm('Yakin ingin menghapus data ini?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                        
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif

    </div>
@endsection

@push('scripts')
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#reportTable').DataTable({
                responsive: true,
                autoWidth: false,
                pageLength: 10,
                lengthMenu: [10, 25, 50, 100],
                columnDefs: [{
                        orderable: false,
                        targets: -1
                    } // disable sorting on Aksi column
                ]
            });
        });
    </script>
@endpush

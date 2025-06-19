@extends('layouts.app')
@section('title', 'Report Bagian')

@section('content')
<div class="w-full px-2 sm:px-4 py-4 sm:py-6 mx-auto space-y-4 sm:space-y-6">
    {{-- Header --}}
    <div class="flex items-center justify-between p-4">
        <h2 class="text-xl font-bold">REPORT DATA MESIN</h2>
        <div class="flex items-center space-x-2">
            <a href="{{ route('mesin.create') }}" class="bg-sky-600 hover:bg-sky-700 text-white px-4 py-2 rounded-lg font-medium transition-all duration-200 shadow-sm hover:shadow-md  px-3 py-2">
              <i class="fas fa-plus"></i> Tambah
            </a>
            <a href="{{ route('mesin.exportExcel') }}" class="bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2 rounded-lg font-medium transition-all duration-200 shadow-sm hover:shadow-md">
                <i class="fas fa-file-excel mr-1"></i> Export
            </a>
        </div>
    </div>
    <div class="bg-white shadow-md rounded-lg overflow-scroll-x">
        <table id="reportTable" class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Area</th>
                    <th>Qty Erp</th>
                    <th>Qty Timter</th>
                    <th>Qty Summary</th>
                    <th>Qty Running</th>
                    <th>Qty Apk</th>
                    <th>Qty Reject</th>
                    <th>Qty Rework</th>
                    <th>Keterangan Reject</th>
                    <th>Keterangan Rework</th>
                    <th>Keterangan Erp</th>
                    <th>Keterangan Timter</th>
                    <th>Keterangan Summary</th>
                    <th>Keterangan Running</th>
                    <th>Keterangan Apk</th>
                    <th>Shift</th>
                </tr>
            </thead>
            <tbody>
                @php $no = 1;
                @endphp
                @foreach($records as $r)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $r->tanggal_input }}</td>
                    <td>{{ $r->area }}</td>
                    <td>{{ $r->qty_erp }}</td>
                    <td>{{ $r->qty_timter }}</td>
                    <td>{{ $r->qty_summary }}</td>
                    <td>{{ $r->qty_running }}</td>
                    <td>{{ $r->qty_apk }}</td>
                    <td>{{ $r->qty_reject }}</td>
                    <td>{{ $r->qty_rework }}</td>
                    <td>{{ $r->ket_reject }}</td>
                    <td>{{ $r->ket_rework }}</td>
                    <td>{{ $r->ket_erp }}</td>
                    <td>{{ $r->ket_timter }}</td>
                    <td>{{ $r->ket_summary }}</td>
                    <td>{{ $r->ket_running }}</td>
                    <td>{{ $r->ket_apk }}</td>
                    <td>{{ $r->shift }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
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
    $(document).ready(function() {
        $('#reportTable').DataTable({
            responsive: true,
            pageLength: 10,
            columnDefs: [
                { orderable: false, targets: [10, 11, 12, 13, 14, 15, 16] }
            ]
           });
       });
</script>
@endpush

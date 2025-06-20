@extends('layouts.app')
@section('title', 'Report Bagian')

@section('navbar-report-mesin')
<li class="relative flex items-center pl-4">
    <div class="relative">
        <button
            id="dropdownToggle"
            type="button"
            class="flex items-center px-3 py-2 font-semibold text-sm text-slate-600 hover:text-slate-800 focus:outline-none focus:ring focus:ring-slate-300 rounded-md transition">
            <span class="hidden sm:inline">Report</span>
            <svg class="-mr-1 size-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon">
                <path fill-rule="evenodd" d="M5.22 8.22a.75.75 0 0 1 1.06 0L10 11.94l3.72-3.72a.75.75 0 1 1 1.06 1.06l-4.25 4.25a.75.75 0 0 1-1.06 0L5.22 9.28a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
            </svg>
        </button>

        <div
            id="dropdownMenu"
            class="absolute right-0 mt-2 w-48 bg-white border rounded-lg shadow-lg z-50 py-2 opacity-0 scale-95 translate-y-1 pointer-events-none transition-all duration-200 ease-out">
            <a href="{{ route('mesin.index')}}" class="block px-4 py-2 text-sm text-slate-700 hover:bg-gray-100">REPORT DATA MESIN</a>
        </div>
    </div>
</li>
@endsection

@section('content')
<div class="w-full px-2 sm:px-4 py-4 sm:py-6 mx-auto space-y-4 sm:space-y-6">
    {{-- Header --}}
    <div class="flex items-center justify-between p-4">
        <h2 class="text-xl font-bold">REPORT DATA INPUT ERP</h2>
        <div class="flex items-center space-x-2">
            <a href="{{ route('mesin.createInputErp') }}" class="bg-sky-600 hover:bg-sky-700 text-white px-4 py-2 rounded-lg font-medium transition-all duration-200 shadow-sm hover:shadow-md  px-3 py-2">
              <i class="fas fa-plus"></i> Tambah
            </a>
            <a href="" class="bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2 rounded-lg font-medium transition-all duration-200 shadow-sm hover:shadow-md">
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
                    <th>Start Input</th>
                    <th>Stop Input</th>
                    <th>Area</th>
                    <th>Total Mc</th>
                    <th>Jalan Mc</th>
                    <th>Produksi ERP</th>
                    <th>Keterangan</th>
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
                    <td>{{ $r->start_input }}</td>
                    <td>{{ $r->stop_input }}</td>
                    <td>{{ $r->area }}</td>
                    <td>{{ $r->ttl_mc }}</td>
                    <td>{{ $r->jln_mc }}</td>
                    <td>{{ $r->prod_erp }}</td>
                    <td>{{ $r->ket }}</td>
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
    const toggle = document.getElementById('dropdownToggle');
    const menu = document.getElementById('dropdownMenu');

    toggle.addEventListener('click', () => {
        menu.classList.toggle('opacity-0');
        menu.classList.toggle('scale-95');
        menu.classList.toggle('translate-y-1');
        menu.classList.toggle('pointer-events-none');
    });

    document.addEventListener('click', (e) => {
        if (!toggle.contains(e.target) && !menu.contains(e.target)) {
            menu.classList.add('opacity-0', 'scale-95', 'translate-y-1', 'pointer-events-none');
        }
    });
</script>
<script>
    $(document).ready(function() {
        $('#reportTable').DataTable({
            responsive: true,
            pageLength: 10,
            columnDefs: [
                { orderable: false, targets: [8] }
            ]
           });
       });
</script>
@endpush

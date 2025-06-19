<!-- resources/views/kronologi/index.blade.php -->
@extends('layouts.app')
@section('title', 'Kronologi')

@section('content')
<div class="w-full px-2 sm:px-4 py-4 sm:py-6 mx-auto space-y-4 sm:space-y-6">

  <!-- Header & Modal Triggers -->
  <div class="bg-white rounded-xl shadow-md p-4 sm:p-6 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
    <div class="w-full sm:w-auto">
      <h2 class="text-lg sm:text-xl font-semibold text-slate-700">Data Kronologi</h2>
      <p class="text-sm text-slate-500">Tools System</p>
    </div>
    <div class="flex flex-col sm:flex-row gap-2 w-full sm:w-auto">
      <button id="openCreateModal" class="w-full sm:w-auto inline-flex items-center justify-center bg-sky-400 hover:bg-sky-700 text-white text-sm px-4 py-2 rounded-lg shadow-sm transition-all">
        <span class="text-lg mr-1">+</span> Tambah Kronologi
      </button>
      <button id="openImportModal" class="w-full sm:w-auto inline-flex items-center justify-center bg-green-400 hover:bg-green-700 text-white text-sm px-4 py-2 rounded-lg shadow-sm transition-all">
        <span class="text-lg mr-1">📥</span> Import Kronologi
      </button>
    </div>
  </div>

  <!-- Create Modal -->
  <div id="createKronologiModal" class="fixed inset-0 z-[9999] hidden overflow-y-auto bg-black bg-opacity-50 transition-opacity duration-300">
    <div class="min-h-screen flex items-center justify-center p-2 sm:p-4">
      <div class="bg-white rounded-lg shadow-xl w-full max-w-xl transform transition-all duration-300 scale-95 opacity-0" id="createModalContent">
        <!-- Header -->
        <div class="flex justify-between items-center px-6 py-4 border-b sticky top-0 bg-white z-10">
          <h3 class="text-lg font-semibold text-gray-700">Tambah Kronologi</h3>
          <button id="closeCreateModal" class="text-gray-400 hover:text-gray-600 text-2xl p-1 rounded-full hover:bg-gray-100 transition-colors">&times;</button>
        </div>
        <!-- Body -->
        <form method="POST" action="" id="createForm" class="px-6 py-4 space-y-4">
          @csrf
          <!-- Example fields -->
          <div>
            <label class="block text-sm font-medium text-gray-700">Tanggal</label>
            <input type="date" name="tanggal" required class="w-full border-gray-300 rounded-md px-3 py-2 focus:ring-2 focus:ring-blue-500" />
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700">Keterangan</label>
            <textarea name="keterangan" rows="3" required class="w-full border-gray-300 rounded-md px-3 py-2 focus:ring-2 focus:ring-blue-500"></textarea>
          </div>
        </form>
        <!-- Footer -->
        <div class="flex justify-end px-6 py-4 border-t bg-gray-50">
          <button type="button" id="cancelCreateModal" class="px-4 py-2 bg-gray-200 hover:bg-gray-300 rounded-md text-sm font-medium transition-colors mr-2">Batal</button>
          <button type="submit" form="createForm" class="px-4 py-2 bg-sky-500 hover:bg-sky-600 rounded-md text-sm font-medium text-white transition-colors">Simpan</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Import Modal -->
  <div id="importKronologiModal" class="fixed inset-0 z-[9999] hidden overflow-y-auto bg-black bg-opacity-50 transition-opacity duration-300">
    <div class="min-h-screen flex items-center justify-center p-2 sm:p-4">
      <div class="bg-white rounded-lg shadow-xl w-full max-w-3xl max-h-[90vh] overflow-hidden transform transition-all duration-300 scale-95 opacity-0" id="importModalContent">
        <div class="flex justify-between items-center px-6 py-4 border-b sticky top-0 bg-white z-10">
          <h3 class="text-lg font-semibold text-gray-700">Import Kronologi</h3>
          <button id="closeImportModal" class="text-gray-400 hover:text-gray-600 text-2xl p-1 rounded-full hover:bg-gray-100 transition-colors">&times;</button>
        </div>
        <form method="POST" action="" id="importForm" enctype="multipart/form-data" class="px-6 py-4">
          @csrf
          <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-2">Pilih File CSV</label>
            <input type="file" name="file" accept=".csv" required class="w-full border-gray-300 rounded-md px-3 py-2 focus:ring-2 focus:ring-blue-500" />
          </div>
        </form>
        <div class="flex justify-end px-6 py-4 border-t bg-gray-50">
          <button type="button" id="cancelImportModal" class="px-4 py-2 bg-gray-200 hover:bg-gray-300 rounded-md text-sm font-medium transition-colors mr-2">Batal</button>
          <button type="submit" form="importForm" class="px-4 py-2 bg-green-500 hover:bg-green-600 rounded-md text-sm font-medium text-white transition-colors">Import</button>
        </div>
      </div>
    </div>
  </div>

  <!-- DataTable Card -->
  <div class="border-black/12.5 shadow-soft-xl relative flex flex-col break-words rounded-2xl bg-white">
    <div class="p-3 sm:p-6 pb-0">
      <!-- Mobile View -->
      <div class="block lg:hidden mb-4">
        <input type="text" id="mobileSearch" placeholder="Search..." class="w-full px-3 py-2 border rounded-md text-sm focus:ring-2 focus:ring-blue-500" />
      </div>
      <div class="space-y-4 lg:hidden" id="mobileCards"></div>
      <!-- Desktop View -->
      <div class="hidden lg:block overflow-x-auto">
        <table id="kronologiTable" class="min-w-full text-slate-500">
          <thead class="bg-gray-300 text-slate-600">
            <tr>
              <th class="px-4 py-3 text-left font-bold uppercase text-xs">NO</th>
              <th class="px-4 py-3 text-left font-bold uppercase text-xs">TANGGAL</th>
              <!-- more headers... -->
            </tr>
          </thead>
          <tbody></tbody>
        </table>
      </div>
    </div>
  </div>
</div>
@endsection

@push('scripts')


<script>
  function showModal(modalId, contentId) {
    const modal = document.getElementById(modalId);
    const content = document.getElementById(contentId);
    modal.classList.remove('hidden');
    document.body.style.overflow = 'hidden';
    setTimeout(() => {
      modal.classList.add('opacity-100');
      content.classList.replace('scale-95','scale-100');
      content.classList.replace('opacity-0','opacity-100');
    }, 10);
  }

  function hideModal(modalId, contentId) {
    const modal = document.getElementById(modalId);
    const content = document.getElementById(contentId);
    modal.classList.remove('opacity-100');
    content.classList.replace('scale-100','scale-95');
    content.classList.replace('opacity-100','opacity-0');
    setTimeout(() => {
      modal.classList.add('hidden');
      document.body.style.overflow = 'auto';
    }, 300);
  }

  document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('openCreateModal')?.addEventListener('click', () => showModal('createKronologiModal','createModalContent'));
    document.getElementById('closeCreateModal')?.addEventListener('click', () => hideModal('createKronologiModal','createModalContent'));
    document.getElementById('cancelCreateModal')?.addEventListener('click', () => hideModal('createKronologiModal','createModalContent'));
    document.getElementById('openImportModal')?.addEventListener('click', () => showModal('importKronologiModal','importModalContent'));
    document.getElementById('closeImportModal')?.addEventListener('click', () => hideModal('importKronologiModal','importModalContent'));
    document.getElementById('cancelImportModal')?.addEventListener('click', () => hideModal('importKronologiModal','importModalContent'));

    ['createKronologiModal','importKronologiModal'].forEach(id => {
      document.getElementById(id)?.addEventListener('click', e => {
        if (e.target.id === id) hideModal(id, id === 'createKronologiModal'? 'createModalContent':'importModalContent');
      });
    });

    // DataTable init
    $('#kronologiTable').DataTable({ responsive:true, searching:false, paging:true, info:false, order:[[1,'desc']] });
  });
</script>
@endpush
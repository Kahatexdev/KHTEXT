{{-- resources/views/import/kronologi.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container mx-auto py-6">
    @if(session('success'))
        <div class="bg-green-100 p-4 mb-4">{{ session('success') }}</div>
    @endif

    <div class="bg-white p-6 rounded shadow">
        <h2 class="text-xl mb-4">Import Kronologi Kesalahan ERP</h2>
        <form action="{{ route('import.kronologi.process') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
                <label for="file" class="block mb-2">Pilih file Excel</label>
                <input type="file" name="file" id="file" class="border p-2 w-full">
                @error('file')
                    <span class="text-red-600">{{ $message }}</span>
                @enderror
            </div>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Upload & Import</button>
        </form>
    </div>
</div>
@endsection

@extends('layouts.admin')

@section('content')
<div class="space-y-6">
    <div class="sm:flex sm:items-center">
        <div class="sm:flex-auto">
            <h1 class="text-2xl font-semibold text-gray-900">{{ __('Tambah Surat Keputusan Baru') }}</h1>
            <p class="mt-2 text-sm text-gray-700">{{ __('Isi formulir di bawah untuk menambahkan surat keputusan baru') }}</p>
        </div>
    </div>

    <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white">
            <form method="POST" action="{{ route('admin.decrees.store') }}" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Nomor Surat -->
                    <div>
                        <label for="nomor_sk" class="block text-sm font-medium text-gray-700">{{ __('Nomor Surat') }} <span class="text-red-500">*</span></label>
                        <input id="nomor_sk" type="text" name="nomor_sk" value="{{ old('nomor_sk') }}" required class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        @error('nomor_sk')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Tipe Surat -->
                    <div>
                        <label for="jenis_sk" class="block text-sm font-medium text-gray-700">{{ __('Tipe Surat') }} <span class="text-red-500">*</span></label>
                        <select id="jenis_sk" name="jenis_sk" required class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                            @foreach($jenisOptions as $value => $label)
                                <option value="{{ $value }}" {{ old('jenis_sk') == $value ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                        @error('jenis_sk')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Tentang/Perihal -->
                    <div class="md:col-span-2">
                        <label for="tentang" class="block text-sm font-medium text-gray-700">{{ __('Tentang/Perihal') }} <span class="text-red-500">*</span></label>
                        <input id="tentang" type="text" name="tentang" value="{{ old('tentang') }}" required class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        @error('tentang')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Tanggal Penetapan -->
                    <div>
                        <label for="tanggal_terbit" class="block text-sm font-medium text-gray-700">{{ __('Tanggal Penetapan') }} <span class="text-red-500">*</span></label>
                        <input id="tanggal_terbit" type="date" name="tanggal_terbit" value="{{ old('tanggal_terbit') }}" required class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        @error('tanggal_terbit')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Tanggal Berlaku -->
                    <div>
                        <label for="tanggal_berlaku" class="block text-sm font-medium text-gray-700">{{ __('Tanggal Berlaku') }} <span class="text-red-500">*</span></label>
                        <input id="tanggal_berlaku" type="date" name="tanggal_berlaku" value="{{ old('tanggal_berlaku') }}" required class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        @error('tanggal_berlaku')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Ditandatangani oleh -->
                    <div>
                        <label for="ditandatangani_oleh" class="block text-sm font-medium text-gray-700">{{ __('Ditandatangani oleh') }} <span class="text-red-500">*</span></label>
                        <input id="ditandatangani_oleh" type="text" name="ditandatangani_oleh" value="{{ old('ditandatangani_oleh') }}" required class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        @error('ditandatangani_oleh')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Deskripsi -->
                    <div class="md:col-span-2">
                        <label for="deskripsi" class="block text-sm font-medium text-gray-700">{{ __('Deskripsi') }}</label>
                        <textarea id="deskripsi" name="deskripsi" rows="3" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">{{ old('deskripsi') }}</textarea>
                        @error('deskripsi')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- File Upload -->
                    <div class="md:col-span-2">
                        <label for="file_sk" class="block text-sm font-medium text-gray-700">{{ __('Upload PDF File') }} <span class="text-red-500">*</span></label>
                        <div class="mt-1 flex items-center">
                            <input id="file_sk" type="file" name="file_sk" accept="application/pdf" required class="focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        </div>
                        <p class="mt-1 text-sm text-gray-500">{{ __('Format file: PDF. Ukuran maksimum: 10MB') }}</p>
                        @error('file_sk')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="flex items-center justify-end space-x-3 pt-4">
                    <a href="{{ route('admin.decrees.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-300 active:bg-gray-300 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                        {{ __('Batal') }}
                    </a>
                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150">
                        {{ __('Simpan') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection 
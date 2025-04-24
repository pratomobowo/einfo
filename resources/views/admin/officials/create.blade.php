@extends('layouts.admin')

@section('content')
<div class="space-y-6">
    <div class="sm:flex sm:items-center">
        <div class="sm:flex-auto">
            <h1 class="text-2xl font-semibold text-gray-900">{{ __('Tambah Rektor Baru') }}</h1>
            <p class="mt-2 text-sm text-gray-700">{{ __('Isi formulir di bawah untuk menambahkan data rektor baru.') }}</p>
        </div>
    </div>

    <div class="mt-5 overflow-hidden bg-white shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white">
            <x-officials.form />
        </div>
    </div>
</div>
@endsection 
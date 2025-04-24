@extends('layouts.admin')

@section('content')
<div class="space-y-6">
    <div class="sm:flex sm:items-center">
        <div class="sm:flex-auto">
            <h1 class="text-2xl font-semibold text-gray-900">{{ __('Edit Rektor') }}</h1>
            <p class="mt-2 text-sm text-gray-700">{{ __('Perbarui informasi rektor yang terdaftar.') }}</p>
        </div>
    </div>

    <div class="mt-5 overflow-hidden bg-white shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white">
            <x-officials.form :official="$official" />
        </div>
    </div>
</div>
@endsection 
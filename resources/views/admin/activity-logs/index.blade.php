@extends('layouts.admin')

@section('content')
    <div class="space-y-6">
        <div class="sm:flex sm:items-center">
            <div class="sm:flex-auto">
                <h1 class="text-2xl font-semibold text-gray-900">{{ __('Aktivitas Log') }}</h1>
                <p class="mt-2 text-sm text-gray-700">{{ __('Riwayat aktivitas pengguna dalam sistem') }}</p>
            </div>
        </div>

        <div class="mt-5 overflow-hidden bg-white shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white">
                <div class="mb-4">
                    <h3 class="text-lg font-medium text-gray-900">{{ __('Filter Log') }}</h3>
                    <form action="{{ route('admin.activity_logs.index') }}" method="GET" class="mt-3 grid grid-cols-1 md:grid-cols-4 gap-4">
                        <div>
                            <label for="action" class="block text-sm font-medium text-gray-700">{{ __('Aksi') }}</label>
                            <select id="action" name="action" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                <option value="">{{ __('Semua Aksi') }}</option>
                                <option value="create" {{ request('action') == 'create' ? 'selected' : '' }}>{{ __('Tambah') }}</option>
                                <option value="update" {{ request('action') == 'update' ? 'selected' : '' }}>{{ __('Ubah') }}</option>
                                <option value="delete" {{ request('action') == 'delete' ? 'selected' : '' }}>{{ __('Hapus') }}</option>
                            </select>
                        </div>
                        
                        <div>
                            <label for="model_type" class="block text-sm font-medium text-gray-700">{{ __('Jenis Data') }}</label>
                            <select id="model_type" name="model_type" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                <option value="">{{ __('Semua Jenis') }}</option>
                                @foreach ($modelTypes as $type)
                                    <option value="{{ $type }}" {{ request('model_type') == $type ? 'selected' : '' }}>{{ $type }}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div>
                            <label for="date_from" class="block text-sm font-medium text-gray-700">{{ __('Tanggal Dari') }}</label>
                            <input type="date" id="date_from" name="date_from" value="{{ request('date_from') }}" 
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        </div>
                        
                        <div>
                            <label for="date_to" class="block text-sm font-medium text-gray-700">{{ __('Tanggal Hingga') }}</label>
                            <input type="date" id="date_to" name="date_to" value="{{ request('date_to') }}" 
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        </div>
                        
                        <div class="md:col-span-4 flex items-end">
                            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                                {{ __('Filter') }}
                            </button>
                            
                            <a href="{{ route('admin.activity_logs.index') }}" class="ml-2 px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300">
                                {{ __('Reset') }}
                            </a>
                        </div>
                    </form>
                </div>
                
                <div class="mt-8 overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Pengguna') }}</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Aksi') }}</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Data') }}</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Tanggal & Waktu') }}</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Tindakan') }}</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($logs as $log)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $log->user ? $log->user->name : 'Sistem' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                            {{ $log->action == 'create' ? 'bg-green-100 text-green-800' : '' }}
                                            {{ $log->action == 'update' ? 'bg-blue-100 text-blue-800' : '' }}
                                            {{ $log->action == 'delete' ? 'bg-red-100 text-red-800' : '' }}">
                                            {{ $log->action == 'create' ? 'Tambah' : ($log->action == 'update' ? 'Ubah' : 'Hapus') }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ class_basename($log->model_type) }} #{{ $log->model_id }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $log->created_at->format('d M Y, H:i:s') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        <a href="{{ route('admin.activity_logs.show', $log) }}" class="text-blue-600 hover:text-blue-800">
                                            {{ __('Detail') }}
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-4 text-center text-sm text-gray-500">
                                        {{ __('Tidak ada log aktivitas yang ditemukan.') }}
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                
                <div class="mt-4">
                    {{ $logs->withQueryString()->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection 
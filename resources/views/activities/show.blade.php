@extends('layouts.admin')

@section('content')
    <div class="sm:flex sm:items-center mb-6">
        <div class="sm:flex-auto">
            <h1 class="text-base font-semibold leading-6 text-gray-900">Detail Kegiatan</h1>
        </div>
        <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
            <a href="{{ route('activities.index') }}" class="text-sm text-blue-600 hover:text-blue-900">
                &larr; Kembali ke Daftar Kegiatan
            </a>
        </div>
    </div>

    <div class="bg-white overflow-hidden shadow-sm rounded-lg">
        <div class="p-6 text-gray-900">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <h3 class="text-lg font-medium text-gray-900">Informasi Kegiatan</h3>
                    <dl class="mt-4 space-y-4">
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Judul</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $activity->title }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Pejabat</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $activity->official->name }} ({{ $activity->official->position }})</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Tanggal</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $activity->date->format('d/m/Y') }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Waktu</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $activity->formatted_time }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Lokasi</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $activity->location }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Kategori Kegiatan</dt>
                            <dd class="mt-1 text-sm text-gray-900">
                                <span class="px-2 py-0.5 inline-flex text-xs leading-5 font-semibold rounded-full {{ $activity->kategori_kegiatan === 'internal' ? 'bg-green-100 text-green-800' : 'bg-blue-100 text-blue-800' }}">
                                    {{ $activity->kategori_kegiatan === 'internal' ? 'Kegiatan Internal' : 'Kegiatan Eksternal' }}
                                </span>
                            </dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Surat Tugas</dt>
                            <dd class="mt-1 text-sm text-gray-900">
                                @if($activity->assignment_letter)
                                    <a href="{{ route('activities.download_assignment_letter', $activity) }}" class="inline-flex items-center text-blue-600 hover:text-blue-900">
                                        <svg class="h-5 w-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                        </svg>
                                        Download Surat Tugas
                                    </a>
                                @else
                                    <span class="text-gray-500">Tidak ada surat tugas</span>
                                @endif
                            </dd>
                        </div>
                    </dl>
                </div>
                <div>
                    <h3 class="text-lg font-medium text-gray-900">Deskripsi</h3>
                    <div class="mt-4 prose max-w-none">
                        {{ $activity->description }}
                    </div>
                </div>
            </div>

            @if(auth()->check() && auth()->user()->is_admin)
                <div class="mt-6 flex space-x-4">
                    <a href="{{ route('activities.edit', $activity) }}" class="bg-yellow-600 text-white px-4 py-2 rounded-md hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500">
                        Edit Kegiatan
                    </a>
                    <form action="{{ route('activities.destroy', $activity) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500" onclick="return confirm('Apakah Anda yakin ingin menghapus kegiatan ini?')">
                            Hapus Kegiatan
                        </button>
                    </form>
                </div>
            @endif
        </div>
    </div>
@endsection 
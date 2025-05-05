@extends('layouts.admin')

@section('content')
<div class="space-y-8">
    <div class="sm:flex sm:items-center">
        <div class="sm:flex-auto">
            <h1 class="text-2xl font-semibold text-gray-900">Kegiatan</h1>
            <p class="mt-2 text-sm text-gray-700">Daftar semua kegiatan yang telah ditambahkan.</p>
            
            <!-- Filter Status Indicators -->
            @if($request->has('date') && $request->date || $request->has('official_id') && $request->official_id)
            <div class="mt-4 p-3 bg-blue-50 border border-blue-100 rounded-lg flex items-center justify-between">
                <div class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                    </svg>
                    <span class="text-sm text-blue-800">
                        Filter aktif:
                        @if($request->has('date') && $request->date)
                            <strong class="mr-2">Tanggal: {{ \Carbon\Carbon::parse($request->date)->format('d F Y') }}</strong>
                        @endif
                        @if($request->has('official_id') && $request->official_id)
                            <strong>Pejabat: 
                                @foreach($officials as $official)
                                    @if($official->id == $request->official_id)
                                        {{ $official->name }}
                                    @endif
                                @endforeach
                            </strong>
                        @endif
                    </span>
                </div>
                <a href="{{ route('admin.activities') }}" class="bg-white hover:bg-blue-50 text-blue-700 text-xs py-1 px-3 rounded border border-blue-300 transition-colors duration-200 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                    Reset Filter
                </a>
            </div>
            @endif
            
            <!-- Filter Form -->
            <form action="{{ route('admin.activities') }}" method="GET" class="mt-6">
                <div class="flex flex-wrap md:flex-nowrap items-end gap-4">
                    <div>
                        <label for="date" class="block text-sm font-medium text-gray-700 mb-1">Filter Tanggal</label>
                        <input type="date" name="date" id="date" class="w-full md:w-auto rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50 text-sm" value="{{ $request->date ?? '' }}">
                    </div>
                    
                    <div class="md:w-56">
                        <label for="official_id" class="block text-sm font-medium text-gray-700 mb-1">Filter Pejabat</label>
                        <select id="official_id" name="official_id" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50 text-sm">
                            <option value="">Semua Pejabat</option>
                            @foreach($officials as $official)
                                <option value="{{ $official->id }}" @selected($request->official_id == $official->id)>
                                    {{ $official->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    
                    <button type="submit" class="h-10 inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 whitespace-nowrap">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                        </svg>
                        Terapkan Filter
                    </button>
                </div>
            </form>
        </div>
        <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
            <a href="{{ route('admin.activities.create') }}" class="block rounded-md bg-gradient-to-r from-blue-600 to-indigo-600 px-4 py-2 text-center text-sm font-semibold text-white shadow-sm hover:from-blue-700 hover:to-indigo-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 transition-all duration-300">
                <span class="flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                    </svg>
                    Tambah Kegiatan
                </span>
            </a>
        </div>
    </div>

    <div class="mt-8 flow-root">
        <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                <div class="overflow-hidden shadow-lg rounded-lg border border-gray-200">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                            <tr class="bg-gradient-to-r from-blue-50 to-indigo-50">
                                <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">Judul</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Pejabat</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Tanggal</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Waktu</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Lokasi</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Kategori</th>
                                <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6 text-center">
                                    <span class="text-sm font-semibold text-gray-900">Aksi</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($activities as $activity)
                            <tr class="{{ $loop->even ? 'bg-gray-50' : 'bg-white' }} hover:bg-blue-50 transition-colors duration-150">
                                <td class="py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6 border-b border-gray-200">
                                    <div class="line-clamp-2 max-w-xs" title="{{ $activity->title }}">
                                        {{ $activity->title }}
                                    </div>
                                </td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-600 border-b border-gray-200">
                                    <div class="flex items-center">
                                        <span class="h-7 w-7 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-700 mr-2 font-semibold text-xs flex-shrink-0">
                                            {{ substr($activity->official->name, 0, 1) }}
                                        </span>
                                        <span class="line-clamp-1 max-w-[180px]" title="{{ $activity->official->name }} - {{ $activity->official->position }}">
                                            {{ $activity->official->name }} - {{ $activity->official->position }}
                                        </span>
                                    </div>
                                </td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-600 border-b border-gray-200">
                                    <div class="flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        {{ $activity->date->format('d M Y') }}
                                    </div>
                                </td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-600 border-b border-gray-200">
                                    <div class="flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        {{ $activity->formatted_time }}
                                    </div>
                                </td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-600 border-b border-gray-200">
                                    <div class="flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400 mr-1.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                        <span class="line-clamp-1 max-w-[150px]" title="{{ $activity->location }}">
                                            {{ $activity->location }}
                                        </span>
                                    </div>
                                </td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-600 border-b border-gray-200">
                                    <span class="px-3 py-1 inline-flex items-center rounded-full text-xs font-medium {{ $activity->kategori_kegiatan === 'internal' ? 'bg-green-100 text-green-800' : 'bg-blue-100 text-blue-800' }}">
                                        @if($activity->kategori_kegiatan === 'internal')
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                                            </svg>
                                            Internal
                                        @else
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z" />
                                            </svg>
                                            Eksternal
                                        @endif
                                    </span>
                                </td>
                                <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-center text-sm font-medium sm:pr-6 border-b border-gray-200">
                                    <div class="flex justify-center space-x-2">
                                        <a href="{{ route('admin.activities.edit', $activity) }}" class="text-indigo-600 hover:text-indigo-900 bg-indigo-50 hover:bg-indigo-100 p-2 rounded-full transition-colors duration-200" title="Edit Kegiatan">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                            </svg>
                                        </a>
                                        <form action="{{ route('admin.activities.destroy', $activity) }}" method="POST" class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900 bg-red-50 hover:bg-red-100 p-2 rounded-full transition-colors duration-200" onclick="return confirm('Apakah Anda yakin ingin menghapus kegiatan ini?')" title="Hapus Kegiatan">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="px-6 py-10 text-center text-gray-500 border-b border-gray-200">
                                    <div class="flex flex-col items-center justify-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-gray-400 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                        </svg>
                                        <p class="text-base font-medium text-gray-500">Tidak ada data kegiatan</p>
                                        <p class="text-sm text-gray-400 mt-1">Belum ada kegiatan yang ditambahkan atau tidak ada data yang sesuai dengan filter</p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-4">
        {{ $activities->links() }}
    </div>
</div>
@endsection 
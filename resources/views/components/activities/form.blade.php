@props(['activity' => null, 'officials' => []])

<div>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Pejabat -->
        <div class="md:col-span-2">
            <label for="official_id" class="block text-sm font-medium text-gray-700 mb-1">Rektor <span class="text-red-500">*</span></label>
            <div class="relative">
                <select id="official_id" name="official_id" class="form-select mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                    <option value="">Pilih Rektor</option>
                    @foreach($officials as $official)
                        <option value="{{ $official->id }}" @selected(old('official_id', $activity->official_id ?? '') == $official->id)>
                            {{ $official->name }} ({{ $official->position }})
                        </option>
                    @endforeach
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                    <svg class="h-4 w-4 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </div>
            </div>
            @error('official_id')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Disposisi Text -->
        <div class="md:col-span-2">
            <div class="flex items-center mb-1">
                <label for="disposition" class="block text-sm font-medium text-gray-700">Disposisi (Jika Rektor Berhalangan)</label>
                <span class="ml-2 text-xs text-gray-500">(Opsional)</span>
            </div>
            <div class="relative rounded-md shadow-sm">
                <textarea id="disposition" name="disposition" rows="2" 
                    class="form-textarea mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">{{ old('disposition', $activity ? $activity->disposition : '') }}</textarea>
            </div>
            <p class="mt-1 text-xs text-gray-500">Tuliskan informasi disposisi jika rektor berhalangan hadir</p>
            @error('disposition')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Title -->
        <div class="md:col-span-2">
            <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Judul Kegiatan <span class="text-red-500">*</span></label>
            <div class="relative rounded-md shadow-sm">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                    </svg>
                </div>
                <input type="text" name="title" id="title" value="{{ old('title', $activity ? $activity->title : '') }}" 
                    class="pl-10 mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
            </div>
            @error('title')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Description -->
        <div class="md:col-span-2">
            <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi <span class="text-red-500">*</span></label>
            <div class="relative rounded-md shadow-sm">
                <textarea id="description" name="description" rows="4" 
                    class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">{{ old('description', $activity ? $activity->description : '') }}</textarea>
            </div>
            @error('description')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Date -->
        <div>
            <label for="date" class="block text-sm font-medium text-gray-700 mb-1">Tanggal <span class="text-red-500">*</span></label>
            <div class="relative rounded-md shadow-sm">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                </div>
                <input type="date" name="date" id="date" value="{{ old('date', $activity ? $activity->date->format('Y-m-d') : '') }}" 
                    class="pl-10 mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
            </div>
            @error('date')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Time -->
        <div>
            <label for="time" class="block text-sm font-medium text-gray-700 mb-1">Waktu <span class="text-red-500">*</span></label>
            <div class="relative rounded-md shadow-sm">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <input type="time" name="time" id="time" 
                    value="{{ old('time', $activity ? $activity->formatted_time : '') }}" 
                    class="pl-10 mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
            </div>
            @error('time')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Location -->
        <div class="md:col-span-2">
            <label for="location" class="block text-sm font-medium text-gray-700 mb-1">Lokasi <span class="text-red-500">*</span></label>
            <div class="relative rounded-md shadow-sm">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                </div>
                <input type="text" name="location" id="location" value="{{ old('location', $activity ? $activity->location : '') }}" 
                    class="pl-10 mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
            </div>
            @error('location')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
        
        <!-- Kategori Kegiatan -->
        <div class="md:col-span-2">
            <label class="block text-sm font-medium text-gray-700 mb-2">Kategori Kegiatan <span class="text-red-500">*</span></label>
            <div class="mt-1 space-y-3">
                <div class="flex items-center">
                    <input id="kategori_internal" name="kategori_kegiatan" type="radio" value="internal" 
                        class="h-4 w-4 border-gray-300 text-blue-600 focus:ring-blue-500"
                        {{ old('kategori_kegiatan', $activity ? $activity->kategori_kegiatan : 'internal') == 'internal' ? 'checked' : '' }}>
                    <label for="kategori_internal" class="ml-3 flex items-center text-sm font-medium text-gray-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500 mr-2" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                        </svg>
                        Kegiatan Internal
                    </label>
                </div>
                <div class="flex items-center">
                    <input id="kategori_eksternal" name="kategori_kegiatan" type="radio" value="eksternal" 
                        class="h-4 w-4 border-gray-300 text-blue-600 focus:ring-blue-500"
                        {{ old('kategori_kegiatan', $activity ? $activity->kategori_kegiatan : '') == 'eksternal' ? 'checked' : '' }}>
                    <label for="kategori_eksternal" class="ml-3 flex items-center text-sm font-medium text-gray-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-500 mr-2" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z" />
                        </svg>
                        Kegiatan Eksternal
                    </label>
                </div>
            </div>
            @error('kategori_kegiatan')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Assignment Letter Upload -->
        <div class="md:col-span-2">
            <label for="assignment_letter" class="block text-sm font-medium text-gray-700 mb-1">Surat Tugas</label>
            <div class="mt-1 flex items-center">
                <div class="flex-grow">
                    <input type="file" name="assignment_letter" id="assignment_letter" accept=".pdf,.doc,.docx" 
                        class="block w-full text-sm text-gray-500 
                        file:mr-4 file:py-2 file:px-4
                        file:rounded-md file:border-0
                        file:text-sm file:font-semibold
                        file:bg-blue-50 file:text-blue-700
                        hover:file:bg-blue-100">
                </div>
            </div>
            
            @if($activity && $activity->assignment_letter)
                <div class="mt-3 bg-blue-50 p-3 rounded-md">
                    <div class="flex items-center">
                        <svg class="h-5 w-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        <span class="ml-2 text-sm font-medium text-blue-700">File saat ini: {{ $activity->assignment_letter }}</span>
                    </div>
                    
                    <div class="flex items-center mt-2 space-x-3">
                        <a href="{{ route('activities.download_assignment_letter', $activity) }}" 
                           class="text-xs inline-flex items-center px-2.5 py-1.5 border border-transparent font-medium rounded text-blue-700 bg-blue-100 hover:bg-blue-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-150">
                            <svg class="h-4 w-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                            </svg>
                            Download
                        </a>
                        
                        <a href="{{ route('admin.activities.delete_file', $activity) }}"
                           class="text-xs inline-flex items-center px-2.5 py-1.5 border border-transparent font-medium rounded text-red-700 bg-red-100 hover:bg-red-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors duration-150"
                           onclick="return confirm('Apakah Anda yakin ingin menghapus file ini?')">
                            <svg class="h-4 w-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                            Hapus
                        </a>
                    </div>
                </div>
            @endif
            
            <p class="mt-1 text-xs text-gray-500">Upload file surat tugas (PDF, DOC, DOCX, maks. 10MB)</p>
            @error('assignment_letter')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
    </div>
</div> 
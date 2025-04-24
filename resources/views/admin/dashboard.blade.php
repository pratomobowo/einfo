@extends('layouts.admin')

@section('content')
<div class="space-y-8" x-data="{
    activityTab: 'ongoing',
    showModal: false,
    activeActivity: null
}">
    <div class="bg-gradient-to-r from-blue-700 to-blue-500 rounded-lg shadow-lg p-6 text-white">
        <h2 class="text-2xl font-bold leading-7 sm:truncate sm:text-3xl sm:tracking-tight">Dashboard</h2>
        <p class="mt-1 text-blue-100">Selamat datang di panel admin eInfo</p>
    </div>

    <!-- Stats -->
    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4">
        <!-- Total Activities -->
        <div class="overflow-hidden rounded-lg bg-white px-4 py-5 shadow-md border-l-4 border-blue-500 hover:shadow-lg transition-all duration-300">
            <dt class="truncate text-sm font-medium text-gray-500 flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                </svg>
                Total Kegiatan
            </dt>
            <dd class="mt-2 text-3xl font-semibold tracking-tight text-gray-900">{{ $stats['total_activities'] }}</dd>
        </div>

        <!-- Today's Activities -->
        <div class="overflow-hidden rounded-lg bg-gradient-to-br from-blue-50 to-blue-100 px-4 py-5 shadow-md border-l-4 border-blue-600 hover:shadow-lg transition-all duration-300">
            <dt class="truncate text-sm font-medium text-blue-700 flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                Kegiatan Hari Ini
            </dt>
            <dd class="mt-2 text-3xl font-semibold tracking-tight text-blue-900">{{ $stats['today_activities_count'] }}</dd>
        </div>

        <!-- Total SK Rektorat -->
        <div class="overflow-hidden rounded-lg bg-white px-4 py-5 shadow-md border-l-4 border-blue-500 hover:shadow-lg transition-all duration-300">
            <dt class="truncate text-sm font-medium text-gray-500 flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                Total SK Rektorat
            </dt>
            <dd class="mt-2 text-3xl font-semibold tracking-tight text-gray-900">{{ $stats['total_sk_rektorat'] }}</dd>
        </div>

        <!-- Total SK Yayasan -->
        <div class="overflow-hidden rounded-lg bg-white px-4 py-5 shadow-md border-l-4 border-blue-500 hover:shadow-lg transition-all duration-300">
            <dt class="truncate text-sm font-medium text-gray-500 flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                Total SK Yayasan   
            </dt>
            <dd class="mt-2 text-3xl font-semibold tracking-tight text-gray-900">{{ $stats['total_sk_yayasan'] }}</dd>
        </div>
    </div>

    <!-- List View -->
    <div class="space-y-6">
        <!-- Activities Tabs -->
        <div class="overflow-hidden bg-white shadow-md rounded-lg">
            <div class="border-b border-gray-200 bg-gradient-to-r from-blue-600 to-blue-400">
                <div class="sm:flex sm:items-baseline px-4 py-5 sm:px-6">
                    <h3 class="text-lg font-medium leading-6 text-white mr-4">Kegiatan</h3>
                    <div class="mt-4 sm:mt-0">
                        <nav class="-mb-px flex space-x-8">
                            <a href="#" 
                               @click.prevent="activityTab = 'ongoing'" 
                               :class="activityTab === 'ongoing' ? 'border-white text-white' : 'border-transparent text-blue-100 hover:border-blue-200 hover:text-white'"
                               class="whitespace-nowrap border-b-2 px-1 pb-2 text-sm font-medium transition-all duration-200">
                                Sedang Berlangsung
                            </a>
                            <a href="#" 
                               @click.prevent="activityTab = 'recent'" 
                               :class="activityTab === 'recent' ? 'border-white text-white' : 'border-transparent text-blue-100 hover:border-blue-200 hover:text-white'"
                               class="whitespace-nowrap border-b-2 px-1 pb-2 text-sm font-medium transition-all duration-200">
                                Terbaru
                            </a>
                            <a href="#" 
                               @click.prevent="activityTab = 'upcoming'" 
                               :class="activityTab === 'upcoming' ? 'border-white text-white' : 'border-transparent text-blue-100 hover:border-blue-200 hover:text-white'"
                               class="whitespace-nowrap border-b-2 px-1 pb-2 text-sm font-medium transition-all duration-200">
                                Yang Akan Datang
                            </a>
                        </nav>
                    </div>
                </div>
            </div>

            <!-- Ongoing Activities Tab Content -->
            <div x-show="activityTab === 'ongoing'">
                <div class="border-t border-gray-200">
                    <ul role="list" class="divide-y divide-gray-200">
                        @forelse($stats['ongoing_activities'] as $activity)
                        <li class="px-4 py-4 sm:px-6 hover:bg-blue-50 transition-colors duration-150">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 bg-blue-500 rounded-md p-2">
                                        <svg class="h-4 w-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                    <div class="ml-4">
                                        <p class="text-sm font-medium text-gray-900">{{ $activity->title }}</p>
                                        <p class="text-sm text-gray-500">{{ $activity->official->name }} - {{ $activity->official->position }}</p>
                                    </div>
                                </div>
                                <div class="ml-2 flex flex-shrink-0">
                                    <span class="inline-flex items-center rounded-full bg-green-100 px-2.5 py-0.5 text-xs font-medium text-green-800">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd" />
                                        </svg>
                                        Berlangsung
                                    </span>
                                </div>
                            </div>
                            <div class="mt-2 sm:flex sm:justify-between pl-10">
                                <div class="sm:flex">
                                    <p class="flex items-center text-sm text-gray-500">
                                        <svg class="mr-1.5 h-5 w-5 flex-shrink-0 text-blue-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd" />
                                        </svg>
                                        <span class="flex items-center">
                                            <span class="font-medium mr-1.5">{{ $activity->date->format('d M Y') }}</span>
                                            <span class="text-gray-400">•</span>
                                            <span class="ml-1.5">{{ $activity->formatted_time }}</span>
                                        </span>
                                    </p>
                                    <p class="mt-2 flex items-center text-sm text-gray-500 sm:mt-0 sm:ml-6">
                                        <svg class="mr-1.5 h-5 w-5 flex-shrink-0 text-blue-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                            <path fill-rule="evenodd" d="M9.69 18.933l.003.001C9.89 19.02 10 19 10 19s.11.02.308-.066l.002-.001.006-.003.018-.008a5.741 5.741 0 00.281-.14c.186-.096.446-.24.757-.433.62-.384 1.445-.966 2.274-1.765C15.302 14.988 17 12.493 17 9A7 7 0 103 9c0 3.492 1.698 5.988 3.355 7.584a13.731 13.731 0 002.273 1.765 11.842 11.842 0 00.976.544l.062.029.018.008.006.003zM10 11.25a2.25 2.25 0 100-4.5 2.25 2.25 0 000 4.5z" clip-rule="evenodd" />
                                        </svg>
                                        {{ $activity->location }}
                                    </p>
                                </div>
                                <div class="mt-2 flex items-center text-sm sm:mt-0">
                                    <button @click="activeActivity = {{ json_encode($activity->append('formatted_date')) }}; showModal = true" class="text-white bg-blue-600 hover:bg-blue-700 rounded-md px-3 py-1 text-sm transition-colors duration-150 flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                            <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" />
                                        </svg>
                                        Detail
                                    </button>
                                </div>
                            </div>
                        </li>
                        @empty
                        <li class="px-4 py-12 text-center">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <h3 class="mt-2 text-sm font-medium text-gray-900">Tidak ada kegiatan yang sedang berlangsung</h3>
                            <p class="mt-1 text-sm text-gray-500">Tidak ada kegiatan yang sedang berlangsung saat ini.</p>
                        </li>
                        @endforelse
                    </ul>
                </div>
            </div>

            <!-- Recent Activities Tab Content -->
            <div x-show="activityTab === 'recent'" x-cloak>
                <div class="border-t border-gray-200">
                    <ul role="list" class="divide-y divide-gray-200">
                        @forelse($stats['recent_activities'] as $activity)
                        <li class="px-4 py-4 sm:px-6 hover:bg-blue-50 transition-colors duration-150">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 bg-blue-600 rounded-md p-2">
                                        <svg class="h-4 w-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                        </svg>
                                    </div>
                                    <div class="ml-4">
                                        <p class="text-sm font-medium text-gray-900">{{ $activity->title }}</p>
                                        <p class="text-sm text-gray-500">{{ $activity->official->name }} - {{ $activity->official->position }}</p>
                                    </div>
                                </div>
                                <div class="ml-2 flex flex-shrink-0">
                                    <span class="inline-flex items-center rounded-full bg-blue-100 px-2.5 py-0.5 text-xs font-medium text-blue-800">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M5 2a1 1 0 011 1v1h8V3a1 1 0 112 0v1h1a2 2 0 012 2v10a2 2 0 01-2 2H3a2 2 0 01-2-2V6a2 2 0 012-2h1V3a1 1 0 011-1zm11 14a1 1 0 100-2H4a1 1 0 100 2h12z" clip-rule="evenodd" />
                                        </svg>
                                        Terbaru
                                    </span>
                                </div>
                            </div>
                            <div class="mt-2 sm:flex sm:justify-between pl-10">
                                <div class="sm:flex">
                                    <p class="flex items-center text-sm text-gray-500">
                                        <svg class="mr-1.5 h-5 w-5 flex-shrink-0 text-blue-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd" />
                                        </svg>
                                        <span class="flex items-center">
                                            <span class="font-medium mr-1.5">{{ $activity->date->format('d M Y') }}</span>
                                            <span class="text-gray-400">•</span>
                                            <span class="ml-1.5">{{ $activity->formatted_time }}</span>
                                        </span>
                                    </p>
                                    <p class="mt-2 flex items-center text-sm text-gray-500 sm:mt-0 sm:ml-6">
                                        <svg class="mr-1.5 h-5 w-5 flex-shrink-0 text-blue-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                            <path fill-rule="evenodd" d="M9.69 18.933l.003.001C9.89 19.02 10 19 10 19s.11.02.308-.066l.002-.001.006-.003.018-.008a5.741 5.741 0 00.281-.14c.186-.096.446-.24.757-.433.62-.384 1.445-.966 2.274-1.765C15.302 14.988 17 12.493 17 9A7 7 0 103 9c0 3.492 1.698 5.988 3.355 7.584a13.731 13.731 0 002.273 1.765 11.842 11.842 0 00.976.544l.062.029.018.008.006.003zM10 11.25a2.25 2.25 0 100-4.5 2.25 2.25 0 000 4.5z" clip-rule="evenodd" />
                                        </svg>
                                        {{ $activity->location }}
                                    </p>
                                </div>
                                <div class="mt-2 flex items-center text-sm sm:mt-0">
                                    <button @click="activeActivity = {{ json_encode($activity->append('formatted_date')) }}; showModal = true" class="text-white bg-blue-600 hover:bg-blue-700 rounded-md px-3 py-1 text-sm transition-colors duration-150 flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                            <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" />
                                        </svg>
                                        Detail
                                    </button>
                                </div>
                            </div>
                        </li>
                        @empty
                        <li class="px-4 py-12 text-center">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 13h6m-3-3v6m5 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            <h3 class="mt-2 text-sm font-medium text-gray-900">Belum ada kegiatan terbaru</h3>
                            <p class="mt-1 text-sm text-gray-500">Belum ada kegiatan yang ditambahkan baru-baru ini.</p>
                        </li>
                        @endforelse
                    </ul>
                </div>
            </div>

            <!-- Upcoming Activities Tab Content -->
            <div x-show="activityTab === 'upcoming'" x-cloak>
                <div class="border-t border-gray-200">
                    <ul role="list" class="divide-y divide-gray-200">
                        @forelse($stats['upcoming_activities'] as $activity)
                        <li class="px-4 py-4 sm:px-6 hover:bg-blue-50 transition-colors duration-150">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 bg-purple-500 rounded-md p-2">
                                        <svg class="h-4 w-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                                        </svg>
                                    </div>
                                    <div class="ml-4">
                                        <p class="text-sm font-medium text-gray-900">{{ $activity->title }}</p>
                                        <p class="text-sm text-gray-500">{{ $activity->official->name }} - {{ $activity->official->position }}</p>
                                    </div>
                                </div>
                                <div class="ml-2 flex flex-shrink-0">
                                    <span class="inline-flex items-center rounded-full bg-purple-100 px-2.5 py-0.5 text-xs font-medium text-purple-800">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd" />
                                        </svg>
                                        {{ $activity->date->diffForHumans() }}
                                    </span>
                                </div>
                            </div>
                            <div class="mt-2 sm:flex sm:justify-between pl-10">
                                <div class="sm:flex">
                                    <p class="flex items-center text-sm text-gray-500">
                                        <svg class="mr-1.5 h-5 w-5 flex-shrink-0 text-blue-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd" />
                                        </svg>
                                        <span class="flex items-center">
                                            <span class="font-medium mr-1.5">{{ $activity->date->format('d M Y') }}</span>
                                            <span class="text-gray-400">•</span>
                                            <span class="ml-1.5">{{ $activity->formatted_time }}</span>
                                        </span>
                                    </p>
                                    <p class="mt-2 flex items-center text-sm text-gray-500 sm:mt-0 sm:ml-6">
                                        <svg class="mr-1.5 h-5 w-5 flex-shrink-0 text-blue-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                            <path fill-rule="evenodd" d="M9.69 18.933l.003.001C9.89 19.02 10 19 10 19s.11.02.308-.066l.002-.001.006-.003.018-.008a5.741 5.741 0 00.281-.14c.186-.096.446-.24.757-.433.62-.384 1.445-.966 2.274-1.765C15.302 14.988 17 12.493 17 9A7 7 0 103 9c0 3.492 1.698 5.988 3.355 7.584a13.731 13.731 0 002.273 1.765 11.842 11.842 0 00.976.544l.062.029.018.008.006.003zM10 11.25a2.25 2.25 0 100-4.5 2.25 2.25 0 000 4.5z" clip-rule="evenodd" />
                                        </svg>
                                        {{ $activity->location }}
                                    </p>
                                </div>
                                <div class="mt-2 flex items-center text-sm sm:mt-0">
                                    <button @click="activeActivity = {{ json_encode($activity->append('formatted_date')) }}; showModal = true" class="text-white bg-blue-600 hover:bg-blue-700 rounded-md px-3 py-1 text-sm transition-colors duration-150 flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                            <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" />
                                        </svg>
                                        Detail
                                    </button>
                                </div>
                            </div>
                        </li>
                        @empty
                        <li class="px-4 py-12 text-center">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <h3 class="mt-2 text-sm font-medium text-gray-900">Belum ada kegiatan yang akan datang</h3>
                            <p class="mt-1 text-sm text-gray-500">Tidak ada kegiatan yang dijadwalkan dalam waktu dekat.</p>
                        </li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Activity Detail Modal -->
    <div x-show="showModal" class="fixed inset-0 z-10 overflow-y-auto" style="display: none;">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0" @click.away="showModal = false">
            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>

            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full" x-show="showModal"
                 x-transition:enter="ease-out duration-300"
                 x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                 x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave="ease-in duration-200"
                 x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
                
                <!-- Modal Header with Gradient -->
                <div class="bg-gradient-to-r from-blue-600 to-blue-400 px-4 py-4">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-bold text-white" x-text="activeActivity ? activeActivity.title : ''"></h3>
                        <button @click="showModal = false" class="text-white hover:text-blue-100 focus:outline-none transition-colors duration-200">
                            <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                    <div class="mt-1 flex items-center">
                        <span class="inline-flex items-center rounded-full bg-blue-50 px-2 py-1 text-xs font-medium text-blue-700 ring-1 ring-inset ring-blue-700/10">
                            <span x-show="activeActivity && activeActivity.kategori_kegiatan === 'internal'">Kegiatan Internal</span>
                            <span x-show="activeActivity && activeActivity.kategori_kegiatan === 'eksternal'">Kegiatan Eksternal</span>
                        </span>
                    </div>
                </div>
                
                <div class="bg-white px-4 py-4">
                    <!-- Officer Information -->
                    <div class="border-b border-gray-200 pb-4">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 bg-blue-100 rounded-full p-2">
                                <svg class="h-6 w-6 text-blue-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <h4 class="text-sm font-medium text-gray-900">Pejabat</h4>
                                <p class="text-sm text-gray-600" x-text="activeActivity ? activeActivity.official.name + ' - ' + activeActivity.official.position : ''"></p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Date and Time Information -->
                    <div class="border-b border-gray-200 py-4">
                        <div class="grid grid-cols-2 gap-4">
                            <div class="flex items-start">
                                <div class="flex-shrink-0 bg-blue-100 rounded-full p-2">
                                    <svg class="h-5 w-5 text-blue-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <h4 class="text-sm font-medium text-gray-900">Tanggal</h4>
                                    <p class="text-sm text-gray-600" x-text="activeActivity ? activeActivity.formatted_date : ''"></p>
                                </div>
                            </div>
                            
                            <div class="flex items-start">
                                <div class="flex-shrink-0 bg-blue-100 rounded-full p-2">
                                    <svg class="h-5 w-5 text-blue-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <h4 class="text-sm font-medium text-gray-900">Waktu</h4>
                                    <p class="text-sm text-gray-600" x-text="activeActivity ? activeActivity.formatted_time : ''"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Location Information -->
                    <div class="border-b border-gray-200 py-4">
                        <div class="flex items-start">
                            <div class="flex-shrink-0 bg-blue-100 rounded-full p-2">
                                <svg class="h-5 w-5 text-blue-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <h4 class="text-sm font-medium text-gray-900">Lokasi</h4>
                                <p class="text-sm text-gray-600" x-text="activeActivity ? activeActivity.location : ''"></p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Description -->
                    <div class="py-4">
                        <div class="flex items-start">
                            <div class="flex-shrink-0 bg-blue-100 rounded-full p-2">
                                <svg class="h-5 w-5 text-blue-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <h4 class="text-sm font-medium text-gray-900">Deskripsi</h4>
                                <p class="text-sm text-gray-600 mt-1" x-text="activeActivity ? activeActivity.description : ''"></p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="bg-gray-50 px-4 py-4 sm:px-6 sm:flex sm:flex-row-reverse">
                    <a :href="activeActivity ? '{{ url('admin/activities') }}/' + activeActivity.id + '/edit' : '#'" class="inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm transition-colors duration-200">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                        Edit Kegiatan
                    </a>
                    <button type="button" @click="showModal = false" class="mt-3 inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:w-auto sm:text-sm transition-colors duration-200">
                        Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    [x-cloak] {
        display: none !important;
    }
</style>
@endsection 
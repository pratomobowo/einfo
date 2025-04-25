<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-gray-50">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - Admin</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts and Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Alpine.js CDN sebagai fallback -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="h-full" x-data="{ sidebarOpen: false }">
    <div>
        <!-- Off-canvas menu for mobile -->
        <div x-show="sidebarOpen" class="relative z-50 lg:hidden" role="dialog" aria-modal="true">
            <div x-show="sidebarOpen" x-transition:enter="transition-opacity ease-linear duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition-opacity ease-linear duration-300" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 bg-gray-900/80"></div>

            <div class="fixed inset-0 flex">
                <div x-show="sidebarOpen" x-transition:enter="transition ease-in-out duration-300 transform" x-transition:enter-start="-translate-x-full" x-transition:enter-end="translate-x-0" x-transition:leave="transition ease-in-out duration-300 transform" x-transition:leave-start="translate-x-0" x-transition:leave-end="-translate-x-full" class="relative mr-16 flex w-full max-w-xs flex-1">
                    <div x-show="sidebarOpen" x-transition:enter="ease-in-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in-out duration-300" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="absolute left-full top-0 flex w-16 justify-center pt-5">
                        <button type="button" @click="sidebarOpen = false" class="-m-2.5 p-2.5">
                            <span class="sr-only">Close sidebar</span>
                            <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    <!-- Sidebar component for mobile -->
                    @include('layouts.partials.admin-sidebar')
                </div>
            </div>
        </div>

        <!-- Static sidebar for desktop -->
        <div class="hidden lg:fixed lg:inset-y-0 lg:z-50 lg:flex lg:w-72 lg:flex-col">
            <div class="flex grow flex-col gap-y-5 overflow-y-auto bg-gradient-to-b from-blue-700 to-blue-600 pb-4">
                <div class="flex h-16 shrink-0 items-center px-6">
                    <img class="h-8 w-auto" src="{{ asset('images/logo.png') }}" alt="eInfo">
                    <span class="ml-3 text-xl font-bold text-white">eInfo Admin</span>
                </div>
                <nav class="flex flex-1 flex-col px-6">
                    <ul role="list" class="flex flex-1 flex-col gap-y-7">
                        <li>
                            <ul role="list" class="-mx-2 space-y-1">
                                <li>
                                    <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'bg-blue-800 text-white' : 'text-white/90 hover:text-white hover:bg-blue-800/80' }} group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold transition-all duration-150">
                                        <svg class="h-6 w-6 shrink-0 {{ request()->routeIs('admin.dashboard') ? 'text-white' : 'text-blue-100 group-hover:text-white' }}" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                                        </svg>
                                        Dashboard
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.activities') }}" class="{{ request()->routeIs('admin.activities*') ? 'bg-blue-800 text-white' : 'text-white/90 hover:text-white hover:bg-blue-800/80' }} group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold transition-all duration-150">
                                        <svg class="h-6 w-6 shrink-0 {{ request()->routeIs('admin.activities*') ? 'text-white' : 'text-blue-100 group-hover:text-white' }}" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
                                        </svg>
                                        Kegiatan
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.decrees.index') }}" class="{{ request()->routeIs('admin.decrees*') ? 'bg-blue-800 text-white' : 'text-white/90 hover:text-white hover:bg-blue-800/80' }} group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold transition-all duration-150">
                                        <svg class="h-6 w-6 shrink-0 {{ request()->routeIs('admin.decrees*') ? 'text-white' : 'text-blue-100 group-hover:text-white' }}" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                                        </svg>
                                        Surat Keputusan
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.officials') }}" class="text-white hover:bg-blue-600 group flex items-center px-2 py-2 text-sm font-medium rounded-md {{ request()->routeIs('admin.officials*') ? 'bg-blue-800' : '' }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="text-white mr-3 flex-shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                        Rektor
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.users') }}" class="{{ request()->routeIs('admin.users*') ? 'bg-blue-800 text-white' : 'text-white/90 hover:text-white hover:bg-blue-800/80' }} group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold transition-all duration-150">
                                        <svg class="h-6 w-6 shrink-0 {{ request()->routeIs('admin.users*') ? 'text-white' : 'text-blue-100 group-hover:text-white' }}" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                                        </svg>
                                        Pengguna
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.activity-logs.index') }}" class="{{ request()->routeIs('admin.activity-logs*') ? 'bg-blue-800 text-white' : 'text-white/90 hover:text-white hover:bg-blue-800/80' }} group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold transition-all duration-150">
                                        <svg class="h-6 w-6 shrink-0 {{ request()->routeIs('admin.activity-logs*') ? 'text-white' : 'text-blue-100 group-hover:text-white' }}" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m.75 12l3 3m0 0l3-3m-3 3v-6m-1.5-9H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                                        </svg>
                                        Aktivitas Log
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.documentation') }}" class="{{ request()->routeIs('admin.documentation*') ? 'bg-blue-800 text-white' : 'text-white/90 hover:text-white hover:bg-blue-800/80' }} group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold transition-all duration-150">
                                        <svg class="h-6 w-6 shrink-0 {{ request()->routeIs('admin.documentation*') ? 'text-white' : 'text-blue-100 group-hover:text-white' }}" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
                                        </svg>
                                        Dokumentasi
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="-mx-2 mt-auto">
                            <a href="{{ route('home') }}" class="flex items-center gap-x-3 rounded-md p-2 text-sm font-semibold leading-6 text-white hover:bg-blue-800/80 transition-all duration-150">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-100" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                                </svg>
                                Kembali ke Beranda
                            </a>
                            <div class="mt-3 px-2">
                                <div class="flex flex-col items-center justify-center space-y-1 bg-blue-800/40 rounded-md py-2 px-3">
                                    <p class="text-xs font-medium text-white">© BIRO TI USBYPKP</p>
                                    <div class="flex items-center">
                                        <span class="px-2 py-1 bg-blue-700/50 rounded text-xs text-blue-100 font-mono">v1.0.0</span>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>

        <div class="lg:pl-72">
            <div class="sticky top-0 z-40 flex h-16 shrink-0 items-center gap-x-4 border-b border-gray-200 bg-white px-4 shadow-sm sm:gap-x-6 sm:px-6 lg:px-8">
                <button type="button" @click="sidebarOpen = true" class="-m-2.5 p-2.5 text-blue-700 lg:hidden">
                    <span class="sr-only">Open sidebar</span>
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    </svg>
                </button>

                <!-- Separator -->
                <div class="h-6 w-px bg-gray-200 lg:hidden" aria-hidden="true"></div>

                <div class="flex flex-1 gap-x-4 self-stretch items-center lg:gap-x-6">
                    <div class="flex flex-1 items-center">
                        <div class="hidden sm:flex sm:items-center px-3 py-1.5 bg-blue-50 rounded-lg border border-blue-100">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-600 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <span class="text-blue-700 font-medium text-sm">
                                {{ \Carbon\Carbon::now()->locale('id')->isoFormat('dddd, D MMMM YYYY') }}
                            </span>
                        </div>
                    </div>
                    <div class="flex items-center gap-x-4 lg:gap-x-6">
                        <!-- Profile dropdown -->
                        <div class="relative" x-data="{ open: false }">
                            <button type="button" @click="open = !open" class="-m-1.5 flex items-center p-1.5" id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                                <span class="sr-only">Open user menu</span>
                                <span class="flex items-center">
                                    <span class="text-sm font-semibold leading-6 text-gray-900" aria-hidden="true">{{ auth()->user()->name }}</span>
                                    <svg class="ml-2 h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                                    </svg>
                                </span>
                            </button>

                            <div x-show="open" @click.away="open = false" x-cloak class="absolute right-0 z-10 mt-2.5 w-32 origin-top-right rounded-md bg-white py-2 shadow-lg ring-1 ring-gray-900/5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">
                                <a href="{{ route('admin.users.edit', auth()->id()) }}" class="block px-3 py-1 text-sm leading-6 text-gray-900 hover:bg-blue-50" role="menuitem" tabindex="-1" id="user-menu-item-0">Profil</a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="block w-full px-3 py-1 text-left text-sm leading-6 text-gray-900 hover:bg-blue-50" role="menuitem" tabindex="-1" id="user-menu-item-2">Logout</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <main class="py-10">
                <div class="px-4 sm:px-6 lg:px-8">
                    @yield('content')
                </div>
            </main>
        </div>
    </div>
    
    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
    
    @stack('scripts')
</body>
</html> 
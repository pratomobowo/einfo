{{-- Mobile sidebar --}}
<div class="flex grow flex-col gap-y-5 overflow-y-auto bg-gradient-to-b from-blue-700 to-blue-600 px-6 pb-4">
    <div class="flex h-16 shrink-0 items-center">
        <img class="h-8 w-auto" src="{{ asset('images/logo.png') }}" alt="eInfo">
        <span class="ml-3 text-xl font-bold text-white">eInfo Admin</span>
    </div>
    <nav class="flex flex-1 flex-col">
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
                        <a href="{{ route('admin.officials') }}" class="text-white hover:bg-blue-600 group flex items-center px-2 py-2 text-base font-medium rounded-md {{ request()->routeIs('admin.officials*') ? 'bg-blue-800' : '' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="text-white mr-4 flex-shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            Rektor
                        </a>
                    </li>
                    @if(auth()->user()->isSuperAdmin())
                    <li>
                        <a href="{{ route('admin.users') }}" class="{{ request()->routeIs('admin.users*') ? 'bg-blue-800 text-white' : 'text-white/90 hover:text-white hover:bg-blue-800/80' }} group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold transition-all duration-150">
                            <svg class="h-6 w-6 shrink-0 {{ request()->routeIs('admin.users*') ? 'text-white' : 'text-blue-100 group-hover:text-white' }}" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                            </svg>
                            Pengguna
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.activity_logs.index') }}" class="{{ request()->routeIs('admin.activity_logs*') ? 'bg-blue-800 text-white' : 'text-white/90 hover:text-white hover:bg-blue-800/80' }} group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold transition-all duration-150">
                            <svg class="h-6 w-6 shrink-0 {{ request()->routeIs('admin.activity_logs*') ? 'text-white' : 'text-blue-100 group-hover:text-white' }}" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m.75 12l3 3m0 0l3-3m-3 3v-6m-1.5-9H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                            </svg>
                            Aktivitas Log
                        </a>
                    </li>
                    @endif
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
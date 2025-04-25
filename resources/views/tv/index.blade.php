<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Jadwal Kegiatan Rektor</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=poppins:300,400,500,600,700&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }

        .header {
            background: linear-gradient(to right, #1a4f95, #3474c4);
            padding: 0.75rem 1rem;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: stretch;
            gap: 0.75rem;
        }

        .header-left {
            display: flex;
            align-items: center;
        }

        .logo-container {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
        }

        .logo {
            height: 2.75rem;
            margin-right: 0.75rem;
        }

        .header-text h1 {
            color: white;
            font-weight: 600;
            margin: 0;
            font-size: 0.9rem;
            text-align: center;
        }

        .time-display {
            color: white;
            font-size: 0.7rem;
            opacity: 0.95;
            margin-top: 0.25rem;
        }

        .tab-nav {
            background: white;
            border-bottom: 1px solid #e2e8f0;
            padding: 0 0.5rem;
            overflow-x: auto;
            white-space: nowrap;
            -webkit-overflow-scrolling: touch;
            scrollbar-width: none; /* Firefox */
            display: flex;
        }

        .tab-nav::-webkit-scrollbar {
            display: none; /* Safari and Chrome */
        }

        .tab-button {
            padding: 0.75rem 1rem;
            color: #64748b;
            font-weight: 500;
            font-size: 0.9rem;
            border: none;
            background: none;
            cursor: pointer;
            position: relative;
            transition: color 0.2s;
            flex-shrink: 0;
        }

        .tab-button.active {
            color: #2563eb;
        }

        .tab-button.active::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 2px;
            background: #2563eb;
        }

        .category-tabs {
            display: flex;
            padding: 0.5rem 0.5rem;
            background: #f8f9fa;
            border-bottom: 1px solid #e2e8f0;
            overflow-x: auto;
            white-space: nowrap;
            -webkit-overflow-scrolling: touch;
            scrollbar-width: none;
        }

        .category-tabs::-webkit-scrollbar {
            display: none; /* Safari and Chrome */
        }

        .category-tab {
            padding: 0.5rem 0.75rem;
            border: none;
            background: none;
            font-size: 0.85rem;
            color: #64748b;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            flex-shrink: 0;
        }

        .category-tab.active {
            color: #2563eb;
            font-weight: 500;
        }

        .badge {
            background: #e2e8f0;
            color: #64748b;
            padding: 0.1rem 0.5rem;
            border-radius: 999px;
            font-size: 0.75rem;
            font-weight: 500;
        }

        .badge.active {
            background: #2563eb;
            color: white;
        }

        .main-content {
            padding: 1rem;
            max-width: 1600px;
            margin: 0 auto;
        }

        .empty-state {
            text-align: center;
            padding: 3rem 0;
            color: #64748b;
        }

        .grid-layout {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 1rem;
        }

        @media (max-width: 640px) {
            .grid-layout {
                grid-template-columns: 1fr;
            }
        }

        .card {
            background: white;
            border-radius: 0.5rem;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: transform 0.2s, box-shadow 0.2s;
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .card:hover {
            transform: translateY(-3px);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .card-content {
            padding: 1.25rem;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }

        .card-title {
            font-weight: 600;
            color: #334155;
            font-size: 1rem;
            margin-bottom: 0.25rem;
            overflow: hidden;
            text-overflow: ellipsis;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            line-height: 1.4;
            max-height: 2.8rem;
        }

        .card-subtitle {
            color: #64748b;
            font-size: 0.9rem;
            margin-bottom: 1rem;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .card-date,
        .card-location {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: #64748b;
            font-size: 0.85rem;
            padding: 0.5rem;
            background: #f8f9fa;
            border-radius: 0.25rem;
            margin-bottom: 0.5rem;
        }

        .card-location span {
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .card-icon {
            color: #2563eb;
            flex-shrink: 0;
        }

        .card-button {
            background: #2563eb;
            color: white;
            border: none;
            padding: 0.6rem 0;
            border-radius: 0.25rem;
            font-weight: 500;
            cursor: pointer;
            transition: background 0.2s;
            margin-top: auto;
            font-size: 0.9rem;
        }

        .card-button:hover {
            background: #1d4ed8;
        }

        .modal {
            position: fixed;
            inset: 0;
            z-index: 50;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(0, 0, 0, 0.5);
            padding: 1rem;
        }

        .modal-content {
            background: white;
            border-radius: 0.5rem;
            max-width: 500px;
            width: 100%;
            max-height: 90vh;
            overflow-y: auto;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .modal-header {
            background: linear-gradient(to right, #1a4f95, #3474c4);
            padding: 1rem 1.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 1;
        }

        .modal-title {
            color: white;
            font-weight: 600;
            font-size: 1.1rem;
            margin: 0;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            max-width: calc(100% - 2rem);
        }

        .modal-close {
            background: none;
            border: none;
            color: white;
            cursor: pointer;
            padding: 0.25rem;
        }

        .modal-body {
            padding: 1.5rem;
        }

        .modal-section {
            margin-bottom: 1.25rem;
        }

        .modal-section:last-child {
            margin-bottom: 0;
        }

        .section-title {
            font-weight: 600;
            font-size: 0.9rem;
            color: #334155;
            margin-bottom: 0.5rem;
        }

        .section-content {
            color: #64748b;
            font-size: 0.9rem;
            word-wrap: break-word;
            overflow-wrap: break-word;
        }

        .info-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 0.5rem;
            word-break: break-word;
        }

        .info-item span {
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .header-right {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            justify-content: center;
        }

        .auth-buttons {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .auth-button {
            background-color: rgba(255, 255, 255, 0.2);
            color: white;
            border: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: 0.375rem;
            padding: 0.35rem 0.7rem;
            font-size: 0.75rem;
            font-weight: 500;
            transition: all 0.15s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.375rem;
            white-space: nowrap;
        }

        .auth-button:hover {
            background-color: rgba(255, 255, 255, 0.3);
        }

        .auth-button.primary {
            background-color: rgba(255, 255, 255, 0.9);
            color: #1a4f95;
        }

        .auth-button.primary:hover {
            background-color: white;
        }

        /* Responsive adjustments */
        @media (min-width: 768px) {
            .header {
                flex-direction: row;
                justify-content: space-between;
                align-items: center;
            }

            .header-text h1 {
                font-size: 1.1rem;
                text-align: left;
            }
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .header {
                padding: 0.5rem 0.75rem;
            }
            
            .logo {
                height: 2rem;
                margin-right: 0.5rem;
            }
            
            .header-left {
                width: 100%;
                justify-content: center;
                margin-bottom: 0.5rem;
            }
            
            .logo-container {
                flex-direction: column;
                align-items: center;
                text-align: center;
            }
            
            @media (min-width: 480px) {
                .logo-container {
                    flex-direction: row;
                }
            }
            
            .header-right {
                width: 100%;
                justify-content: center;
                gap: 0.5rem;
            }
            
            .auth-buttons {
                display: flex;
                flex-direction: row;
                align-items: center;
                gap: 0.5rem;
            }
            
            .tab-button {
                padding: 0.6rem 0.75rem;
                font-size: 0.85rem;
            }
            
            .category-tab {
                padding: 0.4rem 0.6rem;
                font-size: 0.8rem;
            }

            .card-content {
                padding: 1rem;
            }
        }

        /* Status badges styles for the homepage */
        .status-badge {
            display: inline-block;
            font-size: 0.65rem;
            font-weight: 600;
            border-radius: 4px;
            padding: 0.1rem 0.5rem;
            margin-left: 0.75rem;
            text-transform: uppercase;
            letter-spacing: -0.2px;
        }

        .status-ongoing {
            background-color: rgba(16, 185, 129, 0.15);
            color: #10b981;
            border: 1px solid rgba(16, 185, 129, 0.25);
        }

        .status-upcoming {
            background-color: rgba(59, 130, 246, 0.15);
            color: #3b82f6;
            border: 1px solid rgba(59, 130, 246, 0.25);
        }

        /* Adjust card-date to accommodate status */
        .card-date {
            display: flex;
            align-items: center;
            margin-bottom: 0.5rem;
        }

        .card-date > svg {
            flex-shrink: 0;
        }
    </style>
</head>
<body x-data="{ 
    showModal: false, 
    selectedActivity: null
}">
    <!-- Header -->
    <header class="header">
        <div class="header-left">
            <div class="logo-container">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="logo">
                <div class="header-text">
                    <h1>JADWAL KEGIATAN REKTOR</h1>
                    <div class="time-display" id="current-time"></div>
                </div>
            </div>
        </div>

        <div class="header-right">
            @auth
                <div class="auth-buttons">
                    <a href="{{ route('admin.dashboard') }}" class="auth-button primary">
                        {{ __('Admin Panel') }}
                    </a>
                    <form method="POST" action="{{ route('logout') }}" class="m-0">
                        @csrf
                        <button type="submit" class="auth-button">
                            {{ __('Logout') }}
                        </button>
                    </form>
                </div>
            @else
                <div class="auth-buttons">
                    <a href="{{ route('login') }}" class="auth-button">
                        {{ __('Login') }}
                    </a>
                </div>
            @endauth
        </div>
    </header>

    <!-- Navigation Tabs -->
    <nav class="tab-nav">
        <button 
            onclick="filterByPosition('')"
            class="tab-button {{ !$position ? 'active' : '' }}">
            Semua Kegiatan
        </button>
        @foreach($officials as $official)
        <button 
            onclick="filterByPosition('{{ $official->position }}')"
            class="tab-button {{ $position == $official->position ? 'active' : '' }}">
            {{ $official->position }}
        </button>
        @endforeach
    </nav>

    <!-- Category Tabs -->
    @if($position || true)
    <div class="category-tabs">
        <button 
            onclick="filterByCategory('today')"
            class="category-tab {{ $category == 'today' ? 'active' : '' }}">
            <span>Kegiatan Hari Ini</span>
            <span class="badge {{ $category == 'today' ? 'active' : '' }}">{{ $counts['today'] }}</span>
        </button>
        <button 
            onclick="filterByCategory('upcoming')"
            class="category-tab {{ $category == 'upcoming' ? 'active' : '' }}">
            <span>Kegiatan Mendatang</span>
            <span class="badge {{ $category == 'upcoming' ? 'active' : '' }}">{{ $counts['upcoming'] }}</span>
        </button>
        <button 
            onclick="filterByCategory('past')"
            class="category-tab {{ $category == 'past' ? 'active' : '' }}">
            <span>Kegiatan Sebelumnya</span>
            <span class="badge {{ $category == 'past' ? 'active' : '' }}">{{ $counts['past'] }}</span>
        </button>
    </div>
    @endif

    <!-- Main Content -->
    <main class="main-content">
        @if($activities->isEmpty())
        <div class="empty-state">
            <p>Tidak ada kegiatan untuk ditampilkan</p>
        </div>
        @else
        <div class="grid-layout">
            @foreach($activities as $activity)
            <div class="card">
                <div class="card-content">
                    <h3 class="card-title">{{ $activity->title }}</h3>
                    <p class="card-subtitle">{{ $activity->official->name }} ({{ $activity->official->position }})</p>
                    
                    <div class="card-date">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 card-icon" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" />
                        </svg>
                        <span>{{ \Carbon\Carbon::parse($activity->date)->format('d F Y') }}</span>
                    </div>
                    
                    <div class="card-date">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 card-icon" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd" />
                        </svg>
                        <span>{{ $activity->formatted_time }}</span>
                        
                        @php
                        try {
                            // Get current time
                            $now = \Carbon\Carbon::now();
                            
                            // Parse activity date (just the date part, no time)
                            $activityDate = \Carbon\Carbon::parse($activity->date)->startOfDay();
                            
                            // Get time from activity
                            $timeStr = $activity->formatted_time;
                            
                            // Default start and end times
                            $startTime = null;
                            $endTime = null;
                            
                            // Parse the time string - looking for patterns like "09:00 - 10:00"
                            if (is_string($timeStr) && strpos($timeStr, '-') !== false) {
                                $timeParts = explode('-', $timeStr);
                                $startTimeStr = trim($timeParts[0]);
                                $endTimeStr = isset($timeParts[1]) ? trim($timeParts[1]) : null;
                                
                                // Create the full datetime by combining activity date with time
                                if (!empty($startTimeStr)) {
                                    try {
                                        $startTime = \Carbon\Carbon::parse($activityDate->format('Y-m-d') . ' ' . $startTimeStr);
                                        
                                        if (!empty($endTimeStr)) {
                                            $endTime = \Carbon\Carbon::parse($activityDate->format('Y-m-d') . ' ' . $endTimeStr);
                                        } else {
                                            $endTime = (clone $startTime)->addHour();
                                        }
                                    } catch (\Exception $e) {
                                        // If specific parsing fails, use default times
                                        $startTime = $activityDate->copy()->addHours(8);  // 8 AM
                                        $endTime = $activityDate->copy()->addHours(9);    // 9 AM
                                    }
                                }
                            } else {
                                // Single time format, like "09:00"
                                try {
                                    $startTime = \Carbon\Carbon::parse($activityDate->format('Y-m-d') . ' ' . $timeStr);
                                    $endTime = (clone $startTime)->addHour();
                                } catch (\Exception $e) {
                                    // If specific parsing fails, use default times
                                    $startTime = $activityDate->copy()->addHours(8);  // 8 AM
                                    $endTime = $activityDate->copy()->addHours(9);    // 9 AM
                                }
                            }
                            
                            // If we still don't have valid times, use defaults
                            if (!$startTime) {
                                $startTime = $activityDate->copy()->addHours(8);  // 8 AM
                                $endTime = $activityDate->copy()->addHours(9);    // 9 AM
                            }
                            
                            // Determine status
                            $status = '';
                            $statusClass = '';
                            
                            // Simple comparisons for status
                            if ($now->lt($startTime)) {
                                // Activity is in the future
                                $status = 'AKAN DATANG';
                                $statusClass = 'status-upcoming';
                            } elseif ($now->between($startTime, $endTime)) {
                                // Activity is currently happening
                                $status = 'BERLANGSUNG';
                                $statusClass = 'status-ongoing';
                            }
                        } catch (\Exception $e) {
                            // Handle any unexpected errors
                            $status = '';
                            $statusClass = '';
                        }
                        @endphp
                        
                        @if($status)
                            <span class="status-badge {{ $statusClass }}">{{ $status }}</span>
                        @endif
                    </div>
                    
                    <div class="card-location">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 card-icon" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                        </svg>
                        <span>{{ $activity->location }}</span>
                    </div>
                    
                    <div class="card-location">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 card-icon" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M5 4v3H4a2 2 0 00-2 2v3a2 2 0 002 2h1v2a2 2 0 002 2h6a2 2 0 002-2v-2h1a2 2 0 002-2V9a2 2 0 00-2-2h-1V4a2 2 0 00-2-2H7a2 2 0 00-2 2zm8 0v3H7V4h6zm-5 7a1 1 0 100-2 1 1 0 000 2zm0 3a1 1 0 100-2 1 1 0 000 2zm5-3a1 1 0 100-2 1 1 0 000 2zm0 3a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd" />
                        </svg>
                        <span class="flex items-center">
                            <span class="mr-1">Kategori:</span>
                            <span class="px-2 py-0.5 text-xs rounded-full {{ $activity->kategori_kegiatan === 'internal' ? 'bg-green-100 text-green-800' : 'bg-blue-100 text-blue-800' }}">
                                {{ $activity->kategori_kegiatan === 'internal' ? 'Internal' : 'Eksternal' }}
                            </span>
                        </span>
                    </div>
                    
                    <button 
                        @click="selectedActivity = JSON.parse('{{ $activity->toJson() }}'); showModal = true" 
                        class="card-button">
                        Lihat Detail
                    </button>
                </div>
            </div>
            @endforeach
        </div>
        @endif
    </main>

    <!-- Modal -->
    <div x-show="showModal" 
         class="modal" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0">
        <div class="modal-content"
             x-show="showModal"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 transform scale-95"
             x-transition:enter-end="opacity-100 transform scale-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 transform scale-100"
             x-transition:leave-end="opacity-0 transform scale-95">
            
            <div class="modal-header">
                <h3 class="modal-title" x-text="selectedActivity?.title"></h3>
                <button @click="showModal = false" class="modal-close">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </button>
            </div>
            
            <div class="modal-body">
                <div class="modal-section">
                    <div class="section-title">Rektor</div>
                    <div class="section-content">
                        <div class="overflow-hidden text-ellipsis" x-text="selectedActivity?.official.name"></div>
                        <div class="overflow-hidden text-ellipsis" x-text="selectedActivity?.official.position"></div>
                    </div>
                </div>
                
                <div class="modal-section">
                    <div class="section-title">Waktu & Lokasi</div>
                    <div class="section-content">
                        <div class="info-item">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 card-icon flex-shrink-0" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" />
                            </svg>
                            <span class="break-words overflow-hidden text-ellipsis" x-text="new Date(selectedActivity?.date).toLocaleDateString('id-ID', { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' })"></span>
                        </div>
                        <div class="info-item">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 card-icon flex-shrink-0" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd" />
                            </svg>
                            <span class="break-words" x-text="selectedActivity?.formatted_time"></span>
                        </div>
                        <div class="info-item">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 card-icon flex-shrink-0" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                            </svg>
                            <span class="break-words" x-text="selectedActivity?.location"></span>
                        </div>
                        <div class="info-item">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 card-icon flex-shrink-0" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5 4v3H4a2 2 0 00-2 2v3a2 2 0 002 2h1v2a2 2 0 002 2h6a2 2 0 002-2v-2h1a2 2 0 002-2V9a2 2 0 00-2-2h-1V4a2 2 0 00-2-2H7a2 2 0 00-2 2zm8 0v3H7V4h6zm-5 7a1 1 0 100-2 1 1 0 000 2zm0 3a1 1 0 100-2 1 1 0 000 2zm5-3a1 1 0 100-2 1 1 0 000 2zm0 3a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd" />
                            </svg>
                            <span class="flex items-center">
                                <span class="mr-1">Kategori:</span>
                                <span class="px-2 py-0.5 text-xs rounded-full" 
                                    :class="selectedActivity?.kategori_kegiatan === 'internal' ? 'bg-green-100 text-green-800' : 'bg-blue-100 text-blue-800'">
                                    <span x-text="selectedActivity?.kategori_kegiatan === 'internal' ? 'Internal' : 'Eksternal'"></span>
                                </span>
                            </span>
                        </div>
                    </div>
                </div>
                
                <div class="modal-section">
                    <div class="section-title">Deskripsi Kegiatan</div>
                    <div class="section-content whitespace-pre-line break-words" x-text="selectedActivity?.description || 'Tidak ada deskripsi'"></div>
                </div>
                
                <!-- Tambahkan bagian untuk surat tugas -->
                <div class="modal-section" x-show="selectedActivity?.assignment_letter">
                    <div class="section-title">Surat Tugas</div>
                    <div class="section-content">
                        <a :href="'/activities/' + selectedActivity?.id + '/download-assignment-letter'" 
                            class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            <svg class="h-4 w-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            Download Surat Tugas
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function updateTime() {
            const now = new Date();
            const options = { 
                weekday: 'long', 
                year: 'numeric', 
                month: 'long', 
                day: 'numeric',
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit'
            };
            document.getElementById('current-time').textContent = now.toLocaleDateString('id-ID', options);
        }

        updateTime();
        setInterval(updateTime, 1000);

        function filterByPosition(position) {
            const currentUrl = new URL(window.location);
            currentUrl.searchParams.set('position', position);
            if (!currentUrl.searchParams.has('category')) {
                currentUrl.searchParams.set('category', 'today');
            }
            window.location.href = currentUrl.toString();
        }

        function filterByCategory(category) {
            const currentUrl = new URL(window.location);
            currentUrl.searchParams.set('category', category);
            window.location.href = currentUrl.toString();
        }
    </script>
</body>
</html> 
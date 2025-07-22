<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="refresh" content="300"> <!-- Auto refresh every 5 minutes -->
    <title>Jadwal Kegiatan Rektor - Display</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
    <style>
        :root {
            --bg-color: #111827;
            --header-bg: linear-gradient(to right, #1e40af, #2563eb);
            --text-color: #e5e7eb;
            --text-muted: #9ca3af;
            --row-hover: rgba(55, 65, 81, 0.7);
            --ongoing-color: #10b981;
            --upcoming-color: #3b82f6;
            --completed-color: #ef4444;
            --internal-color: #8b5cf6;
            --external-color: #f59e0b;
            --border-color: rgba(75, 85, 99, 0.4);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html, body {
            font-family: 'Figtree', sans-serif;
            height: 100vh;
            width: 100vw;
            overflow: hidden;
            background-color: var(--bg-color);
            color: var(--text-color);
        }

        .display-container {
            display: flex;
            flex-direction: column;
            height: 100%;
            width: 100%;
        }

        .header {
            background: var(--header-bg);
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 1.5rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 
                        0 2px 4px -1px rgba(0, 0, 0, 0.06);
            position: relative;
            z-index: 20;
        }

        .header-left {
            display: flex;
            align-items: center;
        }

        .logo {
            height: 2.75rem;
            margin-right: 1.25rem;
            filter: drop-shadow(0 1px 2px rgba(0, 0, 0, 0.1));
        }

        .header-title {
            display: flex;
            flex-direction: column;
        }

        .header-title h1 {
            font-size: 1.5rem;
            font-weight: 700;
            margin: 0;
            letter-spacing: -0.5px;
            color: white;
        }

        .header-title .subtitle {
            font-size: 0.875rem;
            color: rgba(255, 255, 255, 0.8);
            font-weight: 500;
        }

        .header-right {
            display: flex;
            align-items: center;
            background-color: rgba(0, 0, 0, 0.2);
            padding: 0.75rem 1.25rem;
            border-radius: 0.5rem;
        }

        .current-time {
            font-size: 1.25rem;
            font-weight: 700;
            text-align: right;
            color: white;
            font-variant-numeric: tabular-nums;
        }

        .date {
            font-size: 0.875rem;
            color: rgba(255, 255, 255, 0.8);
            text-align: right;
            font-weight: 500;
        }

        .status-bar {
            display: flex;
            padding: 0.75rem 1.5rem;
            background-color: #1f2937;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid var(--border-color);
        }

        .page-title {
            font-size: 1rem;
            font-weight: 600;
            color: var(--text-color);
            display: flex;
            align-items: center;
        }

        .page-title i {
            margin-right: 0.5rem;
            font-size: 1.125rem;
            color: #60a5fa;
        }

        .status-legend {
            display: flex;
            gap: 1.25rem;
            align-items: center;
        }

        .legend-item {
            display: flex;
            align-items: center;
            gap: 0.375rem;
            font-size: 0.75rem;
            font-weight: 500;
            color: var(--text-muted);
        }

        .legend-dot {
            width: 0.625rem;
            height: 0.625rem;
            border-radius: 50%;
            position: relative;
        }

        .legend-dot::after {
            content: '';
            position: absolute;
            top: -2px;
            left: -2px;
            right: -2px;
            bottom: -2px;
            border-radius: 50%;
            background: inherit;
            opacity: 0.2;
        }

        .dot-ongoing {
            background-color: var(--ongoing-color);
        }

        .dot-upcoming {
            background-color: var(--upcoming-color);
        }

        .dot-completed {
            background-color: var(--completed-color);
        }

        .dot-internal {
            background-color: var(--internal-color);
        }

        .dot-external {
            background-color: var(--external-color);
        }

        .activity-table-container {
            flex-grow: 1;
            overflow-y: auto;
            position: relative;
            scrollbar-width: thin;
            scrollbar-color: rgba(255, 255, 255, 0.2) transparent;
            background-color: #1a202c;
        }

        .activity-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            white-space: nowrap;
            table-layout: fixed;
        }

        .activity-table thead th {
            background-color: #2d3748;
            color: var(--text-muted);
            padding: 0.85rem 1rem;
            text-align: left;
            font-size: 0.9rem;
            position: sticky;
            top: 0;
            z-index: 10;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            font-weight: 600;
            border-bottom: 1px solid #4b5563;
        }

        .activity-table tbody tr {
            height: 4rem;
            border-bottom: 1px solid rgba(75, 85, 99, 0.3);
            transition: all 0.2s ease-in-out;
        }

        .activity-table tbody tr:hover {
            background-color: var(--row-hover);
            transform: translateY(-1px);
        }

        .activity-table td {
            padding: 0.75rem 1rem;
            font-size: 1rem;
            vertical-align: middle;
            border-bottom: 1px solid var(--border-color);
            color: var(--text-color);
        }

        .col-date, .col-time {
            font-variant-numeric: tabular-nums;
            font-weight: 500;
        }

        .col-title {
            font-weight: 500;
        }

        .col-officials, .col-location {
            color: var(--text-muted);
            font-size: 0.8125rem;
        }

        .activity-table .status {
            position: relative;
            padding-left: 1.5rem;
            font-weight: 600;
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }
        
        .activity-table .status::before {
            content: '';
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
            width: 0.625rem;
            height: 0.625rem;
            border-radius: 50%;
        }

        .status-ongoing {
            color: var(--ongoing-color);
        }

        .status-ongoing::before {
            background-color: var(--ongoing-color);
            box-shadow: 0 0 10px 1px var(--ongoing-color);
        }

        .status-upcoming {
            color: var(--upcoming-color);
        }

        .status-upcoming::before {
            background-color: var(--upcoming-color);
            box-shadow: 0 0 10px 1px var(--upcoming-color);
        }

        .status-completed {
            color: var(--completed-color);
        }

        .status-completed::before {
            background-color: var(--completed-color);
            box-shadow: 0 0 10px 1px var(--completed-color);
        }

        .category {
            text-transform: uppercase;
            font-size: 0.6875rem;
            border-radius: 0.25rem;
            padding: 0.25rem 0.5rem;
            display: inline-block;
            text-align: center;
            width: 100%;
            max-width: 90px;
            letter-spacing: 0.05em;
            font-weight: 600;
        }

        .category-internal {
            background-color: rgba(139, 92, 246, 0.15);
            color: white;
            border: 1px solid rgba(139, 92, 246, 0.25);
        }

        .category-external {
            background-color: rgba(245, 158, 11, 0.15);
            color: white;
            border: 1px solid rgba(245, 158, 11, 0.25);
        }

        .marquee {
            background-color: #0f172a;
            padding: 0.65rem 0;
            overflow: hidden;
            position: relative;
            border-top: 1px solid var(--border-color);
            box-shadow: 0 -1px 3px rgba(0, 0, 0, 0.1);
        }

        .marquee-content {
            display: flex;
            animation: marquee 60s linear infinite;
            white-space: nowrap;
        }

        .marquee-item {
            flex-shrink: 0;
            padding: 0 2rem;
            font-size: 0.875rem;
            color: white;
            position: relative;
        }

        .marquee-item:not(:last-child)::after {
            content: "•";
            position: absolute;
            right: 0.75rem;
            color: #4b5563;
        }

        @keyframes marquee {
            0% { transform: translateX(0); }
            100% { transform: translateX(-100%); }
        }

        /* Width adjustments for table columns */
        .col-date { width: 10%; }
        .col-time { width: 8%; }
        .col-title { width: 29%; }
        .col-officials { width: 16%; }
        .col-location { width: 17%; }
        .col-status { width: 12%; }
        .col-category { width: 8%; }

        /* Improve text overflow handling */
        .activity-table th,
        .activity-table td {
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        @media (max-width: 1200px) {
            .header-title h1 {
                font-size: 1.25rem;
            }
            .current-time {
                font-size: 1.125rem;
            }
            .activity-table td {
                font-size: 0.875rem;
            }
        }

        @media (max-width: 900px) {
            .activity-table .col-title {
                width: 35%;
            }
            .activity-table .col-officials {
                width: 18%;
            }
            .status-legend {
                display: none;
            }
        }

        /* Animation for row updates */
        @keyframes highlight {
            0% { background-color: rgba(59, 130, 246, 0.15); }
            100% { background-color: transparent; }
        }

        .highlight {
            animation: highlight 2s;
        }

        /* Completed activity row styling */
        .completed-activity {
            background-color: rgba(239, 68, 68, 0.08); /* Light red background with low opacity */
        }

        /* Make sure the completed activity style gets applied by making it more specific */
        .activity-table tbody tr.completed-activity {
            background-color: rgba(239, 68, 68, 0.15); /* Slightly darker red background */
        }
        
        /* Override hover effect for completed activities */
        .activity-table tbody tr.completed-activity:hover {
            background-color: rgba(239, 68, 68, 0.2); /* Darker red on hover */
        }

        /* Empty state */
        .empty-state {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100%;
            color: var(--text-muted);
            text-align: center;
            padding: 2rem;
        }
        
        .empty-state i {
            font-size: 3rem;
            margin-bottom: 1rem;
            color: #4b5563;
        }
        
        .empty-state p:first-of-type {
            font-size: 1.25rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }
        
        .empty-state p:last-of-type {
            font-size: 0.875rem;
        }

        .activity-table-container::-webkit-scrollbar {
            width: 6px;
        }
        
        .activity-table-container::-webkit-scrollbar-track {
            background: transparent;
        }
        
        .activity-table-container::-webkit-scrollbar-thumb {
            background-color: rgba(255, 255, 255, 0.2);
            border-radius: 3px;
        }
        
        .empty-row {
            text-align: center;
            padding: 2rem !important;
            color: var(--text-muted);
        }

        /* Remove all debug mode styles */
        .debug-mode .debug-info-row,
        .debug-info-row,
        .debug-toggle,
        .debug-info-cell,
        .countdown-debug {
            display: none !important;
        }
    </style>
</head>
<body>
    <div class="display-container">
        <!-- Header with logo and title -->
        <header class="header">
            <div class="header-left">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="logo">
                <div class="header-title">
                    <h1>JADWAL KEGIATAN REKTOR</h1>
                    <div class="subtitle">UNIVERSITAS SANGGA BUANA</div>
                </div>
            </div>
            <div class="header-right">
                <div>
                    <div class="current-time" id="current-time">00:00:00</div>
                    <div class="date" id="current-date">Day, DD Month YYYY</div>
                </div>
            </div>
        </header>

        <!-- Status legend bar -->
        <div class="status-bar">
            <div class="page-title">
                <i class="ri-calendar-event-fill"></i>
                <span>Informasi Jadwal Kegiatan</span>
            </div>
            <div class="status-legend">
                <div class="legend-item">
                    <div class="legend-dot dot-ongoing"></div>
                    <span>BERLANGSUNG</span>
                </div>
                <div class="legend-item">
                    <div class="legend-dot dot-upcoming"></div>
                    <span>AKAN DATANG</span>
                </div>
                <div class="legend-item">
                    <div class="legend-dot dot-completed"></div>
                    <span>SELESAI</span>
                </div>
                <div class="legend-item">
                    <div class="legend-dot dot-internal"></div>
                    <span>INTERNAL</span>
                </div>
                <div class="legend-item">
                    <div class="legend-dot dot-external"></div>
                    <span>EKSTERNAL</span>
                </div>
            </div>
        </div>

        <!-- Main activity table -->
        <div class="activity-table-container">
            @php
                // Initialize filtered activities collection
                $filteredActivities = collect();
            @endphp
            
            @if($activities->isEmpty())
                <div class="empty-state">
                    <i class="ri-calendar-event-line"></i>
                    <p>TIDAK ADA JADWAL KEGIATAN YANG DITAMPILKAN</p>
                    <p>Silakan cek kembali nanti</p>
                </div>
            @else
                <table class="activity-table">
                    <thead>
                        <tr>
                            <th class="col-date">TANGGAL</th>
                            <th class="col-time">WAKTU</th>
                            <th class="col-title">KEGIATAN</th>
                            <th class="col-officials">PEJABAT</th>
                            <th class="col-location">LOKASI</th>
                            <th class="col-status">STATUS</th>
                            <th class="col-category">KATEGORI</th>
                        </tr>
                    </thead>
                    <tbody id="activity-table-body">
                        @foreach($activities as $activity)
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
                                    
                                    // Force endTime to be after startTime
                                    if ($endTime->lte($startTime)) {
                                        $endTime = (clone $startTime)->addHour();
                                    }
                                    
                                    // Debug times
                                    error_log("Activity {$activity->id}: '{$activity->title}' - Date: {$activity->date}, TimeStr: {$timeStr}");
                                    error_log("Parsed times - StartTime: {$startTime}, EndTime: {$endTime}, Now: {$now}");
                                    
                                    // Determine status
                                    $status = '';
                                    $statusClass = '';
                                    $countdownText = '';
                                    
                                    // Simple comparisons for status
                                    if ($now->lt($startTime)) {
                                        // Activity is in the future
                                        $status = 'AKAN DATANG';
                                        $statusClass = 'status-upcoming';
                                        
                                        // Calculate minutes until start
                                        $diffMinutes = $now->diffInMinutes($startTime, false);
                                        
                                        if ($diffMinutes < 60) {
                                            $countdownText = "({$diffMinutes} Menit Lagi)";
                                        } elseif ($diffMinutes < 24 * 60) {
                                            $hours = floor($diffMinutes / 60);
                                            $mins = $diffMinutes % 60;
                                            $countdownText = "({$hours} Jam {$mins} Menit)";
                                        } else {
                                            $days = floor($diffMinutes / (24 * 60));
                                            $hours = floor(($diffMinutes % (24 * 60)) / 60);
                                            $countdownText = "({$days} Hari {$hours} Jam)";
                                        }
                                        
                                        $filteredActivities->push($activity);
                                    } elseif ($now->between($startTime, $endTime)) {
                                        // Activity is currently happening
                                        $status = 'BERLANGSUNG';
                                        $statusClass = 'status-ongoing';
                                        
                                        // Calculate how long the activity has been ongoing
                                        $minutesSinceStart = $now->diffInMinutes($startTime);
                                        $countdownText = "({$minutesSinceStart} Menit Berlalu)";
                                        
                                        $filteredActivities->push($activity);
                                    } else {
                                        // Activity has ended - now check how long ago
                                        // Activity has ended (now > endTime) - activity is in the past
                                        $status = 'SELESAI';
                                        $hoursSinceEnd = $now->diffInHours($endTime);
                                        
                                        // Ensure hoursSinceEnd is calculated correctly
                                        if ($now->gt($endTime)) {
                                            error_log("Activity {$activity->id} has ended. Hours since end: {$hoursSinceEnd}");
                                        
                                            if ($hoursSinceEnd >= 1) {
                                                // More than 1 hour ago - add red highlighting
                                                $statusClass = 'status-completed';
                                                $rowClass .= ' completed-activity';
                                                error_log("COMPLETED: Adding class 'completed-activity' to activity {$activity->id}. Final rowClass: '{$rowClass}'");
                                            } else {
                                                // Less than 1 hour ago
                                                $statusClass = 'status-ongoing';
                                                error_log("RECENTLY ENDED: Not adding class to activity {$activity->id}");
                                            }
                                        } else {
                                            // This shouldn't happen, but handle it just in case
                                            $statusClass = 'status-ongoing';
                                            error_log("UNEXPECTED: Activity {$activity->id} endTime is in the future but wasn't caught by earlier conditions");
                                        }
                                        
                                        // Calculate how long ago the activity ended
                                        $minutesSinceEnd = $now->diffInMinutes($endTime);
                                        $countdownText = "({$minutesSinceEnd} Menit Berlalu)";
                                        
                                        $filteredActivities->push($activity);
                                    }
                                    
                                    // Determine category
                                    $categoryClass = $activity->kategori_kegiatan === 'internal' 
                                        ? 'category-internal' 
                                        : 'category-external';
                                    $categoryText = $activity->kategori_kegiatan === 'internal' 
                                        ? 'INTERNAL' 
                                        : 'EKSTERNAL';
                                    
                                    $dateFormatted = $activityDate->format('d/m/Y');
                                    
                                    // Highlight today's activities
                                    $rowClass = $activityDate->isToday() ? 'highlight' : '';
                                } catch (\Exception $e) {
                                    // Handle any unexpected errors
                                    $statusClass = 'status-upcoming';
                                    $status = 'AKAN DATANG';
                                    $categoryClass = 'category-internal';
                                    $categoryText = 'INTERNAL';
                                    $dateFormatted = $activity->date ? \Carbon\Carbon::parse($activity->date)->format('d/m/Y') : 'N/A';
                                    $rowClass = '';
                                    $countdownText = '';
                                    $filteredActivities->push($activity);
                                }
                            @endphp
                            @php
                                $inlineStyle = '';
                                if (strpos($rowClass, 'completed-activity') !== false) {
                                    $inlineStyle = 'background-color: rgba(239, 68, 68, 0.15) !important;';
                                }
                            @endphp
                            <tr class="{{ $rowClass }}" style="{{ $inlineStyle }}">
                                <td class="col-date">{{ $dateFormatted }}</td>
                                <td class="col-time">{{ $activity->formatted_time }}</td>
                                <td class="col-title">{{ $activity->title }} @if(strpos($rowClass, 'completed-activity') !== false)<span style="color: #ef4444; font-size: 0.7rem; margin-left: 5px;">[Completed]</span>@endif</td>
                                <td class="col-officials">
                                    @if($activity->officials && $activity->officials->count() > 0)
                                        @if($activity->officials->count() <= 2)
                                            {{ $activity->officials->pluck('position')->join(', ') }}
                                        @else
                                            {{ $activity->officials->take(2)->pluck('position')->join(', ') }} +{{ $activity->officials->count() - 2 }} lainnya
                                        @endif
                                    @else
                                        {{ $activity->official->position ?? 'N/A' }}
                                    @endif
                                </td>
                                <td class="col-location">{{ $activity->location }}</td>
                                <td class="col-status status {{ $statusClass }}">{{ $status }}</td>
                                <td class="col-category">
                                    <span class="category {{ $categoryClass }}">{{ $categoryText }}</span>
                                </td>
                            </tr>
                        @endforeach
                        
                        @if($filteredActivities->isEmpty())
                            <tr>
                                <td colspan="7" class="empty-row">TIDAK ADA JADWAL KEGIATAN UNTUK HARI INI</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            @endif
        </div>

        <!-- Marquee footer -->
        <div class="marquee">
            <div class="marquee-content">
                @if($filteredActivities->isNotEmpty())
                    @foreach($filteredActivities->take(10) as $activity)
                        <div class="marquee-item">
                            {{ \Carbon\Carbon::parse($activity->date)->format('d/m/Y') }} | 
                            @if($activity->officials && $activity->officials->count() > 0)
                                @if($activity->officials->count() <= 2)
                                    {{ $activity->officials->pluck('position')->join(', ') }}
                                @else
                                    {{ $activity->officials->take(2)->pluck('position')->join(', ') }} +{{ $activity->officials->count() - 2 }} lainnya
                                @endif
                            @else
                                {{ $activity->official->position ?? 'N/A' }}
                            @endif
                            : {{ $activity->title }} - {{ $activity->formatted_time }} @ {{ $activity->location }}
                        </div>
                    @endforeach
                    <!-- Duplicate for continuous scroll -->
                    @foreach($filteredActivities->take(10) as $activity)
                        <div class="marquee-item">
                            {{ \Carbon\Carbon::parse($activity->date)->format('d/m/Y') }} | 
                            @if($activity->officials && $activity->officials->count() > 0)
                                @if($activity->officials->count() <= 2)
                                    {{ $activity->officials->pluck('position')->join(', ') }}
                                @else
                                    {{ $activity->officials->take(2)->pluck('position')->join(', ') }} +{{ $activity->officials->count() - 2 }} lainnya
                                @endif
                            @else
                                {{ $activity->official->position ?? 'N/A' }}
                            @endif
                            : {{ $activity->title }} - {{ $activity->formatted_time }} @ {{ $activity->location }}
                        </div>
                    @endforeach
                @else
                    <div class="marquee-item">
                        Tidak ada jadwal kegiatan untuk hari ini
                    </div>
                    <div class="marquee-item">
                        Tidak ada jadwal kegiatan untuk hari ini
                    </div>
                @endif
            </div>
        </div>
    </div>

    <script>
        // Update time function
        function updateTime() {
            const now = new Date();
            
            // Format time as HH:MM:SS
            const hours = String(now.getHours()).padStart(2, '0');
            const minutes = String(now.getMinutes()).padStart(2, '0');
            const seconds = String(now.getSeconds()).padStart(2, '0');
            document.getElementById('current-time').textContent = `${hours}:${minutes}:${seconds}`;
            
            // Format date
            const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
            document.getElementById('current-date').textContent = now.toLocaleDateString('id-ID', options);
        }

        // Auto-scroll function for table if content overflows
        function setupTableScroll() {
            const container = document.querySelector('.activity-table-container');
            const table = document.querySelector('.activity-table');
            
            if (container && table && container.scrollHeight > container.clientHeight) {
                let scrollPosition = 0;
                const scrollSpeed = 0.5; // pixels per frame
                const pauseAtEnds = 3000; // 3 seconds pause at top and bottom
                let isPaused = true;
                let pauseTimer = null;
                
                function scroll() {
                    if (!isPaused) {
                        scrollPosition += scrollSpeed;
                        if (scrollPosition >= (container.scrollHeight - container.clientHeight)) {
                            isPaused = true;
                            pauseTimer = setTimeout(() => {
                                scrollPosition = 0;
                                container.scrollTop = 0;
                                setTimeout(() => {
                                    isPaused = false;
                                }, pauseAtEnds);
                            }, pauseAtEnds);
                        }
                        container.scrollTop = scrollPosition;
                    }
                    requestAnimationFrame(scroll);
                }
                
                // Start with a pause at the top
                setTimeout(() => {
                    isPaused = false;
                    requestAnimationFrame(scroll);
                }, pauseAtEnds);
            }
        }

        // Update time initially and set interval
        updateTime();
        setInterval(updateTime, 1000);
        
        // Setup table scrolling after page load
        document.addEventListener('DOMContentLoaded', setupTableScroll);
        
        // Auto refresh the page every 5 minutes
        setTimeout(function() {
            window.location.reload();
        }, 300000);
    </script>
</body>
</html>
<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Decree;
use App\Models\Official;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function dashboard()
    {
        $today = Carbon::today();
        $now = Carbon::now();
        
        // Today's activities
        $todayActivities = Activity::whereDate('date', $today)->get();
        
        // Today activities count
        $todayActivitiesCount = $todayActivities->count();
        
        // Ongoing activities (activities happening today)
        $ongoingActivities = Activity::with('official')
            ->whereDate('date', $today)
            ->orderBy('time')
            ->take(5)
            ->get();
        
        // Upcoming activities (future activities)
        $upcomingActivities = Activity::with('official')
            ->whereDate('date', '>', $today)
            ->orderBy('date')
            ->orderBy('time')
            ->take(5)
            ->get();
        
        // Recent activities (recently added)
        $recentActivities = Activity::with('official')
            ->latest('created_at')
            ->take(5)
            ->get();
        
        // Count SK Rektorat
        $totalSkRektorat = Decree::where('jenis_sk', 'SK Rektorat')->count();
        
        // Count SK Yayasan
        $totalSkYayasan = Decree::where('jenis_sk', 'SK Yayasan')->count();
        
        $stats = [
            'total_activities' => Activity::count(),
            'total_officials' => Official::count(),
            'total_users' => User::count(),
            'today_activities_count' => $todayActivitiesCount,
            'recent_activities' => $recentActivities,
            'ongoing_activities' => $ongoingActivities,
            'upcoming_activities' => $upcomingActivities,
            'total_sk_rektorat' => $totalSkRektorat,
            'total_sk_yayasan' => $totalSkYayasan
        ];

        return view('admin.dashboard', compact('stats'));
    }

    public function activities()
    {
        $activities = Activity::with('official')->latest()->paginate(10);
        return view('admin.activities.index', compact('activities'));
    }

    public function officials()
    {
        $officials = Official::latest()->paginate(10);
        return view('admin.officials.index', compact('officials'));
    }

    /**
     * Display the users page.
     */
    public function users()
    {
        if (!auth()->user()->isSuperAdmin()) {
            return redirect()->route('admin.dashboard')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
        }
        
        $users = User::latest()->paginate(10);
        return view('admin.users.index', compact('users'));
    }
    
    public function createActivity()
    {
        $officials = Official::all();
        return view('admin.activities.create', compact('officials'));
    }
    
    public function editActivity(Activity $activity)
    {
        $officials = Official::all();
        return view('admin.activities.edit', compact('activity', 'officials'));
    }
    
    public function documentation()
    {
        return view('admin.documentation.index');
    }
    
    /**
     * Get calendar events for the FullCalendar component
     */
    public function getCalendarEvents()
    {
        $activities = Activity::with('official')->get();
        
        $events = $activities->map(function ($activity) {
            return [
                'title' => $activity->title,
                'start' => $activity->date->format('Y-m-d') . ' ' . $activity->time,
                'url' => route('activities.show', $activity),
                'backgroundColor' => $this->getColorByPosition($activity->official->position),
            ];
        });

        return response()->json($events);
    }

    /**
     * Get color for calendar event based on official position
     */
    private function getColorByPosition($position)
    {
        return match($position) {
            'Rektor' => '#FF0000',
            'WR1' => '#00FF00',
            'WR2' => '#0000FF',
            'WR3' => '#FF00FF',
            default => '#808080',
        };
    }
} 
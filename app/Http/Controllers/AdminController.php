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
        $ongoingActivities = Activity::with(['official', 'creator'])
            ->whereDate('date', $today)
            ->orderBy('time')
            ->take(5)
            ->get();
        
        // Upcoming activities (future activities)
        $upcomingActivities = Activity::with(['official', 'creator'])
            ->whereDate('date', '>', $today)
            ->orderBy('date')
            ->orderBy('time')
            ->take(5)
            ->get();
        
        // Recent activities (recently added)
        $recentActivities = Activity::with(['official', 'creator'])
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

    public function activities(Request $request)
    {
        $query = Activity::with(['official', 'creator']);
        
        // Filter berdasarkan pejabat jika ada
        if ($request->has('official_id') && $request->official_id) {
            $query->where('official_id', $request->official_id);
        }
        
        // Filter berdasarkan tanggal jika ada
        if ($request->has('date') && $request->date) {
            $query->whereDate('date', $request->date);
        }
        
        $activities = $query->latest()->paginate(10)->withQueryString();
        
        // Ambil semua pejabat untuk dropdown filter
        $officials = Official::orderBy('name')->get();
        
        return view('admin.activities.index', compact('activities', 'officials', 'request'));
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
} 
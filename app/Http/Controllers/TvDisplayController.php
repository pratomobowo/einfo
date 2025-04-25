<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Official;
use Illuminate\Http\Request;
use Carbon\Carbon;

class TvDisplayController extends Controller
{
    public function index(Request $request)
    {
        $position = $request->get('position');
        $category = $request->get('category', 'today'); // today, upcoming, past
        $route = $request->route()->getName();

        $query = Activity::with('official');

        // For TV display, we'll show activities differently 
        if ($route === 'tv.index') {
            // For TV display, show today's and upcoming activities, ordered by date
            $query = Activity::with('official')
                ->whereDate('date', '>=', Carbon::today())
                ->orderBy('date')
                ->orderBy('time')
                ->limit(50); // Limit to avoid performance issues
        } else {
            // For homepage, apply filters as normal
            // Filter by position if selected
            if ($position) {
                $query->whereHas('official', function($q) use ($position) {
                    $q->where('position', $position);
                });
            }

            // Filter by category
            switch ($category) {
                case 'today':
                    $query->whereDate('date', Carbon::today());
                    break;
                case 'upcoming':
                    $query->whereDate('date', '>', Carbon::today());
                    break;
                case 'past':
                    $query->whereDate('date', '<', Carbon::today());
                    break;
            }
        }

        $activities = $query->get();
                          
        // Tambahkan formatted_time ke setiap activity untuk digunakan di JSON
        $activities->each(function ($activity) {
            $activity->setAttribute('formatted_time', $activity->formatted_time);
        });

        $officials = Official::all();

        // Get counts for each category
        $counts = [
            'today' => $this->getActivityCount($position, 'today'),
            'upcoming' => $this->getActivityCount($position, 'upcoming'),
            'past' => $this->getActivityCount($position, 'past')
        ];

        // Use different view for TV display route
        if ($route === 'tv.index') {
            return view('tv.display', compact('activities', 'officials', 'position', 'category', 'counts'));
        }
        
        // Default view for homepage
        return view('tv.index', compact('activities', 'officials', 'position', 'category', 'counts'));
    }

    private function getActivityCount($position, $category)
    {
        $query = Activity::query();

        if ($position) {
            $query->whereHas('official', function($q) use ($position) {
                $q->where('position', $position);
            });
        }

        switch ($category) {
            case 'today':
                $query->whereDate('date', Carbon::today());
                break;
            case 'upcoming':
                $query->whereDate('date', '>', Carbon::today());
                break;
            case 'past':
                $query->whereDate('date', '<', Carbon::today());
                break;
        }

        return $query->count();
    }
} 
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

        $query = Activity::with('official');

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

        $activities = $query->orderBy('date')
                          ->orderBy('time')
                          ->get();
                          
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
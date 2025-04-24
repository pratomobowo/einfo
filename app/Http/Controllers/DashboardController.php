<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $activities = Activity::with('official')->get();
        return view('dashboard', compact('activities'));
    }

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

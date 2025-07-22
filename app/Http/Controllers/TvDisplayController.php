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

        $query = Activity::with(['official', 'officials', 'creator']);

        // For TV display, we'll show activities differently 
        if ($route === 'tv.index') {
            // For TV display, show today's activities (including past ones)
            // Get all activities for today
            $query = Activity::with(['official', 'officials', 'creator'])
                ->whereDate('date', Carbon::today());
                
            // We'll sort the collection later, after parsing the times
            $activities = $query->get();
            
            // Parse the time for each activity and add sortable DateTime
            $activities->each(function ($activity) {
                $activity->setAttribute('formatted_time', $activity->formatted_time);
                $timeStr = $activity->formatted_time;
                
                // Default start time
                $startTime = null;
                
                // Try to parse the start time from the formatted time string
                if (is_string($timeStr) && strpos($timeStr, '-') !== false) {
                    $timeParts = explode('-', $timeStr);
                    $startTimeStr = trim($timeParts[0]);
                    
                    try {
                        $startTime = Carbon::parse($activity->date . ' ' . $startTimeStr);
                        $activity->setAttribute('parsed_start_time', $startTime);
                    } catch (\Exception $e) {
                        // If parsing fails, use default time
                        $startTime = Carbon::parse($activity->date)->addHours(8); // 8 AM default
                        $activity->setAttribute('parsed_start_time', $startTime);
                    }
                } else {
                    // Single time format or unparseable format
                    try {
                        $startTime = Carbon::parse($activity->date . ' ' . $timeStr);
                        $activity->setAttribute('parsed_start_time', $startTime);
                    } catch (\Exception $e) {
                        // If parsing fails, use default time
                        $startTime = Carbon::parse($activity->date)->addHours(8); // 8 AM default
                        $activity->setAttribute('parsed_start_time', $startTime);
                    }
                }
            });
            
            // Sort activities: ongoing first, then upcoming, then past activities (most recent first)
            $now = Carbon::now();
            $upcoming = $activities->filter(function ($activity) use ($now) {
                return $activity->parsed_start_time->gt($now);
            })->sortBy('parsed_start_time');
            
            $ongoing = $activities->filter(function ($activity) use ($now) {
                $startTime = $activity->parsed_start_time;
                $endTime = (clone $startTime)->addHour(); // Assuming 1 hour duration if not specified
                return $now->between($startTime, $endTime);
            })->sortBy('parsed_start_time');
            
            $past = $activities->filter(function ($activity) use ($now) {
                $startTime = $activity->parsed_start_time;
                $endTime = (clone $startTime)->addHour(); // Assuming 1 hour duration if not specified
                return $now->gt($endTime);
            })->sortByDesc('parsed_start_time'); // Most recent completed activities first
            
            // Combine the collections in the desired order
            $activities = $ongoing->concat($upcoming)->concat($past);
            
            // Limit to 50 activities to avoid performance issues
            $activities = $activities->take(50);
        } else {
            // For homepage, apply filters as normal
            // Filter by position if selected
            if ($position) {
                $query->where(function($q) use ($position) {
                    $q->whereHas('official', function($subQ) use ($position) {
                        $subQ->where('position', $position);
                    })->orWhereHas('officials', function($subQ) use ($position) {
                        $subQ->where('position', $position);
                    });
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
            
            $activities = $query->get();
                              
            // Tambahkan formatted_time ke setiap activity untuk digunakan di JSON
            $activities->each(function ($activity) {
                $activity->setAttribute('formatted_time', $activity->formatted_time);
            });
        }

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
            $query->where(function($q) use ($position) {
                $q->whereHas('official', function($subQ) use ($position) {
                    $subQ->where('position', $position);
                })->orWhereHas('officials', function($subQ) use ($position) {
                    $subQ->where('position', $position);
                });
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
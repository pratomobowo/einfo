<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use Illuminate\Http\Request;

class ActivityLogController extends Controller
{
    /**
     * Constructor to add role check
     */
    public function __construct()
    {
        // Laravel 10+ doesn't support middleware registration in Controller constructor
        // Will implement checks in individual methods
    }

    /**
     * Display a listing of activity logs.
     */
    public function index(Request $request)
    {
        // Check if user is a super admin
        if (!auth()->user()->isSuperAdmin()) {
            return redirect()->route('admin.dashboard')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
        }

        $query = ActivityLog::with('user')->latest();

        // Filter by action type if provided
        if ($request->has('action') && $request->action) {
            $query->where('action', $request->action);
        }

        // Filter by model type if provided
        if ($request->has('model_type') && $request->model_type) {
            $query->where('model_type', 'LIKE', '%' . $request->model_type . '%');
        }

        // Filter by user if provided
        if ($request->has('user_id') && $request->user_id) {
            $query->where('user_id', $request->user_id);
        }

        // Filter by date range if provided
        if ($request->has('date_from') && $request->date_from) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }

        if ($request->has('date_to') && $request->date_to) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        $logs = $query->paginate(15);
        
        // Get unique model types for filtering
        $modelTypes = ActivityLog::select('model_type')
            ->distinct()
            ->pluck('model_type')
            ->map(function ($type) {
                return class_basename($type);
            });

        return view('admin.activity-logs.index', compact('logs', 'modelTypes'));
    }

    /**
     * Display the specified activity log.
     */
    public function show(ActivityLog $activityLog)
    {
        // Check if user is a super admin
        if (!auth()->user()->isSuperAdmin()) {
            return redirect()->route('admin.dashboard')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
        }
        
        return view('admin.activity-logs.show', compact('activityLog'));
    }
}

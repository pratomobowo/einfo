<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Official;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DispositionController extends Controller
{
    /**
     * Show form for creating a new disposition
     */
    public function create(Activity $activity)
    {
        // Check if user is authorized to create dispositions
        $this->authorize('create', Activity::class);
        
        // Only pending activities can be disposed
        if (!$activity->isPending()) {
            return redirect()->back()->with('error', 'Hanya kegiatan dengan status pending yang dapat didisposisikan');
        }
        
        // Get all officials for the dropdown
        $officials = Official::orderBy('name')->get();
        
        return view('admin.dispositions.create', compact('activity', 'officials'));
    }
    
    /**
     * Store a newly created disposition
     */
    public function store(Request $request, Activity $activity)
    {
        // Check if user is authorized to create dispositions
        $this->authorize('create', Activity::class);
        
        // Only pending activities can be disposed
        if (!$activity->isPending()) {
            return redirect()->back()->with('error', 'Hanya kegiatan dengan status pending yang dapat didisposisikan');
        }
        
        // Validate the request
        $validated = $request->validate([
            'official_id' => 'required|exists:officials,id',
            'notes' => 'nullable|string|max:255',
        ]);
        
        // Set the original official if not already set
        if (!$activity->original_official_id) {
            $activity->original_official_id = $activity->official_id;
        }
        
        // Update the activity with the new official and disposition status
        $activity->official_id = $validated['official_id'];
        $activity->status = Activity::STATUS_DISPOSED;
        $activity->disposition = $validated['notes'] ?? null;
        $activity->save();
        
        return redirect()->route('admin.activities')->with('success', 'Kegiatan berhasil didisposisikan');
    }
    
    /**
     * Accept a disposition
     */
    public function accept(Activity $activity)
    {
        // Check if the activity is disposed
        if (!$activity->isDisposed()) {
            return redirect()->back()->with('error', 'Hanya kegiatan dengan status disposisi yang dapat diterima');
        }
        
        // Update status to approved
        $activity->status = Activity::STATUS_APPROVED;
        $activity->save();
        
        return redirect()->route('admin.activities')->with('success', 'Disposisi kegiatan berhasil diterima');
    }
    
    /**
     * Reject a disposition
     */
    public function reject(Activity $activity)
    {
        // Check if the activity is disposed
        if (!$activity->isDisposed()) {
            return redirect()->back()->with('error', 'Hanya kegiatan dengan status disposisi yang dapat ditolak');
        }
        
        // If original official exists, restore it
        if ($activity->original_official_id) {
            $activity->official_id = $activity->original_official_id;
            $activity->original_official_id = null;
        }
        
        // Update status to rejected
        $activity->status = Activity::STATUS_REJECTED;
        $activity->disposition = null;
        $activity->save();
        
        return redirect()->route('admin.activities')->with('success', 'Disposisi kegiatan berhasil ditolak');
    }
} 
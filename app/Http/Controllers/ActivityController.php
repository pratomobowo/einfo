<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Official;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Activity::with('official');

        if ($request->has('official_id')) {
            $query->where('official_id', $request->official_id);
        }

        if ($request->has('date')) {
            $query->whereDate('date', $request->date);
        }

        $activities = $query->latest()->paginate(10);
        $officials = Official::all();

        return view('activities.index', compact('activities', 'officials'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!auth()->check() || !auth()->user()->is_admin) {
            return redirect()->route('home')->with('error', 'Unauthorized access.');
        }
        $officials = Official::all();
        return view('activities.create', compact('officials'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (!auth()->check() || !auth()->user()->is_admin) {
            return redirect()->route('home')->with('error', 'Unauthorized access.');
        }
        $validated = $request->validate([
            'official_id' => 'required|exists:officials,id',
            'original_official_id' => 'nullable|exists:officials,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'date' => 'required|date',
            'time' => 'required',
            'location' => 'required|string|max:255',
            'kategori_kegiatan' => 'required|in:internal,eksternal',
            'assignment_letter' => 'nullable|file|mimes:pdf,doc,docx|max:10240',
            'disposition' => 'nullable|string',
        ]);

        // Set default status
        $validated['status'] = 'pending';

        // Handle file upload
        if ($request->hasFile('assignment_letter')) {
            $file = $request->file('assignment_letter');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('assignment_letters', $filename, 'public');
            $validated['assignment_letter'] = $filename;
        }

        Activity::create($validated);

        return redirect()->route('admin.activities')
            ->with('success', 'Kegiatan berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Activity $activity)
    {
        return view('activities.show', compact('activity'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Activity $activity)
    {
        if (!auth()->check() || !auth()->user()->is_admin) {
            return redirect()->route('home')->with('error', 'Unauthorized access.');
        }
        $officials = Official::all();
        return view('activities.edit', compact('activity', 'officials'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Activity $activity)
    {
        if (!auth()->check() || !auth()->user()->is_admin) {
            return redirect()->route('home')->with('error', 'Unauthorized access.');
        }
        
        // Debugging
        \Log::info('Request time value: ' . $request->time);
        \Log::info('Original activity time: ' . $activity->time);
        
        $validated = $request->validate([
            'official_id' => 'required|exists:officials,id',
            'original_official_id' => 'nullable|exists:officials,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'date' => 'required|date',
            'time' => 'required',
            'location' => 'required|string|max:255',
            'kategori_kegiatan' => 'required|in:internal,eksternal',
            'assignment_letter' => 'nullable|file|mimes:pdf,doc,docx|max:10240',
            'disposition' => 'nullable|string',
        ]);
        
        \Log::info('Validated time value: ' . $validated['time']);

        // Handle file upload
        if ($request->hasFile('assignment_letter')) {
            // Delete old file if exists
            if ($activity->assignment_letter) {
                Storage::disk('public')->delete('assignment_letters/' . $activity->assignment_letter);
            }
            
            $file = $request->file('assignment_letter');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('assignment_letters', $filename, 'public');
            $validated['assignment_letter'] = $filename;
        }

        $activity->update($validated);

        return redirect()->route('admin.activities')
            ->with('success', 'Kegiatan berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Activity $activity)
    {
        if (!auth()->check() || !auth()->user()->is_admin) {
            return redirect()->route('home')->with('error', 'Unauthorized access.');
        }
        $activity->delete();

        return redirect()->route('admin.activities')
            ->with('success', 'Kegiatan berhasil dihapus');
    }

    // Menambahkan method untuk download surat tugas
    public function downloadAssignmentLetter(Activity $activity)
    {
        if (!$activity->assignment_letter) {
            return back()->with('error', 'Surat tugas tidak tersedia.');
        }

        $path = storage_path('app/public/assignment_letters/' . $activity->assignment_letter);
        
        if (!file_exists($path)) {
            return back()->with('error', 'File tidak ditemukan.');
        }

        return response()->download($path);
    }

    // Method untuk menghapus file surat tugas
    public function deleteAssignmentFile(Activity $activity)
    {
        if (!auth()->check() || !auth()->user()->is_admin) {
            return redirect()->route('home')->with('error', 'Unauthorized access.');
        }
        
        if ($activity->assignment_letter) {
            // Hapus file dari penyimpanan
            Storage::disk('public')->delete('assignment_letters/' . $activity->assignment_letter);
            
            // Update database
            $activity->update(['assignment_letter' => null]);
            
            return redirect()->back()->with('success', 'File surat tugas berhasil dihapus.');
        }
        
        return redirect()->back()->with('error', 'Tidak ada file surat tugas untuk dihapus.');
    }
}

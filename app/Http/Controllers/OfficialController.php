<?php

namespace App\Http\Controllers;

use App\Models\Official;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class OfficialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize('admin');
        $officials = Official::all();
        return view('admin.officials.index', compact('officials'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('admin');
        return view('admin.officials.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Gate::authorize('admin');
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
        ]);

        Official::create($validated);

        return redirect()->route('admin.officials')
            ->with('success', 'Rektor berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Official $official)
    {
        Gate::authorize('admin');
        return view('admin.officials.show', compact('official'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Official $official)
    {
        Gate::authorize('admin');
        return view('admin.officials.edit', compact('official'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Official $official)
    {
        Gate::authorize('admin');
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
        ]);

        $official->update($validated);

        return redirect()->route('admin.officials')
            ->with('success', 'Data rektor berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Official $official)
    {
        Gate::authorize('admin');
        
        // Check if official has related activities
        if ($official->activities()->exists()) {
            return redirect()->route('admin.officials')
                ->with('error', 'Rektor tidak dapat dihapus karena masih memiliki kegiatan terkait');
        }

        $official->delete();

        return redirect()->route('admin.officials')
            ->with('success', 'Rektor berhasil dihapus');
    }
} 
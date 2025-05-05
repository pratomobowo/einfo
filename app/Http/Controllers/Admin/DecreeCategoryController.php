<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DecreeCategory;
use Illuminate\Http\Request;

class DecreeCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('manage-decree-categories');
        
        $categories = DecreeCategory::latest()->paginate(10);
        return view('admin.decree-categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('manage-decree-categories');
        
        return view('admin.decree-categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('manage-decree-categories');
        
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:decree_categories',
            'description' => 'nullable|string',
        ]);

        DecreeCategory::create($validated);

        return redirect()->route('admin.decree-categories.index')
            ->with('success', 'Kategori SK berhasil dibuat.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DecreeCategory $category)
    {
        $this->authorize('manage-decree-categories');
        
        return view('admin.decree-categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DecreeCategory $category)
    {
        $this->authorize('manage-decree-categories');
        
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:decree_categories,name,' . $category->id,
            'description' => 'nullable|string',
        ]);

        $category->update($validated);

        return redirect()->route('admin.decree-categories.index')
            ->with('success', 'Kategori SK berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DecreeCategory $category)
    {
        $this->authorize('manage-decree-categories');
        
        // Check if category is being used
        if ($category->decrees()->count() > 0) {
            return redirect()->route('admin.decree-categories.index')
                ->with('error', 'Kategori tidak dapat dihapus karena sedang digunakan oleh satu atau lebih SK.');
        }
        
        $category->delete();

        return redirect()->route('admin.decree-categories.index')
            ->with('success', 'Kategori SK berhasil dihapus.');
    }
} 
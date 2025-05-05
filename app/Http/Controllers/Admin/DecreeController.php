<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Decree;
use App\Models\DecreeCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class DecreeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Decree::query();
        
        // Filter berdasarkan jenis_sk jika ada
        if ($request->has('jenis_sk') && $request->jenis_sk) {
            $query->where('jenis_sk', $request->jenis_sk);
        }
        
        // Filter berdasarkan kategori jika ada
        if ($request->has('category_id') && $request->category_id) {
            $query->where('category_id', $request->category_id);
        }
        
        $decrees = $query->with('category')->latest()->paginate(10)->withQueryString();
        $jenisOptions = Decree::jenisOptions();
        $categories = DecreeCategory::orderBy('name')->get();
        
        return view('admin.decrees.index', compact('decrees', 'jenisOptions', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $jenisOptions = Decree::jenisOptions();
        $categories = DecreeCategory::orderBy('name')->get();
        return view('admin.decrees.create', compact('jenisOptions', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nomor_sk' => 'required|string|max:255',
            'jenis_sk' => ['required', Rule::in(array_keys(Decree::jenisOptions()))],
            'category_id' => 'nullable|exists:decree_categories,id',
            'tentang' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'file_sk' => 'required|file|mimes:pdf|max:10240',
            'tanggal_terbit' => 'required|date',
            'tanggal_berlaku' => 'required|date',
            'ditandatangani_oleh' => 'required|string|max:255',
        ]);

        if ($request->hasFile('file_sk')) {
            $validated['file_sk'] = $request->file('file_sk')->store('sk', 'public');
        }

        Decree::create($validated);

        return redirect()->route('admin.decrees.index')
            ->with('success', 'Data SK berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Decree $decree)
    {
        $decree->load('category');
        return view('admin.decrees.show', compact('decree'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Decree $decree)
    {
        $jenisOptions = Decree::jenisOptions();
        $categories = DecreeCategory::orderBy('name')->get();
        return view('admin.decrees.edit', compact('decree', 'jenisOptions', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Decree $decree)
    {
        // File SK wajib jika belum ada file dan checkbox 'delete_file' tidak dicentang
        $fileSkRule = 'mimes:pdf|max:10240';
        if (!$decree->file_sk || $request->has('delete_file')) {
            $fileSkRule = 'required|' . $fileSkRule;
        }

        $validated = $request->validate([
            'nomor_sk' => 'required|string|max:255',
            'jenis_sk' => ['required', Rule::in(array_keys(Decree::jenisOptions()))],
            'category_id' => 'nullable|exists:decree_categories,id',
            'tentang' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'file_sk' => $fileSkRule,
            'tanggal_terbit' => 'required|date',
            'tanggal_berlaku' => 'required|date',
            'ditandatangani_oleh' => 'required|string|max:255',
        ]);

        // Jika checkbox hapus file dicentang
        if ($request->has('delete_file') && $decree->file_sk) {
            Storage::disk('public')->delete($decree->file_sk);
            $validated['file_sk'] = null;
        }

        if ($request->hasFile('file_sk')) {
            // Hapus file lama jika ada
            if ($decree->file_sk) {
                Storage::disk('public')->delete($decree->file_sk);
            }
            $validated['file_sk'] = $request->file('file_sk')->store('sk', 'public');
        }

        $decree->update($validated);

        return redirect()->route('admin.decrees.index')
            ->with('success', 'Data SK berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Decree $decree)
    {
        // Hapus file jika ada
        if ($decree->file_sk) {
            Storage::disk('public')->delete($decree->file_sk);
        }
        
        $decree->delete();

        return redirect()->route('admin.decrees.index')
            ->with('success', 'Data SK berhasil dihapus.');
    }
}

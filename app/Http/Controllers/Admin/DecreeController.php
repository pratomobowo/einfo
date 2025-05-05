<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Decree;
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
        if ($request->has('jenis_sk')) {
            $query->where('jenis_sk', $request->jenis_sk);
        }
        
        $decrees = $query->latest()->paginate(10)->withQueryString();
        $jenisOptions = Decree::jenisOptions();
        
        return view('admin.decrees.index', compact('decrees', 'jenisOptions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $jenisOptions = Decree::jenisOptions();
        return view('admin.decrees.create', compact('jenisOptions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nomor_sk' => 'required|string|max:255',
            'jenis_sk' => ['required', Rule::in(array_keys(Decree::jenisOptions()))],
            'tentang' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'file_sk' => 'required|file|mimes:pdf,doc,docx|max:10240',
            'tanggal_terbit' => 'required|date',
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
        return view('admin.decrees.show', compact('decree'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Decree $decree)
    {
        $jenisOptions = Decree::jenisOptions();
        return view('admin.decrees.edit', compact('decree', 'jenisOptions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Decree $decree)
    {
        $validated = $request->validate([
            'nomor_sk' => 'required|string|max:255',
            'jenis_sk' => ['required', Rule::in(array_keys(Decree::jenisOptions()))],
            'tentang' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'file_sk' => 'nullable|file|mimes:pdf,doc,docx|max:10240',
            'tanggal_terbit' => 'required|date',
            'ditandatangani_oleh' => 'required|string|max:255',
        ]);

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

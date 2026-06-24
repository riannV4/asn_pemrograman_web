<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Auth::user()->categories()
            ->withCount('transactions')
            ->latest()
            ->get();
        
        return view('categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:50',
            'type' => 'required|in:income,expense',
            'icon' => 'nullable|string|max:50',
            'color' => 'nullable|string|max:7',
        ]);

        $category = Auth::user()->categories()->create($validated);

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Kategori berhasil dibuat.',
                'category' => $category
            ]);
        }

        return redirect()->back()
            ->with('success', 'Kategori berhasil dibuat.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        // Pastikan kategori milik user yang sedang login
        if ($category->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        return view('categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        // Pastikan kategori milik user yang sedang login
        if ($category->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:50',
            'type' => 'required|in:income,expense',
        ]);

        $category->update($validated);

        return redirect()->back()
            ->with('success', 'Kategori berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        // Pastikan kategori milik user yang sedang login
        if ($category->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $category->delete();

        return redirect()->back()
            ->with('success', 'Kategori berhasil dihapus.');
    }
}

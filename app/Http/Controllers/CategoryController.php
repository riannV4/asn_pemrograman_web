<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\StoreCategoryRequest;

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
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        $category = Auth::user()->categories()->create($request->validated());

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
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        Gate::authorize('delete', $category);

        $category->delete();

        return redirect()->back()
            ->with('success', 'Kategori berhasil dihapus.');
    }
}

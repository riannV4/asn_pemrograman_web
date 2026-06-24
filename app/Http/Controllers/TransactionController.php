<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\StoreTransactionRequest;
use App\Http\Requests\UpdateTransactionRequest;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Auth::user()->transactions()->with('category');

        // Filter by search (notes or category name)
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('notes', 'like', "%{$search}%")
                  ->orWhereHas('category', function ($q) use ($search) {
                      $q->where('name', 'like', "%{$search}%");
                  });
            });
        }

        // Filter by category
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->input('category_id'));
        }

        // Filter by type (income/expense)
        if ($request->filled('type')) {
            $query->where('type', $request->input('type'));
        }

        // Filter by date range
        if ($request->filled('start_date')) {
            $query->whereDate('transaction_date', '>=', $request->input('start_date'));
        }
        if ($request->filled('end_date')) {
            $query->whereDate('transaction_date', '<=', $request->input('end_date'));
        }

        $transactions = $query->latest('transaction_date')
            ->latest('created_at')
            ->paginate(15)
            ->withQueryString();

        $categories = Auth::user()->categories()->orderBy('name')->get();

        return view('transactions.index', compact('transactions', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Auth::user()->categories()->orderBy('name')->get();
        
        return view('transactions.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTransactionRequest $request)
    {
        Auth::user()->transactions()->create($request->validated());

        return redirect()->route('transactions.index')
            ->with('success', 'Transaksi berhasil dibuat.');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaction $transaction)
    {
        Gate::authorize('update', $transaction);

        $categories = Auth::user()->categories()->orderBy('name')->get();
        
        return view('transactions.edit', compact('transaction', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTransactionRequest $request, Transaction $transaction)
    {
        Gate::authorize('update', $transaction);

        $transaction->update($request->validated());

        return redirect()->route('transactions.index')
            ->with('success', 'Transaksi berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaction $transaction)
    {
        Gate::authorize('delete', $transaction);

        $transaction->delete();

        return redirect()->route('transactions.index')
            ->with('success', 'Transaksi berhasil dihapus.');
    }
}

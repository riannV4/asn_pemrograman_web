@props(['transaction'])

<div class="flex items-center gap-3 p-3 hover:bg-surface-container rounded-button transition-colors">
    <div class="w-12 h-12 rounded-full flex items-center justify-center {{ $transaction->type === 'income' ? 'bg-success-container text-success' : 'bg-primary-container text-primary' }}">
        <span class="material-symbols-rounded">{{ $transaction->type === 'income' ? 'arrow_downward' : 'arrow_upward' }}</span>
    </div>
    <div class="flex-1 min-w-0">
        <p class="text-body-lg font-semibold text-on-surface truncate">
            {{ $transaction->notes ?: ($transaction->category ? $transaction->category->name : 'Transaksi') }}
        </p>
        <p class="text-xs text-on-surface-variant">
            {{ $transaction->transaction_date->format('d M Y') }} • {{ $transaction->category ? $transaction->category->name : '-' }}
        </p>
    </div>
    <div class="text-right">
        <p class="text-body-lg font-bold {{ $transaction->type === 'income' ? 'text-success' : 'text-error' }}">
            {{ $transaction->type === 'income' ? '+' : '-' }} Rp {{ number_format($transaction->amount, 0, ',', '.') }}
        </p>
    </div>
</div>

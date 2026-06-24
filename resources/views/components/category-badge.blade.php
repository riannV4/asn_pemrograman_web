@props(['category', 'color' => '#7c3aed'])

<div class="inline-flex items-center gap-2 px-3 py-1.5 bg-surface-container rounded-full">
    <div class="w-3 h-3 rounded-full" style="background-color: {{ $color }};"></div>
    <span class="text-sm font-semibold text-on-surface">{{ $category }}</span>
</div>

@props([
    'id' => null,
    'title' => 'Confirm',
    'confirmText' => 'Confirm',
    'cancelText' => 'Cancel',
    'type' => 'confirm', // 'confirm' or 'delete'
    'categoryName' => null,
    'categoryColor' => '#7c3aed',
    'categoryIcon' => 'sell'
])
<div x-data="{ show: false }" x-show="show" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 p-4" style="display:none;" @open-modal.window="if($event.detail.id === '{{ $id }}') show = true" @close-modal.window="if($event.detail.id === '{{ $id }}') show = false">
    @if($type === 'delete')
        <div class="bg-white rounded-[32px] shadow-2xl max-w-sm w-full p-6 text-center" @click.away="show = false">
            <!-- Icon Header -->
            <div class="w-20 h-20 bg-red-50 border border-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <span class="material-symbols-rounded text-red-500 text-3xl">delete</span>
            </div>

            <!-- Title -->
            <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $title }}</h3>

            <!-- Category Badge (if available) -->
            @if($categoryName)
                <div class="inline-flex items-center gap-1.5 px-4 py-1.5 rounded-full text-sm font-semibold mb-4" style="background-color: {{ $categoryColor }}15; color: {{ $categoryColor }};">
                    <span class="material-symbols-rounded text-base">{{ $categoryIcon ?: 'sell' }}</span>
                    <span>{{ $categoryName }}</span>
                </div>
            @endif

            <!-- Description/Slot -->
            <div class="text-sm text-gray-500 px-2 leading-relaxed mb-6">
                {{ $slot }}
            </div>

            <!-- Divider -->
            <hr class="border-t border-gray-100 w-full mb-6">

            <!-- Action Buttons -->
            <div class="flex gap-3">
                <button type="button" @click="show = false" class="flex-1 border border-gray-200 bg-white hover:bg-gray-50 text-gray-700 font-semibold py-3 px-4 rounded-xl flex items-center justify-center gap-2 transition-colors">
                    <span class="material-symbols-rounded text-lg">close</span>
                    <span>{{ $cancelText }}</span>
                </button>
                <button type="button" @click="document.getElementById('{{ $id }}-form').submit()" class="flex-1 bg-[#d32f2f] hover:bg-red-700 text-white font-semibold py-3 px-4 rounded-xl flex items-center justify-center gap-2 transition-colors">
                    <span class="material-symbols-rounded text-lg">delete</span>
                    <span>{{ $confirmText }}</span>
                </button>
            </div>
        </div>
    @else
        <div class="bg-white rounded-lg shadow-lg max-w-md w-full p-6" @click.away="show = false">
            <h2 class="text-xl font-semibold mb-4" id="{{ $id }}-title">{{ $title }}</h2>
            <div class="mb-6" id="{{ $id }}-body">
                {{ $slot }}
            </div>
            <div class="flex justify-end space-x-3">
                <button type="button" @click="show = false" class="px-4 py-2 rounded bg-gray-200 hover:bg-gray-300">{{ $cancelText }}</button>
                <button type="button" @click="document.getElementById('{{ $id }}-form').submit()" class="px-4 py-2 rounded bg-red-600 text-white hover:bg-red-700">{{ $confirmText }}</button>
            </div>
        </div>
    @endif
</div>


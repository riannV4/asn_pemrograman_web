@props(['id' => null, 'title' => 'Confirm', 'confirmText' => 'Confirm', 'cancelText' => 'Cancel'])
<div x-data="{ show: false }" x-show="show" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50" style="display:none;" @open-modal.window="if($event.detail.id === '{{ $id }}') show = true" @close-modal.window="if($event.detail.id === '{{ $id }}') show = false">
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
</div>

@props(['title'])
<div
    class="absolute inset-0 flex items-center justify-center bg-gray-700 bg-opacity-50"
    x-show="showSourceModal"
    x-on:source-added.window="showSourceModal = false"
>
    <x-card
        class="p-10 max-w-lg mx-auto"
        @click.away="showSourceModal = false"
    >
        <div class="bg-gray-50 border border-gray-200 p-10 rounded max-w-lg mx-auto">
            <header class="text-center">
                <h2 class="text-2xl font-bold uppercase mb-3">
                    {{ $title }}
                </h2>
            </header>

            {{ $slot }}
        </div>
    </x-card>
</div>

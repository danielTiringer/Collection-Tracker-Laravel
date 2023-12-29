@props(['title'])
<div
    class="absolute inset-0 flex items-center justify-center bg-gray-700 bg-opacity-50"
    x-on:close-modal.window="showModal = false"
    x-show="showModal"
    x-transition.duration
>
    <x-card
        class="p-10 max-w-lg mx-auto"
        @click.away="showModal = false"
    >
        <div class="bg-gray-50 border border-gray-200 rounded max-w-lg mx-auto">
            <div class="w-full block">
                <button
                    @click="showModal = false"
                    type="button"
                    class="float-right mr-2 mt-2 px-2 text-black hover:text-red-500 border border-grey-200 bg-white"
                >
                    X
                </button>
            </div>
            <div class="p-10">
                <header class="text-center">
                    <h2 class="text-2xl font-bold uppercase mb-3">
                        {{ $title }}
                    </h2>
                </header>

                {{ $slot }}
            </div>
        </div>
    </x-card>
</div>

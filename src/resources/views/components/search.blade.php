@props(['route', 'placeholder'])

<form action="{{ $route }}" class="flex items-center mt-4">
    <label for="voice-search" class="sr-only">Search</label>
    <div class="w-full" x-data="{ search: '{{ request()->get('search') }}' }">
        <input
            id="voice-search"
            type="text"
            name="search"
            class="h-14 w-full px-6 rounded-lg bg-gray-50 border border-gray-200 focus:shadow focus:outline-none"
            placeholder="{{ $placeholder }}"
            x-model="search"
        />
    </div>

    <button
        type="submit"
        class="inline-flex items-center h-12 py-2.5 px-3 ms-2 text-sm text-white bg-red-500 rounded-lg border border-red-700 hover:bg-black focus:ring-4 focus:outline-none focus:ring-blue-300"
    >
        <i class="fa-solid fa-search"></i> Search
    </button>
</form>

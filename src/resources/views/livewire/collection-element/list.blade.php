<div>
    <div class="flex items-center mt-4">
        <div class="w-full" x-data="{ search: '{{ request()->get('search') }}' }">
            <label for="voice-search" class="sr-only">Search</label>
            <input
                id="voice-search"
                type="text"
                name="search"
                wire:model.live="searchQuery"
                class="h-14 w-full px-6 rounded-lg bg-gray-50 border border-gray-200 focus:shadow focus:outline-none"
                placeholder="Search in collection"
            />
        </div>

        <div class="mx-4">
            <label for="source-filter" class="sr-only">Source Filter</label>
            <select
                id="source-filter"
                class="border border-gray-200 rounded py-4 px-2 w-full bg-white"
                wire:model.live="sourceDropdown"
            >
                <option value="0">No Source</option>
                @foreach($sources as $source)
                    <option value="{{ $source->id }}">{{ $source->source }}</option>
                @endforeach
            </select>
        </div>
        <button
            class="bg-black text-white rounded py-4 px-4 hover:bg-red-500"
            wire:click="resetFields"
        >
            Reset
        </button>
    </div>

    @unless(count($elements) == 0)

        <div class="lg:grid lg:grid-cols-2 gap-4 space-y-4 md:space-y-0 mt-4">
            @foreach($elements as $element)
                <x-element-card :element="$element" />
            @endforeach
        </div>
    @else
        <div class="mt-4">
            <p>No elements to display</p>
        </div>
    @endunless
</div>

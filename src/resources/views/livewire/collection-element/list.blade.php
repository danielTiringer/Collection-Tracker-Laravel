<div>
    @unless(count($elements) == 0)
        <div class="flex items-center mt-4">
            <label for="voice-search" class="sr-only">Search</label>
            <div class="w-full" x-data="{ search: '{{ request()->get('search') }}' }">
                <input
                    id="voice-search"
                    type="text"
                    name="search"
                    wire:model.live="searchQuery"
                    class="h-14 w-full px-6 rounded-lg bg-gray-50 border border-gray-200 focus:shadow focus:outline-none"
                    placeholder="Search in collection"
                />
            </div>
        </div>

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

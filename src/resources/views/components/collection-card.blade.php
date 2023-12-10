@props(['collection'])

<x-card>
    <div class="flex">
        <img
            class="hidden w-48 mr-6 md:block object-scale-down"
            src="{{ $collection->image ? asset('storage/' . $collection->image) : asset('images/no-image.png') }}"
            alt=""
        />
        <div>
            <h3 class="text-2xl font-bold">
                <a href="{{ route('collections.show', ['collection' => $collection]) }}">{{ $collection->name }}</a>
            </h3>
            <div class="text-xl mb-4">{{ $collection->description }}</div>
        </div>
    </div>
</x-card>

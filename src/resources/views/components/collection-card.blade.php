@props(['collection'])

<x-card>
    <div class="flex">
        <img
            class="hidden w-48 mr-6 md:block"
            src="{{ asset('images/no-image.png') }}"
            alt=""
        />
        <div>
            <h3 class="text-2xl">
                <a href="{{ route('collections.show', ['collection' => $collection]) }}">{{ $collection->name }}</a>
            </h3>
            <div class="text-xl font-bold mb-4">{{ $collection->description }}</div>
        </div>
    </div>
</x-card>

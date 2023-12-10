@props(['element'])

<x-card>
    <div class="flex">
        <img
            class="hidden w-48 mr-6 md:block {{ $element->status->isPlanned() ? 'grayscale' : '' }}"
            src="{{ $element->image ? asset('storage/' . $element->image) : asset('images/no-image.png') }}"
            alt=""
        />
        <div>
            <h3 class="text-2xl">
                <a href="{{ route('elements.show', ['collection' => $element->collection_entity_id, 'element' => $element]) }}">{{ $element->name }}</a>
            </h3>
            <div class="text-xl font-bold mb-4">{{ $element->description }}</div>
            <p>{{ $element->status->getLabelText() }}</p>
        </div>
    </div>
</x-card>

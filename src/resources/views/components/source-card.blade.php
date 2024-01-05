@props(['source'])

<x-card>
    <div class="flex justify-between">
        <div>
            <h3 class="text-2xl font-bold">{{ $source->source }}</h3>
        </div>
        <div>
            <button><i class="fa-solid fa-pen"></i></button>
            <button><i class="fa-solid fa-trash"></i></button>
        </div>
    </div>
</x-card>

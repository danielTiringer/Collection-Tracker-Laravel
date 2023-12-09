@extends('layout')

@section('content')
    <a
        class="inline-block text-black ml-4 mb-4"
        href="{{ route('collections.show', $element->collection_entity_id) }}"
    >
        <i class="fa-solid fa-arrow-left"></i> Back
    </a>
    <div class="mx-4">
        <x-card class="p-10">
            <div
                class="flex flex-col items-center justify-center text-center"
            >
                <div class="flex flex-row">
                    <img
                        class="w-48 mr-6 mb-6"
                        src="{{ $element->image ? asset('storage/' . $element->image) : asset('images/no-image.png') }}"
                        alt=""
                    />
                    <div class="flex items-center">
                        <div>
                            <h3 class="text-2xl mb-2">{{ $element->name }}</h3>
                        </div>
                    </div>
                </div>

                <div class="border border-gray-200 w-full mb-6"></div>
                <div>
                    <h3 class="text-3xl font-bold mb-4">
                        Description
                    </h3>
                    <div class="text-lg space-y-6">
                        <p>{{ $element->description }}</p>
                    </div>
                </div>
            </div>
        </x-card>

        <x-card class="mt-4 p-2 flex space-x-6 justify-end">
                <a href="{{ route('elements.edit', ['collection' => $element->collection_entity_id, 'element' => $element->id]) }}">
                    <i class="fa-solid fa-pencil"></i> Edit
                </a>

                <form action="{{ route('elements.destroy', ['collection' => $element->collection_entity_id, 'element' => $element->id]) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="text-red-500">
                        <i class="fa-solid fa-trash"></i> Delete
                    </button>
                </form>
        </x-card>
    </div>
@endsection
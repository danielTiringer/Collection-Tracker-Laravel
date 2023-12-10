@extends('layout')

@section('content')
    <x-back-button :route="route('collections.show', $element->collection_entity_id)" />
    <div class="mx-4">
        <x-card class="p-10">
            <div class="flex flex-row items-center justify-center text-center">
                <div class="flex-none w-1/4 flex justify-center">
                    <img
                        class="w-48 mr-6 mb-6 {{ $element->status->isPlanned() ? 'grayscale' : '' }}"
                        src="{{ $element->image ? asset('storage/' . $element->image) : asset('images/no-image.png') }}"
                        alt=""
                    />
                </div>
                <div class="flex-none w-1/4 flex items-center">
                    <div class="flex items-center">
                        <div>
                            <h3 class="text-2xl mb-2">{{ $element->name }}</h3>
                            <p>{{ $element->status->getLabelText() }}</p>
                        </div>
                    </div>
                </div>
                <div class="flex-none w-1/2 text-lg space-y-6">
                    <p>{{ $element->description }}</p>
                </div>
            </div>
        </x-card>

        <x-card class="mt-4 p-2 flex space-x-6 justify-end">
            <x-edit-button :route="route('elements.edit', ['collection' => $element->collection_entity_id, 'element' => $element->id])" />

            <x-delete-button :route="route('elements.destroy', ['collection' => $element->collection_entity_id, 'element' => $element->id])" />
        </x-card>
    </div>
@endsection

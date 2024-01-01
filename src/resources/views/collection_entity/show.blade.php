@extends('layout')

@section('content')
    <x-back-button :route="route('collections.index')"></x-back-button>
    <div class="mx-4">
        <x-card class="">
            <div class="flex flex-row items-center justify-center text-center">
                <div class="flex-none w-1/4 flex justify-center">
                    <img
                        class="w-48 object-scale-down"
                        src="{{ $collection->image ? asset('storage/' . $collection->image) : asset('images/no-image.png') }}"
                        alt=""
                    />
                </div>
                <div class="flex-none w-1/4 flex items-center">
                    <div>
                        <h3 class="text-2xl mb-2">{{ $collection->name }}</h3>
                        <div class="text-xl font-bold mb-4">
                            Progress:
                            @if($collection->goal)
                                {{ count($elements) }} / {{ $collection->goal }}
                            @else
                                No goal set
                            @endif
                        </div>
                    </div>
                </div>
                <div class="flex-none w-1/2 text-lg space-y-6">
                    <p>{{ $collection->description }}</p>
                </div>
            </div>
        </x-card>

        <x-card class="mt-4 p-2 flex space-x-6 justify-between">
            <div class="flex space-x-6">
                <a href="{{ route('elements.create', $collection) }}" class="hover:text-red-500">
                    <i class="fa-solid fa-add"></i> Add To The Collection
                </a>
            </div>
            <div class="flex space-x-6">
                <x-edit-button :route="route('collections.edit', $collection->id)" />

                <x-delete-button :route="route('collections.destroy', $collection)" />
            </div>
        </x-card>

        <livewire:collection-element.list-collection-elements
            :collection="$collection"
        />
    </div>
@endsection

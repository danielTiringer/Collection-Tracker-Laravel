@extends('layout')

@section('content')
    <a
        class="inline-block text-black ml-4 mb-4"
        href="{{ route('collections.index') }}"
    >
        <i class="fa-solid fa-arrow-left"></i> Back
    </a>
    <div class="mx-4">
        <x-card class="">
            <div class="flex flex-row items-center justify-center text-center">
                <div class="flex-none w-1/4 flex justify-center">
                    <img
                        class="w-48"
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
                <a href="{{ route('elements.create', $collection) }}">
                    <i class="fa-solid fa-add"></i> Add To The Collection
                </a>
            </div>
            <div class="flex space-x-6">
                <a href="{{ route('collections.edit', $collection->id) }}">
                    <i class="fa-solid fa-pencil"></i> Edit
                </a>

                <form action="{{ route('collections.destroy', $collection) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="text-red-500">
                        <i class="fa-solid fa-trash"></i> Delete
                    </button>
                </form>
            </div>
        </x-card>

        <x-search :route="route('collections.show', $collection->id)" placeholder="Search elements" />

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
@endsection

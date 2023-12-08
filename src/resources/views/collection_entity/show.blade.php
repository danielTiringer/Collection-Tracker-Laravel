@extends('layout')

@section('content')
    <a
        class="inline-block text-black ml-4 mb-4"
        href="{{ route('collections.index') }}"
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
                        src="{{ $collection->image ? asset('storage/' . $collection->image) : asset('images/no-image.png') }}"
                        alt=""
                    />
                    <div class="flex items-center">
                        <div>
                            <h3 class="text-2xl mb-2">{{ $collection->name }}</h3>
                            <div class="text-xl font-bold mb-4">
                                Progress:
                                @if($collection->goal)
                                    0 / {{ $collection->goal }}
                                @else
                                    No goal set
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="border border-gray-200 w-full mb-6"></div>
                <div>
                    <h3 class="text-3xl font-bold mb-4">
                        Description
                    </h3>
                    <div class="text-lg space-y-6">
                        <p>{{ $collection->description }}</p>
                    </div>
                </div>
            </div>
        </x-card>


        <div class="lg:grid lg:grid-cols-2 gap-4 space-y-4 md:space-y-0 mx-4 mt-4">
            @unless(count($collection->elements) == 0)
                @foreach($collection->elements as $element)
                    <x-element-card :element="$element" />
                @endforeach
            @else
                <p>No elements found</p>
            @endunless
        </div>

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
    </div>
@endsection

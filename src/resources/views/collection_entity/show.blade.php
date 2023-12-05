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
    </div>
@endsection

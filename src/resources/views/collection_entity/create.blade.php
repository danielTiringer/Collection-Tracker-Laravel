@extends('layout')

@section('content')
    <x-card class="p-10 max-w-lg mx-auto mt-24">
        <header class="text-center">
            <h2 class="text-2xl font-bold uppercase mb-1">
                Create a new collection
            </h2>
        </header>

        <form method="POST" action="{{ route('collections.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="mb-6">
                <label
                    for="name"
                    class="inline-block text-lg mb-2"
                >
                    Name
                </label>
                <input
                    type="text"
                    class="border border-gray-200 rounded p-2 w-full"
                    name="name"
                    value="{{ old('name') }}"
                />
                @error('name')
                <p class="text-red-500 text-xs mb-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label
                    for="description"
                    class="inline-block text-lg mb-2"
                >
                    Description
                </label>
                <textarea
                    class="border border-gray-200 rounded p-2 w-full"
                    name="description"
                    rows="10"
                    placeholder="Include tasks, requirements, salary, etc"
                >
                    {{ old('description') }}
                </textarea>
                @error('description')
                    <p class="text-red-500 text-xs mb-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label
                    for="goal"
                    class="inline-block text-lg mb-2"
                >
                    Goal
                </label>
                <input
                    type="number"
                    class="border border-gray-200 rounded p-2 w-full"
                    name="goal"
                    value="{{ old('goal') }}"
                />
                @error('goal')
                    <p class="text-red-500 text-xs mb-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="image_file" class="inline-block text-lg mb-2">
                    Collection Image
                </label>
                <input
                    type="file"
                    class="border border-gray-200 rounded p-2 w-full"
                    name="image_file"
                />
                @error('image_file')
                    <p class="text-red-500 text-xs mb-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6 flex justify-between">
                <x-back-button :route="route('collections.index')" />
                <x-save-button text="" />
            </div>
        </form>
    </x-card>
@endsection

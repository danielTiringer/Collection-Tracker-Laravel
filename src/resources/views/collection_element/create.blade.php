@php use App\Enums\CollectionElementStatus; @endphp
@extends('layout')

@section('content')
    <x-card class="p-10 max-w-lg mx-auto mt-24">
        <header class="text-center">
            <h2 class="text-2xl font-bold uppercase mb-1">
                Add a new collection element
            </h2>
            <p>{{ $collection->name }}</p>
        </header>

        <form method="POST" action="{{ route('elements.store', $collection->id) }}" enctype="multipart/form-data">
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
                    for="status"
                    class="inline-block text-lg mb-2"
                >
                    Status
                </label>
                <select
                    class="border border-gray-200 rounded p-2 w-full bg-white"
                    name="status"
                    id="status"
                >
                    @foreach(CollectionElementStatus::cases() as $status)
                        <option value="{{ $status->value }}">{{ $status->getLabelText() }}</option>
                    @endforeach
                </select>
                @error('status')
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
                <x-back-button :route="route('collections.show', $collection->id)" />
                <button
                    class="bg-red-500 text-white rounded py-2 px-4 hover:bg-black"
                >
                    Create Element
                </button>
            </div>
        </form>
    </x-card>
@endsection

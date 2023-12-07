@extends('layout')

@section('content')
    <x-card class="p-10 max-w-lg mx-auto mt-24">
        <div
            class="bg-gray-50 border border-gray-200 p-10 rounded max-w-lg mx-auto mt-24"
        >
            <header class="text-center">
                <h2 class="text-2xl font-bold uppercase mb-1">
                    {{ $user->name }}
                </h2>
                <p class="mb-4">Edit Account</p>
            </header>

            <form action="{{ route('users.update') }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-6">
                    <label for="name" class="inline-block text-lg mb-2">
                        Name
                    </label>
                    <input
                        type="text"
                        class="border border-gray-200 rounded p-2 w-full"
                        name="name"
                        value="{{ old('name') ?? $user->name }}"
                    />
                    @error('name')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="email" class="inline-block text-lg mb-2">Email</label>
                    <input
                        type="email"
                        class="border border-gray-200 rounded p-2 w-full"
                        name="email"
                        value="{{ old('email') ?? $user->email }}"
                    />
                    @error('email')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <button
                        type="submit"
                        class="bg-red-500 text-white rounded py-2 px-4 hover:bg-black"
                    >
                        Save
                    </button>
                </div>

                <div class="mt-8">
                    <p>
                        <a href="{{ route('users.edit_password') }}" class="text-red-500">Change Password</a>
                    </p>
                </div>
            </form>
        </div>
    </x-card>
@endsection

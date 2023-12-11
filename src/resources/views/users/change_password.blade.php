@extends('layout')

@section('content')
    <x-card class="p-10 max-w-lg mx-auto mt-24">
        <div
            class="bg-gray-50 border border-gray-200 p-10 rounded max-w-lg mx-auto mt-24"
        >
            <header class="text-center">
                <h2 class="text-2xl font-bold uppercase mb-4">
                    Change your password
                </h2>
            </header>

            <form action="{{ route('users.update_password') }}" method="POST">
                @csrf
                @method('PATCH')

                <div class="mb-6">
                    <label
                        for="old_password"
                        class="inline-block text-lg mb-2"
                    >
                        Old Password
                    </label>
                    <input
                        type="password"
                        class="border border-gray-200 rounded p-2 w-full"
                        name="old_password"
                        value="{{ old('old_password') }}"
                    />
                    @error('old_password')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label
                        for="password"
                        class="inline-block text-lg mb-2"
                    >
                        New Password
                    </label>
                    <input
                        type="password"
                        class="border border-gray-200 rounded p-2 w-full"
                        name="password"
                        value="{{ old('password') }}"
                    />
                    @error('password')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label
                        for="password_confirmation"
                        class="inline-block text-lg mb-2"
                    >
                        Confirm Password
                    </label>
                    <input
                        type="password"
                        class="border border-gray-200 rounded p-2 w-full"
                        name="password_confirmation"
                        value="{{ old('password_confirmation') }}"
                    />
                    @error('password_confirmation')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-between">
                    <div class="mt-3">
                        <x-back-button :route="route('users.edit')" />
                    </div>

                    <div class="mb-6">
                        <x-save-button text="" />
                    </div>
                </div>
            </form>
        </div>
    </x-card>
@endsection

<form wire:submit="save">
    @csrf

    <div class="mb-6">
        <label for="source" class="inline-block text-lg mb-2">
            Name
        </label>
        <input
            type="text"
            class="border border-gray-200 rounded p-2 w-full"
            id="source"
            name="source"
            value="{{ old('source') }}"
            wire:model="form.source"
        />
        @error('form.source')
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div class="flex flex-row justify-between">
        <button
            @click="showSourceModal = false"
            type="button"
            class="py-2 px-3 text-black hover:text-red-500"
        >
            Cancel
        </button>
        <button class="bg-red-500 text-white rounded py-2 px-4 hover:bg-black">
            Save
        </button>
    </div>
</form>

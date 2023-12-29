<div
    x-data="{ 'showModal': false }"
    @keydown.escape="showModal = false"
>
    <x-card class="p-10 max-w-lg mx-auto mt-24">
        <header class="text-center">
            <h2 class="text-2xl font-bold uppercase mb-1">
                Add a new collection element
            </h2>
            <p>{{ $collection->name }}</p>
        </header>

        <form wire:submit="save">
            @csrf
            <div class="mb-6">
                <label
                    for="name"
                    class="inline-block text-lg mb-2"
                >
                    Name
                </label>
                <input
                    id="name"
                    type="text"
                    class="border border-gray-200 rounded p-2 w-full"
                    wire:model="form.name"
                    value="{{ old('name') }}"
                />
                @error('form.name')
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
                    id="description"
                    class="border border-gray-200 rounded p-2 w-full"
                    wire:model="form.description"
                    rows="10"
                    placeholder="Describe the newest acquisition!"
                >
                    {{ old('description') }}
                </textarea>
                @error('form.description')
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
                    id="status"
                    class="border border-gray-200 rounded p-2 w-full bg-white"
                    wire:model="form.status"
                >
                    @foreach($statuses as $status)
                        <option value="{{ $status->value }}">{{ $status->getLabelText() }}</option>
                    @endforeach
                </select>
                @error('form.status')
                <p class="text-red-500 text-xs mb-1">{{ $message }}</p>
                @enderror
            </div>

            <label
                for="source"
                class="inline-block text-lg mb-2"
            >
                Source
            </label>
            <div class="mb-6 flex flex-row justify-between">
                <div class="w-full mr-2">

                    <select
                        id="source"
                        class="border border-gray-200 rounded p-2 w-full bg-white"
                        wire:model="form.source"
                    >
                        <option value="0">None</option>
                        @foreach($sources as $source)
                            <option value="{{ $source->id }}">{{ $source->source }}</option>
                        @endforeach
                    </select>
                    @error('form.source')
                    <p class="text-red-500 text-xs mb-1">{{ $message }}</p>
                    @enderror

                </div>
                <button
                    class="text-black hover:text-red-500 border py-1 px-2 bg-white"
                    type="button"
                    @click="showModal = true"
                >
                    <i class="fa-solid fa-add"></i>
                </button>
            </div>

            <div class="mb-6">
                <label for="image" class="inline-block text-lg mb-2">
                    Collection Image
                </label>
                <input
                    id="image"
                    type="file"
                    class="border border-gray-200 rounded p-2 w-full"
                    wire:model.defer="form.image"
                />
                @error('form.image')
                <p class="text-red-500 text-xs mb-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6 flex justify-between">
                <x-back-button :route="route('collections.show', $collection->id)" />
                <button class="bg-red-500 text-white rounded py-2 px-4 hover:bg-black">
                    Create Element
                </button>
            </div>
        </form>
    </x-card>

    <x-modal title="Add a new source" button_text="Save">
        <livewire:source.create-source />
    </x-modal>
</div>

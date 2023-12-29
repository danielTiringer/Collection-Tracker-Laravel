<div
    x-data="{ 'showModal': false }"
    @keydown.escape="showModal = false"
>
    <x-card class="p-10 max-w-lg mx-auto mt-24">
        <header class="text-center">
            <h2 class="text-2xl font-bold uppercase mb-1">
                Edit {{ $element->name }}
            </h2>
        </header>

        <form wire:submit="edit">
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
                    wire:model="form.name"
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
                    class="border border-gray-200 rounded p-2 w-full"
                    name="description"
                    wire:model="form.description"
                    rows="10"
                    placeholder="Include tasks, requirements, salary, etc"
                >{{ $element->description }}</textarea>
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
                    class="border border-gray-200 rounded p-2 w-full bg-white"
                    name="status"
                    id="status"
                    wire:model="form.status"
                >
                    @foreach($statuses as $status)
                        <option
                            value="{{ $status->value }}"
                            @if ($status->value == old('status', $element->status->value))
                                selected="selected"
                            @endif
                        >
                            {{ $status->getLabelText() }}
                        </option>
                    @endforeach
                </select>
                @error('form.status')
                <p class="text-red-500 text-xs mb-1">{{ $message }}</p>
                @enderror
            </div>

            <label
                for="sourceRename filepath"
                class="inline-block text-lg mb-2"
            >
                Source
            </label>
            <div class="mb-6 flex flex-row justify-between">
                <div class="w-full mr-2">
                    <select
                        class="border border-gray-200 rounded p-2 w-full bg-white"
                        name="source"
                        id="source"
                        wire:model="form.source"
                    >
                        <option value="0">None</option>
                        @foreach($sources as $source)
                            <option
                                value="{{ $source->id }}"
                                @if($source->id == old('source', $element->sources()->first()?->id))
                                    selected="selected"
                                @endif
                            >
                                {{ $source->source }}
                            </option>
                        @endforeach
                    </select>
                    @error('form.source')
                    <p class="text-red-500 text-xs mb-1">{{ $source }}</p>
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
                    Image
                </label>
                <input
                    type="file"
                    class="border border-gray-200 rounded p-2 w-full"
                    name="image"
                    wire:model="form.image"
                />
                <img
                    class="w-48 mx-auto my-6"
                    src="{{ $element->image ? asset('storage/' . $element->image) : asset('images/no-image.png') }}"
                    alt=""
                />
                @error('form.image')
                <p class="text-red-500 text-xs mb-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6 flex justify-between">
                <x-back-button :route="route('elements.show', ['collection' => $element->collection_entity_id, 'element' => $element])" />
                <x-save-button text="Changes" />
            </div>
        </form>
    </x-card>

    <x-modal title="Add a new source" button_text="Save">
        <livewire:source.create-source />
    </x-modal>
</div>

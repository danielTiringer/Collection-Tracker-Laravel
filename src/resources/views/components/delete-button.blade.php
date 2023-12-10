@props(['route'])

<div x-data="{ 'showModal': false}" @keydown.escape="showModal = false">
    <button
        class="text-red-500 hover:text-black"
        type="button"
        @click="showModal = true"
    >
        <i class="fa-solid fa-trash"></i> Delete
    </button>

    <div
        class="absolute inset-0 flex items-center justify-center bg-gray-700 bg-opacity-50"
        x-show="showModal"
    >
        <div
            class="max-w-sm p-6 bg-gray-50 border border-gray-200 rounded"
            @click.away="showModal = false"
        >
            <p class="text-xl">Are you sure you want to delete this item?</p>
            <div class="flex justify-center items-center space-x-4">
                <button
                    @click="showModal = false"
                    type="button"
                    class="py-2 px-3 text-black hover:text-red-500"
                >
                    Cancel
                </button>
                <form action="{{ $route }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button
                        type="submit"
                        class="py-2 px-4 text-white bg-red-500 hover:bg-black rounded"
                    >
                        Delete
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

@props(['text'])

<button class="bg-red-500 text-white rounded py-2 px-4 hover:bg-black">
    Save{{ $text ? ' ' . $text : '' }}
</button>

@extends('layout')

@section('content')
    <div
        class="lg:grid lg:grid-cols-2 gap-4 space-y-4 md:space-y-0 mx-4"
    >
        @unless(count($collections) == 0)

            @foreach($collections as $collection)
                <x-collection-card :collection="$collection" />
            @endforeach
        @else
            <p>No collections found</p>
        @endunless
    </div>

    <div class="mt-6 p-4">
        {{ $collections->links() }}
    </div>
@endsection

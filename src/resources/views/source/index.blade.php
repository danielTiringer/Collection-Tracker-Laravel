@extends('layout')

@section('content')
    <div class="grid gap-4 mt-4 w-1/2 mx-auto">
        @unless(count($sources) == 0)
            @foreach($sources as $source)
                <x-source-card :source="$source" />
            @endforeach
        @else
            <p>No sources found</p>
        @endunless
    </div>
@endsection

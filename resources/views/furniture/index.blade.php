@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Furniture Catalog</h1>
        <ul>
            @foreach($furniture as $item)
                <p>{{ $item->name }} / {{ $item->description }}</p>
            @endforeach
        </ul>
    </div>
@endsection

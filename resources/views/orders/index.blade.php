@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Orders</h1>
        <ul>
            @foreach($orders as $item)
                <p>{{ $item->status }} / {{ $item->process }} / {{ $item->furniture->name }}</p>
            @endforeach
        </ul>
    </div>
@endsection

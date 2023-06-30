@extends('layout')

@section('title', 'Home')

@section('content')
    <div class="container">
        <div class="row">
            @foreach ($products as $item)
                <div class="col-md-4">
                    <div class="card">
                        <div class="text-center">
                            <img width="100" class="mx-auto" height="100" src="{{ '/images/product/' . $item->image }}">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">{{ $item->name }}</h5>
                            <p class="card-text">R$ {{' ' . $item->value }}</p>
                            <a href="{{ route('details', $item->id) }}"> Detalhe do produto </a>
                        </div>
                    </div>
            @endforeach
        </div>
    </div>
@endsection

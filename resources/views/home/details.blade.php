@extends('layout')

@section('title', 'detalhes do produto')

@section('content')
        <input hidden id="product_id" value="{{ $product->id }}">
        <input hidden id="product_value" value="{{ $product->value }}">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h4>{{ $product->name }}</h4>
                    <hr>
                </div>
                <div class="col-md-5">
                    <div class="card">
                        <img class="img-fluid" src="{{ '/images/product/' . $product->image }}" alt="Imagem do Produto">
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="row">
                        <div class="col-md-6 text-center">
                            <h4>R$ {{ $product->value }}</h4>
                        </div>
                        <div class="col-md-6">
                            <button type="button" id="comprar" class="btn btn-success" style="width:100%">Comprar</button>
                        </div>
                    </div>
                    <p class="p-5">{{ $product->description }}</p>
                </div>
            </div>
        </div>
    <script type="text/javascript" src="{{ asset('js/details.js?v=1') }}"></script>
@endsection

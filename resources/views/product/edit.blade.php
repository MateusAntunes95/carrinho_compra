@extends('layout')
@section('title', 'Editar Produto')

@section('content')
    <form method="PATCH" enctype="multipart/form-data" action="{{ route('produto.update', $product->id) }}">
        @csrf
        @include('product._form')
    </form>
@endsection

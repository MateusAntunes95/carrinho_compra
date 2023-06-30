@extends('layout')
@section('title', 'Editar Produto')

@section('content')
    <form method="POST" enctype="multipart/form-data" action="{{ route('produto.update', $product->id) }}">
        @csrf
        @method('PUT')
        @include('product._form')
    </form>
@endsection

@extends('layout')
@section('title', 'Editar Cupom')

@section('content')
    <form method="POST" enctype="multipart/form-data" action="{{ route('desconto.update', $product->id) }}">
        @csrf
        @method('PUT')
        @include('discount_doupon._form')
    </form>
@endsection

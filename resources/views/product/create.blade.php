@extends('layout')
@section('title', 'Criar Produtos')

@section('content')
    <form method="POST" enctype="multipart/form-data" action="{{ route('produto.store') }}">
        @csrf
        @include('product._form')
    </form>
@endsection

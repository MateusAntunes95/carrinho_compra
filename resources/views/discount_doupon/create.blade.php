@extends('layout')
@section('title', 'Criar Cupom')

@section('content')
    <form method="POST" enctype="multipart/form-data" action="{{ route('desconto.store') }}">
        @csrf
        @include('discount_doupon._form')
    </form>
@endsection

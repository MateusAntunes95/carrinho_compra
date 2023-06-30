@extends('layout')
@section('title', 'Criar Usuario')

@section('content')
    <form method="POST" enctype="multipart/form-data" action="{{ route('user.store') }}">
        @csrf
        @include('user._form')
    </form>
@endsection

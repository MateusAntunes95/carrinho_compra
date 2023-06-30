@extends('layout')
@section('title', 'Editar Usuario')

@section('content')
    <form method="POST" action="{{ route('user.update', $user->id) }}">
        @csrf
        @method('PUT')
        @include('user._form')
    </form>
@endsection

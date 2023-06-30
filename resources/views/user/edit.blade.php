@extends('layout')
@section('title', 'Editar Usuario')

@section('content')
    <form method="PATCH" action="{{ route('user.update', $user->id) }}">
        @csrf
        @include('user._form')
    </form>
@endsection

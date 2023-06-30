@extends('layout')
@section('title', 'Login')

@section('content')

    <div class="container">
        <form action="{{ route('login.store') }}" method="POST">
            @csrf
            <h1 class="h3 mb-3 font-weight-normal">Faça login</h1>
            @error('error')
                <span> {{ $message }}</span>
            @enderror
            <label for="inputEmail" class="sr-only">Endereço de email</label>
            <input type="email" name="email" class="form-control" placeholder="Seu email">
            @error('email')
                <span> {{ $message }} </span>
            @enderror
            <label for="inputPassword" class="sr-only">Senha</label>
            <input name="password" type="password" id="inputPassword" class="form-control" placeholder="Senha">
            @error('password')
                <span> {{ $message }} </span>
            @enderror
            <button class="btn btn-lg btn-primary " type="submit">Login</button>
            <a class="btn btn-lg btn-success" type="button" href="{{ route('user.create') }}">Não tenho conta
                ainda</a>
        </form>
    </div>
@endsection

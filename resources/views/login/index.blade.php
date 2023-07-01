@extends('layout')
@section('title', 'Login')

@section('content')

    <div class="card border-primary">
        <form action="{{ route('login.store') }}" method="POST">
            <div class="card border-primary">
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
                <button class="btn btn-md mt-1 btn-primary " type="submit">Login</button>
                <a class="btn btn-md mt-1 btn-success" type="button" href="{{ route('user.create') }}">Não tenho conta
                    ainda</a>
            </div>
        </form>
    </div>
@endsection

@extends('layout')
@section('title', 'Login')

@section('content')
    <div class="container-sm offset-sm-3 col-sm-6 text-center">
        <div class="card border-primary">
            <form action="{{ route('login.store') }}" method="POST">
                @csrf
                <div class="d-flex justify-content-center align-items-center">
                    <div class="col-sm-8">
                        <h1 class="h3 mb-3 font-weight-normal">Faça login</h1>
                        @error('error')
                            <span>{{ $message }}</span>
                        @enderror
                        <div class="row">
                            <div class="text-center col">
                                <label for="inputEmail" class="sr-only">Endereço de email</label>
                                <input type="email" name="email" class="form-control text-center"
                                    placeholder="Seu email">
                            </div>
                        </div>
                        @error('email')
                            <span>{{ $message }}</span>
                        @enderror
                        <label for="inputPassword" class="text-center sr-only">Senha</label>
                        <input name="password" type="password" id="inputPassword" class="text-center form-control"
                            placeholder="Senha">
                        @error('password')
                            <span>{{ $message }}</span>
                        @enderror
                        <button class="btn btn-md mt-3 btn-primary w-100" type="submit">Login</button>
                        <a class="btn btn-md mb-2 mt-3 btn-success w-100 " type="button"
                            href="{{ route('user.create') }}">Criar conta </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

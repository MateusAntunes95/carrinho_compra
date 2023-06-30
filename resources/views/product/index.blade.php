@extends('layout')

@section('title', 'Produtos')

@section('content')
    <div class="container mt-4">
        <form method="GET" action="{{ route('produto.index') }}">
            <div class="card border-primary">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Filtrar Produtos</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-3 mb-3">
                            <label for="id">Código:</label>
                            <input name="id" id="id" type="text" class="form-control"
                                value="{{ $request->id }}">
                        </div>
                        <div class="col-sm-3 mb-3">
                            <label for="name">Nome:</label>
                            <input name="name" id="name" type="text" class="form-control"
                                value="{{ $request->name }}">
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-search"></i> Pesquisar
                        </button>
                        <a href="{{ route('produto.create') }}" class="btn btn-success">
                            Criar Produto
                        </a>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="container mt-4">
        <div class="card border-primary">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Listagem de Produtos</h5>
            </div>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Código</th>
                        <th>Nome</th>
                        <th>Imagem</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dados as $dado)
                        <tr>
                            <td>{{ $dado->id }}</td>
                            <td>{{ $dado->name }}</td>
                            <td>
                                <img width="50" height="50" src="{{ '/images/product/' . $dado->image }}">
                            </td>
                            <td>
                                <a href="{{ route('produto.edit', $dado->id) }}">
                                    <button class="btn btn-success" data-toggle="tooltip" title="Editar Produto">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

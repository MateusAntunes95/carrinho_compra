@extends('layout')
@section('title', 'carrinho')

@section('content')

    <div class="container">
        <h3 class="mt-4">Produtos no carrinho</h3>
        <hr />

        @forelse ($requests as $item)
            <h5 class="mt-4"> Código do Pedido: {{ $item->id }} </h5>
            <h5 class="mt-4"> Criado em: {{ $item->created_at->format('d/m/y') }} </h5>
            <table class="table mt-4">
                <thead>
                    <tr>
                        <th></th>
                        <th>Qtd</th>
                        <th>Produto</th>
                        <th>Valor Unit</th>
                        <th>Desconto(s)</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $total_request = 0;
                    @endphp

                    @foreach ($item->request_products as $rp)
                        <tr>
                            <td>
                                <img width="100" height="100" src="{{ '/images/product/' . $rp->product->image }}">
                            </td>
                            <td>{{ $rp->quantity }}</td>
                            <td>{{ $rp->product->name }}</td>
                            <td>{{ number_format($rp->product->value, 2, ',', '.') }}</td>
                            <td>{{ number_format($rp->discounts, 2, ',', '.') }}</td>
                            @php
                                $total_product = $rp->total_value - $rp->discounts;
                                $total_request += $total_product;
                            @endphp
                            <td>{{ number_format($total_product, 2, ',', '.') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="row">
                <strong> Total do pedido: </strong>
                <span> {{ number_format($total_request, 2, ',', '.') }} </span>
            </div>
            <div class="row">
                <a type="button" href="{{ route('home') }}" class="btn btn-primary">Continuar Comprando?</a>
            </div>
        @empty
            <h5 class="mt-4"> Não há nenhum pedido no carrinho </h5>
        @endforelse
    </div>

@endsection

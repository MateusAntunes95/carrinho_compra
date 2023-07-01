@extends('layout')
@section('title', 'carrinho')

@section('content')

    <div class="container">
        <div class="divider">
            <h3 class="mt-4">Minhas compras</h3>
            <hr />
            <h5 class="mt-4"> Compras concluídas </h5>
            @forelse ($purchases as $item)
                <h5 class="mt-4"> Código do Pedido: {{ $item->id }} </h5>
                <h5 class="mt-4"> Criado em: {{ $item->created_at->format('d/m/y') }} </h5>
                <form method="POST" action="{{ route('cart.canceled') }}">
                    @csrf
                    <input hidden name="request_id" value="{{ $item->id }}">
                    <table class="table mt-4">
                        <thead>
                            <tr>
                                <th colspan="2"></th>
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

                            @foreach ($item->request_product_item as $rp)
                                <tr>
                                    <td class="text-center">
                                        @if ($rp->status == 'PA')
                                            <p class="text-center">
                                                <input type="checkbox" id="item-{{ $rp->id }}" name="id[]"
                                                    value="{{ $rp->id }}">
                                                <label for="item-{{ $rp->id }}"> Selecionar </label>
                                            </p>
                                        @else
                                            <strong class="text-danger"> CANCELADO </strong>
                                        @endif
                                    </td>
                                    <td>
                                        <img width="100" height="100"
                                            src="{{ '/images/product/' . $rp->product->image }}">
                                    </td>
                                    <td>{{ $rp->product->name }}</td>
                                    <td>{{ number_format($rp->value, 2, ',', '.') }}</td>
                                    <td>{{ number_format($rp->discounts, 2, ',', '.') }}</td>
                                    @php
                                        $total_product = $rp->value - $rp->discounts;
                                        $total_request += $total_product;
                                    @endphp
                                    <td>{{ number_format($total_product, 2, ',', '.') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="4"> </td>
                                <td> <strong> Total do pedido: </strong> </td>
                                <td> {{ number_format($total_request, 2, ',', '.') }} </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <button type="submit" class="btn btn-danger w-100" data-toggle="tooltip"
                                        title="Cancelar produtos selecionados"> Cancelar
                                    </button>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </form>
            @empty
                <h5 class="mt-4 text-center">
                    @if ($canceleds->count() > 0)
                        Neste momento não há nenhuma compra valida.
                    @else
                        Você ainda não fez nenhuma compra.
                    @endif
                </h5>
            @endforelse
        </div>
        <div class="divider">
            <hr />
            <h5 class="mt-4"> Compras canceladas </h5>
            @forelse ($canceleds as $item)
                <h5 class="mt-4"> Código do Pedido: {{ $item->id }} </h5>
                {{-- <h5 class="mt-4"> Cancelado em: {{ $item->update_at->format('d/m/y') }} </h5> --}}
                <table class="table mt-4">
                    <thead>
                        <tr>
                            <th></th>
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

                        @foreach ($item->request_product_item as $rp)
                            <tr>
                                <td>
                                    <img width="100" height="100"
                                        src="{{ '/images/product/' . $rp->product->image }}">
                                </td>
                                <td>{{ $rp->product->name }}</td>
                                <td>{{ number_format($rp->value, 2, ',', '.') }}</td>
                                <td>{{ number_format($rp->discounts, 2, ',', '.') }}</td>
                                @php
                                    $total_product = $rp->value - $rp->discounts;
                                    $total_request += $total_product;
                                @endphp
                                <td>{{ number_format($total_product, 2, ',', '.') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3"> </td>
                            <td> <strong> Total do pedido: </strong> </td>
                            <td> {{ number_format($total_request, 2, ',', '.') }} </td>
                        </tr>
                    </tfoot>
                </table>
            @empty
                <h5 class="mt-4 text-center">
                    Nenhuma compra ainda foi cancelada
                </h5>
            @endforelse

        </div>
    </div>
    {{-- <script type="text/javascript" src="{{ asset('js/cart/index.js?v=1') }}"></script> --}}
@endsection

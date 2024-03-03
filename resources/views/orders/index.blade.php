@extends('layouts.app')

@section('content')
    <div class="container">
        {{--        <div class="container" id="delete-url" data-delete-url="{{ url('products') }}/">--}}
        @include('helpers.flash-messages')
        <div class="row">
            <div class="col-6">
                <h1>Zamówienie</h1>
            </div>
        </div>
        <div class="row justify-content-center">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Ilość</th>
                    <th scope="col">Cena [PLN]</th>
                    <th scope="col">Produkty</th>
                </tr>
                </thead>
                <tbody>
                @foreach($orders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->amount }}</td>
                        <td>{{ $order->price }}</td>
                        <td>
                            @foreach($order->products as $product)
                                <ul>
                                    <li>
                                        {{ $product->name }} - {{ $product->description }}
                                    </li>
                                </ul>
                            @endforeach
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{--            <div class="d-flex justify-content-center">--}}
            {{--                {{ $orders->links('pagination::bootstrap-4') }}--}}
            {{--            </div>--}}
        </div>
    </div>
@endsection

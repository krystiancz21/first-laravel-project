@extends('layouts.app')
@section('css-files')
    @vite('resources/css/cart.css')
@endsection
@section('content')
    <div class="container">
        @include('helpers.flash-messages')
        <div class="cart_section">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-10 offset-lg-1">
                        <div class="cart_container">
                            <div class="cart_title">Koszyk<small> ({{ $cart->getItems()->count() }}) </small></div>

                            <div class="cart_items" id="delete-url" data-delete-url="{{ url('cart') }}/">
                                <ul class="cart_list">
                                    @foreach($cart->getItems() as $item)
                                        <li class="row text-center justify-content-center cart_item clearfix align-items-center">
                                            <div class="col-md-2">
                                                <img src="{{ $item->getImage() }}" class="img-fluid mx-auto d-block" alt="Zdjęcie produktu">
                                            </div>
                                            <div class="col-md-3">
                                                <div class="cart_item_title">Nazwa</div>
                                                <div class="cart_item_text">{{ $item->getName() }}</div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="cart_item_title">Ilość</div>
                                                <div class="cart_item_text">{{ $item->getQuantity() }}</div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="cart_item_title">Cena [PLN]</div>
                                                <div class="cart_item_text">{{ $item->getPrice() }}</div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="cart_item_title">Suma [PLN]</div>
                                                <div class="cart_item_text">{{ $item->getSum() }}</div>
                                            </div>
                                            <div class="col-md-1">
                                                <button type="button" class="btn btn-danger btn-sm delete" data-id="{{ $item->getProductId() }}">
                                                    <i class="far fa-trash-alt"></i>
                                                </button>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="order_total">
                                <div class="order_total_content text-md-right">
                                    <div class="order_total_title">Order Total:</div>
                                    <div class="order_total_amount">{{ $cart->getSum() }} PLN</div>
                                </div>
                            </div>
                            <div class="cart_buttons">
                                <a href="/" class="button cart_button_clear">Wróć do sklepu</a>
                                <button type="button" class="button cart_button_checkout" disabled>Zapłać</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js-files')
    @vite('resources/js/delete.js')
@endsection

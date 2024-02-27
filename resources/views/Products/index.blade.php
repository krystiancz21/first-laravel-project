@extends('layouts.app')

@section('content')
    <div class="container" id="delete-url" data-delete-url="{{ url('products') }}/">
        @include('helpers.flash-messages')
        <div class="row">
            <div class="col-6">
                <h1>{{ __('shop.product.index_title') }}</h1>
            </div>
            <div class="col-6">
                <a class="d-flex justify-content-end" href="{{ route("products.create") }}">
                    <button type="button" class="btn btn-primary">
                        {{ __('shop.button.add') }}
                    </button>
                </a>
            </div>
        </div>
        <div class="row justify-content-center">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">{{ __('shop.product.fields.name') }}</th>
                    <th scope="col">{{ __('shop.product.fields.description') }}</th>
                    <th scope="col">{{ __('shop.product.fields.amount') }}</th>
                    <th scope="col">{{ __('shop.product.fields.price') }}</th>
                    <th scope="col">{{ __('shop.product.fields.category') }}</th>
                    <th scope="col">{{ __('shop.columns.actions') }}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($products as $product)
                    <tr>
                        <th scope="row">{{ $product->id }}</th>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->description }}</td>
                        <td>{{ $product->amount }}</td>
                        <td>{{ $product->price }}</td>
                        <td>@if($product->hasCategory())
                                {{ $product->category->name }}
                            @endif</td>
                        <td>
                            <a href="{{ route('products.show', $product->id) }}">
                                <button type="button" class="btn btn-primary primary">
                                    <i class="fa-solid fa-magnifying-glass-arrow-right"></i>
                                </button>
                            </a>
                            <a href="{{ route('products.edit', $product->id) }}">
                                <button type="button" class="btn btn-success success">
                                    <i class="fa-solid fa-pen"></i>
                                </button>
                            </a>
                            <button type="button" class="btn btn-danger delete" data-id="{{ $product->id  }}">
                                <i class="fa-solid fa-trash-can"></i>
                            </button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-center">
                {{ $products->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
@endsection
@section('javascript')
    {{--    const deleteUrl = "{{ url('users') }}/";--}}
@endsection
@section('js-files')
    @vite('resources/js/delete.js')
    {{--    <script src="{{ asset('js/delete.js') }}"></script>--}}
@endsection

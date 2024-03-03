@extends('layouts.app')

@section('content')
    <div class="container" id="delete-url" data-delete-url="{{ url('users') }}/">
        @include('helpers.flash-messages')
        <div class="row">
            <div class="col-6">
                <h1>{{ __('shop.user.index_title') }}</h1>
            </div>
        </div>
        <div class="row justify-content-center">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Email</th>
                    <th scope="col">{{ __('Name') }}</th>
                    <th scope="col">{{ __('Surname') }}</th>
                    <th scope="col">{{ __('Phone number') }}</th>
                    <th scope="col">Akcje</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <th scope="row">{{ $user->id }}</th>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->surname }}</td>
                        <td>{{ $user->phone_number }}</td>
                        <td>
                            <a href="{{ route('users.edit', $user->id) }}">
                                <button type="button" class="btn btn-success success">
                                    <i class="fa-solid fa-pen"></i>
                                </button>
                            </a>
                            <button type="button" class="btn btn-danger delete" data-id="{{ $user->id  }}">
                                <i class="fa-solid fa-trash-can"></i>
                            </button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-center">
                {{ $users->links('pagination::bootstrap-4') }}
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

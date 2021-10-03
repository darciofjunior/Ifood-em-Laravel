@extends('adminlte::page')

@section('title', 'Editar o Usuário {$user->name}')

@section('content_header')
    <h1>
        Editar o Usuário {{ $user->name }}
    </h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('users.update', $user->id) }}" class="form" method="post">
                @method('PUT')

                @include('admin.pages.users.partials.form')
            </form>
        </div>
    </div>
@endsection

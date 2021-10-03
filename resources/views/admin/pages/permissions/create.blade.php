@extends('adminlte::page')

@section('title', 'Cadastrar Nova Permissão')

@section('content_header')
    <h1>
        Cadastrar Nova Permissão
    </h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('permissions.store') }}" class="form" method="post">
                @include('admin.pages.permissions.partials.form')
            </form>
        </div>
    </div>
@endsection

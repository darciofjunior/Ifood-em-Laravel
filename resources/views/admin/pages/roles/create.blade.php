@extends('adminlte::page')

@section('title', 'Cadastrar Novo Cargo')

@section('content_header')
    <h1>
        Cadastrar Novo Cargo
    </h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('roles.store') }}" class="form" method="post">
                @include('admin.pages.roles.partials.form')
            </form>
        </div>
    </div>
@endsection

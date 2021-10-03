@extends('adminlte::page')

@section('title', 'Cadastrar Novo Plano')

@section('content_header')
    <h1>
        Cadastrar Novo Plano
    </h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('plans.store') }}" class="form" method="post">
                @include('admin.pages.plans.partials.form')
            </form>
        </div>
    </div>
@endsection

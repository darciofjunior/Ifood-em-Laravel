@extends('adminlte::page')

@section('title', 'Cadastrar Novo Produto')

@section('content_header')
    <h1>
        Cadastrar Novo Produto
    </h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('products.store') }}" class="form" method="post" enctype="multipart/form-data">
                @include('admin.pages.products.partials.form')
            </form>
        </div>
    </div>
@endsection

@extends('adminlte::page')

@section('title', 'Editar o Produto {$product->title}')

@section('content_header')
    <h1>
        Editar o Produto {{ $product->title }}
    </h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('products.update', $product->id) }}" class="form" method="post" enctype="multipart/form-data">
                @method('PUT')

                @include('admin.pages.products.partials.form')
            </form>
        </div>
    </div>
@endsection

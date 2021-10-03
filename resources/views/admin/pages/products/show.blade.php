@extends('adminlte::page')

@section('title', "Detalhes da Produto {$product->title}")

@section('content_header')
    <h1>
        Detalhes da Produto <b>{{ $product->title }}</b>
    </h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <ul>
                <img src="{{ url("storage/{$product->image}") }}" alt="{{ $product->title }}" style="max-width: 90px;">
                <li>
                    <strong>Título: </strong> {{ $product->title }}
                </li>
                <li>
                    <strong>Flag: </strong> {{ $product->flag }}
                </li>
                <li>
                    <strong>Descrição: </strong> {{ $product->description }}
                </li>
            </ul>

            @include('admin.includes.alerts')

            <form action="{{ route('products.destroy', $product->id) }}" method="post">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">
                    <i class="fas fa-trash"></i> 
                    DELETAR O PRODUTO {{ $product->title }}
                </button>
            </form>
        </div>
    </div>
@endsection

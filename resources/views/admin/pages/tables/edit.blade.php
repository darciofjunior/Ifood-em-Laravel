@extends('adminlte::page')

@section('title', 'Editar a Mesa {$table->identify}')

@section('content_header')
    <h1>
        Editar a Mesa {{ $table->identify }}
    </h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('tables.update', $table->id) }}" class="form" method="post">
                @method('PUT')

                @include('admin.pages.tables.partials.form')
            </form>
        </div>
    </div>
@endsection

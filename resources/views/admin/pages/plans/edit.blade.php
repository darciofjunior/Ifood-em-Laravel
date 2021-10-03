@extends('adminlte::page')

@section('title', 'Editar o Plano {$plan->name}')

@section('content_header')
    <h1>
        Editar o Plano {{ $plan->name }}
    </h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('plans.update', $plan->url) }}" class="form" method="post">
                @method('PUT')

                @include('admin.pages.plans.partials.form')
            </form>
        </div>
    </div>
@endsection

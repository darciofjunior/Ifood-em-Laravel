@include('admin.includes.alerts')

@csrf

<div class="form-group">
    <label>Nome:</label>
    <input type="text" name="name" value="{{ $detail->name ?? old('name') }}" placeholder="Nome" class="form-control">
</div>
<div class="form-group">
    <button type="submit" class="btn btn-info">Enviar</button>
</div>

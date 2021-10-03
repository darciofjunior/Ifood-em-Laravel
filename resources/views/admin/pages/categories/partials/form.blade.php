@include('admin.includes.alerts')

@csrf

<div class="form-group">
    <label>Nome: </label>
    <input type="text" name="name" value="{{ $category->name ?? old('name') }}" class="form-control" placeholder="Nome:">
</div>
<div class="form-group">
    <label>Descrição: </label>
    <textarea name="description" cols="30" rows="5" class="form-control">{{ $category->description ?? old('description') }}</textarea>
</div>
<div class="form-group">
    <button type="submit" class="btn btn-dark">Enviar</button>
</div>
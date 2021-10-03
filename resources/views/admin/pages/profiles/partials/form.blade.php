@include('admin.includes.alerts')

@csrf

<div class="form-group">
    <label>* Nome: </label>
    <input type="text" name="name" id="" value="{{ $profile->name ?? old('name') }}" class="form-control" placeholder="Nome:">
</div>
<div class="form-group">
    <label>Descrição: </label>
    <input type="text" name="description" id="" value="{{ $profile->description ?? old('description') }}" class="form-control" placeholder="Descrição:">
</div>
<div class="form-group">
    <button type="submit" class="btn btn-dark">Enviar</button>
</div>
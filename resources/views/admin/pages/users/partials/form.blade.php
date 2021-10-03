@include('admin.includes.alerts')

@csrf

<div class="form-group">
    <label>Nome: </label>
    <input type="text" name="name" value="{{ $user->name ?? old('name') }}" class="form-control" placeholder="Nome:">
</div>
<div class="form-group">
    <label>E-mail: </label>
    <input type="email" name="email" value="{{ $user->email ?? old('email') }}" class="form-control" placeholder="E-mail:">
</div>
<div class="form-group">
    <label>Senha: </label>
    <input type="password" name="password" class="form-control" placeholder="Senha:">
</div>
<div class="form-group">
    <button type="submit" class="btn btn-dark">Enviar</button>
</div>
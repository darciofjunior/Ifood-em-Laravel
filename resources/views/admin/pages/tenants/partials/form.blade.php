@include('admin.includes.alerts')

@csrf

<div class="form-group">
    <label>* Nome: </label>
    <input type="text" name="name" value="{{ $tenant->name ?? old('name') }}" class="form-control" placeholder="Título:">
</div>
<div class="form-group">
    <label>Logo: </label>
    <input type="file" name="logo" class="form-control">
</div>
<div class="form-group">
    <label>* E-mail: </label>
    <input type="email" name="email" value="{{ $tenant->email ?? old('email') }}" class="form-control" placeholder="E-mail">
</div>
<div class="form-group">
    <label>* CNPJ: </label>
    <input type="number" name="cnpj" value="{{ $tenant->cnpj ?? old('cnpj') }}" class="form-control" placeholder="CNPJ">
</div>
<div class="form-group">
    <label>* Ativo? </label>
    <select name="active" class="form-control">
        <option value="Y" @if(isset($tenant) && $tenant->active == 'Y') selected @endif>SIM</option>
        <option value="N" @if(isset($tenant) && $tenant->active == 'N') selected @endif>NÃO</option>
    </select>
</div>

<hr>

<h3>Assinatura</h3>

<div class="form-group">
    <label>Data Assinatura (início): </label>
    <input type="date" name="subscription" value="{{ $tenant->subscription ?? old('subscription') }}" class="form-control" placeholder="Data Assinatura">
</div>
<div class="form-group">
    <label>Expira (final): </label>
    <input type="date" name="expires_at" value="{{ $tenant->expires_at ?? old('expires_at') }}" class="form-control" placeholder="Expira">
</div>
<div class="form-group">
    <label>Identificador: </label>
    <input type="text" name="subscription_id" value="{{ $tenant->subscription_id ?? old('subscription_id') }}" class="form-control" placeholder="Identificador">
</div>
<div class="form-group">
    <label>* Assinatura Ativa? </label>
    <select name="subscription_active" class="form-control">
        <option value="1" @if(isset($tenant) && $tenant->subscription_active) selected @endif)>SIM</option>
        <option value="0" @if(isset($tenant) && !$tenant->subscription_active) selected @endif>NÃO</option>
    </select>
</div>
<div class="form-group">
    <label>* Assinatura Cancelada? </label>
    <select name="subscription_suspended" class="form-control">
        <option value="1" @if(isset($tenant) && $tenant->subscription_suspended) selected @endif)>SIM</option>
        <option value="0" @if(isset($tenant) && !$tenant->subscription_suspended) selected @endif>NÃO</option>
    </select>
</div>
<div class="form-group">
    <button type="submit" class="btn btn-dark">Enviar</button>
</div>
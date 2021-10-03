@include('admin.includes.alerts')

@csrf

<div class="form-group">
    <label>* Título: </label>
    <input type="text" name="title" value="{{ $product->title ?? old('title') }}" class="form-control" placeholder="Título:">
</div>
<div class="form-group">
    <label>* Preço: </label>
    <input type="text" name="price" value="{{ $product->price ?? old('price') }}" class="form-control" placeholder="Preço:">
</div>
<div class="form-group">
    <label>* Imagem: </label>
    <input type="file" name="image" class="form-control">
</div>
<div class="form-group">
    <label>* Descrição: </label>
    <textarea name="description" cols="30" rows="5" class="form-control">{{ $product->description ?? old('description') }}</textarea>
</div>
<div class="form-group">
    <button type="submit" class="btn btn-dark">Enviar</button>
</div>
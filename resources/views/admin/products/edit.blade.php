@extends('layouts.app')

@section('content')
<h1 class="text-2xl font-bold mb-4">Edit Product</h1>

<form class="bg-white border rounded-xl p-5" method="post" enctype="multipart/form-data" action="{{ route('admin.products.update', $product) }}">
  @csrf @method('PUT')

  <label class="block mb-2">Category</label>
  <select name="category_id" class="w-full border rounded px-3 py-2 mb-4" required>
    @foreach($categories as $c)
      <option value="{{ $c->id }}" @selected($product->category_id === $c->id)>{{ $c->name }}</option>
    @endforeach
  </select>

  <label class="block mb-2">Name</label>
  <input name="name" value="{{ $product->name }}" class="w-full border rounded px-3 py-2 mb-4" required>

  <div class="grid md:grid-cols-2 gap-4">
    <div>
      <label class="block mb-2">Price (BDT)</label>
      <input type="number" name="price" min="0" value="{{ $product->price }}" class="w-full border rounded px-3 py-2 mb-4" required>
    </div>
    <div>
      <label class="block mb-2">Stock</label>
      <input type="number" name="stock" min="0" value="{{ $product->stock }}" class="w-full border rounded px-3 py-2 mb-4" required>
    </div>
  </div>

  <label class="block mb-2">Description</label>
  <textarea name="description" class="w-full border rounded px-3 py-2 mb-4" rows="3">{{ $product->description }}</textarea>

  <label class="flex items-center gap-2 mb-4">
    <input type="checkbox" name="is_active" value="1" @checked($product->is_active)>
    Active
  </label>

  <label class="block mb-2">Replace Image</label>
  <input type="file" name="image" class="w-full border rounded px-3 py-2 mb-5">

  <button class="px-4 py-2 rounded bg-gray-900 text-white">Update</button>
</form>
@endsection

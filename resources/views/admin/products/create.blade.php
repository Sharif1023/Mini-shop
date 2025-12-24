@extends('layouts.app')

@section('content')
<h1 class="text-2xl font-bold mb-4">Add Product</h1>

{{-- success message --}}
@if(session('ok'))
  <div class="mb-4 p-3 rounded bg-green-100 text-green-800">
    {{ session('ok') }}
  </div>
@endif

{{-- errors --}}
@if($errors->any())
  <div class="mb-4 p-3 rounded bg-red-100 text-red-800">
    <ul class="list-disc pl-5">
      @foreach($errors->all() as $e)
        <li>{{ $e }}</li>
      @endforeach
    </ul>
  </div>
@endif

{{-- ✅ QUICK ADD CATEGORY (Form OUTSIDE product form) --}}
<div class="mb-6 bg-white border rounded-xl p-5 max-w-xl">
  <div class="font-semibold mb-2">Quick Add Category</div>

  <form method="POST" action="{{ route('admin.categories.quick') }}" class="flex gap-2">
    @csrf
    <input name="name"
           value="{{ old('name') }}"
           placeholder="New category name"
           class="flex-1 border rounded px-3 py-2"
           required>
    <button class="px-4 py-2 rounded bg-gray-900 text-white">Add</button>
  </form>

  <p class="text-xs text-gray-500 mt-2">
    Add করার পর page reload হবে—তারপর নিচের dropdown এ category দেখাবে।
  </p>
</div>

{{-- ✅ PRODUCT FORM (separate) --}}
<form method="POST"
      action="{{ route('admin.products.store') }}"
      enctype="multipart/form-data"
      class="bg-white border rounded-xl p-5 max-w-xl">
  @csrf

  <label class="block mb-2">Category</label>
  <select name="category_id" class="w-full border rounded px-3 py-2 mb-4" required>
    @forelse($categories as $c)
      <option value="{{ $c->id }}">{{ $c->name }}</option>
    @empty
      <option value="">No categories found</option>
    @endforelse
  </select>

  <label class="block mb-2">Product Name</label>
  <input name="name" class="w-full border rounded px-3 py-2 mb-4" required>

  <div class="grid md:grid-cols-2 gap-4">
    <div>
      <label class="block mb-2">Price</label>
      <input type="number" name="price" min="0" class="w-full border rounded px-3 py-2 mb-4" required>
    </div>
    <div>
      <label class="block mb-2">Stock</label>
      <input type="number" name="stock" min="0" class="w-full border rounded px-3 py-2 mb-4" required>
    </div>
  </div>

  <label class="block mb-2">Description</label>
  <textarea name="description" class="w-full border rounded px-3 py-2 mb-4" rows="3"></textarea>

  <label class="block mb-2">Image</label>
  <input type="file" name="image" class="w-full border rounded px-3 py-2 mb-5">

  <button class="px-4 py-2 rounded bg-gray-900 text-white">Save Product</button>
</form>
@endsection

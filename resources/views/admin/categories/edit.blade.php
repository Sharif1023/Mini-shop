@extends('layouts.app')

@section('content')
<h1 class="text-2xl font-bold mb-4">Edit Category</h1>

<form method="POST"
      action="{{ route('admin.categories.update', $category) }}"
      class="bg-white border rounded-xl p-5 max-w-md">
  @csrf @method('PUT')

  <label class="block mb-2">Category Name</label>
  <input type="text" name="name"
         value="{{ $category->name }}"
         class="w-full border rounded px-3 py-2 mb-4"
         required>

  <button class="px-4 py-2 bg-gray-900 text-white rounded">
    Update
  </button>
</form>
@endsection

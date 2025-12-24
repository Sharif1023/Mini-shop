@extends('layouts.app')

@section('content')
<h1 class="text-2xl font-bold mb-4">Add Category</h1>

@if($errors->any())
<div class="mb-4 bg-red-100 text-red-700 p-3 rounded">
  <ul class="list-disc pl-5">
    @foreach($errors->all() as $e)
      <li>{{ $e }}</li>
    @endforeach
  </ul>
</div>
@endif

<form method="POST" action="{{ route('admin.categories.store') }}"
      class="bg-white border rounded-xl p-5 max-w-md">
  @csrf

  <label class="block mb-2">Category Name</label>
  <input type="text" name="name"
         class="w-full border rounded px-3 py-2 mb-4"
         required>

  <button class="px-4 py-2 bg-gray-900 text-white rounded">
    Save
  </button>
</form>
@endsection

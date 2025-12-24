@extends('layouts.app')

@section('content')
<div class="flex justify-between items-center mb-4">
  <h1 class="text-2xl font-bold">Categories</h1>
  <a href="{{ route('admin.categories.create') }}"
     class="px-4 py-2 bg-gray-900 text-white rounded">
     Add Category
  </a>
</div>

<div class="bg-white border rounded-xl overflow-hidden">
  <table class="w-full text-left">
    <thead class="bg-gray-50">
      <tr>
        <th class="p-3">Name</th>
        <th class="p-3">Slug</th>
        <th class="p-3">Action</th>
      </tr>
    </thead>
    <tbody>
      @foreach($categories as $cat)
      <tr class="border-t">
        <td class="p-3">{{ $cat->name }}</td>
        <td class="p-3 text-gray-600">{{ $cat->slug }}</td>
        <td class="p-3 flex gap-3">
          <a href="{{ route('admin.categories.edit', $cat) }}"
             class="underline">Edit</a>

          <form method="POST" action="{{ route('admin.categories.destroy', $cat) }}">
            @csrf @method('DELETE')
            <button class="underline text-red-600"
              onclick="return confirm('Delete this category?')">
              Delete
            </button>
          </form>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>

<div class="mt-5">
  {{ $categories->links() }}
</div>
@endsection

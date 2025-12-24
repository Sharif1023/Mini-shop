@extends('layouts.app')

@section('content')
<div class="flex items-center justify-between mb-4">
  <h1 class="text-2xl font-bold">Admin Products</h1>
  <a class="px-4 py-2 rounded bg-gray-900 text-white" href="{{ route('admin.products.create') }}">Add Product</a>
</div>

<div class="bg-white border rounded-xl overflow-hidden">
  <table class="w-full text-left">
    <thead class="bg-gray-50">
      <tr>
        <th class="p-3">Name</th>
        <th class="p-3">Category</th>
        <th class="p-3">Price</th>
        <th class="p-3">Stock</th>
        <th class="p-3">Active</th>
        <th class="p-3"></th>
      </tr>
    </thead>
    <tbody>
      @foreach($products as $p)
        <tr class="border-t">
          <td class="p-3">{{ $p->name }}</td>
          <td class="p-3">{{ $p->category?->name }}</td>
          <td class="p-3">BDT {{ $p->price }}</td>
          <td class="p-3">{{ $p->stock }}</td>
          <td class="p-3">{{ $p->is_active ? 'Yes' : 'No' }}</td>
          <td class="p-3 flex gap-2">
            <a class="underline" href="{{ route('admin.products.edit', $p) }}">Edit</a>
            <form method="post" action="{{ route('admin.products.destroy', $p) }}">
              @csrf @method('DELETE')
              <button class="underline text-red-600">Delete</button>
            </form>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
</div>

<div class="mt-6">{{ $products->links() }}</div>
<div class="mt-6">
  <a class="underline" href="{{ route('admin.orders.index') }}">Go to Orders</a>
</div>
@endsection

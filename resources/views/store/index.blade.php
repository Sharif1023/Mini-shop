@extends('layouts.app')

@section('content')
<div class="flex flex-col md:flex-row gap-4 md:items-end md:justify-between">
  <form class="flex gap-2 w-full md:w-auto" method="get" action="{{ route('store.index') }}">
    <input name="q" value="{{ $q }}" placeholder="Search products..."
           class="w-full md:w-72 border rounded px-3 py-2" />
    <select name="category" class="border rounded px-3 py-2">
      <option value="">All</option>
      @foreach($categories as $c)
        <option value="{{ $c->slug }}" @selected($cat === $c->slug)>{{ $c->name }}</option>
      @endforeach
    </select>
    <button class="px-4 py-2 rounded bg-gray-900 text-white">Go</button>
  </form>

  <a href="/admin" class="text-sm underline text-gray-600">Admin</a>
</div>

<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5 mt-6">
  @foreach($products as $p)
    <div class="bg-white border rounded-xl p-4">
      @if($p->image)
        <img class="w-full h-44 object-cover rounded-lg mb-3"
             src="{{ asset('storage/'.$p->image) }}" alt="{{ $p->name }}">
      @endif

      <div class="font-semibold text-lg">{{ $p->name }}</div>
      <div class="text-gray-600">BDT {{ $p->price }}</div>

      <div class="mt-3 flex gap-2">
        <a href="{{ route('store.show', $p->slug) }}"
           class="px-3 py-2 rounded border">View</a>

        <form method="post" action="{{ route('cart.add', $p->id) }}">
          @csrf
          <button class="px-3 py-2 rounded bg-gray-900 text-white">Add</button>
        </form>
      </div>
    </div>
  @endforeach
</div>

<div class="mt-6">{{ $products->links() }}</div>
@endsection

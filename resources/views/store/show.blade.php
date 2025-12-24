@extends('layouts.app')

@section('content')
<div class="bg-white border rounded-xl p-5 grid md:grid-cols-2 gap-6">
  <div>
    @if($product->image)
      <img class="w-full h-80 object-cover rounded-xl"
           src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->name }}">
    @else
      <div class="w-full h-80 bg-gray-100 rounded-xl"></div>
    @endif
  </div>

  <div>
    <h1 class="text-2xl font-bold">{{ $product->name }}</h1>
    <p class="text-gray-600 mt-1">BDT {{ $product->price }}</p>
    <p class="mt-4 text-gray-700">{{ $product->description }}</p>
    <p class="mt-3 text-sm text-gray-500">Stock: {{ $product->stock }}</p>

    <form class="mt-5 flex gap-2 items-center" method="post" action="{{ route('cart.add', $product->id) }}">
      @csrf
      <input type="number" name="qty" value="1" min="1"
             class="w-24 border rounded px-3 py-2"/>
      <button class="px-4 py-2 rounded bg-gray-900 text-white">Add to cart</button>
    </form>
  </div>
</div>
@endsection

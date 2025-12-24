@extends('layouts.app')

@section('content')
<h1 class="text-2xl font-bold mb-4">Your Cart</h1>

@if(empty($cart))
  <div class="p-4 bg-white border rounded-xl">Cart is empty.</div>
  <a class="inline-block mt-4 underline" href="{{ route('store.index') }}">Go shopping</a>
@else
  <div class="bg-white border rounded-xl overflow-hidden">
    <table class="w-full text-left">
      <thead class="bg-gray-50">
        <tr>
          <th class="p-3">Product</th>
          <th class="p-3">Price</th>
          <th class="p-3">Qty</th>
          <th class="p-3">Subtotal</th>
          <th class="p-3"></th>
        </tr>
      </thead>
      <tbody>
        @foreach($cart as $item)
          <tr class="border-t">
            <td class="p-3">{{ $item['name'] }}</td>
            <td class="p-3">BDT {{ $item['price'] }}</td>
            <td class="p-3">
              <form class="flex gap-2" method="post" action="{{ route('cart.update', $item['product_id']) }}">
                @csrf
                <input type="number" name="qty" min="1" value="{{ $item['qty'] }}"
                       class="w-24 border rounded px-2 py-1"/>
                <button class="px-3 py-1 rounded bg-gray-900 text-white">Update</button>
              </form>
            </td>
            <td class="p-3">BDT {{ $item['subtotal'] }}</td>
            <td class="p-3">
              <form method="post" action="{{ route('cart.remove', $item['product_id']) }}">
                @csrf
                <button class="underline text-red-600">Remove</button>
              </form>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>

  <div class="mt-4 flex items-center justify-between">
    <div class="text-lg font-semibold">Total: BDT {{ $total }}</div>
    <div class="flex gap-2">
      <form method="post" action="{{ route('cart.clear') }}">
        @csrf
        <button class="px-4 py-2 rounded border">Clear</button>
      </form>
      <a href="{{ route('checkout.form') }}" class="px-4 py-2 rounded bg-green-600 text-white">
        Checkout
      </a>
    </div>
  </div>
@endif
@endsection

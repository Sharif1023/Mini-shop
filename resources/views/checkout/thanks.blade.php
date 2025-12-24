@extends('layouts.app')

@section('content')
<div class="bg-white border rounded-xl p-6">
  <h1 class="text-2xl font-bold">Order Placed ✅</h1>
  <p class="mt-2 text-gray-700">Your Order ID: <b>#{{ $order->id }}</b></p>
  <p class="mt-1 text-gray-600">Status: {{ $order->status }}</p>

  <div class="mt-5">
    <div class="font-semibold mb-2">Items</div>
    @foreach($order->items as $it)
      <div class="flex justify-between py-2 border-b">
        <div>{{ $it->product?->name }} × {{ $it->qty }}</div>
        <div>BDT {{ $it->subtotal }}</div>
      </div>
    @endforeach
    <div class="flex justify-between mt-4 font-bold">
      <div>Total</div>
      <div>BDT {{ $order->total_amount }}</div>
    </div>
  </div>

  <a class="inline-block mt-6 underline" href="{{ route('store.index') }}">Back to shop</a>
</div>
@endsection

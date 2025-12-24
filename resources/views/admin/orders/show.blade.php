@extends('layouts.app')

@section('content')
<h1 class="text-2xl font-bold mb-2">Order #{{ $order->id }}</h1>
<p class="text-gray-600 mb-4">{{ $order->name }} — {{ $order->phone }}</p>

<div class="bg-white border rounded-xl p-5 mb-5">
  <div class="font-semibold mb-2">Address</div>
  <div>{{ $order->address }}</div>
</div>

<div class="bg-white border rounded-xl p-5 mb-5">
  <div class="font-semibold mb-3">Items</div>
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

<form class="bg-white border rounded-xl p-5" method="post" action="{{ route('admin.orders.status', $order) }}">
  @csrf
  <label class="block mb-2 font-semibold">Update Status</label>
  <select name="status" class="border rounded px-3 py-2">
    @foreach(['pending','confirmed','delivered','cancelled'] as $s)
      <option value="{{ $s }}" @selected($order->status === $s)>{{ $s }}</option>
    @endforeach
  </select>
  <button class="ml-2 px-4 py-2 rounded bg-gray-900 text-white">Save</button>
</form>
@endsection

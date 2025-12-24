@extends('layouts.app')

@section('content')
<h1 class="text-2xl font-bold mb-4">Checkout</h1>

@if($errors->any())
  <div class="mb-4 p-3 rounded bg-red-100 text-red-800">
    <ul class="list-disc pl-5">
      @foreach($errors->all() as $e) <li>{{ $e }}</li> @endforeach
    </ul>
  </div>
@endif

<div class="grid md:grid-cols-2 gap-6">
  <form class="bg-white border rounded-xl p-5" method="post" action="{{ route('checkout.place') }}">
    @csrf
    <label class="block mb-2">Name</label>
    <input name="name" class="w-full border rounded px-3 py-2 mb-4" required>

    <label class="block mb-2">Phone</label>
    <input name="phone" class="w-full border rounded px-3 py-2 mb-4" required>

    <label class="block mb-2">Address</label>
    <textarea name="address" class="w-full border rounded px-3 py-2 mb-4" rows="3" required></textarea>

    <button class="px-4 py-2 rounded bg-gray-900 text-white w-full">
      Place Order (BDT {{ $total }})
    </button>
  </form>

  <div class="bg-white border rounded-xl p-5">
    <div class="font-semibold mb-3">Order Summary</div>
    @foreach($cart as $item)
      <div class="flex justify-between py-2 border-b">
        <div>{{ $item['name'] }} × {{ $item['qty'] }}</div>
        <div>BDT {{ $item['subtotal'] }}</div>
      </div>
    @endforeach
    <div class="flex justify-between mt-4 font-bold">
      <div>Total</div>
      <div>BDT {{ $total }}</div>
    </div>
  </div>
</div>
@endsection

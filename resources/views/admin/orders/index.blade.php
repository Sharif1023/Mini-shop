@extends('layouts.app')

@section('content')
<h1 class="text-2xl font-bold mb-4">Admin Orders</h1>

<div class="bg-white border rounded-xl overflow-hidden">
  <table class="w-full text-left">
    <thead class="bg-gray-50">
      <tr>
        <th class="p-3">Order</th>
        <th class="p-3">Name</th>
        <th class="p-3">Phone</th>
        <th class="p-3">Total</th>
        <th class="p-3">Status</th>
        <th class="p-3"></th>
      </tr>
    </thead>
    <tbody>
      @foreach($orders as $o)
        <tr class="border-t">
          <td class="p-3">#{{ $o->id }}</td>
          <td class="p-3">{{ $o->name }}</td>
          <td class="p-3">{{ $o->phone }}</td>
          <td class="p-3">BDT {{ $o->total_amount }}</td>
          <td class="p-3">{{ $o->status }}</td>
          <td class="p-3">
            <a class="underline" href="{{ route('admin.orders.show', $o) }}">View</a>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
</div>

<div class="mt-6">{{ $orders->links() }}</div>
@endsection

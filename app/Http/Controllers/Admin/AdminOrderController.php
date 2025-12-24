<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class AdminOrderController extends Controller
{
  public function index() {
    $orders = Order::latest()->paginate(20);
    return view('admin.orders.index', compact('orders'));
  }

  public function show(Order $order) {
    $order->load('items.product');
    return view('admin.orders.show', compact('order'));
  }

  public function updateStatus(Request $request, Order $order) {
    $data = $request->validate([
      'status' => 'required|in:pending,confirmed,delivered,cancelled',
    ]);
    $order->update($data);
    return back()->with('ok', 'Status updated');
  }
}

<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
  public function form() {
    $cart = session()->get('cart', []);
    if (empty($cart)) return redirect()->route('store.index')->with('ok', 'Cart is empty');
    $total = array_sum(array_column($cart, 'subtotal'));
    return view('checkout.form', compact('cart','total'));
  }

  public function place(Request $request) {
    $cart = session()->get('cart', []);
    if (empty($cart)) return redirect()->route('store.index');

    $data = $request->validate([
      'name' => 'required|string|max:120',
      'phone' => 'required|string|max:30',
      'address' => 'required|string|max:255',
    ]);

    $total = array_sum(array_column($cart, 'subtotal'));

    $orderId = DB::transaction(function () use ($data, $cart, $total) {
      // Optional: stock check
      foreach ($cart as $item) {
        $p = Product::lockForUpdate()->find($item['product_id']);
        if (!$p || !$p->is_active) abort(400, 'Invalid product in cart');
        if ($p->stock < $item['qty']) abort(400, "Stock not available: {$p->name}");
        $p->decrement('stock', $item['qty']);
      }

      $order = Order::create([
        ...$data,
        'total_amount' => (int) $total,
        'status' => 'pending',
      ]);

      foreach ($cart as $item) {
        OrderItem::create([
          'order_id' => $order->id,
          'product_id' => $item['product_id'],
          'price' => (int) $item['price'],
          'qty' => (int) $item['qty'],
          'subtotal' => (int) $item['subtotal'],
        ]);
      }

      return $order->id;
    });

    session()->forget('cart');
    return redirect()->route('checkout.thanks', $orderId);
  }

  public function thanks(int $orderId) {
    $order = Order::with('items.product')->findOrFail($orderId);
    return view('checkout.thanks', compact('order'));
  }
}

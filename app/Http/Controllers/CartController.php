<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
  private function cart(): array {
    return session()->get('cart', []);
  }

  public function index() {
    $cart = $this->cart();
    $total = array_sum(array_map(fn($i) => $i['subtotal'], $cart));
    return view('cart.index', compact('cart','total'));
  }

  public function add(Request $request, int $productId) {
    $product = Product::where('is_active', true)->findOrFail($productId);

    $qty = (int) $request->input('qty', 1);
    if ($qty < 1) $qty = 1;

    $cart = $this->cart();

    if (isset($cart[$product->id])) {
      $cart[$product->id]['qty'] += $qty;
    } else {
      $cart[$product->id] = [
        'product_id' => $product->id,
        'name' => $product->name,
        'price' => (int) $product->price,
        'qty' => $qty,
        'image' => $product->image,
      ];
    }

    $cart[$product->id]['subtotal'] = $cart[$product->id]['price'] * $cart[$product->id]['qty'];

    session()->put('cart', $cart);
    return redirect()->route('cart.index')->with('ok', 'Added to cart');
  }

  public function update(Request $request, int $productId) {
    $qty = (int) $request->input('qty', 1);
    if ($qty < 1) $qty = 1;

    $cart = $this->cart();
    if (!isset($cart[$productId])) return back();

    $cart[$productId]['qty'] = $qty;
    $cart[$productId]['subtotal'] = $cart[$productId]['price'] * $qty;

    session()->put('cart', $cart);
    return back()->with('ok', 'Cart updated');
  }

  public function remove(int $productId) {
    $cart = $this->cart();
    unset($cart[$productId]);
    session()->put('cart', $cart);
    return back()->with('ok', 'Removed');
  }

  public function clear() {
    session()->forget('cart');
    return back()->with('ok', 'Cart cleared');
  }
}

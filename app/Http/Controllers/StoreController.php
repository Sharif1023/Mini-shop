<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class StoreController extends Controller
{
  public function index(Request $request) {
    $q = $request->query('q');
    $cat = $request->query('category');

    $categories = Category::orderBy('name')->get();

    $products = Product::query()
      ->where('is_active', true)
      ->when($q, fn($qq) => $qq->where('name', 'like', "%{$q}%"))
      ->when($cat, fn($qq) => $qq->whereHas('category', fn($c) => $c->where('slug', $cat)))
      ->latest()
      ->paginate(12)
      ->withQueryString();

    return view('store.index', compact('products','categories','q','cat'));
  }

  public function show(string $slug) {
    $product = Product::where('slug', $slug)->where('is_active', true)->firstOrFail();
    return view('store.show', compact('product'));
  }
}

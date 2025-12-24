<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
  public function run(): void
  {
    // 24 dummy products
    Product::factory()->count(24)->create();
  }
}

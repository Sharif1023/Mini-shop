<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
  public function run(): void
  {
    $cats = [
      'T-Shirts',
      'Hoodies',
      'Pants',
      'Shoes',
      'Accessories',
    ];

    foreach ($cats as $name) {
      Category::updateOrCreate(
        ['slug' => Str::slug($name)],
        ['name' => $name, 'slug' => Str::slug($name)]
      );
    }
  }
}

<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Category;

class ProductFactory extends Factory
{
  public function definition(): array
  {
    $name = $this->faker->unique()->words(3, true); // e.g. "classic cotton tee"

    return [
      'category_id' => Category::inRandomOrder()->value('id') ?? 1,
      'name' => ucwords($name),
      'slug' => Str::slug($name) . '-' . Str::random(4),
      'price' => $this->faker->numberBetween(199, 1999),
      'stock' => $this->faker->numberBetween(0, 50),
      'image' => null, // later upload from admin
      'description' => $this->faker->sentence(14),
      'is_active' => true,
    ];
  }
}

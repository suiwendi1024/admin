<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = Category::where('type', 'shop')
            ->where('parent_id', '!=', 0)
            ->get();

        for ($i = 0; $i < 100; $i++) {
            Product::factory()
                ->for($categories->random())
                ->create();
        }
    }
}

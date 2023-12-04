<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 10; $i++) {
            $parent = Category::factory()->create([
                'type' => 'shop',
                'number' => $i,
            ]);
            for ($j = 0; $j < 4; $j++) {
                Category::factory()->for($parent, 'parent')->create([
                    'type' => 'shop',
                    'number' => $j,
                ]);
            }

            $parent = Category::factory()->create([
                'type' => 'blog',
                'number' => $i,
            ]);
            for ($j = 0; $j < 4; $j++) {
                Category::factory()->for($parent, 'parent')->create([
                    'type' => 'blog',
                    'number' => $j,
                ]);
            }
        }
    }
}

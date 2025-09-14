<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Book;
use App\Models\Category;

class BookSeeder extends Seeder
{
    public function run(): void
    {
        $categories = Category::all();

        // Create 5 books for each category
        foreach ($categories as $category) {
            Book::factory()->count(5)->create([
                'category_id' => $category->id,
            ]);
        }
    }
}

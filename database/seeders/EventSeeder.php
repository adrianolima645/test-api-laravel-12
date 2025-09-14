<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Event;
use App\Models\User;
use App\Models\Book;

class EventSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::all();
        $books = Book::all();

        foreach ($users as $user) {
            // Each user gets 3 events randomly
            Event::factory()->count(3)->create([
                'user_id' => $user->id,
                'book_id' => $books->random()->id,
            ]);
        }
    }
}

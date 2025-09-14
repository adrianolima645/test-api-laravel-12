<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Event;
use App\Models\Book;
use App\Models\User;

class EventFactory extends Factory
{
    protected $model = Event::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(), // creates user if none exists
            'book_id' => Book::factory(), // creates book if none exists
            'type' => $this->faker->randomElement(['borrow', 'return', 'reservation']),
            'event_date' => $this->faker->dateTimeBetween('-1 month', '+1 month'),
        ];
    }
}

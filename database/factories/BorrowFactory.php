<?php

namespace Database\Factories;

use App\Models\Book;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Borrow>
 */
class BorrowFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'reader_id'=>User::factory(),
            'book_id'=>Book::factory(),
            'status'=>$this->faker->randomElement(['PENDING','ACCEPTED','REJECTED','RETURNED']),
            'request_process_at'=>$this->faker->dateTime(),
            'request_managed_by'=>User::factory(),
            'deadline'=>$this->faker->dateTime(),
            'returned_at'=>$this->faker->dateTime(),
            'return_managed_by'=>User::factory(),
        ];
    }
}

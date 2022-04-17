<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Genre;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('books')->truncate();
        $genres = Genre::all();
        Book::factory()->count(10)->create() -> each(function ($book) use ($genres) {
            for ($i = 0; $i < random_int(1,8); $i++) {
                $book-> genres() -> toggle($genres[random_int(0, 5)]);
            }
        });
    }
}

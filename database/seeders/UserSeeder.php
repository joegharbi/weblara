<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('genres')->truncate();
        User::factory(3)->create();
        User::create([
            'name' => 'Reader Test',
            'email' => 'reader@brs.com',
            'password' => Hash::make('password'),
        ]);
        User::create([
            'name' => 'Librarian Test',
            'email' => 'librarian@brs.com',
            'password' => Hash::make('password'),
            'is_librarian'=> 1
        ]);
    }
}

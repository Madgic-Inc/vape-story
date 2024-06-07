<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        // Crie usuários aqui com o método DB::table('users')->insert()
        DB::table('users')->insert([
            [
                'name' => 'Taynara',
                'email' => 'taynara@gmail.com',
                'password' => bcrypt('taynara2024'),
            ],
        ]);
    }
}

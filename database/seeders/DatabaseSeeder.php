<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        // for ($i = 0; $i < 10; $i++) {
            \DB::table('users') -> insert([
                'login_name' => "ManhKhanh",
                'user_name' => "Mạnh Khánh",
                'role_id' => 1,
                'email' => "manhkhanh@test.com",
                'password' => "123456789"
            ]);
        // }
        Schema::enableForeignKeyConstraints();
    }
}

<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'Jeysson Manuel Sánchez Rodríguez',
                'email' => 'jeysson_s.r@hotmail.com',
                'password' => Hash::make('jeysson12345')
            ],
        ]);
    }
}

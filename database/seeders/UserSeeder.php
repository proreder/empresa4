<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Creamos los usuarios
        User::create([
            'name'      => 'Juan Francico Vico Martínez',
            'email'     => 'juan@hotmail.com',
            'password'  =>  bcrypt('12345678')
        ])->assignRole('Admin');

        User::create([
            'name'      => 'Jose Carmona',
            'email'     => 'jose@hotmail.com',
            'password'  =>  bcrypt('12345678')
        ])->assignRole('Usuario');

        User::factory()->create();
    }   
}

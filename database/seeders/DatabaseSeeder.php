<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

         \App\Models\User::factory()->create([
             'name' => 'Admin',
             'email' => 'admin@gmail.com',
             'password' => 'password',
             'is_admin' => '1'
         ]);

         \App\Models\User::factory()->create([
            'name' => 'Technician',
            'email' => 'tech@gmail.com',
            'password' => 'password',
            'is_admin' => '2'
        ]);

        \App\Models\User::factory()->create([
            'name' => 'Patient',
            'email' => 'patient@gmail.com',
            'password' => 'password',
            'is_admin' => '0'
        ]);


    }
}

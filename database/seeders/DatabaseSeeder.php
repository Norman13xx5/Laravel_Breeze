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
        //Roles y Permisos
        $this->call(RoleSeede::class);
        //Usuarios base
        $this->call(UserSeed::class);

        \App\Models\User::factory(10)->create()->each(function ($user) {
            $user->assignRole('developer');
        });

        // \App\Models\User::factory()->create([
        //     'name' => 'Brayan Guillermo Diaz Martinez',
        //     'email' => 'brahyan.com@gmail.com',
        // ]);
    }
}

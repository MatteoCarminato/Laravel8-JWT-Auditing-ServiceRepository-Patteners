<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Adding an admin user
        User::factory()
            ->count(1)
            ->create([
                'name' => 'Administrador',
                'email' => 'admin@admin.com',
                'password' => md5('1234'),
            ]);

        $this->call(CompanySeeder::class);
        $this->call(UserSeeder::class);
    }
}

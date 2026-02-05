<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create specific test users with known credentials
        $testUsers = [
            [
                'username' => 'testuser1',
                'name' => 'Test User One',
                'email' => 'test1@example.com',
                'password' => Hash::make('password123'),
                'is_active' => true,
                'last_login' => null,
            ],
            [
                'username' => 'testuser2',
                'name' => 'Test User Two',
                'email' => 'test2@example.com',
                'password' => Hash::make('password123'),
                'is_active' => true,
                'last_login' => null,
            ],
            [
                'username' => 'testuser3',
                'name' => 'Test User Three',
                'email' => 'test3@example.com',
                'password' => Hash::make('password123'),
                'is_active' => true,
                'last_login' => null,
            ],
            [
                'username' => 'testuser4',
                'name' => 'Test User Four',
                'email' => 'test4@example.com',
                'password' => Hash::make('password123'),
                'is_active' => true,
                'last_login' => null,
            ],
            [
                'username' => 'testuser5',
                'name' => 'Test User Five',
                'email' => 'test5@example.com',
                'password' => Hash::make('password123'),
                'is_active' => true,
                'last_login' => null,
            ],
        ];

        // Create test users
        foreach ($testUsers as $userData) {
            User::create($userData);
        }

        // Create 95 additional random users using the factory
        User::factory(95)->create();

        $this->command->info('Created 5 test users with credentials:');
        $this->command->info('- Username: testuser1, Password: password123');
        $this->command->info('- Username: testuser2, Password: password123');
        $this->command->info('- Username: testuser3, Password: password123');
        $this->command->info('- Username: testuser4, Password: password123');
        $this->command->info('- Username: testuser5, Password: password123');
        $this->command->info('Plus 95 additional random users created.');
    }
}

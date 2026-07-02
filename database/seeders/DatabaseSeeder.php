<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role; // Idinagdag para makagawa ng Roles

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Gagawa muna tayo ng Roles sa database
        $adminRole = Role::create(['name' => 'admin']);
        $studentRole = Role::create(['name' => 'student']);

        // 2. Gagawa ng Admin account at bibigyan ng 'admin' role
        $admin = User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@test.com',
            'password' => Hash::make('password123'),
        ]);
        $admin->assignRole($adminRole);

        // 3. Gagawa ng Student 1 at bibigyan ng 'student' role
        $student1 = User::factory()->create([
            'name' => 'Student One',
            'email' => 'student1@test.com',
            'password' => Hash::make('password123'),
        ]);
        $student1->assignRole($studentRole);

        // 4. Gagawa ng Student 2 at bibigyan ng 'student' role
        $student2 = User::factory()->create([
            'name' => 'Student Two',
            'email' => 'student2@test.com',
            'password' => Hash::make('password123'),
        ]);
        $student2->assignRole($studentRole);
    }
}
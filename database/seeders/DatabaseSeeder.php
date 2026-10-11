<?php

namespace Database\Seeders;

use App\Models\Branch;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // The three branches from the assignment
        $male = Branch::create(['name' => 'Branch 1', 'district' => 'Malé']);
        Branch::create(['name' => 'Branch 2', 'district' => 'Hulhumalé']);
        Branch::create(['name' => 'Branch 3', 'district' => 'Villingili']);

        // One test login per role. Every password is "password".
        $users = [
            ['name' => 'System Admin', 'email' => 'admin@example.com', 'phone' => '7770001', 'role' => 'admin', 'branch_id' => $male->id],
            ['name' => 'Branch Manager', 'email' => 'manager@example.com', 'phone' => '7770002', 'role' => 'manager', 'branch_id' => $male->id],
            ['name' => 'Ahmed Afzal', 'email' => 'specialist@example.com', 'phone' => '7770003', 'role' => 'specialist', 'branch_id' => $male->id],
            ['name' => 'Front Desk', 'email' => 'receptionist@example.com', 'phone' => '7770004', 'role' => 'receptionist', 'branch_id' => $male->id],
            ['name' => 'Ali Hassan', 'email' => 'owner@example.com', 'phone' => '7771234', 'role' => 'owner'],
            ['name' => 'Aishath Shifa', 'email' => 'client@example.com', 'phone' => '7775678', 'role' => 'client'],
        ];

        foreach ($users as $user) {
            User::create($user + ['password' => 'password', 'is_verified' => true]);
        }
    }
}

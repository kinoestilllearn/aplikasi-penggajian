<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // create a Staff payroll user will be as a staff-payroll
        $user = User::create([
            'name'     => 'Staff Payroll',
            'email'    => 'staff@maumaju.com',
            'password' => Hash::make('Password'),
        ]);

        // assign the user as staff-payrol role
        $user->syncRoles(['staff-payroll']);

        // create a Supervisor payroll user will be as a supervisor-payroll
        $user = User::create([
            'name'     => 'SPV Payroll',
            'email'    => 'spv@maumaju.com',
            'password' => Hash::make('Password'),
        ]);

        // assign the user as supervisor-payrol role
        $user->syncRoles(['supervisor-payroll']);

        // create a user
        $user = User::create([
            'name'     => 'Example User',
            'email'    => 'user@maumaju.com',
            'password' => Hash::make('Password'),
        ]);

        // assign the user as user role
        $user->syncRoles(['user']);
    }
}

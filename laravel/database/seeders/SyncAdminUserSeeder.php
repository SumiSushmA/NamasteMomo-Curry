<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class SyncAdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::query()->delete();

        User::create([
            'name' => 'Admin',
            'email' => 'indainnepaliadmin@kitchen.com',
            'password' => 'password',
            'role' => 'Owner',
            'status' => 'active',
            'last_active_at' => now(),
        ]);
    }
}

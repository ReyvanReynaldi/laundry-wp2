<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UpdateAdminRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminUser = User::where('email', 'admin@laundry.com')->first();
        
        if ($adminUser) {
            $adminUser->role = 'admin';
            $adminUser->save();
            
            $this->command->info('Admin user role updated successfully.');
        } else {
            $this->command->error('Admin user not found.');
        }
    }
}

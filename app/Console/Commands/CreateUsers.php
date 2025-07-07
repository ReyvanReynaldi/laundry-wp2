<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class CreateUsers extends Command
{
    protected $signature = 'users:create';
    protected $description = 'Create admin and customer users';

    public function handle()
    {
        $this->info('Creating users...');

        try {
            // Create Admin
            $admin = User::create([
                'name' => 'Admin LaundryPro',
                'email' => 'admin@laundry.com',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'phone' => '+62 812-3456-7890',
                'address' => 'Jl. Sudirman No. 123, Jakarta Pusat',
                'email_verified_at' => now(),
            ]);

            $this->info('✅ Admin created: ' . $admin->email);

            // Create Customer
            $customer = User::create([
                'name' => 'John Doe',
                'email' => 'customer@email.com',
                'password' => Hash::make('password'),
                'role' => 'customer',
                'phone' => '+62 812-9876-5432',
                'address' => 'Jl. Thamrin No. 456, Jakarta Pusat',
                'reward_points' => 1250,
                'email_verified_at' => now(),
            ]);

            $this->info('✅ Customer created: ' . $customer->email);
            $this->info('🔑 Password for both: password');

        } catch (\Exception $e) {
            $this->error('Error: ' . $e->getMessage());
        }

        return 0;
    }
}
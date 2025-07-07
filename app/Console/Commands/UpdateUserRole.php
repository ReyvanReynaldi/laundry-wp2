<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;

class UpdateUserRole extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:update-role {email} {role}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update user role by email';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $email = $this->argument('email');
        $role = $this->argument('role');

        $user = User::where('email', $email)->first();

        if (!$user) {
            $this->error("User with email {$email} not found.");
            return 1;
        }

        $user->role = $role;
        $user->save();

        $this->info("User {$user->name} role updated to {$role}.");
        return 0;
    }
}

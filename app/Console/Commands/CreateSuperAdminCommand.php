<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class CreateSuperAdminCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:create-super-admin 
                            {--name=Super Admin : The name of the super admin}
                            {--email=superadmin@example.com : The email of the super admin}
                            {--password=superadmin123 : The password for the super admin}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new super admin user';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = $this->option('name');
        $email = $this->option('email');
        $password = $this->option('password');

        // Check if user with this email already exists
        $existingUser = User::where('email', $email)->first();

        if ($existingUser) {
            $this->error("A user with email {$email} already exists!");
            return 1;
        }

        // Create the super admin user
        $user = User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
            'is_admin' => true,
            'role' => User::ROLE_SUPER_ADMIN,
        ]);

        $this->info("Super admin user created successfully:");
        $this->info("Name: {$name}");
        $this->info("Email: {$email}");
        $this->info("Password: {$password}");
        $this->info("Role: Super Admin");

        return 0;
    }
}

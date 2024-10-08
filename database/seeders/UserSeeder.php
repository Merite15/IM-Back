<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = collect([
            [
                'name' => 'Admin',
                'email' => 'admin@admin.com',
                'email_verified_at' => now(),
                'password' => bcrypt('Mbongui@1992'),
            ],
            [
                'name' => 'quest',
                'email' => 'quest@quest.com',
                'email_verified_at' => now(),
                'password' => bcrypt('Mbongui@1992'),
            ],
            [
                'name' => 'user',
                'email' => 'user@user.com',
                'email_verified_at' => now(),
                'password' => bcrypt('Mbongui@1992'),
            ],
        ]);

        $users->each(function ($user): void {
            User::insert($user);
        });
    }
}

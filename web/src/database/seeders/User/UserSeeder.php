<?php

namespace Database\Seeders\User;

use App\Models\Quran\Profile\Profile;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Testing\Fluent\Concerns\Has;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::query()->create([
            'first_name' => 'Admin',
            'last_name' => 'User',
            'email' => 'admin@demo.com',
            'password' => Hash::make('123456'),
            'is_admin' => 1
        ]);

        Profile::query()->create([
            'user_id' => 1,
            'gender' => 'male',
            'profile_picture' => '/assets/img/avatar.png'
        ]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Profile;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class StudentSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();
        
        // Get the student role ID (assuming 2 is for students)
        $studentRoleId = 2;
        
        // Generate 200 student accounts
        for ($i = 0; $i < 200; $i++) {
            // Create user account
            $user = User::create([
                'username' => $faker->unique()->userName,
                'email' => $faker->unique()->safeEmail,
                'password' => Hash::make('password123'), // Default password
                'role_id' => $studentRoleId,
                'isActive' => true,
                'isDeleted' => false,
            ]);
            
            // Generate LRN (Learner Reference Number) - 12 digits
            $lrn = mt_rand(100000000000, 999999999999);
            
            // Create corresponding profile
            Profile::create([
                'user_id' => $user->id,
                'lrn' => $lrn,
                'firstname' => $faker->firstName,
                'lastname' => $faker->lastName,
                'phone_number' => $faker->numerify('09#########'),
                'address' => $faker->address,
                'profile_picture' => null,
                'birthdate' => $faker->dateTimeBetween('-20 years', '-15 years'),
                'gender' => $faker->randomElement(['Male', 'Female']),
                'nationality' => 'Filipino',
                'bio' => $faker->sentence(10),
            ]);
        }
    }
} 
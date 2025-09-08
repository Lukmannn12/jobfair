<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
   public function run()
    {
        // Create Admin User
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@jobfier.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'email_verified_at' => now(),
        ]);

        // Create Sample Employer
        User::create([
            'name' => 'John Employer',
            'email' => 'employer@jobfier.com',
            'password' => Hash::make('password'),
            'role' => 'employer',
            'company_name' => 'Tech Solutions Inc.',
            'company_website' => 'https://techsolutions.com',
            'company_description' => 'We are a leading technology company focused on innovative software solutions.',
            'phone' => '+62 21 1234 5678',
            'address' => 'Jakarta, Indonesia',
            'email_verified_at' => now(),
        ]);

        // Create Sample Job Seeker
        User::create([
            'name' => 'Jane Jobseeker',
            'email' => 'jobseeker@jobfier.com',
            'password' => Hash::make('password'),
            'role' => 'job_seeker',
            'bio' => 'Passionate software developer with 3+ years of experience.',
            'skills' => json_encode(['PHP', 'Laravel', 'JavaScript', 'React', 'MySQL']),
            'experience_level' => 'mid',
            'phone' => '+62 21 9876 5432',
            'address' => 'Bandung, Indonesia',
            'email_verified_at' => now(),
        ]);

        // Create additional employers
        $employers = [
            [
                'name' => 'Sarah Manager',
                'email' => 'sarah@startupco.com',
                'company_name' => 'StartupCo',
                'company_description' => 'Fast-growing startup in the fintech space.',
            ],
            [
                'name' => 'Mike Director',
                'email' => 'mike@bigcorp.com',
                'company_name' => 'BigCorp Indonesia',
                'company_description' => 'Multinational corporation with offices worldwide.',
            ],
            [
                'name' => 'Lisa HR',
                'email' => 'lisa@creativestudio.com',
                'company_name' => 'Creative Studio',
                'company_description' => 'Digital agency specializing in web design and development.',
            ],
        ];

        foreach ($employers as $employer) {
            User::create(array_merge($employer, [
                'password' => Hash::make('password'),
                'role' => 'employer',
                'email_verified_at' => now(),
            ]));
        }

        // Create additional job seekers
        $jobSeekers = [
            [
                'name' => 'Ahmad Rahman',
                'email' => 'ahmad@email.com',
                'bio' => 'Frontend developer specializing in React and Vue.js',
                'skills' => json_encode(['JavaScript', 'React', 'Vue.js', 'CSS', 'HTML']),
                'experience_level' => 'junior',
            ],
            [
                'name' => 'Siti Nurhaliza',
                'email' => 'siti@email.com',
                'bio' => 'Full-stack developer with expertise in PHP and Node.js',
                'skills' => json_encode(['PHP', 'Laravel', 'Node.js', 'MySQL', 'MongoDB']),
                'experience_level' => 'senior',
            ],
            [
                'name' => 'Budi Santoso',
                'email' => 'budi@email.com',
                'bio' => 'Mobile app developer focused on Flutter and React Native',
                'skills' => json_encode(['Flutter', 'React Native', 'Dart', 'JavaScript']),
                'experience_level' => 'mid',
            ],
        ];

        foreach ($jobSeekers as $jobSeeker) {
            User::create(array_merge($jobSeeker, [
                'password' => Hash::make('password'),
                'role' => 'job_seeker',
                'email_verified_at' => now(),
            ]));
        }
    }
}

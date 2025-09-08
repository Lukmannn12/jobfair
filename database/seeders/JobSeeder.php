<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Job;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JobSeeder extends Seeder
{
   public function run()
    {
        $employers = User::where('role', 'employer')->get();
        $categories = Category::all();

        $jobs = [
            [
                'title' => 'Senior Laravel Developer',
                'description' => 'We are looking for an experienced Laravel developer to join our team. You will be responsible for developing and maintaining web applications using the Laravel framework. The ideal candidate should have strong knowledge of PHP, MySQL, and modern web development practices.',
                'requirements' => "• Bachelor's degree in Computer Science or related field\n• 3+ years of experience with Laravel framework\n• Strong knowledge of PHP, MySQL, and JavaScript\n• Experience with Git version control\n• Understanding of MVC architecture\n• Good communication skills",
                'location' => 'Jakarta, Indonesia',
                'type' => 'full_time',
                'level' => 'senior',
                'salary_min' => 8000000,
                'salary_max' => 12000000,
                'benefits' => json_encode(['Health Insurance', 'Dental Coverage', 'Annual Bonus', 'Flexible Working Hours']),
                'application_deadline' => now()->addDays(30),
                'category_id' => $categories->where('name', 'Technology')->first()->id,
            ],
            [
                'title' => 'Frontend Developer (React)',
                'description' => 'Join our dynamic team as a Frontend Developer specializing in React.js. You will be creating beautiful and responsive user interfaces for our web applications. We are looking for someone who is passionate about creating excellent user experiences.',
                'requirements' => "• 2+ years of experience with React.js\n• Strong knowledge of JavaScript, HTML, and CSS\n• Experience with responsive design\n• Knowledge of state management (Redux/Context API)\n• Familiarity with RESTful APIs\n• Portfolio of previous work required",
                'location' => 'Bandung, Indonesia',
                'type' => 'full_time',
                'level' => 'mid',
                'salary_min' => 6000000,
                'salary_max' => 9000000,
                'benefits' => json_encode(['Health Insurance', 'Training Budget', 'Remote Work Option']),
                'application_deadline' => now()->addDays(25),
                'category_id' => $categories->where('name', 'Technology')->first()->id,
            ],
            [
                'title' => 'Digital Marketing Manager',
                'description' => 'We are seeking a creative and results-driven Digital Marketing Manager to lead our online marketing efforts. You will be responsible for developing and executing digital marketing strategies across various channels including social media, email, and search engines.',
                'requirements' => "• Bachelor's degree in Marketing or related field\n• 3+ years of digital marketing experience\n• Experience with Google Ads and Facebook Ads\n• Knowledge of SEO and content marketing\n• Strong analytical skills\n• Experience with marketing automation tools",
                'location' => 'Surabaya, Indonesia',
                'type' => 'full_time',
                'level' => 'mid',
                'salary_min' => 7000000,
                'salary_max' => 10000000,
                'benefits' => json_encode(['Health Insurance', 'Performance Bonus', 'Professional Development']),
                'application_deadline' => now()->addDays(20),
                'category_id' => $categories->where('name', 'Marketing')->first()->id,
            ],
            [
                'title' => 'UI/UX Designer',
                'description' => 'We are looking for a talented UI/UX Designer to create amazing user experiences. You will be responsible for the entire design process from concept to implementation, working closely with our development team to bring designs to life.',
                'requirements' => "• Bachelor's degree in Design or related field\n• 2+ years of UI/UX design experience\n• Proficiency in design tools (Figma, Sketch, Adobe Creative Suite)\n• Understanding of user-centered design principles\n• Experience with prototyping\n• Portfolio showcasing previous work",
                'location' => 'Yogyakarta, Indonesia',
                'type' => 'full_time',
                'level' => 'junior',
                'salary_min' => 5000000,
                'salary_max' => 8000000,
                'benefits' => json_encode(['Health Insurance', 'Creative Environment', 'Flexible Hours']),
                'application_deadline' => now()->addDays(15),
                'category_id' => $categories->where('name', 'Design')->first()->id,
            ],
            [
                'title' => 'Sales Executive',
                'description' => 'Join our sales team as a Sales Executive and help drive our company growth. You will be responsible for identifying new business opportunities, building relationships with clients, and achieving sales targets.',
                'requirements' => "• Bachelor's degree in Business or related field\n• 1+ years of sales experience preferred\n• Excellent communication and negotiation skills\n• Goal-oriented and self-motivated\n• Experience with CRM systems\n• Willingness to travel",
                'location' => 'Jakarta, Indonesia',
                'type' => 'full_time',
                'level' => 'entry',
                'salary_min' => 4500000,
                'salary_max' => 7000000,
                'benefits' => json_encode(['Commission Structure', 'Health Insurance', 'Sales Training']),
                'application_deadline' => now()->addDays(35),
                'category_id' => $categories->where('name', 'Sales')->first()->id,
            ],
            [
                'title' => 'Data Analyst Intern',
                'description' => 'This is a great opportunity for students or recent graduates to gain hands-on experience in data analysis. You will work with our data team to analyze business metrics and create insightful reports.',
                'requirements' => "• Currently pursuing or recently completed degree in Statistics, Math, or related field\n• Basic knowledge of SQL and Excel\n• Familiarity with data visualization tools\n• Strong analytical and problem-solving skills\n• Attention to detail\n• Eagerness to learn",
                'location' => 'Remote',
                'type' => 'internship',
                'level' => 'entry',
                'salary_min' => 2000000,
                'salary_max' => 3000000,
                'benefits' => json_encode(['Mentorship Program', 'Learning Opportunities', 'Certificate of Completion']),
                'application_deadline' => now()->addDays(40),
                'category_id' => $categories->where('name', 'Technology')->first()->id,
            ],
        ];

        foreach ($jobs as $index => $jobData) {
            $employer = $employers->get($index % $employers->count());
            
            Job::create(array_merge($jobData, [
                'user_id' => $employer->id,
                'status' => 'active',
            ]));
        }
    }
}

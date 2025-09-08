<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
     public function run()
    {
        $categories = [
            ['name' => 'Technology', 'icon' => '💻'],
            ['name' => 'Marketing', 'icon' => '📢'],
            ['name' => 'Design', 'icon' => '🎨'],
            ['name' => 'Sales', 'icon' => '💼'],
            ['name' => 'Finance', 'icon' => '💰'],
            ['name' => 'Human Resources', 'icon' => '👥'],
            ['name' => 'Customer Service', 'icon' => '📞'],
            ['name' => 'Operations', 'icon' => '⚙️'],
            ['name' => 'Education', 'icon' => '📚'],
            ['name' => 'Healthcare', 'icon' => '🏥'],
            ['name' => 'Construction', 'icon' => '🏗️'],
            ['name' => 'Hospitality', 'icon' => '🏨'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}

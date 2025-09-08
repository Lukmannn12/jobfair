<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Job;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $featuredJobs = Job::with(['user', 'category'])
            ->where('status', 'active')
            ->latest()
            ->take(6)
            ->get();

        $categories = Category::withCount('jobs')->get();

        return view('home', compact('featuredJobs', 'categories'));
    }
}

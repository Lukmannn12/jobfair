<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Job;
use App\Models\Category;
use App\Models\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (!Auth::user()->isAdmin()) {
                return redirect('/')->with('error', 'Access denied.');
            }
            return $next($request);
        });
    }

     public function dashboard()
    {
        $totalUsers = User::count();
        $totalJobs = Job::count();
        $totalApplications = Application::count();
        $totalCategories = Category::count();

        $recentUsers = User::latest()->take(5)->get();
        $recentJobs = Job::with('user')->latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalUsers', 'totalJobs', 'totalApplications', 
            'totalCategories', 'recentUsers', 'recentJobs'
        ));
    }

    public function users()
    {
        $users = User::latest()->paginate(20);
        return view('admin.users', compact('users'));
    }

    public function jobs()
    {
        $jobs = Job::with('user')->latest()->paginate(20);
        return view('admin.jobs', compact('jobs'));
    }

    public function categories()
    {
        $categories = Category::withCount('jobs')->get();
        return view('admin.categories', compact('categories'));
    }

    public function storeCategory(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories',
            'icon' => 'nullable|string|max:255',
        ]);

        Category::create($validated);

        return redirect()->back()->with('success', 'Category created successfully!');
    }
}

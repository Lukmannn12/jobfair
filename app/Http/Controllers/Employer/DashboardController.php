<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\Category;
use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
public function index()
{
    $user = Auth::user();

    // ambil data statistik
    $totalJobs = Job::where('user_id', $user->id)->count();
    $activeJobs = Job::where('user_id', $user->id)->where('status', 'active')->count();
    $totalApplications = Application::whereHas('job', function ($q) use ($user) {
        $q->where('user_id', $user->id);
    })->count();
    $pendingApplications = Application::whereHas('job', function ($q) use ($user) {
        $q->where('user_id', $user->id);
    })->where('status', 'pending')->count();

    // ambil data jobs untuk tabel
    $jobs = Job::with('category')
        ->where('user_id', $user->id)
        ->latest()
        ->paginate(10);

    return view('employer.dashboard', compact(
        'user',
        'totalJobs',
        'activeJobs',
        'totalApplications',
        'pendingApplications',
        'jobs'
    ));
}

    public function jobs()
    {
        $user = Auth::user();
        $categories = Category::all();
        $jobs = Job::orderBy('created_at', 'desc')->paginate(10);
        return view('employer.jobs.index', compact('user', 'categories', 'jobs'));
    }


}

<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Job;
use App\Models\Category;
use App\Models\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    public function dashboard()
    {
        // Contoh data statis dulu, bisa diganti ambil dari database
        $totalUsers = User::count();
        $totalEmployers = User::where('role', 'employer')->count();
        $totalJobs = Job::count();
        $pendingApplications = 23; // contoh manual

        return view('admin.dashboard', compact(
            'totalUsers',
            'totalEmployers',
            'totalJobs',
            'pendingApplications'
        ));
    }

    public function categories() {
        $categories = Category::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.categories.index', compact('categories'));
    }  

    public function storeCategory(Request $request) {
        $request->validate([
            'name' => 'required|string|max:100|unique:categories,name',
            'icon' => 'nullable|string|max:255'
        ]);

        Category::create([
            'name' => $request->name,
            'icon' => $request->icon,
            'slug' => Str::slug($request->name), 
        ]);

        return redirect()->back()->with('success', 'Kategori berhasil di tambah');
    }

}

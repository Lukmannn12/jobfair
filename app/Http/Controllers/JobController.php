<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Category;
use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class JobController extends Controller
{

    public function create()
    {
        $user = Auth::user();
        $categories = Category::all();
        return view('employer.jobs.create', compact('user', 'categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
            'requirements' => 'required',
            'location' => 'required|string|max:255',
            'type' => 'required|in:full_time,part_time,contract,internship',
            'level' => 'required|in:entry,junior,mid,senior,lead',
            'salary_min'  => 'nullable|numeric',
            'salary_max'  => 'nullable|numeric',
            'salary_negotiable' => 'boolean',
            'benefits'    => 'nullable|string',
            'application_deadline' => 'nullable|date',
            'category_id' => 'required|exists:categories,id',
        ]);

        Job::create([
            'title'       => $request->title,
            'slug'        => Str::slug($request->title) . '-' . uniqid(),
            'description' => $request->description,
            'requirements' => $request->requirements,
            'location'    => $request->location,
            'type'        => $request->type,
            'level'       => $request->level,
            'salary_min'  => $request->salary_min,
            'salary_max'  => $request->salary_max,
            'salary_negotiable' => $request->salary_negotiable ?? false,
            // CUKUP array, biar Laravel yang encode
            'benefits' => $request->benefits
                ? array_map('trim', explode(',', $request->benefits))
                : null,
            'application_deadline' => $request->application_deadline,
            'status'      => 'active',
            'user_id'     => Auth::id(),
            'category_id' => $request->category_id,
        ]);

        return redirect()->route('employer.jobs')->with('success', 'Job berhasil diposting!');
    }

    public function show($slug)
    {
        $job = Job::with(['user.employerProfile'])
            ->where('slug', $slug)
            ->firstOrFail();

        return view('employer.jobs.show', compact('job'));
    }

    public function destroy($id)
    {
        // Cari job berdasarkan id
        $job = Job::findOrFail($id);

        // Hapus job
        $job->delete();

        // Redirect balik dengan pesan sukses
        return redirect()->route('employer.jobs')->with('success', 'Job berhasil dihapus.');
    }
}

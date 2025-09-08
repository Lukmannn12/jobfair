<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Category;
use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   public function index(Request $request)
    {
        $query = Job::with(['user', 'category'])->where('status', 'active');

        if ($request->search) {
            $query->where(function($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%')
                  ->orWhere('location', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->category) {
            $query->whereHas('category', function($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        if ($request->type) {
            $query->where('type', $request->type);
        }

        if ($request->level) {
            $query->where('level', $request->level);
        }

        $jobs = $query->latest()->paginate(12);
        $categories = Category::all();

        return view('jobs.index', compact('jobs', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         $this->authorize('create', Job::class);
        $categories = Category::all();
        return view('jobs.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create', Job::class);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'requirements' => 'required|string',
            'location' => 'required|string|max:255',
            'type' => 'required|in:full_time,part_time,contract,internship',
            'level' => 'required|in:entry,junior,mid,senior,lead',
            'salary_min' => 'nullable|numeric|min:0',
            'salary_max' => 'nullable|numeric|gte:salary_min',
            'salary_negotiable' => 'boolean',
            'benefits' => 'nullable|array',
            'application_deadline' => 'nullable|date|after:today',
            'category_id' => 'required|exists:categories,id',
        ]);

        $validated['user_id'] = Auth::id();

        Job::create($validated);

        return redirect()->route('employer.jobs')->with('success', 'Job posted successfully!');
    }
    /**
     * Display the specified resource.
     */
    public function show($slug)
    {
        $job = Job::with(['user', 'category', 'applications'])->where('slug', $slug)->firstOrFail();
        
        $job->incrementViews();
        
        $hasApplied = false;
        if (Auth::check() && Auth::user()->isJobSeeker()) {
            $hasApplied = Application::where('job_id', $job->id)
                ->where('user_id', Auth::id())
                ->exists();
        }

        $relatedJobs = Job::where('category_id', $job->category_id)
            ->where('id', '!=', $job->id)
            ->where('status', 'active')
            ->take(3)
            ->get();

        return view('jobs.show', compact('job', 'hasApplied', 'relatedJobs'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Job $job)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Job $job)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Job $job)
    {
        //
    }

    public function apply(Request $request, Job $job)
    {
        if (!Auth::user()->isJobSeeker()) {
            return redirect()->back()->with('error', 'Only job seekers can apply for jobs.');
        }

        $validated = $request->validate([
            'cover_letter' => 'nullable|string|max:2000',
            'resume' => 'nullable|file|mimes:pdf,doc,docx|max:5120',
        ]);

        $resumePath = null;
        if ($request->hasFile('resume')) {
            $resumePath = $request->file('resume')->store('resumes', 'public');
        }

        Application::create([
            'job_id' => $job->id,
            'user_id' => Auth::id(),
            'cover_letter' => $validated['cover_letter'],
            'resume' => $resumePath,
        ]);

        return redirect()->back()->with('success', 'Application submitted successfully!');
    }
}

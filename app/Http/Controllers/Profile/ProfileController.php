<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Models\EmployerProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function show()
    {
        $profile = Auth::user()->employerProfile;

        return view('employer.profile', compact('profile'));
    }

    public function create()
    {
        return view('employer.profile_create');
    }

     public function store(Request $request)
    {
        $request->validate([
            'company_name' => 'required|string|max:255',
            'company_website' => 'nullable|url|max:255',
            'company_description' => 'nullable|string',
        ]);

        EmployerProfile::create([
            'user_id' => Auth::id(),
            'company_name' => $request->company_name,
            'company_website' => $request->company_website,
            'company_description' => $request->company_description,
        ]);

        return redirect()->route('employer.profile.show')->with('success', 'Profile berhasil dibuat.');
    }
}

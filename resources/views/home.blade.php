@extends('layouts.app')

@section('content')
<!-- Hero Section -->
<section class="relative bg-gradient-to-r from-green-700 via-green-600 to-purple-700 text-white py-24">
    <div class="max-w-7xl mx-auto px-4 text-center relative z-10">
        <h1 class="text-5xl font-extrabold mb-6 drop-shadow-lg">
            Find Your Dream Job
        </h1>
        <p class="mb-10 text-blue-100 max-w-2xl mx-auto drop-shadow-sm">
            Connect with top employers and discover opportunities that match your skills
        </p>

        <div class="max-w-3xl mx-auto">
            <form action="{{ route('jobs.index') }}" method="GET"
                class="flex flex-col md:flex-row gap-4 bg-white rounded-xl py-4 px-8 shadow-lg">
                <input type="text" name="search" placeholder="Job title, keywords, or company"
                    class="flex-1 px-5 py-1 rounded-lg text-sm text-gray-800 border border-gray-200 focus:ring-1 focus:ring-gray-400 focus:outline-none">
                <input type="text" name="location" placeholder="City or remote"
                    class="flex-1 px-5 py-3 rounded-lg text-gray-800 text-sm border border-gray-200 focus:ring-2 focus:ring-blue-400 focus:outline-none">
                <button type="submit"
                    class="bg-yellow-500 hover:bg-yellow-600 text-white px-8 py-3 text-sm rounded-lg font-semibold transition duration-300 shadow-md hover:shadow-lg">
                    Search Jobs
                </button>
            </form>
        </div>
    </div>

    <!-- Optional overlay for better contrast -->
    <div class="absolute inset-0 bg-black opacity-20"></div>
</section>


<!-- Job Categories -->
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4">
        <h2 class="text-3xl font-bold text-center mb-12">Browse by Category</h2>
        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-8 gap-6">
            @foreach($categories as $category)
            <a href="{{ route('jobs.index', ['category' => $category->slug]) }}"
                class="bg-gray-50 hover:bg-blue-50 p-6 rounded-lg text-center transition-colors group border border-gray-200">
                <div class="text-xl mb-3">{{ $category->icon ?? '💼' }}</div>
                <h3 class="font-semibold text-sm text-gray-800 py-2 group-hover:text-blue-600">{{ $category->name }}
                </h3>
                <p class="text-xs text-gray-500">{{ $category->jobs_count }} jobs</p>
            </a>
            @endforeach
        </div>
    </div>
</section>

<!-- Featured Jobs -->
<section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4">
        <h2 class="text-3xl font-bold text-center mb-12">Featured Jobs</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($featuredJobs as $job)
            <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow p-6 border border-gray-200">
                <div class="flex items-start justify-between mb-4">
                    <div>
                        <h3 class="font-semibold text-base text-gray-800 mb-2">
                            <a href="{{ route('jobs.show', $job->slug) }}" class="hover:text-blue-600">{{ $job->title
                                }}</a>
                        </h3>
                        <p class="text-gray-600 text-sm">{{ $job->user->company_name ?? $job->user->name }}</p>
                    </div>
                    <span class="bg-green-100 text-green-800 text-xs px-2 py-1 rounded-full">{{ ucfirst(str_replace('_',
                        ' ', $job->type)) }}</span>
                </div>

                <div class="space-y-2 mb-4">
                    <div class="flex items-center text-gray-500 text-xs">
                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z"
                                clip-rule="evenodd"></path>
                        </svg>
                        {{ $job->location }}
                    </div>
                    <div class="flex items-center text-gray-500 text-xs">
                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z"
                                clip-rule="evenodd"></path>
                        </svg>
                        {{ $job->formatted_salary }}
                    </div>
                </div>

                <p class="text-gray-600 text-sm mb-4 line-clamp-2">{{ Str::limit($job->description, 100) }}</p>

                <div class="flex items-center justify-between mt-4">
                    <span class="text-xs text-gray-500">{{ $job->created_at->diffForHumans() }}</span>
                    <a href="{{ route('jobs.show', $job->slug) }}"
                        class="bg-green-600 hover:bg-green-700 text-white text-xs font-medium px-4 py-2 rounded-lg transition duration-300 shadow-md hover:shadow-lg">
                        View Details
                    </a>
                </div>
            </div>
            @endforeach
        </div>

        <div class="text-center mt-10 text-sm font-semibold">
            <a href="{{ route('jobs.index') }}"
                class="bg-green-500 text-white px-8 py-3 rounded-lg hover:bg-green-700 transition-colors">
                View All Jobs
            </a>
        </div>
    </div>
</section>

<!-- Call to Action -->
<section class="relative py-20 bg-gradient-to-r from-blue-700 via-indigo-600 to-purple-700 text-white">
    <div class="max-w-7xl mx-auto px-4 text-center relative z-10">
        <h2 class="text-5xl font-extrabold mb-4 drop-shadow-lg">
            Ready to Get Started?
        </h2>
        <p class="mb-10 text-blue-100 max-w-2xl mx-auto drop-shadow-sm py-2">
            Join thousands of job seekers and employers finding the perfect match
        </p>
        <div class="flex flex-col md:flex-row gap-6 justify-center">
            <a href="#"
                class="bg-white text-blue-600 px-10 py-4 rounded-xl font-semibold shadow-md hover:shadow-xl hover:scale-105 transform transition duration-300">
                Find Jobs
            </a>
            <a href="#"
                class="bg-yellow-500 text-white px-10 py-4 rounded-xl font-semibold shadow-md hover:shadow-xl hover:scale-105 transform transition duration-300">
                Post a Job
            </a>
        </div>
    </div>

    <!-- Optional overlay for better contrast -->
    <div class="absolute inset-0 bg-black opacity-20"></div>
</section>
@endsection
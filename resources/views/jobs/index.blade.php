@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-8">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-4">Find Your Perfect Job</h1>
        
        <!-- Search and Filters -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <form action="{{ route('jobs.index') }}" method="GET" class="space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                    <input type="text" name="search" value="{{ request('search') }}" 
                           placeholder="Search jobs..." 
                           class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    
                    <select name="category" class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                        <option value="">All Categories</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->slug }}" {{ request('category') == $category->slug ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    
                    <select name="type" class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                        <option value="">All Types</option>
                        <option value="full_time" {{ request('type') == 'full_time' ? 'selected' : '' }}>Full Time</option>
                        <option value="part_time" {{ request('type') == 'part_time' ? 'selected' : '' }}>Part Time</option>
                        <option value="contract" {{ request('type') == 'contract' ? 'selected' : '' }}>Contract</option>
                        <option value="internship" {{ request('type') == 'internship' ? 'selected' : '' }}>Internship</option>
                    </select>
                    
                    <select name="level" class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                        <option value="">All Levels</option>
                        <option value="entry" {{ request('level') == 'entry' ? 'selected' : '' }}>Entry Level</option>
                        <option value="junior" {{ request('level') == 'junior' ? 'selected' : '' }}>Junior</option>
                        <option value="mid" {{ request('level') == 'mid' ? 'selected' : '' }}>Mid Level</option>
                        <option value="senior" {{ request('level') == 'senior' ? 'selected' : '' }}>Senior</option>
                        <option value="lead" {{ request('level') == 'lead' ? 'selected' : '' }}>Lead</option>
                    </select>
                </div>
                
                <div class="flex justify-between">
                    <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition-colors">
                        Search
                    </button>
                    <a href="{{ route('jobs.index') }}" class="text-gray-500 hover:text-gray-700">Clear Filters</a>
                </div>
            </form>
        </div>
    </div>

    <!-- Jobs Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        @forelse($jobs as $job)
            <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow p-6">
                <div class="flex items-start justify-between mb-4">
                    <div class="flex-1">
                        <h3 class="font-semibold text-lg text-gray-800 mb-2">
                            <a href="{{ route('jobs.show', $job->slug) }}" class="hover:text-blue-600">{{ $job->title }}</a>
                        </h3>
                        <p class="text-gray-600 mb-2">{{ $job->user->company_name ?? $job->user->name }}</p>
                        <div class="flex flex-wrap gap-2 mb-3">
                            <span class="bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded-full">{{ $job->category->name }}</span>
                            <span class="bg-green-100 text-green-800 text-xs px-2 py-1 rounded-full">{{ ucfirst(str_replace('_', ' ', $job->type)) }}</span>
                            <span class="bg-purple-100 text-purple-800 text-xs px-2 py-1 rounded-full">{{ ucfirst($job->level) }}</span>
                        </div>
                    </div>
                </div>
                
                <div class="space-y-2 mb-4">
                    <div class="flex items-center text-gray-500 text-sm">
                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path>
                        </svg>
                        {{ $job->location }}
                    </div>
                    <div class="flex items-center text-gray-500 text-sm">
                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path>
                        </svg>
                        {{ $job->formatted_salary }}
                    </div>
                </div>
                
                <p class="text-gray-600 text-sm mb-4 line-clamp-2">{{ Str::limit(strip_tags($job->description), 120) }}</p>
                
                <div class="flex items-center justify-between">
                    <div class="flex items-center text-xs text-gray-500">
                        <span>{{ $job->created_at->diffForHumans() }}</span>
                        <span class="mx-2">•</span>
                        <span>{{ $job->applications->count() }} applicants</span>
                    </div>
                    <a href="{{ route('jobs.show', $job->slug) }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                        View Details →
                    </a>
                </div>
            </div>
        @empty
            <div class="col-span-2 text-center py-12">
                <div class="text-gray-500 mb-4">
                    <svg class="w-16 h-16 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 12h6m-6-4h6m2 5.291A7.962 7.962 0 0112 15c-2.34 0-4.464-.881-6.08-2.33l-.732.732a1 1 0 01-1.414-1.414l.732-.732A7.962 7.962 0 016 6c0-2.34.881-4.464 2.33-6.08M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-medium text-gray-900 mb-2">No jobs found</h3>
                <p class="text-gray-500 mb-4">Try adjusting your search criteria</p>
                <a href="{{ route('jobs.index') }}" class="text-blue-600 hover:text-blue-800">Clear all filters</a>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="mt-8">
        {{ $jobs->appends(request()->query())->links() }}
    </div>
</div>
@endsection
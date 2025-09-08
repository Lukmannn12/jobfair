@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-8">
    <div class="bg-white rounded-lg shadow-md">
        <!-- Job Header -->
        <div class="p-8 border-b border-gray-200">
            <div class="flex flex-col md:flex-row md:items-start md:justify-between">
                <div class="flex-1">
                    <h1 class="text-3xl font-bold text-gray-800 mb-4">{{ $job->title }}</h1>
                    <div class="flex items-center mb-4">
                        <div class="mr-8">
                            <h2 class="text-xl font-semibold text-gray-700">{{ $job->user->company_name ?? $job->user->name }}</h2>
                            @if($job->user->company_website)
                                <a href="{{ $job->user->company_website }}" target="_blank" class="text-blue-600 hover:underline text-sm">
                                    {{ $job->user->company_website }}
                                </a>
                            @endif
                        </div>
                    </div>
                    
                    <div class="flex flex-wrap gap-3 mb-6">
                        <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm">{{ $job->category->name }}</span>
                        <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm">{{ ucfirst(str_replace('_', ' ', $job->type)) }}</span>
                        <span class="bg-purple-100 text-purple-800 px-3 py-1 rounded-full text-sm">{{ ucfirst($job->level) }}</span>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm">
                        <div class="flex items-center text-gray-600">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path>
                            </svg>
                            {{ $job->location }}
                        </div>
                        <div class="flex items-center text-gray-600">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path>
                            </svg>
                            {{ $job->formatted_salary }}
                        </div>
                        <div class="flex items-center text-gray-600">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                            </svg>
                            Posted {{ $job->created_at->diffForHumans() }}
                        </div>
                    </div>
                </div>
                
                <!-- Apply Button -->
                @auth
                    @if(auth()->user()->isJobSeeker())
                        @if(!$hasApplied)
                            <div class="mt-6 md:mt-0">
                                <button onclick="document.getElementById('apply-modal').classList.remove('hidden')" 
                                        class="bg-blue-600 text-white px-8 py-3 rounded-lg hover:bg-blue-700 transition-colors font-semibold">
                                    Apply Now
                                </button>
                            </div>
                        @else
                            <div class="mt-6 md:mt-0">
                                <div class="bg-green-100 text-green-800 px-6 py-3 rounded-lg font-semibold">
                                    ✓ Applied
                                </div>
                            </div>
                        @endif
                    @endif
                @else
                    <div class="mt-6 md:mt-0">
                        <a href="{{ route('login') }}" class="bg-blue-600 text-white px-8 py-3 rounded-lg hover:bg-blue-700 transition-colors font-semibold">
                            Login to Apply
                        </a>
                    </div>
                @endauth
            </div>
        </div>

        <!-- Job Content -->
        <div class="p-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <div class="lg:col-span-2">
                    <!-- Description -->
                    <div class="mb-8">
                        <h3 class="text-xl font-semibold mb-4">Job Description</h3>
                        <div class="prose max-w-none text-gray-600">
                            {!! nl2br(e($job->description)) !!}
                        </div>
                    </div>

                    <!-- Requirements -->
                    <div class="mb-8">
                        <h3 class="text-xl font-semibold mb-4">Requirements</h3>
                        <div class="prose max-w-none text-gray-600">
                            {!! nl2br(e($job->requirements)) !!}
                        </div>
                    </div>

                    <!-- Benefits -->
                    @if($job->benefits)
                        <div class="mb-8">
                            <h3 class="text-xl font-semibold mb-4">Benefits</h3>
                            <ul class="list-disc list-inside space-y-2 text-gray-600">
                                @foreach($job->benefits as $benefit)
                                    <li>{{ $benefit }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>

                <!-- Sidebar -->
                <div>
                    <div class="bg-gray-50 rounded-lg p-6 mb-6">
                        <h3 class="font-semibold mb-4">Job Summary</h3>
                        <div class="space-y-3 text-sm">
                            <div>
                                <span class="text-gray-500">Category:</span>
                                <span class="ml-2 font-medium">{{ $job->category->name }}</span>
                            </div>
                            <div>
                                <span class="text-gray-500">Type:</span>
                                <span class="ml-2 font-medium">{{ ucfirst(str_replace('_', ' ', $job->type)) }}</span>
                            </div>
                            <div>
                                <span class="text-gray-500">Level:</span>
                                <span class="ml-2 font-medium">{{ ucfirst($job->level) }}</span>
                            </div>
                            <div>
                                <span class="text-gray-500">Location:</span>
                                <span class="ml-2 font-medium">{{ $job->location }}</span>
                            </div>
                            @if($job->application_deadline)
                                <div>
                                    <span class="text-gray-500">Deadline:</span>
                                    <span class="ml-2 font-medium">{{ $job->application_deadline->format('M d, Y') }}</span>
                                </div>
                            @endif
                            <div>
                                <span class="text-gray-500">Views:</span>
                                <span class="ml-2 font-medium">{{ number_format($job->views) }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Company Info -->
                    @if($job->user->company_description)
                        <div class="bg-gray-50 rounded-lg p-6">
                            <h3 class="font-semibold mb-4">About {{ $job->user->company_name ?? $job->user->name }}</h3>
                            <p class="text-gray-600 text-sm">{{ $job->user->company_description }}</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Related Jobs -->
    @if($relatedJobs->count() > 0)
        <div class="mt-12">
            <h2 class="text-2xl font-bold mb-6">Similar Jobs</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($relatedJobs as $relatedJob)
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <h3 class="font-semibold mb-2">
                            <a href="{{ route('jobs.show', $relatedJob->slug) }}" class="hover:text-blue-600">{{ $relatedJob->title }}</a>
                        </h3>
                        <p class="text-gray-600 text-sm mb-3">{{ $relatedJob->user->company_name ?? $relatedJob->user->name }}</p>
                        <div class="flex items-center text-gray-500 text-sm mb-3">
                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path>
                            </svg>
                            {{ $relatedJob->location }}
                        </div>
                        <a href="{{ route('jobs.show', $relatedJob->slug) }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                            View Details →
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
</div>

<!-- Apply Modal -->
@auth
    @if(auth()->user()->isJobSeeker() && !$hasApplied)
        <div id="apply-modal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
            <div class="relative top-20 mx-auto p-5 border w-full max-w-md shadow-lg rounded-md bg-white">
                <div class="mt-3">
                    <h3 class="text-lg font-medium text-gray-900 text-center mb-4">Apply for {{ $job->title }}</h3>
                    <form action="{{ route('jobs.apply', $job) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Cover Letter</label>
                            <textarea name="cover_letter" rows="4" 
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                    placeholder="Tell us why you're interested in this position..."></textarea>
                        </div>
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Resume (Optional)</label>
                            <input type="file" name="resume" accept=".pdf,.doc,.docx"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            <p class="text-xs text-gray-500 mt-1">PDF, DOC, DOCX (max 5MB)</p>
                        </div>
                        <div class="flex space-x-3">
                            <button type="button" onclick="document.getElementById('apply-modal').classList.add('hidden')"
                                    class="flex-1 bg-gray-300 text-gray-700 py-2 px-4 rounded-lg hover:bg-gray-400 transition-colors">
                                Cancel
                            </button>
                            <button type="submit" class="flex-1 bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700 transition-colors">
                                Submit Application
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif
@endauth
@endsection
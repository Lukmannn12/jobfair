@extends('layouts.app')

@section('content')
<section class="py-16">
    <div class="max-w-5xl mx-auto px-6">
        
        <!-- Header -->
        <div class="bg-white rounded-2xl p-10 border border-gray-200">
            <!-- Title & Company -->
            <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-8">
                <div>
                    <h1 class="text-2xl font-extrabold text-gray-900 mb-3">{{ $job->title }}</h1>
                    <p class="text-sm text-gray-600 flex items-center space-x-2">
                        <svg class="w-5 h-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M4 3a2 2 0 00-2 2v2h16V5a2 2 0 00-2-2H4z" />
                            <path fill-rule="evenodd" d="M18 9H2v6a2 2 0 002 2h12a2 2 0 002-2V9z" clip-rule="evenodd" />
                        </svg>
                        <span>{{ $job->user->employerProfile->company_name ?? $job->user->name }}</span>
                    </p>
                </div>
                <span class="mt-4 md:mt-0 inline-block bg-green-100 text-green-800 text-sm px-5 py-2 rounded-full font-medium">
                    {{ ucfirst(str_replace('_', ' ', $job->type)) }}
                </span>
            </div>

            <!-- Meta Info -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
                <div class="flex items-center rounded-xl p-4 border border-gray-200">
                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z"
                                clip-rule="evenodd"></path>
                        </svg>
                    <span class="text-gray-700 text-sm">{{ $job->location }}</span>
                </div>
                <div class="flex items-center rounded-xl p-4 border border-gray-200">
                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z"
                                clip-rule="evenodd"></path>
                        </svg>
                    <span class="text-gray-700 text-sm">{{ $job->formatted_salary }}</span>
                </div>
                <div class="flex items-center rounded-xl p-4 border border-gray-200">
                    <span class="text-gray-700 text-sm">
                        Apply before: {{ $job->application_deadline ? $job->application_deadline->format('d M Y') : 'N/A' }}
                    </span>
                </div>
            </div>

            <!-- Job Description -->
            <div class="mb-10">
                <h3 class="text-2xl font-semibold text-gray-900 border-l-4 border-green-600 pl-3">Job Description</h3>
                <p class="text-gray-700 text-sm leading-relaxed text-justify whitespace-pre-line">
                    {{ $job->description }}
                </p>
            </div>

            <!-- Requirements -->
            @if($job->requirements)
            <div class="mb-10">
                <h3 class="text-2xl font-semibold text-gray-900 mb-4 border-l-4 border-green-600 pl-3">Requirements</h3>
                <ul class="list-disc pl-6 space-y-2 text-gray-700 text-sm">
                    @foreach(explode("\n", $job->requirements) as $req)
                        @if(trim($req) !== '')
                            <li>{{ trim($req) }}</li>
                        @endif
                    @endforeach
                </ul>
            </div>
            @endif

            <!-- Benefits -->
            @if($job->benefits && is_array($job->benefits))
            <div class="mb-10">
                <h3 class="text-2xl font-semibold text-gray-900 mb-4 border-l-4 border-green-600 pl-3">Benefits</h3>
                <ul class="list-disc pl-6 space-y-2 text-gray-700 text-sm">
                    @foreach($job->benefits as $benefit)
                        <li>{{ $benefit }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <!-- Footer -->
            <div class="flex flex-col md:flex-row md:items-center md:justify-between mt-12 space-y-4 md:space-y-0">
                <span class="text-sm text-gray-500">Posted {{ $job->created_at->diffForHumans() }}</span>
                <div class="flex items-center space-x-3">
                    <a href="{{ route('home') }}"
                        class="px-4 py-2 rounded-lg border text-sm border-gray-300 text-gray-700 hover:bg-gray-100 transition">
                        Back to Jobs
                    </a>
                    <a href="#apply"
                        class="px-4 py-2 rounded-lg bg-green-600 text-white text-sm font-medium hover:bg-green-700 shadow-lg transition">
                        Apply Now
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    
    <div class="mb-8 space-y-2">
        <h1 class="text-2xl font-bold text-gray-800">Admin Dashboard</h1>
        <p class="text-gray-600 text-sm">Overview of the platform statistics</p>
    </div>
    <!-- Quick Actions Navbar -->
   <div class="mb-8 bg-white rounded-xlpx-4 py-3 flex flex-wrap gap-4">
       <a href=""
          class="text-gray-700 hover:text-blue-600 font-medium px-3 py-2 rounded text-sm border border-gray-200 rounded-xl transition-colors">
           Manage Users
       </a>
       <a href=""
          class="text-gray-700 hover:text-green-600 font-medium px-3 py-2 rounded text-sm border border-gray-200 rounded-xl transition-colors">
           Manage Employers
       </a>
       <a href="{{ route('admin.categories') }}"
          class="text-gray-700 hover:text-fuchsia-600 font-medium px-3 py-2 rounded text-sm border border-gray-200 rounded-xl transition-colors">
           Manage Categories
       </a>
       <a href=""
          class="text-gray-700 hover:text-yellow-600 font-medium px-3 py-2 rounded text-sm border border-gray-200 rounded-xl transition-colors">
           Manage Jobs
       </a>
       <a href=""
          class="text-gray-700 hover:text-red-600 font-medium px-3 py-2 rounded text-sm border border-gray-200 rounded-xl transition-colors">
           Review Applications
       </a>
   </div>
    
    <!-- Stats Cards -->    
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-xl p-6 border border-gray-200">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path>
                    </svg>
                </div>
                <div class="ml-4 space-y-1">
                    <p class="text-xl font-semibold text-gray-800">12</p>
                    <p class="text-gray-600 text-sm">Total Jobs</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl p-6 border border-gray-200">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-green-100 text-green-600">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-xl font-semibold text-gray-800">8</p>
                    <p class="text-sm text-gray-600">Active Jobs</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl p-6 border border-gray-200">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-yellow-100 text-yellow-600">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-xl font-semibold text-gray-800">25</p>
                    <p class="text-sm text-gray-600">Total Applications</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl p-6 border border-gray-200">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-red-100 text-red-600">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-xl font-semibold text-gray-800">3</p>
                    <p class="text-sm text-gray-600">Pending Applications</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

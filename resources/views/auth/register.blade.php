@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-100 relative overflow-hidden">
    <!-- Background dekoratif lingkaran -->
    <div class="absolute -top-32 -left-32 w-96 h-96 bg-gradient-to-r from-green-400 to-teal-500 rounded-full opacity-30 animate-pulse"></div>
    <div class="absolute -bottom-40 -right-40 w-96 h-96 bg-gradient-to-r from-blue-400 to-purple-500 rounded-full opacity-30 animate-pulse"></div>

    <!-- Form registrasi -->
    <div class="relative z-10 w-full max-w-md bg-white p-10 rounded-2xl shadow-xl">
        <h1 class="text-3xl font-extrabold text-center text-gray-800 mb-6">Register</h1>

        <form action="{{ route('register') }}" method="POST" class="space-y-5">
            @csrf
            <div>
                <label class="block text-gray-700 mb-1">Name</label>
                <input type="text" name="name" placeholder="Your Name" class="w-full px-5 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-blue-400 focus:outline-none transition duration-300" required>
            </div>
            <div>
                <label class="block text-gray-700 mb-1">Email</label>
                <input type="email" name="email" placeholder="you@example.com" class="w-full px-5 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-blue-400 focus:outline-none transition duration-300" required>
            </div>
            <div>
                <label class="block text-gray-700 mb-1">Password</label>
                <input type="password" name="password" placeholder="********" class="w-full px-5 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-blue-400 focus:outline-none transition duration-300" required>
            </div>
            <div>
                <label class="block text-gray-700 mb-1">Confirm Password</label>
                <input type="password" name="password_confirmation" placeholder="********" class="w-full px-5 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-blue-400 focus:outline-none transition duration-300" required>
            </div>
            <div>
                <label class="block text-gray-700 mb-1">Role</label>
                <select name="role" class="w-full px-5 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-blue-400 focus:outline-none transition duration-300">
                    <option value="job_seeker">Job Seeker</option>
                    <option value="employer">Employer</option>
                </select>
            </div>

            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-xl font-semibold shadow-lg transition duration-300 hover:shadow-xl">Register</button>
        </form>

        <p class="mt-6 text-center text-gray-500">
            Already have an account? <a href="{{ route('login') }}" class="text-blue-600 hover:underline font-medium">Login</a>
        </p>
    </div>
</div>
@endsection

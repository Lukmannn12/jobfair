<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Jobfier - Find Your Dream Job')</title>
    @vite('resources/css/app.css')
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>

<body class="font-poppins">

    <!-- Navigation -->
    <nav class="bg-white shadow-md sticky top-0 z-50">
        <div class="container mx-auto px-6">
            <div class="flex justify-between h-16 items-center">
                <a href="" class="text-2xl font-bold text-blue-600 hover:text-blue-700 transition-colors">Jobfier</a>
                
                <div class="hidden md:flex items-center space-x-6 text-gray-700 font-medium text-sm">
                    <a href="" class="hover:text-blue-600 transition">Home</a>
                    <a href="" class="hover:text-blue-600 transition">Jobs</a>

                    @auth
                    @if(auth()->user()->isEmployer())
                    <a href="{{ route('employer.dashboard') }}" class="hover:text-blue-600 transition">Dashboard</a>
                    @elseif(auth()->user()->isAdmin())
                    <a href="" class="hover:text-blue-600 transition">Admin</a>
                    @endif

                    <div class="relative group">
                        <button class="flex items-center gap-1 hover:text-blue-600 transition">
                            {{ auth()->user()->name }}
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </button>
                        <div
                            class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300">
                            <a href="{{ route('employer.profile.show') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profile</a>
                            <form method="post" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                    class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Logout</button>
                            </form>
                        </div>
                    </div>
                    @else
                    <a href="{{ route('login') }}" class="hover:text-blue-600 transition">Login</a>
                    <a href="{{ route('register') }}"
                        class="bg-green-500 text-white px-4 py-2 rounded-lg text-sm hover:bg-green-700 transition">Sign Up</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-300 py-16 mt-16">
        <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 md:grid-cols-4 gap-8">
            <div>
                <h3 class="text-xl font-bold mb-4 text-white">Jobfier</h3>
                <p>Find your dream job or hire the best talents.</p>
            </div>
            <div>
                <h4 class="font-semibold mb-4 text-white">For Job Seekers</h4>
                <ul class="space-y-2">
                    <li><a href="#" class="hover:text-white transition">Browse Jobs</a></li>
                    <li><a href="#" class="hover:text-white transition">Career Advice</a></li>
                    <li><a href="#" class="hover:text-white transition">Resume Builder</a></li>
                </ul>
            </div>
            <div>
                <h4 class="font-semibold mb-4 text-white">For Employers</h4>
                <ul class="space-y-2">
                    <li><a href="#" class="hover:text-white transition">Post Jobs</a></li>
                    <li><a href="#" class="hover:text-white transition">Search Candidates</a></li>
                    <li><a href="#" class="hover:text-white transition">Employer Branding</a></li>
                </ul>
            </div>
            <div>
                <h4 class="font-semibold mb-4 text-white">Company</h4>
                <ul class="space-y-2">
                    <li><a href="#" class="hover:text-white transition">About Us</a></li>
                    <li><a href="#" class="hover:text-white transition">Contact</a></li>
                    <li><a href="#" class="hover:text-white transition">Privacy Policy</a></li>
                </ul>
            </div>
        </div>
        <div class="border-t border-gray-700 mt-8 pt-8 text-center text-gray-500">
            <p>&copy; 2024 Jobfier. All rights reserved.</p>
        </div>
    </footer>

    
    {{-- Toast Notification --}}
    @if(session('success') || session('error'))
    <div id="toast"
        class="fixed top-20 right-5 z-[9999]
        {{ session('success') ? 'text-green-600 border-green-300' : 'text-red-600 border-red-300' }}
        bg-white border shadow-lg tracking-wide font-medium text-sm px-5 py-3 rounded-lg flex items-center justify-between min-w-[250px] opacity-0 transition-opacity duration-500 ease-in-out">

        <span>{{ session('success') ?? session('error') }}</span>
        <button onclick="hideToast()"
            class="ml-3 {{ session('success') ? 'text-green-400 hover:text-green-600' : 'text-red-400 hover:text-red-600' }} font-bold">
            &times;
        </button>
    </div>

    <script>
        const toast = document.getElementById('toast');

        if (toast) {
            // Fade in
            setTimeout(() => {
                toast.classList.add('opacity-100');
            }, 100);

            // Auto fade out
            setTimeout(() => {
                hideToast();
            }, 3000);

            function hideToast() {
                toast.classList.remove('opacity-100');
                toast.classList.add('opacity-0');
                setTimeout(() => toast.style.display = 'none', 500);
            }
        }
    </script>
    @endif

</body>

</html>

@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto mt-10 border p-2 border-gray-200 rounded-xl">
    <!-- Header Profile -->
    <div class="bg-gradient-to-r from-blue-500 to-indigo-600 text-white rounded-xl p-6 flex items-center gap-6 ">
        <div class="w-20 h-20 bg-white rounded-full flex items-center justify-center shadow-inner text-blue-600 text-3xl font-bold">
            {{ strtoupper(substr($profile->company_name ?? 'NT', 0, 2)) }}
        </div>
        <div>
            <h1 class="text-3xl font-bold">{{ $profile->company_name ?? 'Nama Perusahaan' }}</h1>
            <p class="mt-1 text-blue-100">
                {{ $profile->company_description ?? 'Deskripsi singkat perusahaan...' }}
            </p>
        </div>
    </div>

    <!-- Info Details -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-8">
        <!-- Website Card -->
        <div class="bg-white rounded-xl p-6 flex items-center gap-4 border border-gray-200">
            <div class="p-4 bg-blue-100 text-blue-600 rounded-full">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 11c0-4 4-4 4-4s4 0 4 4-4 4-4 4-4 0-4-4z" />
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 11v10m0 0H8m4 0h4" />
                </svg>
            </div>
            <div class="space-y-2">
                <h2 class="text-md font-semibold text-gray-700">Website</h2>
                @if($profile && $profile->company_website)
                    <p class="text-blue-600 underline text-sm">
                        <a href="{{ $profile->company_website }}" target="_blank">{{ $profile->company_website }}</a>
                    </p>
                @else
                    <p class="text-gray-400">Belum ada website</p>
                @endif
            </div>
        </div>

        <!-- Description Card -->
        <div class="bg-white rounded-xl shadow-md p-6 flex items-start gap-4 hover:shadow-xl transition-shadow">
            <div class="p-4 bg-green-100 text-green-600 rounded-full">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16h6M5 6h14M5 20h14" />
                </svg>
            </div>
            <div class="space-y-2">
                <h2 class="text-md font-semibold text-gray-700">Description</h2>
                <p class="text-gray-600 text-sm">
                    {{ $profile->company_description ?? 'Deskripsi perusahaan belum diisi.' }}
                </p>
            </div>
        </div>
    </div>

    <!-- Actions -->
    <div class="pt-5 flex justify-end">
        <a href="{{ route('employer.profile.edit') }}"
           class="bg-indigo-600 text-white px-6 py-2 text-sm rounded-xl hover:bg-indigo-700 transition-colors shadow-md">
            Edit Profile
        </a>
    </div>
</div>
@endsection

@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8">
    <div class="bg-white shadow-xl rounded-2xl p-8 max-w-5xl mx-auto">
        <h2 class="text-2xl font-bold text-gray-800 mb-6 border-b pb-3">🚀 Post New Job</h2>
        @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
            <ul class="list-disc ml-5 text-sm">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <form action="{{ route('employer.jobs.store') }}" method="POST" class="space-y-6">
            @csrf

            <!-- Grid 2 kolom -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Title -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Job Title</label>
                    <input type="text" name="title" value="{{ old('title') }}"
                        class="mt-1 w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-green-400 focus:outline-none"
                        required>
                </div>

                <!-- Location -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Location</label>
                    <input type="text" name="location" value="{{ old('location') }}"
                        class="mt-1 w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-green-400 focus:outline-none"
                        required>
                </div>

                <!-- Type -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Type</label>
                    <select name="type"
                        class="mt-1 w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-green-400 focus:outline-none"
                        required>
                        <option value="">-- Pilih --</option>
                        <option value="full_time">Full Time</option>
                        <option value="part_time">Part Time</option>
                        <option value="contract">Contract</option>
                        <option value="internship">Internship</option>
                    </select>
                </div>

                <!-- Level -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Level</label>
                    <select name="level"
                        class="mt-1 w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-green-400 focus:outline-none"
                        required>
                        <option value="">-- Pilih --</option>
                        <option value="entry">Entry</option>
                        <option value="junior">Junior</option>
                        <option value="mid">Mid</option>
                        <option value="senior">Senior</option>
                        <option value="lead">Lead</option>
                    </select>
                </div>

                <!-- Salary Min -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Salary Min</label>
                    <input type="number" step="0.01" name="salary_min" value="{{ old('salary_min') }}"
                        class="mt-1 w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-green-400 focus:outline-none">
                </div>

                <!-- Salary Max -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Salary Max</label>
                    <input type="number" step="0.01" name="salary_max" value="{{ old('salary_max') }}"
                        class="mt-1 w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-green-400 focus:outline-none">
                </div>
            </div>

            <!-- Negotiable -->
            <div>
                <label class="inline-flex items-center">
                    <input type="checkbox" name="salary_negotiable" value="1"
                        class="rounded border-gray-300 text-green-600 focus:ring-2 focus:ring-green-400">
                    <span class="ml-2 text-sm">Salary Negotiable</span>
                </label>
            </div>

            <!-- Description -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Description</label>
                <textarea name="description" rows="4"
                    class="mt-1 w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-green-400 focus:outline-none"
                    required>{{ old('description') }}</textarea>
            </div>

            <!-- Requirements -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Requirements</label>
                <textarea name="requirements" rows="4"
                    class="mt-1 w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-green-400 focus:outline-none"
                    required>{{ old('requirements') }}</textarea>
            </div>

            <!-- Grid 2 kolom -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Benefits -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Benefits (pisahkan dengan koma)</label>
                    <input type="text" name="benefits" placeholder="Contoh: BPJS, Tunjangan, Cuti Tahunan" value="{{ old('benefits') }}"
                        class="mt-1 w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-green-400 focus:outline-none">
                </div>

                <!-- Deadline -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Application Deadline</label>
                    <input type="date" name="application_deadline" value="{{ old('application_deadline') }}"
                        class="mt-1 w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-green-400 focus:outline-none">
                </div>
            </div>

            <!-- Category -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Category</label>
                <select name="category_id"
                    class="mt-1 w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-green-400 focus:outline-none"
                    required>
                    <option value="">-- Pilih Kategori --</option>
                    @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Buttons -->
            <div class="flex justify-end space-x-3 pt-4 border-t">
                <a href="{{ route('employer.jobs') }}"
                    class="px-5 py-2 rounded-lg bg-gray-100 hover:bg-gray-200 text-sm font-medium">Batal</a>
                <button type="submit"
                    class="px-5 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg text-sm font-medium shadow">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
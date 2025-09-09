@extends('layouts.app')

@section('content')

<div class="container mx-auto py-5">
    <div class="mx-auto" x-data="{ loading: true, loadingTable: true }"
        x-init="setTimeout(() => { loading = false; loadingTable = false }, 1500)">

        <!-- Judul -->
        <h1
            class="text-xl py-5 font-bold bg-gradient-to-r from-green-600 to-blue-600 bg-clip-text text-transparent relative inline-block">
            Dashboard <span class="text-gray-400">→</span> Manajemen Jobs
        </h1>

        <!-- Table Section -->
        <div class="bg-white border border-gray-200 rounded-lg overflow-hidden">
            <div>
                <!-- Header Action -->
                <div class="flex justify-between items-center px-6 py-4 border-b border-gray-200">
                    <!-- Tombol Tambah -->
                    <template x-if="!loadingTable">
                        <a href="{{ route('employer.jobs.create') }}"
                            class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg text-sm shadow">
                            + Tambah Job
                        </a>
                    </template>
                </div>

                <!-- Table -->
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 text-sm">
                        <thead class="bg-gray-100 text-center">
                            <tr>
                                <th class="p-4">No</th>
                                <th class="p-4">Title</th>
                                <th class="p-4">Location</th>
                                <th class="p-4">Type</th>
                                <th class="p-4">Level</th>
                                <th class="p-4">Salary</th>
                                <th class="p-4">Status</th>
                                <th class="p-4">Negotiable</th>
                                <th class="p-4">Deadline</th>
                                <th class="p-4">Category</th>
                                <th class="p-4">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 text-center text-sm">
                            @if($jobs->isEmpty())
                            <tr>
                                <td colspan="10" class="py-6 text-gray-500">Tidak ada data</td>
                            </tr>
                            @else
                            @foreach ($jobs as $job)
                            <tr>
                                <td class="p-4">{{ $jobs->firstItem() + $loop->index }}</td>
                                <td class="p-4">{{ $job->title }}</td>
                                <td class="p-4">{{ $job->location }}</td>
                                <td class="p-4">{{ $job->type }}</td>
                                <td class="p-4">{{ $job->level }}</td>
                                <td class="p-4">
                                    Rp {{ number_format($job->salary_min) }} - {{ number_format($job->salary_max) }}
                                </td>
                                <td class="p-4">
                                    @if ($job->status === 'active')
                                    <span
                                        class="px-3 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                        Active
                                    </span>
                                    @elseif ($job->status === 'inactive')
                                    <span
                                        class="px-3 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                        Inactive
                                    </span>
                                    @elseif ($job->status === 'closed')
                                    <span class="px-3 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">
                                        Closed
                                    </span>
                                    @endif
                                </td>
                                <td class="p-4">
                                    {{ $job->salary_negotiable ? 'Ya' : 'Tidak' }}
                                </td>
                                <td class="p-4">{{ \Carbon\Carbon::parse($job->application_deadline)->format('d M Y') }}
                                </td>
                                <td class="p-4">{{ $job->category->name ?? '-' }}</td>
                                <td class="p-4 flex justify-center space-x-2">
                                    <!-- Tombol Edit -->
                                    <a href="" class="bg-blue-600 text-white px-3 py-1 rounded-lg text-sm">
                                        Edit
                                    </a>
                                    <!-- Tombol Delete -->
                                    <form action="{{ route('employer.jobs.destroy', $job->id) }}" method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus job ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-lg text-sm">
                                            Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>

                <div class="mt-4 px-6">
                    {{ $jobs->links() }}
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
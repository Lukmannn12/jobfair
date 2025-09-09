@extends('layouts.app')

@section('content')

<div class="container mx-auto py-5">
    <div class="mx-auto" x-data="{ loading: true, loadingTable: true, openModal: false }"
        x-init="setTimeout(() => { loading = false; loadingTable = false }, 1500)">

        <!-- Judul -->
        <h1
            class="text-xl py-5 font-bold bg-gradient-to-r from-green-600 to-blue-600 bg-clip-text text-transparent relative inline-block">
            Dashboard <span class="text-gray-400">→</span> Manajemen Category
        </h1>

        <!-- Table Section -->
        <div class="bg-white border border-gray-200 rounded-lg overflow-hidden">
            <div>
                <!-- Header Action -->
                <div class="flex justify-between items-center px-6 py-4 border-b border-gray-200">
                    {{-- Tambah Data --}}
                    <div>
                        <!-- Tombol Tambah -->
                        <template x-if="!loadingTable">
                            <button @click="openModal = true"
                                class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg text-sm shadow">
                                + Tambah Kategori
                            </button>
                        </template>

                        <!-- Modal -->
                        <div x-show="openModal" class="fixed inset-72 z-50 flex items-start justify-center"
                            x-transition>
                            <div @click.away="openModal = false"
                                class="bg-white w-full max-w-md rounded-2xl shadow-lg p-6 relative">

                                <h2 class="text-lg font-semibold text-gray-800 mb-4">Tambah Kategori</h2>

                                <form action="{{ route('admin.categories.store') }}" method="POST">
                                    @csrf
                                    <div class="mb-4 text-left">
                                        <label class="block text-sm font-medium text-gray-700">Nama Kategori</label>
                                        <input type="text" name="name"
                                            class="mt-1 w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring focus:ring-blue-300 focus:outline-none"
                                            required>
                                    </div>

                                    <div class="mb-4 text-left">
                                        <label class="block text-sm font-medium text-gray-700">Icon (opsional)</label>
                                        <input type="text" name="icon"
                                            class="mt-1 w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring focus:ring-blue-300 focus:outline-none"
                                            placeholder="contoh: fa-solid fa-star">
                                    </div>

                                    <div class="flex justify-end space-x-2">
                                        <button type="button" @click="openModal = false"
                                            class="px-4 py-2 bg-gray-300 hover:bg-gray-400 rounded-lg text-sm">
                                            Batal
                                        </button>
                                        <button type="submit"
                                            class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg text-sm">
                                            Simpan
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>


                    </div>
                </div>

                <!-- Table -->
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 text-sm">
                        <thead class="bg-gray-100 text-center">
                            <tr>
                                <th class="p-4">No</th>
                                <th class="p-4">Kategori</th>
                                <th class="p-4">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 text-center text-sm">
                            @if($categories->isEmpty())
                            <tr>
                                <td colspan="3" class="py-6 text-gray-500">Tidak ada data</td>
                            </tr>
                            @else
                            @foreach ($categories as $category)
                            <tr>
                                <td class="p-4">
                                    {{ $categories->firstItem() + $loop->index }}
                                </td>
                                <td class="p-4">{{ $category->name }}</td>
                                <td class="p-4 flex justify-center space-x-2">
                                    <!-- Tombol Edit -->
                                    <div x-data="{ openModal: false }">
                                        <button @click="openModal = true"
                                            class="bg-blue-600 text-white px-3 py-1 rounded-lg text-sm mx-1 flex items-center space-x-1">
                                            <!-- Icon pensil -->
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M11 5H6a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-5M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z" />
                                            </svg>
                                            <span>Edit</span>
                                        </button>

                                        <!-- Modal -->
                                        <div x-show="openModal" x-transition
                                            class="fixed inset-0 z-50 pt-40 flex items-start justify-center bg-opacity-40"
                                            x-cloak>
                                            <div @click.away="openModal = false"
                                                class="bg-white rounded-lg shadow-lg w-full max-w-md mx-2 p-6">

                                                <!-- Header -->
                                                <div class="flex justify-between items-center mb-4">
                                                    <h3 class="text-lg font-semibold text-gray-800">Edit Kategori</h3>
                                                    <button @click="openModal = false"
                                                        class="text-gray-500 hover:text-gray-700">&times;</button>
                                                </div>

                                                <!-- Body -->
                                                <form method="POST" action="" class="space-y-3">
                                                    @csrf
                                                    @method('PUT')
                                                    <div>
                                                        <div class="mb-4 text-left">
                                                            <label class="block text-sm font-medium text-gray-700">Nama
                                                                Kategori</label>
                                                            <input type="text" name="name"
                                                                value="{{ old('name', $category->name) }}"
                                                                class="mt-1 w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring focus:ring-blue-300 focus:outline-none"
                                                                required>
                                                        </div>
                                                    </div>

                                                    <!-- Footer -->
                                                    <div class="mt-4 flex justify-end space-x-2">
                                                        <button type="button" @click="openModal = false"
                                                            class="px-4 py-2 rounded-lg bg-gray-100 hover:bg-gray-200 text-sm">Batal</button>
                                                        <button type="submit"
                                                            class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg text-sm">Simpan</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Tombol Delete -->
                                    <form action="" method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus kategori ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-lg text-sm mx-1 flex items-center space-x-1">
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

                <div class="mt-4">
    {{ $categories->links() }}
</div>
            </div>
        </div>

    </div>
</div>
@endsection
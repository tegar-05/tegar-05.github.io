@extends('admin.layout')

@section('title', 'Menus Management')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Page Header -->
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">Menus Management</h1>
            <nav class="text-sm text-gray-600 mt-2">
                <span>Admin</span> > <span class="text-blue-600">Menus</span>
            </nav>
        </div>
        <a href="{{ route('admin.menus.create') }}"
           class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-medium transition-colors duration-200 shadow-md">
            <i class="fas fa-plus mr-2"></i>Add New Menu
        </a>
    </div>

    <!-- Search and Filters -->
    <div class="bg-white rounded-lg shadow-md p-6 mb-6">
        <form method="GET" class="flex flex-wrap gap-4">
            <div class="flex-1 min-w-64">
                <input type="text" name="search" value="{{ request('search') }}"
                       placeholder="Search menus..."
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            </div>
            <div class="min-w-48">
                <select name="category" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    <option value="">All Categories</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>
                            {{ $cat->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="min-w-48">
                <select name="is_popular" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    <option value="">All Popularity</option>
                    <option value="1" {{ request('is_popular') == '1' ? 'selected' : '' }}>Popular</option>
                    <option value="0" {{ request('is_popular') == '0' ? 'selected' : '' }}>Not Popular</option>
                </select>
            </div>
            <div class="min-w-48">
                <select name="is_active" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    <option value="">All Status</option>
                    <option value="1" {{ request('is_active') == '1' ? 'selected' : '' }}>Active</option>
                    <option value="0" {{ request('is_active') == '0' ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>
            <button type="submit" class="bg-gray-600 hover:bg-gray-700 text-white px-6 py-2 rounded-lg font-medium transition-colors duration-200">
                <i class="fas fa-search mr-2"></i>Search
            </button>
            @if(request('search') || request('category') || request('is_popular') || request('is_active'))
                <a href="{{ route('admin.menus.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-2 rounded-lg font-medium transition-colors duration-200">
                    <i class="fas fa-times mr-2"></i>Clear
                </a>
            @endif
        </form>
    </div>

    <!-- Products Table -->
    <div class="bg-white shadow-lg rounded-xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">ID</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Name</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Category</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Price</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($menus as $menu)
                        <tr class="hover:bg-gray-50 transition-colors duration-200">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                #{{ $menu->id }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ $menu->name }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                <span class="px-2 py-1 text-xs font-medium rounded-full
                                    {{ $menu->category === 'Coffee' ? 'bg-blue-100 text-blue-800' :
                                       ($menu->category === 'Non-Coffee' ? 'bg-green-100 text-green-800' :
                                       ($menu->category === 'Dessert' ? 'bg-yellow-100 text-yellow-800' :
                                       'bg-purple-100 text-purple-800')) }}">
                                    {{ $menu->category }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                Rp {{ number_format($menu->price, 0, ',', '.') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                <a href="{{ route('admin.menus.show', $menu->id) }}"
                                   class="inline-flex items-center px-3 py-1 rounded-md text-sm font-medium text-blue-700 bg-blue-100 hover:bg-blue-200 transition-colors duration-200">
                                    <i class="fas fa-eye mr-1"></i>View
                                </a>
                                <a href="{{ route('admin.menus.edit', $menu->id) }}"
                                   class="inline-flex items-center px-3 py-1 rounded-md text-sm font-medium text-yellow-700 bg-yellow-100 hover:bg-yellow-200 transition-colors duration-200">
                                    <i class="fas fa-edit mr-1"></i>Edit
                                </a>
                                <form action="{{ route('admin.menus.destroy', $menu->id) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="inline-flex items-center px-3 py-1 rounded-md text-sm font-medium text-red-700 bg-red-100 hover:bg-red-200 transition-colors duration-200"
                                            onclick="return confirm('Are you sure you want to delete this menu?')">
                                        <i class="fas fa-trash mr-1"></i>Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-gray-500">
                                <div class="flex flex-col items-center">
                                    <i class="fas fa-utensils text-6xl text-gray-300 mb-4"></i>
                                    <p class="text-lg font-medium">No menus found</p>
                                    <p class="text-sm">Get started by adding your first menu.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($menus->hasPages())
            <div class="px-6 py-4 bg-gray-50 border-t">
                {{ $menus->links() }}
            </div>
        @endif
    </div>
</div>
@endsection

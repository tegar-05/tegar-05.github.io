@extends('admin.layout')

@section('title', 'Category Details')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Page Header -->
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">Category Details</h1>
            <nav class="text-sm text-gray-600 mt-2">
                <span>Admin</span> > <a href="{{ route('admin.categories.index') }}" class="text-blue-600 hover:underline">Categories</a> > <span class="text-blue-600">{{ $category->name }}</span>
            </nav>
        </div>
        <div class="flex space-x-3">
            <a href="{{ route('admin.categories.edit', $category->id) }}"
               class="px-4 py-2 bg-yellow-600 hover:bg-yellow-700 text-white rounded-lg font-medium transition-colors duration-200">
                <i class="fas fa-edit mr-2"></i>Edit
            </a>
            <a href="{{ route('admin.categories.index') }}"
               class="px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white rounded-lg font-medium transition-colors duration-200">
                <i class="fas fa-arrow-left mr-2"></i>Back to List
            </a>
        </div>
    </div>

    <!-- Category Details -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Basic Information -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h2 class="text-xl font-semibold mb-4">Basic Information</h2>

            <dl class="space-y-3">
                <div>
                    <dt class="text-sm font-medium text-gray-500">Name</dt>
                    <dd class="text-sm text-gray-900">{{ $category->name }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500">Slug</dt>
                    <dd class="text-sm text-gray-900">{{ $category->slug }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500">Status</dt>
                    <dd class="text-sm">
                        <span class="px-2 py-1 text-xs font-medium rounded-full
                            {{ $category->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            {{ $category->is_active ? 'Active' : 'Inactive' }}
                        </span>
                    </dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500">Created At</dt>
                    <dd class="text-sm text-gray-900">{{ $category->created_at->format('d M Y, H:i') }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500">Updated At</dt>
                    <dd class="text-sm text-gray-900">{{ $category->updated_at->format('d M Y, H:i') }}</dd>
                </div>
            </dl>
        </div>

        <!-- Description -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h2 class="text-xl font-semibold mb-4">Description</h2>
            @if($category->description)
                <div class="text-sm text-gray-700 bg-gray-50 rounded-lg p-4">
                    {!! nl2br(e($category->description)) !!}
                </div>
            @else
                <p class="text-sm text-gray-500 italic">No description provided.</p>
            @endif
        </div>
    </div>

    <!-- Products in Category -->
    <div class="mt-6 bg-white rounded-lg shadow-md p-6">
        <h2 class="text-xl font-semibold mb-4">Products in this Category</h2>

        @if($category->products->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach($category->products as $product)
                    <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition-shadow duration-200">
                        @if($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                                 class="w-full h-32 object-cover rounded-lg mb-3">
                        @else
                            <div class="w-full h-32 bg-gray-200 rounded-lg flex items-center justify-center mb-3">
                                <i class="fas fa-image text-gray-400"></i>
                            </div>
                        @endif
                        <h3 class="font-medium text-gray-900 mb-1">{{ $product->name }}</h3>
                        <p class="text-sm text-gray-600 mb-2">${{ number_format($product->price, 2) }}</p>
                        <span class="px-2 py-1 text-xs font-medium rounded-full
                            {{ $product->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            {{ $product->is_active ? 'Active' : 'Inactive' }}
                        </span>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-8">
                <i class="fas fa-box-open text-6xl text-gray-300 mb-4"></i>
                <p class="text-lg font-medium text-gray-500">No products in this category</p>
                <p class="text-sm text-gray-400">Add products to this category to see them here.</p>
            </div>
        @endif
    </div>

    <!-- Delete Section -->
    <div class="mt-6 bg-white rounded-lg shadow-md p-6">
        <h2 class="text-xl font-semibold mb-4 text-red-600">Danger Zone</h2>
        <p class="text-sm text-gray-600 mb-4">
            Once you delete this category, there is no going back. Please be certain.
        </p>
        <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" class="inline-block">
            @csrf
            @method('DELETE')
            <button type="submit"
                    class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg font-medium transition-colors duration-200"
                    onclick="return confirm('Are you sure you want to delete this category? This action cannot be undone.')">
                <i class="fas fa-trash mr-2"></i>Delete Category
            </button>
        </form>
    </div>
</div>
@endsection

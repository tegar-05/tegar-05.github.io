@extends('admin.layout')

@section('title', 'Florist Details')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Page Header -->
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">Florist Details</h1>
            <nav class="text-sm text-gray-600 mt-2">
                <span>Admin</span> > <a href="{{ route('admin.florists.index') }}" class="text-blue-600 hover:underline">Florists</a> > <span class="text-blue-600">{{ $florist->name }}</span>
            </nav>
        </div>
        <div class="flex space-x-3">
            <a href="{{ route('admin.florists.edit', $florist->id) }}"
               class="px-4 py-2 bg-yellow-600 hover:bg-yellow-700 text-white rounded-lg font-medium transition-colors duration-200">
                <i class="fas fa-edit mr-2"></i>Edit
            </a>
            <a href="{{ route('admin.florists.index') }}"
               class="px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white rounded-lg font-medium transition-colors duration-200">
                <i class="fas fa-arrow-left mr-2"></i>Back to List
            </a>
        </div>
    </div>

    <!-- Florist Details -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Image Section -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-xl font-semibold mb-4">Florist Image</h2>
                @if($florist->image)
                    <img src="{{ asset('storage/' . $florist->image) }}" alt="{{ $florist->name }}"
                         class="w-full max-h-64 object-cover rounded-lg border">
                @else
                    <div class="w-full h-64 bg-gray-200 rounded-lg flex items-center justify-center">
                        <i class="fas fa-store text-6xl text-gray-400"></i>
                    </div>
                @endif
            </div>
        </div>

        <!-- Details Section -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-xl font-semibold mb-4">Florist Information</h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Basic Info -->
                    <div>
                        <h3 class="text-lg font-medium text-gray-900 mb-3">Basic Information</h3>
                        <dl class="space-y-2">
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Name</dt>
                                <dd class="text-sm text-gray-900">{{ $florist->name }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Phone</dt>
                                <dd class="text-sm text-gray-900">{{ $florist->phone }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Email</dt>
                                <dd class="text-sm text-gray-900">{{ $florist->email ?: 'N/A' }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Status</dt>
                                <dd class="text-sm">
                                    <span class="px-2 py-1 text-xs font-medium rounded-full
                                        {{ $florist->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                        {{ $florist->is_active ? 'Active' : 'Inactive' }}
                                    </span>
                                </dd>
                            </div>
                        </dl>
                    </div>

                    <!-- Address & Dates -->
                    <div>
                        <h3 class="text-lg font-medium text-gray-900 mb-3">Address & Dates</h3>
                        <dl class="space-y-2">
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Address</dt>
                                <dd class="text-sm text-gray-900">{{ $florist->address }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Created At</dt>
                                <dd class="text-sm text-gray-900">{{ $florist->created_at->format('d M Y, H:i') }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Updated At</dt>
                                <dd class="text-sm text-gray-900">{{ $florist->updated_at->format('d M Y, H:i') }}</dd>
                            </div>
                        </dl>
                    </div>
                </div>

                <!-- Description -->
                @if($florist->description)
                    <div class="mt-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-3">Description</h3>
                        <div class="text-sm text-gray-700 bg-gray-50 rounded-lg p-4">
                            {!! nl2br(e($florist->description)) !!}
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Delete Section -->
    <div class="mt-6 bg-white rounded-lg shadow-md p-6">
        <h2 class="text-xl font-semibold mb-4 text-red-600">Danger Zone</h2>
        <p class="text-sm text-gray-600 mb-4">
            Once you delete this florist, there is no going back. Please be certain.
        </p>
        <form action="{{ route('admin.florists.destroy', $florist->id) }}" method="POST" class="inline-block">
            @csrf
            @method('DELETE')
            <button type="submit"
                    class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg font-medium transition-colors duration-200"
                    onclick="return confirm('Are you sure you want to delete this florist? This action cannot be undone.')">
                <i class="fas fa-trash mr-2"></i>Delete Florist
            </button>
        </form>
    </div>
</div>
@endsection

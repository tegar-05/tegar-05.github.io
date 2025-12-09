@extends('admin.layout')

@section('content')
<h1 class="text-2xl font-bold mb-6">Edit Menu</h1>

<form action="{{ route('admin.menu.update',$menu->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
    @csrf @method('PUT')
    <input type="text" name="name" value="{{ $menu->name }}" class="w-full p-3 border rounded-lg" required>
    <textarea name="description" class="w-full p-3 border rounded-lg">{{ $menu->description }}</textarea>
    <input type="number" name="price" value="{{ $menu->price }}" class="w-full p-3 border rounded-lg" required>
    <input type="file" name="image" class="w-full">
    <div class="flex space-x-4">
        <label><input type="checkbox" name="is_popular" {{ $menu->is_popular ? 'checked':'' }}> Populer</label>
        <label><input type="checkbox" name="is_active" {{ $menu->is_active ? 'checked':'' }}> Aktif</label>
    </div>
    <button type="submit" class="px-6 py-3 bg-yellow-600 text-white rounded-lg">Update</button>
</form>
@endsection

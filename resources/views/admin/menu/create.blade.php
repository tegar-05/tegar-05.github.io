
@extends('admin.layouts.main')

@section('content')
<h1 class="text-2xl font-bold mb-6">Tambah Menu</h1>

<form action="{{ route('admin.menu.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
    @csrf
    <input type="text" name="name" placeholder="Nama Menu" class="w-full p-3 border rounded-lg" required>
    <textarea name="description" placeholder="Deskripsi" class="w-full p-3 border rounded-lg"></textarea>
    <input type="number" name="price" placeholder="Harga" class="w-full p-3 border rounded-lg" required>
    <input type="file" name="image" class="w-full">
    <div class="flex space-x-4">
        <label><input type="checkbox" name="is_popular"> Populer</label>
        <label><input type="checkbox" name="is_active" checked> Aktif</label>
    </div>
    <button type="submit" class="px-6 py-3 bg-yellow-600 text-white rounded-lg">Simpan</button>
</form>
@endsection

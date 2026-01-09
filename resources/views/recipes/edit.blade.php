@extends('layouts.app')

@section('title', 'Edit Resep')

@section('content')
    <div class="container mt-4 mb-5">
        <div class="form" style="max-width: 800px; margin: 0 auto;">
            <h2 style="text-align: center; margin-bottom: 2rem;">Edit Resep</h2>

            <form action="{{ route('recipes.update', $recipe) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="title" class="form-label">Judul Resep *</label>
                    <input type="text" name="title" id="title" class="form-control"
                        value="{{ old('title', $recipe->title) }}" required>
                    @error('title')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="category_id" class="form-label">Kategori</label>
                    <select class="form-control @error('category_id') is-invalid @enderror" id="category_id" name="category_id" required>
                        <option value="">Pilih Kategori</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id', $recipe->category_id) == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="description" class="form-label">Deskripsi *</label>
                    <textarea name="description" id="description" class="form-control"
                        required>{{ old('description', $recipe->description) }}</textarea>
                    @error('description')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-2">
                    <div class="form-group">
                        <label for="cooking_time" class="form-label">Waktu Memasak (menit)</label>
                        <input type="number" name="cooking_time" id="cooking_time" class="form-control"
                            value="{{ old('cooking_time', $recipe->cooking_time) }}" min="1">
                        @error('cooking_time')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="servings" class="form-label">Jumlah Porsi</label>
                        <input type="number" name="servings" id="servings" class="form-control"
                            value="{{ old('servings', $recipe->servings) }}" min="1">
                        @error('servings')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label for="ingredients" class="form-label">Bahan-Bahan * (pisahkan dengan enter)</label>
                    <textarea name="ingredients" id="ingredients" class="form-control" rows="6"
                        required>{{ old('ingredients', $recipe->ingredients) }}</textarea>
                    @error('ingredients')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="instructions" class="form-label">Cara Memasak * (pisahkan dengan enter)</label>
                    <textarea name="instructions" id="instructions" class="form-control" rows="8"
                        required>{{ old('instructions', $recipe->instructions) }}</textarea>
                    @error('instructions')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

                @if($recipe->image_url)
                    <div class="form-group">
                        <label class="form-label">Gambar Saat Ini</label>
                        <img src="{{ $recipe->image_url }}" alt="{{ $recipe->title }}"
                            style="max-width: 200px; border-radius: var(--border-radius); display: block;">
                    </div>
                @endif

                <div class="form-group">
                    <label for="image" class="form-label">Gambar Baru (opsional)</label>
                    <input type="file" name="image" id="image" class="form-control" accept="image/*">
                    @error('image')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

                <div style="display: flex; gap: 1rem;">
                    <button type="submit" class="btn btn-primary" style="flex: 1;">
                        <i class="fas fa-save"></i> Simpan Perubahan
                    </button>
                    <a href="{{ route('recipes.show', $recipe) }}" class="btn btn-outline" style="flex: 1;">
                        <i class="fas fa-times"></i> Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection
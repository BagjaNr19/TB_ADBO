@extends('layouts.app')

@section('title', 'Buat Resep Baru')

@section('content')
    <div class="container mt-4 mb-5">
        <div class="form" style="max-width: 800px; margin: 0 auto;">
            <h2 style="text-align: center; margin-bottom: 2rem;">Buat Resep Baru</h2>

            <form action="{{ route('recipes.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label for="title" class="form-label">Judul Resep *</label>
                    <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}" required>
                    @error('title')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="category_id" class="form-label">Kategori</label>
                    <select class="form-control @error('category_id') is-invalid @enderror" id="category_id" name="category_id" required>
                        <option value="">Pilih Kategori</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="description" class="form-label">Deskripsi Singkat</label>
                    <textarea name="description" id="description" class="form-control"
                        required>{{ old('description') }}</textarea>
                    @error('description')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-2">
                    <div class="form-group">
                        <label for="cooking_time" class="form-label">Waktu Memasak (menit)</label>
                        <input type="number" name="cooking_time" id="cooking_time" class="form-control"
                            value="{{ old('cooking_time') }}" min="1">
                        @error('cooking_time')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="servings" class="form-label">Jumlah Porsi</label>
                        <input type="number" name="servings" id="servings" class="form-control"
                            value="{{ old('servings') }}" min="1">
                        @error('servings')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label for="ingredients" class="form-label">Bahan-Bahan * (pisahkan dengan enter)</label>
                    <textarea name="ingredients" id="ingredients" class="form-control" rows="6"
                        required>{{ old('ingredients') }}</textarea>
                    @error('ingredients')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="instructions" class="form-label">Cara Memasak * (pisahkan dengan enter)</label>
                    <textarea name="instructions" id="instructions" class="form-control" rows="8"
                        required>{{ old('instructions') }}</textarea>
                    @error('instructions')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="image" class="form-label">Gambar Resep (opsional)</label>
                    <input type="file" name="image" id="image" class="form-control" accept="image/*">
                    @error('image')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

                <div style="display: flex; gap: 1rem;">
                    <button type="submit" class="btn btn-primary" style="flex: 1;">
                        <i class="fas fa-save"></i> Simpan Resep
                    </button>
                    <a href="{{ route('recipes.index') }}" class="btn btn-outline" style="flex: 1;">
                        <i class="fas fa-times"></i> Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection
@extends('layouts.app')

@section('title', 'Edit Profil')

@section('content')
    <div class="container mt-4 mb-5">
        <div class="form" style="max-width: 600px; margin: 0 auto;">
            <h2 style="text-align: center; margin-bottom: 2rem;">Edit Profil</h2>

            <form action="{{ route('profile.update') }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="name" class="form-label">Nama Lengkap</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $user->name) }}"
                        required>
                    @error('name')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" id="email" class="form-control"
                        value="{{ old('email', $user->email) }}" required>
                    @error('email')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="bio" class="form-label">Bio</label>
                    <textarea name="bio" id="bio" class="form-control" rows="4">{{ old('bio', $user->bio) }}</textarea>
                    @error('bio')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="avatar" class="form-label">Avatar URL</label>
                    <input type="url" name="avatar" id="avatar" class="form-control"
                        value="{{ old('avatar', $user->avatar) }}" placeholder="https://example.com/avatar.jpg">
                    @error('avatar')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

                <hr style="margin: 2rem 0;">

                <h3 style="font-size: 1.25rem; font-weight: 700; margin-bottom: 1rem;">Ubah Password (opsional)</h3>

                <div class="form-group">
                    <label for="password" class="form-label">Password Baru</label>
                    <input type="password" name="password" id="password" class="form-control">
                    @error('password')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password_confirmation" class="form-label">Konfirmasi Password Baru</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
                </div>

                <button type="submit" class="btn btn-primary" style="width: 100%;">
                    <i class="fas fa-save"></i> Simpan Perubahan
                </button>
            </form>
        </div>
    </div>
@endsection
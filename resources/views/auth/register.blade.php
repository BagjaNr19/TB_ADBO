@extends('layouts.app')

@section('title', 'Registrasi')

@section('content')
    <div class="container mt-5 mb-5">
        <div class="form" style="max-width: 450px; margin: 0 auto;">
            <h2 style="text-align: center; margin-bottom: 2rem;">Daftar Akun Baru</h2>

            <form action="{{ route('register') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="name" class="form-label">Nama Lengkap</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
                    @error('name')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required>
                    @error('email')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" id="password" class="form-control" required>
                    @error('password')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control"
                        required>
                </div>

                <button type="submit" class="btn btn-primary" style="width: 100%;">
                    <i class="fas fa-user-plus"></i> Daftar
                </button>
            </form>

            <p style="text-align: center; margin-top: 1.5rem; color: var(--gray);">
                Sudah punya akun? <a href="{{ route('login') }}" style="color: var(--primary); font-weight: 600;">Login di
                    sini</a>
            </p>
        </div>
    </div>
@endsection
@extends('layouts.app')

@section('title', 'Login')

@section('content')
    <div class="container mt-5 mb-5">
        <div class="form" style="max-width: 450px; margin: 0 auto;">
            <h2 style="text-align: center; margin-bottom: 2rem;">Login ke Akun Anda</h2>

            <form action="{{ route('login') }}" method="POST">
                @csrf

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

                <button type="submit" class="btn btn-primary" style="width: 100%;">
                    <i class="fas fa-sign-in-alt"></i> Login
                </button>
            </form>

            <p style="text-align: center; margin-top: 1.5rem; color: var(--gray);">
                Belum punya akun? <a href="{{ route('register') }}" style="color: var(--primary); font-weight: 600;">Daftar
                    di sini</a>
            </p>
        </div>
    </div>
@endsection
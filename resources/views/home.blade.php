@extends('layouts.app')

@section('title', 'Beranda - Sistem Resep Makanan')

@section('content')
    <!-- Hero Section -->
    <section class="hero">
        <div class="container">
            <h1 class="hero-title">Selamat Datang di Sistem Resep Makanan 🍳</h1>
            <p class="hero-subtitle">Berbagi resep favorit Anda dan temukan inspirasi masakan baru dari komunitas</p>
            <div class="d-flex justify-between align-center" style="gap: 1rem; justify-content: center; margin-top: 2rem;">
                <a href="{{ route('recipes.index') }}" class="btn btn-lg" style="background: white; color: var(--primary);">
                    <i class="fas fa-book-open"></i> Jelajahi Resep
                </a>
                @guest
                    <a href="{{ route('register') }}" class="btn btn-lg btn-outline" style="border-color: white; color: white;">
                        <i class="fas fa-user-plus"></i> Daftar Sekarang
                    </a>
                @else
                    <a href="{{ route('recipes.create') }}" class="btn btn-lg"
                        style="background: var(--secondary); color: white;">
                        <i class="fas fa-plus"></i> Buat Resep Baru
                    </a>
                @endguest
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="container mt-5">
        <h2 class="text-center mb-4" style="font-size: 2rem; font-weight: 700;">Fitur Unggulan</h2>
        <div class="grid grid-3">
            <div class="card">
                <div class="card-body" style="text-align: center;">
                    <div style="font-size: 3rem; color: var(--primary); margin-bottom: 1rem;">
                        <i class="fas fa-utensils"></i>
                    </div>
                    <h3 class="card-title">Berbagi Resep</h3>
                    <p class="card-text">Bagikan resep masakan favorit Anda dengan komunitas kuliner</p>
                </div>
            </div>

            <div class="card">
                <div class="card-body" style="text-align: center;">
                    <div style="font-size: 3rem; color: var(--secondary); margin-bottom: 1rem;">
                        <i class="fas fa-comments"></i>
                    </div>
                    <h3 class="card-title">Interaksi Komunitas</h3>
                    <p class="card-text">Berikan komentar dan feedback pada resep yang Anda coba</p>
                </div>
            </div>

            <div class="card">
                <div class="card-body" style="text-align: center;">
                    <div style="font-size: 3rem; color: var(--success); margin-bottom: 1rem;">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <h3 class="card-title">Pantau Aktivitas</h3>
                    <p class="card-text">Lihat riwayat aktivitas dan kontribusi Anda di platform</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="container mt-5 mb-5">
        <div
            style="background: var(--gradient-secondary); color: white; padding: 3rem; border-radius: var(--border-radius); text-align: center;">
            <h2 style="font-size: 2rem; margin-bottom: 1rem;">Siap Berbagi Resep Anda?</h2>
            <p style="font-size: 1.125rem; margin-bottom: 2rem; opacity: 0.95;">Bergabunglah dengan ribuan pecinta kuliner
                lainnya</p>
            @guest
                <a href="{{ route('register') }}" class="btn btn-lg" style="background: white; color: var(--secondary);">
                    Mulai Sekarang <i class="fas fa-arrow-right"></i>
                </a>
            @endguest
        </div>
    </section>
@endsection
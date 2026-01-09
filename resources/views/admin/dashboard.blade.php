@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
    <div class="container mt-4 mb-5">
        <h1 style="font-size: 2.5rem; font-weight: 800; margin-bottom: 2rem; text-align: center;">
            <i class="fas fa-tachometer-alt"></i> Dashboard Admin
        </h1>

        <!-- Statistics -->
        <div class="grid grid-4" style="margin-bottom: 3rem;">
            <div class="stat-card">
                <div class="stat-value">{{ $stats['total_users'] }}</div>
                <div class="stat-label">Total Pengguna</div>
            </div>
            <div class="stat-card">
                <div class="stat-value">{{ $stats['total_recipes'] }}</div>
                <div class="stat-label">Total Resep</div>
            </div>
            <div class="stat-card">
                <div class="stat-value">{{ $stats['total_comments'] }}</div>
                <div class="stat-label">Total Komentar</div>
            </div>
            <div class="stat-card">
                <div class="stat-value">{{ $stats['total_admins'] }}</div>
                <div class="stat-label">Total Admin</div>
            </div>
        </div>

        <div class="grid grid-2">
            <!-- Recent Recipes -->
            <div
                style="background: white; padding: 2rem; border-radius: var(--border-radius); box-shadow: var(--shadow-md);">
                <h2 style="font-size: 1.5rem; font-weight: 700; margin-bottom: 1.5rem;">
                    <i class="fas fa-utensils"></i> Resep Terbaru
                </h2>

                @foreach($recentRecipes as $recipe)
                    <div
                        style="padding: 1rem; background: var(--light); border-radius: var(--border-radius); margin-bottom: 1rem;">
                        <div style="display: flex; justify-content: space-between; align-items: start;">
                            <div style="flex: 1;">
                                <strong>{{ $recipe->title }}</strong>
                                <p style="color: var(--gray); font-size: 0.875rem; margin-top: 0.25rem;">
                                    <i class="fas fa-user"></i> {{ $recipe->user->name }}
                                </p>
                            </div>
                            <a href="{{ route('recipes.show', $recipe) }}" class="btn btn-sm btn-primary">Lihat</a>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Recent Activities -->
            <div
                style="background: white; padding: 2rem; border-radius: var(--border-radius); box-shadow: var(--shadow-md);">
                <h2 style="font-size: 1.5rem; font-weight: 700; margin-bottom: 1.5rem;">
                    <i class="fas fa-history"></i> Aktivitas Terakhir
                </h2>

                @foreach($recentActivities as $activity)
                    <div
                        style="padding: 1rem; background: var(--light); border-radius: var(--border-radius); margin-bottom: 1rem;">
                        <div style="display: flex; justify-content: space-between; align-items: start;">
                            <div>
                                <strong>{{ $activity->user->name }}</strong>
                                <p style="color: var(--gray); font-size: 0.875rem; margin-top: 0.25rem;">
                                    {{ $activity->description }}
                                </p>
                            </div>
                            <span style="font-size: 0.75rem; color: var(--gray);">
                                {{ $activity->created_at->diffForHumans() }}
                            </span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="mt-4 text-center">
            <a href="{{ route('admin.reports') }}" class="btn btn-primary btn-lg">
                <i class="fas fa-chart-bar"></i> Lihat Laporan Lengkap
            </a>
        </div>
    </div>
@endsection
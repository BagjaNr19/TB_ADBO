@extends('layouts.app')

@section('title', 'Aktivitas Saya')

@section('content')
    <div class="container mt-4 mb-5">
        <h1 style="font-size: 2.5rem; font-weight: 800; margin-bottom: 2rem; text-align: center;">
            Aktivitas Saya
        </h1>

        <!-- Statistics -->
        <div class="grid grid-3" style="margin-bottom: 3rem;">
            <div class="stat-card">
                <div class="stat-value">{{ $stats['total_recipes'] }}</div>
                <div class="stat-label">Total Resep</div>
            </div>
            <div class="stat-card">
                <div class="stat-value">{{ $stats['total_comments'] }}</div>
                <div class="stat-label">Total Komentar</div>
            </div>
            <div class="stat-card">
                <div class="stat-value">{{ $stats['total_activities'] }}</div>
                <div class="stat-label">Total Aktivitas</div>
            </div>
        </div>

        <!-- My Recipes -->
        <div
            style="background: white; padding: 2rem; border-radius: var(--border-radius); box-shadow: var(--shadow-md); margin-bottom: 2rem;">
            <h2 style="font-size: 1.5rem; font-weight: 700; margin-bottom: 1.5rem;">
                <i class="fas fa-utensils"></i> Resep Saya
            </h2>

            @if($myRecipes->isEmpty())
                <p style="text-align: center; color: var(--gray); padding: 2rem;">Belum ada resep</p>
            @else
                <div class="grid grid-2">
                    @foreach($myRecipes as $recipe)
                        <div class="card">
                            <div class="card-body">
                                <h3 class="card-title">{{ $recipe->title }}</h3>
                                <p class="card-text">{{ Str::limit($recipe->description, 80) }}</p>
                                <div style="display: flex; gap: 0.5rem; margin-bottom: 1rem;">
                                    <span class="badge badge-primary">
                                        <i class="fas fa-comments"></i> {{ $recipe->comments->count() }}
                                    </span>
                                    <span class="badge">{{ $recipe->created_at->format('d M Y') }}</span>
                                </div>
                                <a href="{{ route('recipes.show', $recipe) }}" class="btn btn-sm btn-primary">Lihat Detail</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        <!-- Recent Activities -->
        <div style="background: white; padding: 2rem; border-radius: var(--border-radius); box-shadow: var(--shadow-md);">
            <h2 style="font-size: 1.5rem; font-weight: 700; margin-bottom: 1.5rem;">
                <i class="fas fa-history"></i> Aktivitas Terakhir
            </h2>

            @if($recentActivities->isEmpty())
                <p style="text-align: center; color: var(--gray); padding: 2rem;">Belum ada aktivitas</p>
            @else
                <div style="display: flex; flex-direction: column; gap: 1rem;">
                    @foreach($recentActivities as $activity)
                        <div
                            style="padding: 1rem; background: var(--light); border-radius: var(--border-radius); border-left: 3px solid var(--primary);">
                            <div style="display: flex; justify-content: space-between; align-items: start;">
                                <div>
                                    <strong>{{ $activity->action }}</strong>
                                    <p style="color: var(--gray); margin-top: 0.25rem;">{{ $activity->description }}</p>
                                </div>
                                <span style="font-size: 0.875rem; color: var(--gray);">
                                    {{ $activity->created_at->diffForHumans() }}
                                </span>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
@endsection
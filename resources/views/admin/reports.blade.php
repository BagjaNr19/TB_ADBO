@extends('layouts.app')

@section('title', 'Laporan Sistem')

@section('content')
    <div class="container mt-4 mb-5">
        <h1 style="font-size: 2.5rem; font-weight: 800; margin-bottom: 2rem; text-align: center;">
            <i class="fas fa-chart-bar"></i> Laporan Sistem
        </h1>

        <div class="grid grid-2" style="margin-bottom: 3rem;">
            <!-- Most Active Users -->
            <div
                style="background: white; padding: 2rem; border-radius: var(--border-radius); box-shadow: var(--shadow-md);">
                <h2 style="font-size: 1.5rem; font-weight: 700; margin-bottom: 1.5rem;">
                    <i class="fas fa-users"></i> Pengguna Paling Aktif
                </h2>

                @foreach($mostActiveUsers as $user)
                    <div
                        style="padding: 1rem; background: var(--light); border-radius: var(--border-radius); margin-bottom: 1rem;">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <div>
                                <strong>{{ $user->name }}</strong>
                                <p style="color: var(--gray); font-size: 0.875rem; margin-top: 0.25rem;">
                                    {{ $user->email }}
                                </p>
                            </div>
                            <div style="text-align: right;">
                                <div class="badge badge-primary">{{ $user->recipes_count }} resep</div>
                                <div class="badge badge-success" style="margin-top: 0.25rem;">{{ $user->comments_count }}
                                    komentar</div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Popular Recipes -->
            <div
                style="background: white; padding: 2rem; border-radius: var(--border-radius); box-shadow: var(--shadow-md);">
                <h2 style="font-size: 1.5rem; font-weight: 700; margin-bottom: 1.5rem;">
                    <i class="fas fa-fire"></i> Resep Terpopuler
                </h2>

                @foreach($popularRecipes as $recipe)
                    <div
                        style="padding: 1rem; background: var(--light); border-radius: var(--border-radius); margin-bottom: 1rem;">
                        <div style="display: flex; justify-content: space-between; align-items: start;">
                            <div style="flex: 1;">
                                <strong>{{ $recipe->title }}</strong>
                                <p style="color: var(--gray); font-size: 0.875rem; margin-top: 0.25rem;">
                                    <i class="fas fa-user"></i> {{ $recipe->user->name }}
                                </p>
                            </div>
                            <div style="text-align: right;">
                                <span class="badge badge-primary">
                                    <i class="fas fa-comments"></i> {{ $recipe->comments_count }}
                                </span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Recent Activity Log -->
        <div style="background: white; padding: 2rem; border-radius: var(--border-radius); box-shadow: var(--shadow-md);">
            <h2 style="font-size: 1.5rem; font-weight: 700; margin-bottom: 1.5rem;">
                <i class="fas fa-list"></i> Log Aktivitas Terbaru
            </h2>

            @foreach($recentActivity as $activity)
                <div
                    style="padding: 1rem; background: var(--light); border-radius: var(--border-radius); margin-bottom: 1rem; border-left: 3px solid var(--primary);">
                    <div style="display: flex; justify-content: space-between; align-items: start;">
                        <div>
                            <strong>{{ $activity->user->name }}</strong>
                            <p style="color: var(--dark-light); margin-top: 0.25rem;">{{ $activity->description }}</p>
                            <span style="color: var(--gray); font-size: 0.875rem;">
                                {{ $activity->created_at->format('d M Y H:i') }}
                            </span>
                        </div>
                        <span class="badge">{{ $activity->action }}</span>
                    </div>
                </div>
            @endforeach

            <div class="mt-3">
                {{ $recentActivity->links() }}
            </div>
        </div>

        <div class="mt-4 text-center">
            <a href="{{ route('admin.dashboard') }}" class="btn btn-outline">
                <i class="fas fa-arrow-left"></i> Kembali ke Dashboard
            </a>
        </div>
    </div>
@endsection
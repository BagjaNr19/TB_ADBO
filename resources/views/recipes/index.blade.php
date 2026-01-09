@extends('layouts.app')

@section('title', 'Daftar Resep')

@section('content')
    <div class="container mt-4 mb-5">
        <h1 style="font-size: 2.5rem; font-weight: 800; margin-bottom: 2rem; text-align: center;">
            Jelajahi Resep Makanan
        </h1>

        <div class="row mb-4">
            <div class="col-md-8 mx-auto">
                <form action="{{ route('recipes.index') }}" method="GET" class="d-flex gap-2">
                    @if(request('category'))
                        <input type="hidden" name="category" value="{{ request('category') }}">
                    @endif
                    <input type="text" name="search" class="form-control" placeholder="Cari resep..." value="{{ request('search') }}">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i> Cari</button>
                    @if(request('search') || request('category'))
                        <a href="{{ route('recipes.index') }}" class="btn btn-secondary">Reset</a>
                    @endif
                </form>
            </div>
        </div>
        
        <div class="mb-4 text-center">
            <div class="btn-group flex-wrap" role="group">
                <a href="{{ route('recipes.index', ['search' => request('search')]) }}" 
                   class="btn {{ !request('category') ? 'btn-primary' : 'btn-outline-primary' }} m-1">
                   Semua
                </a>
                @foreach($categories as $category)
                    <a href="{{ route('recipes.index', ['category' => $category->slug, 'search' => request('search')]) }}" 
                       class="btn {{ request('category') == $category->slug ? 'btn-primary' : 'btn-outline-primary' }} m-1">
                       {{ $category->name }}
                    </a>
                @endforeach
            </div>
        </div>

        @if($recipes->isEmpty())
            <div class="empty-state">
                <div class="empty-state-icon">
                    <i class="fas fa-book-open"></i>
                </div>
                <p class="empty-state-text">Belum ada resep tersedia</p>
                @auth
                    <a href="{{ route('recipes.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Buat Resep Pertama
                    </a>
                @else
                    <a href="{{ route('login') }}" class="btn btn-primary">
                        <i class="fas fa-sign-in-alt"></i> Login untuk Membuat Resep
                    </a>
                @endauth
            </div>
        @else
            <div class="grid grid-3">
                @foreach($recipes as $recipe)
                    <div class="card">
                        @if($recipe->image_url)
                            <img src="{{ $recipe->image_url }}" alt="{{ $recipe->title }}" class="card-img">
                            @if($recipe->category)
                                <div class="badge" style="position: absolute; top: 1rem; right: 1rem; background: rgba(0,0,0,0.6); color: white;">
                                    {{ $recipe->category->name }}
                                </div>
                            @endif
                        @else
                            <div class="card-img"
                                style="background: var(--gradient-primary); display: flex; align-items: center; justify-content: center; color: white; font-size: 3rem; position: relative;">
                                <i class="fas fa-utensils"></i>
                                @if($recipe->category)
                                    <div class="badge" style="position: absolute; top: 1rem; right: 1rem; background: rgba(0,0,0,0.6); color: white; font-size: 0.8rem;">
                                        {{ $recipe->category->name }}
                                    </div>
                                @endif
                            </div>
                        @endif

                        <div class="card-body">
                            <h3 class="card-title">{{ $recipe->title }}</h3>
                            <p class="card-text">{{ Str::limit($recipe->description, 100) }}</p>

                            <div style="display: flex; gap: 0.5rem; margin-bottom: 1rem; flex-wrap: wrap;">
                                @if($recipe->cooking_time)
                                    <span class="badge">
                                        <i class="fas fa-clock"></i> {{ $recipe->cooking_time }} menit
                                    </span>
                                @endif
                                @if($recipe->servings)
                                    <span class="badge">
                                        <i class="fas fa-users"></i> {{ $recipe->servings }} porsi
                                    </span>
                                @endif
                                <span class="badge badge-primary">
                                    <i class="fas fa-comments"></i> {{ $recipe->comments->count() }}
                                </span>
                            </div>

                            <div style="display: flex; justify-content: space-between; align-items: center;">
                                <small style="color: var(--gray);">
                                    <i class="fas fa-user"></i> {{ $recipe->user->name }}
                                </small>
                                <a href="{{ route('recipes.show', $recipe) }}" class="btn btn-sm btn-primary">
                                    Lihat Detail
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-4" style="display: flex; justify-content: center;">
                {{ $recipes->links() }}
            </div>
        @endif
    </div>
@endsection
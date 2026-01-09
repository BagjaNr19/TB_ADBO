@extends('layouts.app')

@section('title', $recipe->title)

@section('content')
    <div class="container mt-4 mb-5">
        <!-- Recipe Header -->
        <div
            style="background: white; padding: 2rem; border-radius: var(--border-radius); box-shadow: var(--shadow-md); margin-bottom: 2rem;">
            <div style="display: flex; justify-content: space-between; align-items: start; margin-bottom: 1rem;">
                <h1 style="font-size: 2.5rem; font-weight: 800;">{{ $recipe->title }}</h1>

                @auth
                    @if(Auth::id() === $recipe->user_id || Auth::user()->isAdmin())
                        <div style="display: flex; gap: 0.5rem;">
                            <a href="{{ route('recipes.edit', $recipe) }}" class="btn btn-sm btn-primary">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <form action="{{ route('recipes.destroy', $recipe) }}" method="POST"
                                onsubmit="return confirm('Yakin ingin menghapus resep ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">
                                    <i class="fas fa-trash"></i> Hapus
                                </button>
                            </form>
                        </div>
                    @endif
                @endauth
            </div>

            <div style="display: flex; gap: 1rem; align-items: center; margin-bottom: 1rem;">
                <span class="badge badge-primary">
                    <i class="fas fa-user"></i> {{ $recipe->user->name }}
                </span>
                @if($recipe->category)
                    <a href="{{ route('recipes.index', ['category' => $recipe->category->slug]) }}" 
                       class="badge" style="background: var(--secondary); text-decoration: none;">
                        <i class="fas fa-tag"></i> {{ $recipe->category->name }}
                    </a>
                @endif
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
                <span class="badge">
                    <i class="fas fa-calendar"></i> {{ $recipe->created_at->format('d M Y') }}
                </span>
            </div>

            @if($recipe->image_url)
                <img src="{{ $recipe->image_url }}" alt="{{ $recipe->title }}"
                    style="width: 100%; max-height: 400px; object-fit: cover; border-radius: var(--border-radius); margin-bottom: 1.5rem;">
            @endif

            <p style="font-size: 1.125rem; color: var(--dark-light); line-height: 1.8;">{{ $recipe->description }}</p>
        </div>

        <!-- Ingredients & Instructions -->
        <div class="grid grid-2" style="gap: 2rem; margin-bottom: 2rem;">
            <div
                style="background: white; padding: 2rem; border-radius: var(--border-radius); box-shadow: var(--shadow-md);">
                <h2 style="font-size: 1.5rem; font-weight: 700; margin-bottom: 1rem; color: var(--primary);">
                    <i class="fas fa-list"></i> Bahan-Bahan
                </h2>
                <div style="white-space: pre-line; line-height: 1.8;">{{ $recipe->ingredients }}</div>
            </div>

            <div
                style="background: white; padding: 2rem; border-radius: var(--border-radius); box-shadow: var(--shadow-md);">
                <h2 style="font-size: 1.5rem; font-weight: 700; margin-bottom: 1rem; color: var(--secondary);">
                    <i class="fas fa-fire"></i> Cara Memasak
                </h2>
                <div style="white-space: pre-line; line-height: 1.8;">{{ $recipe->instructions }}</div>
            </div>
        </div>

        <!-- Comments Section -->
        <div style="background: white; padding: 2rem; border-radius: var(--border-radius); box-shadow: var(--shadow-md);">
            <h2 style="font-size: 1.5rem; font-weight: 700; margin-bottom: 1.5rem;">
                <i class="fas fa-comments"></i> Komentar ({{ $recipe->comments->count() }})
            </h2>

            @auth
                <form action="{{ route('comments.store') }}" method="POST" style="margin-bottom: 2rem;">
                    @csrf
                    <input type="hidden" name="recipe_id" value="{{ $recipe->id }}">

                    <div class="form-group">
                        <textarea name="content" class="form-control" placeholder="Tulis komentar Anda..." required></textarea>
                        @error('content')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-paper-plane"></i> Kirim Komentar
                    </button>
                </form>
            @else
                <p style="text-align: center; padding: 2rem; background: var(--light); border-radius: var(--border-radius);">
                    <a href="{{ route('login') }}" style="color: var(--primary); font-weight: 600;">Login</a> untuk memberikan
                    komentar
                </p>
            @endauth

            @forelse($recipe->comments as $comment)
                <div class="comment">
                    <div class="comment-header">
                        <span class="comment-author">
                            <i class="fas fa-user-circle"></i> {{ $comment->user->name }}
                        </span>
                        <div style="display: flex; gap: 0.5rem; align-items: center;">
                            <span class="comment-date">{{ $comment->created_at->diffForHumans() }}</span>
                            @if(Auth::check() && Auth::user()->isAdmin())
                                <form action="{{ route('comments.destroy', $comment) }}" method="POST"
                                    onsubmit="return confirm('Yakin ingin menghapus komentar ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                    <p class="comment-content">{{ $comment->content }}</p>
                </div>
            @empty
                <p style="text-align: center; color: var(--gray); padding: 2rem;">Belum ada komentar</p>
            @endforelse
        </div>
    </div>
@endsection
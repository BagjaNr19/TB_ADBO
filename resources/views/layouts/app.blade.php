<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Sistem Resep Makanan')</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @stack('styles')
</head>

<body>
    <!-- Navigation -->
    <nav class="navbar">
        <div class="container navbar-content">
            <a href="{{ route('home') }}" class="navbar-brand">
                <i class="fas fa-utensils"></i> Resep Makanan
            </a>

            <ul class="navbar-menu">
                <li><a href="{{ route('recipes.index') }}">Resep</a></li>

                @auth
                    <li><a href="{{ route('recipes.create') }}">Buat Resep</a></li>
                    <li><a href="{{ route('reports.user-activity') }}">Aktivitas Saya</a></li>

                    @if(Auth::user()->isAdmin())
                        <li><a href="{{ route('admin.dashboard') }}">Dashboard Admin</a></li>
                    @endif

                    <li><a href="{{ route('profile.edit') }}">Profil</a></li>
                    <li>
                        <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-danger">Logout</button>
                        </form>
                    </li>
                @else
                    <li><a href="{{ route('login') }}" class="btn btn-sm btn-primary">Login</a></li>
                    <li><a href="{{ route('register') }}" class="btn btn-sm btn-outline">Daftar</a></li>
                @endauth
            </ul>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        <!-- Flash Messages -->
        @if(session('success'))
            <div class="container mt-3">
                <div class="alert alert-success">
                    <i class="fas fa-check-circle"></i> {{ session('success') }}
                </div>
            </div>
        @endif

        @if(session('error'))
            <div class="container mt-3">
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
                </div>
            </div>
        @endif

        @yield('content')
    </main>

    <!-- Footer -->
    <footer style="background: var(--dark); color: white; padding: 2rem 0; margin-top: 4rem; text-align: center;">
        <div class="container">
            <p>&copy; {{ date('Y') }} Sistem Resep Makanan. Semua hak dilindungi.</p>
            <p style="margin-top: 0.5rem; opacity: 0.8;">Berbagi Resep, Berbagi Cinta</p>
        </div>
    </footer>

    <script src="{{ asset('js/main.js') }}"></script>
    @stack('scripts')
</body>

</html>
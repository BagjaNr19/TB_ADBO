<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Recipe;
use App\Models\Comment;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (!Auth::check() || !Auth::user()->isAdmin()) {
                abort(403, 'Akses ditolak. Hanya admin yang dapat mengakses halaman ini.');
            }
            return $next($request);
        });
    }

    /**
     * Display admin dashboard.
     */
    public function dashboard()
    {
        $stats = [
            'total_users' => User::where('role', 'user')->count(),
            'total_recipes' => Recipe::count(),
            'total_comments' => Comment::count(),
            'total_admins' => User::where('role', 'admin')->count(),
        ];

        $recentActivities = ActivityLog::with('user')
            ->latest()
            ->take(10)
            ->get();

        $recentRecipes = Recipe::with('user')
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact('stats', 'recentActivities', 'recentRecipes'));
    }

    /**
     * Display system reports.
     */
    public function reports()
    {
        $mostActiveUsers = User::withCount(['recipes', 'comments'])
            ->orderByDesc('recipes_count')
            ->orderByDesc('comments_count')
            ->take(10)
            ->get();

        $popularRecipes = Recipe::withCount('comments')
            ->orderByDesc('comments_count')
            ->take(10)
            ->get();

        $recentActivity = ActivityLog::with('user')
            ->latest()
            ->paginate(20);

        return view('admin.reports', compact('mostActiveUsers', 'popularRecipes', 'recentActivity'));
    }
}

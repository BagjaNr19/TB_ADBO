<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display user's activity report.
     */
    public function userActivity()
    {
        $user = Auth::user();

        $myRecipes = $user->recipes()->latest()->get();
        $myComments = $user->comments()->with('recipe')->latest()->get();
        $recentActivities = $user->activityLogs()->latest()->take(20)->get();

        $stats = [
            'total_recipes' => $myRecipes->count(),
            'total_comments' => $myComments->count(),
            'total_activities' => $user->activityLogs()->count(),
        ];

        return view('reports.user-activity', compact('user', 'myRecipes', 'myComments', 'recentActivities', 'stats'));
    }
}

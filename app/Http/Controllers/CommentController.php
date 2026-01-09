<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Store a newly created comment.
     */
    public function store(Request $request)
    {
        $request->validate([
            'recipe_id' => 'required|exists:recipes,id',
            'content' => 'required|string|min:1',
        ], [
            'content.required' => 'Komentar tidak boleh kosong',
            'content.min' => 'Komentar tidak boleh kosong',
        ]);

        $comment = Comment::create([
            'recipe_id' => $request->recipe_id,
            'user_id' => Auth::id(),
            'content' => $request->content,
        ]);

        // Log activity
        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'added_comment',
            'target_type' => 'Comment',
            'target_id' => $comment->id,
            'description' => 'Menambahkan komentar pada resep',
        ]);

        return back()->with('success', 'Komentar berhasil ditambahkan!');
    }

    /**
     * Remove the specified comment (Admin only).
     */
    public function destroy(Comment $comment)
    {
        // Only admin can delete comments
        if (!Auth::user()->isAdmin()) {
            abort(403, 'Hanya admin yang dapat menghapus komentar');
        }

        // Log activity before deletion
        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'deleted_comment',
            'target_type' => 'Comment',
            'target_id' => $comment->id,
            'description' => 'Admin menghapus komentar',
        ]);

        $comment->delete();

        return back()->with('success', 'Komentar berhasil dihapus!');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the form for editing the user profile.
     */
    public function edit()
    {
        $user = Auth::user();
        return view('profile.edit', compact('user'));
    }

    /**
     * Update the user's profile information.
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'bio' => 'nullable|string|max:500',
            'avatar' => 'nullable|url|max:255',
            'password' => 'nullable|min:6|confirmed',
        ], [
            'name.required' => 'Nama wajib diisi',
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Format email tidak valid',
            'email.unique' => 'Email sudah digunakan',
            'bio.max' => 'Bio maksimal 500 karakter',
            'avatar.url' => 'Avatar harus berupa URL yang valid',
            'password.min' => 'Password minimal 6 karakter',
            'password.confirmed' => 'Konfirmasi password tidak cocok',
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'bio' => $request->bio,
            'avatar' => $request->avatar,
        ];

        // Update password if provided
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        // Log activity
        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'updated_profile',
            'description' => 'Mengupdate profil',
        ]);

        return back()->with('success', 'Profil berhasil diperbarui!');
    }
}

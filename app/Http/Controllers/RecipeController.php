<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use App\Models\Category;

class RecipeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }

    /**
     * Display a listing of recipes.
     */
    public function index(Request $request)
    {
        $query = Recipe::with(['user', 'category'])->latest();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhere('ingredients', 'like', "%{$search}%");
            });
        }

        if ($request->filled('category')) {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        $recipes = $query->paginate(12)->withQueryString();
        $categories = Category::all();
        
        return view('recipes.index', compact('recipes', 'categories'));
    }

    /**
     * Show the form for creating a new recipe.
     */
    public function create()
    {
        $categories = Category::all();
        return view('recipes.create', compact('categories'));
    }

    /**
     * Store a newly created recipe in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'required|string',
            'ingredients' => 'required|string',
            'instructions' => 'required|string',
            'cooking_time' => 'nullable|integer|min:1',
            'servings' => 'nullable|integer|min:1',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'title.required' => 'Judul resep wajib diisi',
            'category_id.required' => 'Kategori wajib dipilih',
            'category_id.exists' => 'Kategori tidak valid',
            'description.required' => 'Deskripsi wajib diisi',
            'ingredients.required' => 'Bahan-bahan wajib diisi',
            'instructions.required' => 'Cara memasak wajib diisi',
            'cooking_time.min' => 'Waktu memasak minimal 1 menit',
            'servings.min' => 'Porsi minimal 1',
            'image.image' => 'File harus berupa gambar',
            'image.max' => 'Ukuran gambar maksimal 2MB',
        ]);

        $imageUrl = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('recipes', 'public');
            $imageUrl = Storage::url($imagePath);
        }

        $recipe = Recipe::create([
            'user_id' => Auth::id(),
            'category_id' => $request->category_id,
            'title' => $request->title,
            'description' => $request->description,
            'ingredients' => $request->ingredients,
            'instructions' => $request->instructions,
            'cooking_time' => $request->cooking_time,
            'servings' => $request->servings,
            'image_url' => $imageUrl,
        ]);

        // Log activity
        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'created_recipe',
            'target_type' => 'Recipe',
            'target_id' => $recipe->id,
            'description' => 'Membuat resep baru: ' . $recipe->title,
        ]);

        return redirect()->route('recipes.show', $recipe)->with('success', 'Resep berhasil ditambahkan!');
    }

    /**
     * Display the specified recipe.
     */
    public function show(Recipe $recipe)
    {
        $recipe->load(['user', 'comments.user']);
        return view('recipes.show', compact('recipe'));
    }

    /**
     * Show the form for editing the specified recipe.
     */
    public function edit(Recipe $recipe)
    {
        // Check ownership
        if ($recipe->user_id !== Auth::id() && !Auth::user()->isAdmin()) {
            abort(403, 'Anda tidak memiliki akses untuk mengedit resep ini');
        }
        
        $categories = Category::all();

        return view('recipes.edit', compact('recipe', 'categories'));
    }

    /**
     * Update the specified recipe in storage.
     */
    public function update(Request $request, Recipe $recipe)
    {
        // Check ownership
        if ($recipe->user_id !== Auth::id() && !Auth::user()->isAdmin()) {
            abort(403, 'Anda tidak memiliki akses untuk mengedit resep ini');
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'required|string',
            'ingredients' => 'required|string',
            'instructions' => 'required|string',
            'cooking_time' => 'nullable|integer|min:1',
            'servings' => 'nullable|integer|min:1',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'title.required' => 'Judul resep wajib diisi',
            'category_id.required' => 'Kategori wajib dipilih',
            'category_id.exists' => 'Kategori tidak valid',
            'description.required' => 'Deskripsi wajib diisi',
            'ingredients.required' => 'Bahan-bahan wajib diisi',
            'instructions.required' => 'Cara memasak wajib diisi',
            'cooking_time.min' => 'Waktu memasak minimal 1 menit',
            'servings.min' => 'Porsi minimal 1',
            'image.image' => 'File harus berupa gambar',
            'image.max' => 'Ukuran gambar maksimal 2MB',
        ]);

        $imageUrl = $recipe->image_url;
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($recipe->image_url) {
                $oldPath = str_replace('/storage/', '', $recipe->image_url);
                Storage::disk('public')->delete($oldPath);
            }

            $imagePath = $request->file('image')->store('recipes', 'public');
            $imageUrl = Storage::url($imagePath);
        }

        $recipe->update([
            'title' => $request->title,
            'category_id' => $request->category_id,
            'description' => $request->description,
            'ingredients' => $request->ingredients,
            'instructions' => $request->instructions,
            'cooking_time' => $request->cooking_time,
            'servings' => $request->servings,
            'image_url' => $imageUrl,
        ]);

        // Log activity
        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'updated_recipe',
            'target_type' => 'Recipe',
            'target_id' => $recipe->id,
            'description' => 'Mengupdate resep: ' . $recipe->title,
        ]);

        return redirect()->route('recipes.show', $recipe)->with('success', 'Resep berhasil diperbarui!');
    }

    /**
     * Remove the specified recipe from storage.
     */
    public function destroy(Recipe $recipe)
    {
        // Check ownership
        if ($recipe->user_id !== Auth::id() && !Auth::user()->isAdmin()) {
            abort(403, 'Anda tidak memiliki akses untuk menghapus resep ini');
        }

        $recipeTitle = $recipe->title;

        // Delete image if exists
        if ($recipe->image_url) {
            $imagePath = str_replace('/storage/', '', $recipe->image_url);
            Storage::disk('public')->delete($imagePath);
        }

        // Log activity before deletion
        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'deleted_recipe',
            'target_type' => 'Recipe',
            'target_id' => $recipe->id,
            'description' => 'Menghapus resep: ' . $recipeTitle,
        ]);

        // Delete recipe (cascade will handle comments)
        $recipe->delete();

        return redirect()->route('recipes.index')->with('success', 'Resep berhasil dihapus!');
    }
}

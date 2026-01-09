<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'category_id',
        'title',
        'description',
        'ingredients',
        'instructions',
        'cooking_time',
        'servings',
        'image_url',
    ];

    /**
     * Get the user that owns the recipe.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the comments for the recipe.
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * Get the category that owns the recipe.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}

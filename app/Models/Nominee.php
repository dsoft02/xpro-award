<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nominee extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'bio', 'category_id'];

    // Define the relationship with the Category model
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    // Nominee has many votes
    public function votes()
    {
        return $this->hasMany(Vote::class);
    }

    public function votesInCategory($categoryId)
    {
        return $this->votes()->where('category_id', $categoryId)->count();
    }

}

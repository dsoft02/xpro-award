<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    use HasFactory;

    protected $fillable = ['email', 'ip_address', 'nominee_id', 'category_id'];

    // Relationship with nominee
    public function nominee()
    {
        return $this->belongsTo(Nominee::class);
    }

    // Relationship with category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}

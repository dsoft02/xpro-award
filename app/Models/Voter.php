<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voter extends Model
{
    use HasFactory;

    // Specify the fillable attributes
    protected $fillable = [
        'username',
        'team_name',
    ];
}

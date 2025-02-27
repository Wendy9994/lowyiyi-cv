<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    use HasFactory;

    protected $fillable = [
        'category',      // e.g., Programming Languages, Web Development
        'name',          // Skill name (e.g., Java, PHP)
        'proficiency',   // e.g., Percentage (0-100)
    ];
}

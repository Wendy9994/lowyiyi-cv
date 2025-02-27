<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',        // Project or Job Title
        'type',         // e.g., Web Development, Networking
        'description',  // Details about work experience
        'start_date',
        'end_date',
    ];
}

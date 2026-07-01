<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    // Ito ang nagpapahintulot sa Laravel na i-save ang mga data na ito
    protected $fillable = [
        'title', 
        'description', 
        'is_completed'
    ];
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;

    protected $fillable = [
        'navber',
        'logo',
        'head_tag',
        'sort_paragraph',
        'image',
    ];

    protected $casts = [
        "image" =>"array",
        "navber" =>"array"
    ];

}

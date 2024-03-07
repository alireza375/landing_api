<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Footer extends Model
{
    use HasFactory;
    protected $fillable=[
        'logo',
        'short_dec',
        'image',
        'quick_links',
        'support',
        'contacts'
        
    ];

    protected $casts=[
      
        "quick_links"=>"array",
        "support"=>"array",
        "contacts"=>"array",
        "image"=>"array"
    ];
}

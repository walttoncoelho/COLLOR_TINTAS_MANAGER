<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BannerHome extends Model
{
    use HasFactory;
    protected $table = 'banner_home';

    protected $fillable = [
        'titulo', 
        'link',
        'status',
        'ordem', 
        'banner_desktop', 
        'banner_mobile'
    ];
    protected $casts = [
        'status' => 'boolean',
    ];
}

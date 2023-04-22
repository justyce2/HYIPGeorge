<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'photo',
        'fb_link',
        'twitter_link',
        'instra_link',
        'linkedin_link',
        'youtube_link	',
    ];
}

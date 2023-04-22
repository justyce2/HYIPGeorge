<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Feature extends Model
{
    protected $fillable = [ 'title', 'details', 'icon'];

    public $timestamps = false;
  
}

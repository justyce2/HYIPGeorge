<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $fillable = ['title','subtitle', 'photo','facebook','twitter','linkedin'];

    public $timestamps = false;


}
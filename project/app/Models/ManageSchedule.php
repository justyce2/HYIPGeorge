<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManageSchedule extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name',
        'time',
    ];

    public function plans(){
        return $this->hasMany(Plan::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;
    protected $fillable = [
        'manage_schedule_id',
        'schedule_hour',
        'title',
        'subtitle',
        'min_amount',
        'max_amount',
        'fixed_amount',
        'invest_type',
        'profit_percentage',
        'captial_return',
        'lifetime_return',
        'profit_repeat',
        'status',
    ];

    public function schedule(){
        return $this->belongsTo(ManageSchedule::class,'manage_schedule_id')->withDefault();
    }

    public function invests(){
        return $this->hasMany(Plan::class);
    }
}

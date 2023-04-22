<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $fillable = ['name','section','register_id','preloaded'];


    public $timestamps = false;

    public function admins()
    {
    	return $this->hasMany('App\Models\Admin');
    }


    public function sectionCheck($value)
    {
        $sections = explode(" , ", $this->section);
        if (in_array($value, $sections)){
            return true;
        }else{
            return false;
        }
    }

 

}

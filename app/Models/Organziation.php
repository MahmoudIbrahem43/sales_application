<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organziation extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'location', 'employees',
    ];


    public function prodect(){
        return $this->hasMany('App\Product');
    }
}

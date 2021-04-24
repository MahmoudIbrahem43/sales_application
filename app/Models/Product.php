<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'logo', 'price','organization_id',
    ];


    public function organziation(){
        return $this->belongsTo('App\Organziation');
    }
}


<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public function attribute(){
        return $this->hasMany(Attribute::class);
    }


    public function ingredient(){
         return $this->hasMany(Ingredient::class);
    }

    public function product(){
        return $this->hasMany(Product::class);
    }


}

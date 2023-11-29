<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function category(){
        return $this->belongsTo(Category::class);
    }

    // public function attribute(){
    //     return $this->belongsTo(Attribute::class,'all_details');
    // }
}


// {"attribute":[{"name":"3","price":"200"},
// {"name":"4","price":"100"}],
// "ingredient":[{"name":"1","price":"100"},
// {"name":"2","price":"200"}]}
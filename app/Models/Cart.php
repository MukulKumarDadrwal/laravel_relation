<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $table = 'carts';

    protected $fillable = [
        'user_id ',
        'product_id ',
        'attribute_id ',
        'ingredient_id  ',
        'total_price ',
        'quantity ',
        'category_id  ',
        'extra_col1 ',
        'extra_col2 ',
    ];

    
    public function product(){
        return $this->belongsTo(Product::class);
    }

    public function attribute(){
        return $this->belongsTo(Attribute::class);
    }


}

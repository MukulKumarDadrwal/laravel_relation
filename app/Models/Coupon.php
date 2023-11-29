<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;

    protected $table ="coupons";

    protected $fillable =[
        'code ',
        'type ',
        'coupon_type ',
        'amount ',
        'max_uses ',
        'product_id ',
        'category_id ',
        'user_id',
        'pro_min_amount ',
        'start_at ',
        'expire_at ',
        'extra_col1 ',
        'extra_col2 ',
    ];


    
}

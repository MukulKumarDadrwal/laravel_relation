<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function create_coupon(){
        $products = Product::all();
        $categories = Category::all();
        $users = User::all();
        return view("admin/coupon/add",compact("products","categories","users"));
    }


    public function submit_coupon(Request $request){
        // dd($request->all());
        $request->validate([
            "code" => "required|min:6",
            'type' => "required",
            'amount_type' =>"required",
            'amount'=>"required|numeric",
            "max_uses"=>"required|numeric",
            "start_at"=>"required|date",
            "expire_at"=>"required|date|after:start_at"
        ],[
            "code.required" =>"Coupon Code is Required",
            "code.min"=>"Coupon Code Should be at least six  characters.",
            "type"=>"Please Select A type.",
            'amount_type'=>"Please Select Amount Type.",
            "amount.required"=>"Plese Fill Amount.",
            "amount.numeric"=>"Amount Should be Numeric.",
            "max_uses.required"=>"The max uses field is required.",
            "max_uses.numeric"=>"The max uses must be a number.",
            "start_at.required"=>"The start at field is required.", 
            "start_at.date"=>"The start at Should be a valid Date." ,
            'expire_at.required' => 'The expire at field is required.',
            'expire_at.date' => 'The expire at must be a valid date.',
            'expire_at.after' => 'The expire at must be after the starts at date.',
        ]);
    }
    
}

<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Cart;
class CartController extends Controller
{



    public function index(){
 
    $cart = Cart::first()->ingredient_id;
          dd(json_decode($cart));
    }




    public function add_to_cart_api(Request $request){  
        $cart = new Cart();
        $cart->product_id = $request->product_id;
        $cart->category_id = $request->category_id;
        $cart->attribute_id = $request->attribute_id;
        $cart->user_id = $request->user_id;
        $cart->total_price = $request->total_price;
        $cart->quantity = $request->quantity;
        $cart->ingredient_id = $request->ingredient_id;
        $cart->save();

        return response()->json([
          'message'=>'cart added successfully',
          'status'=>'success'
        ]);

    }


    public function show_cart_api($id){
       $cart = Cart::find($id);

       return response()->json([
        // 'cart'=>$cart,
        'product_name'=>$cart->product->name,
        'product_description'=>$cart->product->description,
        'attribute_name'=>$cart->attribute->name,
        'total_price'=>$cart->total_price,
        'status'=>'success'
       ]);
    }
}

<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
 
use App\Models\Product;
use App\Models\ParentCategoryModel;
use App\Models\ChildCategoryModel;
use App\Models\AttributeIngredientModel;
use App\Traits\Common_trait;
class productController extends Controller
{
    public function productindex(){  
      $products = Product::all();

        return view('admin/products/index',compact('products'));
        
        
    }
    public function productFormGet(){   
      $cat = ParentCategoryModel::all();
      $attribute =  ChildCategoryModel::all();
      $ingredient =  AttributeIngredientModel::all();
    //   dd($cat,$attribute,$ingredient);
        return view('admin/products/product',compact('cat','attribute','ingredient'));
        
    }
    public function getAttribute(Request $request,$catId){  
        $attribute = ChildCategoryModel::where('parent_cat', $catId)->pluck('child_name', 'id');
        $Ingredient = AttributeIngredientModel::where('parent_cat', $catId)->pluck('child_name', 'id');
        // dd($states,$catId);
    return response()->json(['attribute'=>$attribute, 'Ingredient'=>$Ingredient]);
        
    }
    public function productPostForm(Request $request){  
        $request->validate([
            'productimage' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'title' => 'required|string|max:255', // Add other relevant validation rules for your data
            // Add more validation rules for other data fields as needed
        ]);
        if($request->product_type == 'Simple')
        { 
            $image = $request->file('productimage');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('admin-assets/img/product_img'), $imageName);

            $product = new Product();
            $product->title = $request->title;
            $product->title_slug = $request->title;
            $product->description = $request->description;
            $product->product_type = $request->product_type;
            $product->price = $request->titlePriceSimple;
            $product->category_id = $request->category_name;
            $product->image = $imageName; 
            $product->status = '1';
            $product->save();
            return back()->with('flash-success', 'product add successful.');
        }
        // dd('variable');
            $image = $request->file('productimage');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('admin-assets/img/product_img'), $imageName);
        
           foreach($request->Product_attribute as $key=> $item){
            $attribute[] = ['id'=>$request->Product_attribute[$key],'price'=>$request->attributePrice[$key]];
           }
           foreach($request->Product_ingredient as $key=> $item){
            $ingredient[] = ['id'=>$request->Product_ingredient[$key],'price'=>$request->ingredientsPrice[$key]];
           }  
           $allDetails = ['attribute'=>$attribute,'ingredient'=>$ingredient];
            $product = new Product();
            $product->title = $request->title;
            $product->title_slug = $request->title;
            $product->description = $request->description;
            $product->product_type = $request->product_type; 
            $product->category_id = $request->category_name;
            $product->image = $imageName;
            $product->status = '1';
            $product->all_details = json_encode($allDetails);
            $product->save();
            return redirect()->route('productindex')->with('flash-success', 'product add successful.');
        
    }

    public function productDelete($id){
        Product::find($id)->delete();
        return back()->with('flash-success', 'product delete successful.');
    }
    public function productEdit($id){
      $product = Product::find($id);
      $product_cateId = $product->category_id;
      $cat = ParentCategoryModel::all();
      $attribute =  ChildCategoryModel::where('parent_cat',$product_cateId)->get();
      $ingredient =  AttributeIngredientModel::where('parent_cat',$product_cateId)->get();
      $productDetails = json_encode($product->all_details);
        return view('admin/products/productEdit',compact('cat','attribute','ingredient','product','productDetails'));
       
    }

    public function productEditPostForm(Request $request, $id){
           $product  = Product::find($id);
      if($request->product_type == 'Simple')
        { 
          if($request->file('productimage')){
            $image = $request->file('productimage');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('admin-assets/img/product_img'), $imageName);
            $product->image = $imageName;
          }
          if($request->title){
            $product->title = $request->title;
            $product->title_slug = $request->title;
          }
          if($request->description){ 
            $product->description = $request->description;
          }
          if($request->product_type){ 
            $product->product_type = $request->product_type;
          }
          if($request->titlePriceSimple){ 
            $product->price = $request->titlePriceSimple;
          }
          if($request->category_name){
            $product->category_id = $request->category_name; 
          } 
            $product->status = '1';
            $product->update();
            return back()->with('flash-success', 'product update successful.');
        }
        if($request->file('productimage')){
          $image = $request->file('productimage');
          $imageName = time() . '.' . $image->getClientOriginalExtension();
          $image->move(public_path('admin-assets/img/product_img'), $imageName);
          $product->image = $imageName;
        }
        if($request->title){
          $product->title = $request->title;
          $product->title_slug = $request->title;
        }
        if($request->description){ 
          $product->description = $request->description;
        }
        if($request->product_type){ 
          $product->product_type = $request->product_type;
        }
        // if($request->titlePriceSimple){ 
        //   $product->price = $request->titlePriceSimple;
        // }
        if($request->category_name){
          $product->category_id = $request->category_name; 
        } 

        if($request->Product_attribute){
          foreach($request->Product_attribute as $key=> $item){
            $attribute[] = ['id'=>$request->Product_attribute[$key],'price'=>$request->attributePrice[$key]];
           }
        }else{ $attribute[] = array();}

        if($request->Product_ingredient){
          foreach($request->Product_ingredient as $key=> $item){
            $ingredient[] = ['id'=>$request->Product_ingredient[$key],'price'=>$request->ingredientsPrice[$key]];
           } 
        }else{ $ingredient[] = array();}
        
          
         $allDetails = ['attribute'=>$attribute,'ingredient'=>$ingredient]; 


          $product->all_details = json_encode($allDetails);
          $product->status = '1';
          $product->update();
          return back()->with('flash-success', 'product update successful.');


    }



}

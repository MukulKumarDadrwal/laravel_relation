<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Attribute;
use App\Models\Ingredient;

class ProductController extends Controller
{


  public function index()
  {
   
    $product = Product::first()->all_details;

    $allDetails = json_decode(Product::first()->all_details, true);
    // $attributes = $allDetails['attribute'][0]['id'] ?? [];
    $attributeIds = array_column($allDetails['attribute'], 'id');
    $attributes = Attribute::whereIn('id', $attributeIds)->get(['id', 'name']);
    $namesById = $attributes->pluck('name', 'id')->toArray();

    $pro = Product::all();

    foreach ($pro as $value) {
      $allDetails = (json_decode($value->all_details, true));
      $attributeIds = array_column($allDetails['attribute'], 'id');
      $attributes = Attribute::whereIn('id', $attributeIds)->get(['id', 'name']);
      $namesById = $attributes->pluck('name', 'id')->toArray();
    }
    echo '<pre>';
    print_r($namesById);
    // print_r($allDetails);

    echo '</pre>';
  }












  // public function show(){

  //   $pro = Product::all();
//     foreach ($pro as $value) {
//       $data[] = (($value->all_details));
//     }

  //   foreach ($data as $productDetails) {
//     $decodedData = json_decode($productDetails, true);

  //     if (isset($decodedData['attribute'])) {
//         foreach ($decodedData['attribute'] as &$item) {
//             $attribute = Attribute::find($item['id']); // Fetch the Attribute model by ID
//             $item['name'] = ($attribute) ? $attribute->name : '';
//         }
//     }

  //     if (isset($decodedData['ingredient'])) {
//         foreach ($decodedData['ingredient'] as &$item) {
//             $ingredient = Ingredient::find($item['id']); // Fetch the Ingredient model by ID
//             $item['name'] = ($ingredient) ? $ingredient->name : '';
//         }
//     }
//     dd($decodedData);

  // }

  // }










  public function show()
  {
    $pro = Product::all();

    $pro->transform(function ($product) {
      $decodedData = json_decode($product->all_details, true);

      if (isset($decodedData['attribute'])) {
        $decodedData['attribute'] = collect($decodedData['attribute'])->map(function ($item) {
          $attribute = Attribute::find($item['id']); // Fetch the Attribute model by ID
          $item['name'] = ($attribute) ? $attribute->name : '';
          return $item;
        })->all();
      }

      if (isset($decodedData['ingredient'])) {
        $decodedData['ingredient'] = collect($decodedData['ingredient'])->map(function ($item) {
          $ingredient = Ingredient::find($item['id']); // Fetch the Ingredient model by ID
          $item['name'] = ($ingredient) ? $ingredient->name : '';
          return $item;
        })->all();
      }

      $product->all_details = json_encode($decodedData);

      return $product;
    });

    dd($pro); 


  }



  public function showpro($id)
  {
      $product = Product::find($id);
      $decodedData = json_decode($product->all_details, true);

      $decodedData['attribute'] = collect($decodedData['attribute'] ?? [])->map(function ($item) {
        $item['name'] = Attribute::find($item['id'])->name ?? '';
        return $item;
      })->all();

      $decodedData['ingredient'] = collect($decodedData['ingredient'] ?? [])->map(function ($item) {
        $item['name'] = Ingredient::find($item['id'])->name ?? '';
        return $item;
      })->all();

      $product->all_details = json_encode($decodedData);

    dd($product); 
  }











  public function top10()
  {
    $pro = Product::groupBy('category_id')->get();
    dd($pro);

  }
}

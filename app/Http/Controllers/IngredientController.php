<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ingredient;
class IngredientController extends Controller
{
    public function index(){
        // $ingredients = Ingredient::all();
        $ingredients = Ingredient::first()->category;
        dd($ingredients);
    }
}

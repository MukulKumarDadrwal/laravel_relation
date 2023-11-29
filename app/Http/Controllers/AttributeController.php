<?php

namespace App\Http\Controllers;

use App\Models\Attribute;
use Illuminate\Http\Request;

class AttributeController extends Controller
{
    public function index(){
        // $att = Attribute::all();
        $att = Attribute::first()->category->name;
        dd($att);
    }
}

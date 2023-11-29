<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index(){
        // $pro = User::first()->profile;
        // dd($pro);


        $pro = new Profile();
        $pro->dob = "43";
        $pro->city = "fgd";
        $pro->user_id ="1";
        $pro->save();
    } 
}

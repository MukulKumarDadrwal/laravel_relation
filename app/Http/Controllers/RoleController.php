<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Role;
class RoleController extends Controller
{
    public function index(){
        // $roles = Role::first()->user;
        // dd($roles);

        $user = User::skip('2')->first()->role;
        dd($user);
    }
}

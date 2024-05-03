<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    //index
    public function index() {
        //search by name, paginate 10
        $users = User::where("name", "like", "%".request("name")."%")
        ->orderBy("id","desc")
        ->paginate(10);
        return view("pages.users.index", compact("users"));
    }
}
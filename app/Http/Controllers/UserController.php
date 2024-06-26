<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

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

    // create
    public function create() {
        return view("pages.users.create");
    }

    // edit
    public function edit($id) {
        $user = User::findOrFail($id);
        return view("pages.users.edit", compact("user"));
    }

    //update
    public function update(Request $request, User $user) {
        $request->validate([
            "name" => "required",
            "email" => "required|email",
        ]);
        $user->update([
            "name" => $request->name,
            "email" => $request->email,
            "phone" => $request->phone,
            "role" => $request->role,
        ]);
        if($request->password) {
            $user->update([
                "password" => Hash::make($request->password),
            ]);
        }
        return redirect()->route("users.index")->with("success", "User updated successfully");
    }

    // store
    public function store(Request $request) {
        $request->validate([
            "name" => "required",
            "email" => "required|email",
            "password" => "required|min:8",
        ]);
        User::create([
            "name" => $request->name,
            "email" => $request->email,
            "phone" => $request->phone,
            "role" => $request->role,
            "password" => Hash::make($request->password),
        ]);
        return redirect()->route("users.index")->with("success", "User created successfully");
    }

    //destroy
    public function destroy(User $user) {
        $user->delete();
        return redirect()->route("users.index")->with("success", "User deleted successfully");
    }
}
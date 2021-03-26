<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function show(){
       $users=  User::all();
       return view('users.users',compact('users'));
    }
    public function getUsers()
    {
        return datatables()->of(User::query())->toJson();
    }
}

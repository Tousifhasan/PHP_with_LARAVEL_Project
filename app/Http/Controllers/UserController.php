<?php

namespace App\Http\Controllers;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::latest()->paginate(10);

        return view('backend.user.index', compact('users'));
    }
    public function roleList()
    {
        $roles = Role::latest()->paginate(10);

        return view('backend.role.index', compact('roles'));
    }
    public function usersList(Role $role)
    {
       $users = $role->users;
           
        return view('backend.role.show', compact('users'));
    }
}

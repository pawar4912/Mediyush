<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function getUsers() {
        $users = User::orderBy('id', 'DESC')->paginate(10);
        $users->withPath('/admin/users/list');
        return view('admin.users.list', compact('users'));
    }
}

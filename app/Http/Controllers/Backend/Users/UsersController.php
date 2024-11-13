<?php

namespace App\Http\Controllers\Backend\Users;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Gate;

class UsersController extends Controller
{
    //Show Users Page
    public function index()
    {
        abort_if(Gate::denies('user_management_access'), 403);
        $users = User::get();

        return view('admin.page.Users.user', [
            'users' => $users,
        ]);
    }

    public function create()
    {
        return view('admin.page.Users.usersadd');
    }

    public function edit(User $user){
        return view('admin.page.Users.usersedit',[
            'user' => $user
        ]);
    }

    public function UserArchiveIndex()
    {
        return view('admin.page.Users.userarchive');
    }
}

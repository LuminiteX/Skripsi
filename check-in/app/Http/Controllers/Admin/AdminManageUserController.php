<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

class AdminManageUserController extends Controller
{
    //
    public function index(){


        $users = User::whereNotIn('is_special_user', [2])->paginate(5);

        return view('admin.manage_user.index', compact('users'));
    }

    public function deleteUser(User $user){
        $user_data = $user;
        if ($user_data->image) {
            Storage::delete($user_data->image);
        }
        $user->delete();

        return to_route('admin.manage.user')->with('danger', 'User has been deleted successfully.');
    }

}

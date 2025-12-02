<?php
namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UsersController extends Controller
{

    public function userlist(Request $request)
    {
        $query = User::query();

        if ($request->email) {
            $query->where('email', 'LIKE', '%' . $request->email . '%');
        }

        if ($request->mobile_number) {
            $query->where('mobile_number', 'LIKE', '%' . $request->mobile_number . '%');
        }

        $userlists = $query->orderBy('id','DESC')->paginate(8);

        return view('admin.users.list', compact('userlists'));
    }


}

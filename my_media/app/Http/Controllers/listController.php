<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class listController extends Controller
{
    //
    public function homeList()
    {
        $allUserDatas = User::select('id', 'name', 'email', 'address', 'phone', 'gender')->get();
        return view('admin.list.index', compact('allUserDatas'));
    }

    public function deleteAcc($id)
    {
        User::where('id', $id)->delete();
        return back()->with('successfully', 'Account successfully deleted');
    }

    public function searchAdmin(Request $request)
    {
        $allUserDatas = User::where('name', 'LIKE', '%' . $request->searchKey . '%')
            ->orWhere('email', 'LIKE', '%' . $request->searchKey . '%')
            ->orWhere('address', 'LIKE', '%' . $request->searchKey . '%')
            ->orWhere('phone', 'LIKE', '%' . $request->searchKey . '%')
            ->orWhere('gender', 'LIKE', '%' . $request->searchKey . '%')
            ->get();
        return view('admin.list.index', compact('allUserDatas'));
    }
}

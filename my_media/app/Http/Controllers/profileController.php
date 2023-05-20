<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class profileController extends Controller
{
    //
    private function getUserInfo($request)
    {
        return [
            'name' => $request->adminName,
            'email' => $request->adminEmail,
            'address' => $request->adminAddress,
            'phone' => $request->adminPhone,
            'gender' => $request->adminGender,
        ];
    }

    private function validation($request)
    {
        return Validator::make($request->all(), [
            'adminName' => 'required',
            'adminEmail' => 'required',
        ]);
        //you can add default message after ],
        //eg. ], ['admin.required'=>'your name is empty', 'adminEmail.required'=>'email is required'])
    }

    private function validationForPsw($request)
    {
        return Validator::make($request->all(), [
            'oldpassword' => 'required',
            'newpassword' => 'required|min:8|max:15',
            'confirmpassword' => 'required|same:newpassword|min:8|max:15',
        ], [
            'confirmpassword.same' => 'new password and confirm password not match'
        ]);
    }

    public function changingPassword()
    {
        return view('admin.profile.changePsw');
    }

    public function updatingPassword(Request $request)
    {
        $validator = $this->validationForPsw($request);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $dbPassword = User::select('password')->where('id', Auth::user()->id)->first()->password;
        // $hashOldPassword = Hash::make($request->input('oldpassword'));
        // dd($hashOldPassword);

        //hash check shae ka plain text input value nuk ka hash psw
        if (Hash::check($request->input('oldpassword'), $dbPassword)) {
            User::where('id', Auth::user()->id)->update(['password' => Hash::make($request->confirmpassword)]);
            return redirect()->route('/dashboard');
        } else {
            return back()->with(['passworderr' => 'Invalid password']);
        }
    }

    public function updateProfileAcc(Request $request)
    {
        $userData = $this->getUserInfo($request);

        $validator = $this->validation($request);
        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        User::where('id', Auth::user()->id)->update($userData);
        return back()->with(['updateinfo' => 'Admin profile successfully updated!']);
    }

    public function homeProfile()
    {
        $id = Auth::user()->id;
        $userInfo = User::select('id', 'name', 'address', 'email', 'phone', 'gender')->where('id', $id)->first();
        // dd($userInfo->toArray());
        return view('admin.profile.index', ['user' => $userInfo]);;
    }
}

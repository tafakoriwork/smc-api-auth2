<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $this->validateRequest($request);
        $user = User::where(['username' => $request->username])->first();
        if ($user) {
            $hashCheck = Hash::check($request->password, $user->password);
            if ($hashCheck)
                return $user;
            return 0;
        }
    }

    public function validateRequest(Request $request)
    {
        $rules = [
            'username' => 'required',
            'password' => 'required',
        ];
        $this->validate($request, $rules);
    }
}

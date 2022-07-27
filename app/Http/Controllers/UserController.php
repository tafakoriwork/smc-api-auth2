<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(){
        $users = User::with('userroles.roles')->get();
        return response()->json(['data' => $users], 200);
    }
    public function store(Request $request){
        $this->validateRequest($request);
        $password = Hash::make($request->get('password'));
        $user = new User([
                    'firstname' => $request->get('firstname'),
                    'lastname' => $request->get('lastname'),
                    'username' => $request->get('username'),
                    'api_token'=> base64_encode($password),
                ]);
        $user->password = $password;
        $user->save();
        return response()->json(['data' => "The user with with id {$user->id} has been created"], 201);
    }
    public function show($id){
        $user = User::find($id);
        if(!$user){
            return response()->json(['message' => "The user with {$id} doesn't exist"], 404);
        }
        return response()->json(['data' => $user], 200);
    }
    public function update(Request $request, $id){
        $user = User::find($id);
        if(!$user){
            return response()->json(['message' => "The user with {$id} doesn't exist"], 404);
        }
        $this->validateRequest($request);
        $user->username        = $request->get('username');
        $user->password     = Hash::make($request->get('password'));
        $user->save();
        return response()->json(['data' => "The user with with id {$user->id} has been updated"], 200);
    }
    public function destroy($id){
        $user = User::find($id);
        if(!$user){
            return response()->json(['message' => "The user with {$id} doesn't exist"], 404);
        }
        $user->delete();
        return response()->json(['data' => "The user with with id {$id} has been deleted"], 200);
    }
    public function validateRequest(Request $request){
        $rules = [
            'username' => 'required|unique:users', 
            'password' => 'required|min:6'
        ];
        $this->validate($request, $rules);
    }
    //
}

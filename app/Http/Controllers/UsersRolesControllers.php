<?php

namespace App\Http\Controllers;

use App\Models\UserRole;
use Illuminate\Http\Request;

class UsersRolesControllers extends Controller
{
    public function store(Request $request)
    {
        $this->validateRequest($request);
        $result = new UserRole(
            [
                'role_id' => $request->role_id,
                'user_id' => $request->user_id,
            ]
        );
        return $result->save();
    }

    public function destroy($id)
    {
        $Role = UserRole::find($id);
        if (!$Role) {
            return response()->json(['message' => "The user with {$id} doesn't exist"], 404);
        }
        $Role->delete();
        return response()->json(['data' => "The user with with id {$id} has been deleted"], 200);
    }

    public function validateRequest(Request $request)
    {
        $rules = [
            'role_id' => 'required|numeric',
            'user_id' => 'required|numeric',
        ];
        $this->validate($request, $rules);
    }
}

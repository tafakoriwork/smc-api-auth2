<?php

namespace App\Http\Controllers;

use App\Models\RoleCTRL;
use Illuminate\Http\Request;

class RolesCTRLSControllers extends Controller
{
    public function store(Request $request)
    {
        $this->validateRequest($request);
     $result = new RoleCTRL(
        [
            'role_id' => $request->role_id,
            'ctrl_id' => $request->ctrl_id,
        ]
     );   


     return $result->save();
    }

    public function destroy($id)
    {
        $Role = RoleCTRL::find($id);
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
            'ctrl_id' => 'required|numeric',
        ];
        $this->validate($request, $rules);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RolesController extends Controller
{
    public function index()
    {
        $ctlrs = Role::with(['rolectrl.ctrls'])->get();
        return response()->json(['data' => $ctlrs], 200);
    }

    public function store(Request $request)
    {
        $this->validateRequest($request);
        $Role = new Role([
            'name' => $request->get('name'),
        ]);
        $Role->save();
        return $Role->id;
    }

    public function show($id)
    {
        $Role = Role::find($id);
        if (!$Role) {
            return response()->json(['message' => "The user with {$id} doesn't exist"], 404);
        }
        return response()->json(['data' => $Role], 200);
    }

    public function update(Request $request, $id)
    {
        $Role = Role::find($id);
        if (!$Role) {
            return response()->json(['message' => "The user with {$id} doesn't exist"], 404);
        }
        $this->validateRequest($request);
        $Role->name = $request->get('name');
        $Role->save();
        return response()->json(['data' => "The user with with id {$Role->id} has been updated"], 200);
    }

    public function destroy($id)
    {
        $Role = Role::find($id);
        if (!$Role) {
            return response()->json(['message' => "The user with {$id} doesn't exist"], 404);
        }
        $Role->delete();
        return response()->json(['data' => "The user with with id {$id} has been deleted"], 200);
    }
    public function validateRequest(Request $request)
    {
        $rules = [
            'name' => 'required',
        ];
        $this->validate($request, $rules);
    }
}

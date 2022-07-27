<?php

namespace App\Http\Controllers;

use App\Models\CTRLS;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CTRLSController extends Controller
{
    public function index()
    {
        $ctlrs = CTRLS::all();
        return response()->json(['data' => $ctlrs], 200);
    }

    public function store(Request $request)
    {
        $this->validateRequest($request);
        $password = Hash::make($request->get('password'));
        $ctrls = new CTRLS([
            'name' => $request->get('name'),
        ]);
        $ctrls->save();
        return response()->json(['data' => "The user with with id {$ctrls->id} has been created"], 201);
    }

    public function show($id)
    {
        $ctrls = CTRLS::find($id);
        if (!$ctrls) {
            return response()->json(['message' => "The user with {$id} doesn't exist"], 404);
        }
        return response()->json(['data' => $ctrls], 200);
    }

    public function update(Request $request, $id)
    {
        $ctrls = CTRLS::find($id);
        if (!$ctrls) {
            return response()->json(['message' => "The user with {$id} doesn't exist"], 404);
        }
        $this->validateRequest($request);
        $ctrls->name = $request->get('name');
        $ctrls->save();
        return response()->json(['data' => "The user with with id {$ctrls->id} has been updated"], 200);
    }

    public function destroy($id)
    {
        $ctrls = CTRLS::find($id);
        if (!$ctrls) {
            return response()->json(['message' => "The user with {$id} doesn't exist"], 404);
        }
        $ctrls->delete();
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

<?php

namespace App\Http\Controllers\smc;
use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller;

class RAMController extends Controller
{
    public function getState(Request $request) {
        if(!str_contains($request->url, 'ceph'))
            return 'error';
        $smc = new SMCController;
        return $smc->index($request);
    }

    public function store(Request $request)
    {
    }
    public function show($id)
    {
    }
}
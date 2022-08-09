<?php

namespace App\Http\Controllers\smc;

use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller;

class SMCController extends Controller
{
    public function get($url, $token, $address)
    {
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $headers = [
            "Authorization: Bearer $token",
            "address: $address",
            'username: morsa',
            'password: p@ss@ceph',

        ];
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        $apiResponse = curl_exec($curl);
        curl_close($curl);
        return $apiResponse;
    }


    public function index(Request $request)
    {
        $cpu = $this->get($request->url, $request->token, $request->address);
        if (isset($cpu)) {
            $cpuAsArray = json_decode($cpu, true);
            $retval = $cpuAsArray['Status']['RetVal'];
            if ($retval == 1) {
                return $cpuAsArray['Result']['SMC-SL Result']['result'];
            }
        }
        return $this->index($request);
    }

    public function store(Request $request)
    {
    }
    public function show($id)
    {
    }
}

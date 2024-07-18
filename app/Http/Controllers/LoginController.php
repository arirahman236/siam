<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;

class LoginController extends Controller
{
    // login

    public function login(Request $request)
    {
        return view('login');
    }

    public function loginApi(Request $request)
    {

        $nim      = $request->nim;
        $password   = $request->password;

        $response = Http::post('http://127.0.0.1:8000/api/loginn?',[ 
                'NIMHSMSMHS'=>$nim,
                'PASSWORD'=>$password
        ]);

        $result = json_decode((string)$response->getBody(),true);
        dd($response);
        return view('login');
    }
}

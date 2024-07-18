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

    public function loginApii(Request $request)
    {

        $nim      = $request->nim;
        $password   = $request->password;

        $response = Http::post('http://127.0.0.1:8000/api/loginn',[
                'NIMHSMSMHS'=>$nim,
                'PASSWORD'=>$password
        ]);

        $result = json_decode((string)$response->getBody(),true);

        return view('login');
    }
    public function loginApi(Request $request)
{
    $nim = $request->nim;
    $password = $request->password;

    $response = Http::post('http://127.0.0.1:8000/api/loginn', [
        'NIMHSMSMHS' => $nim,
        'PASSWORD' => $password
    ]);

    $result = json_decode($response->getBody(), true);

    if ($response->successful()) {
        // Lakukan sesuatu dengan $result jika diperlukan
        return view('dashboard', ['data' => $result]);
    } else {
        // Tangani kesalahan jika permintaan tidak berhasil
        return redirect()->back()->withErrors(['login' => 'Login gagal, silakan coba lagi.']);
    }
}

}

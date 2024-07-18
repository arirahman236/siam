<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\KrsModel;
use App\Models\e_msmhsModel;

class LoginController extends Controller
{
    public function index(Request $request)
    {
        return view('auth.log-in');
    }

    public function LoginCheck(Request $request)
    {
        $this->validate($request, [
            'nim' => 'required',
            'password' => 'required',
        ], [
            'nim.required' => 'NIM wajib diisi.',
            'password.required' => 'Password wajib diisi.',
        ]);

        // Cari pengguna berdasarkan NIM dan password
        $user = User::where('NIM', $request->nim)
                    ->where('PASSWORD', $request->password)
                    ->first();

        if (!$user) {
            // Jika pengguna tidak ditemukan, kembalikan ke halaman utama dengan pesan error
            return redirect('/')
                    ->with(['clr' => 'danger', 'status' => 'Gagal! NIM atau Password salah']);
        }

        // Setiap pengguna ditemukan di atas

        // Lakukan pengaturan sesuai dengan kondisi STATUS_UPDATE_BIODATA
        if ($user->KODE_STATUS_AKTIVITAS == 'L') {
            // Pengguna adalah alumni, arahkan ke halaman alumni
            return redirect('/tracer')
                    ->with(['clr' => 'success', 'status' => 'Berhasil Login sebagai Alumni!']);
        } elseif ($user->STATUS_UPDATE_BIODATA != 1) {
            // STATUS_UPDATE_BIODATA tidak sama dengan 1, arahkan ke halaman update biodata
            Auth::login($user);
            $request->session()->put('kontrol', KrsModel::getViewKontrolData());
            return redirect('/edit-profile')
                    ->with(['clr' => 'success', 'status' => 'Berhasil Login! Silakan perbarui biodata Anda.']);
        } else {
            // STATUS_UPDATE_BIODATA adalah 1, arahkan ke halaman dashboard
            Auth::login($user);
            $request->session()->put('kontrol', KrsModel::getViewKontrolData());
            return redirect('/dashboard')
                    ->with(['clr' => 'success', 'status' => 'Berhasil Login!']);
        }
    }

    // public function LoginCheck(Request $request)
    // {
    //     $this->validate(
    //         $request,
    //         ['nim' => 'required'],
    //         ['password' => 'required']
    //     );

    //     $user = User::where('NIM', $request->nim)
    //         ->where('PASSWORD', $request->password)
    //         ->firstOrFail();
    //     $kontrol = KrsModel::getViewKontrolData();

    //     if ($user) {

    //         if ($user->KODE_STATUS_AKTIVITAS == 'L') {
    //             // Pengguna adalah alumni, arahkan ke halaman alumni
    //             return redirect('/tracer')->with(['clr' => 'success', 'status' => 'Berhasil Login sebagai Alumni!']);
    //         } else {
    //             if ($user->STATUS_UPDATE_BIODATA != 1) {
    //                 // STATUS_UPDATE_BIODATA tidak sama dengan 1, arahkan ke halaman update biodata
    //                 Auth::attempt(['NIM' => $request->nim, 'password' => $request->password]);
    //                 // Auth::login($user);
    //                 // Auth::loginUsingId(''.$user->nim);
    //                 if (Auth::check()) {
    //                     // dd($kontrol);
    //                     $request->session()->put('kontrol', $kontrol);
    //                     return redirect('/edit-profile')->with(['clr' => 'success', 'status' => 'Berhasil Login!, Silakan perbarui biodata Anda.']);
    //                 } else {
    //                     return redirect('/')->with(['clr' => 'danger', 'status' => 'Gagal! NIM atau Password salah']);
    //                 }
    //             } else {
    //                 // STATUS_UPDATE_BIODATA adalah 1, arahkan ke halaman dashboard
    //                 Auth::login($user);
    //                 // Auth::loginUsingId(''.$user->nim);
    //                 Auth::attempt(['NIM' => $request->nim, 'password' => $request->password]);
    //                 if (Auth::check()) {
    //                     $request->session()->put('kontrol', $kontrol);
    //                     return redirect('/dashboard')->with(['clr' => 'success', 'status' => 'Berhasil Login!']);
    //                 } else {
    //                     return redirect('/')->with(['clr' => 'danger', 'status' => 'Gagal! NIM atau Password salah']);
    //                 }
    //             }
    //         }
    //     } else {
    //         return redirect('/')->with(['clr' => 'danger', 'status' => 'Gagal! NIM atau Password salah']);
    //     }
    // }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}

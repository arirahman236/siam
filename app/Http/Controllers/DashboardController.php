<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\KrsModel;
use App\Models\ViewDataMahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function dashboard(Request $request)
    {
        
        return view('pages.dashboard');
    }
}

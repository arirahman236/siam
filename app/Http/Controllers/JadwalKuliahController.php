<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\ViewDataMahasiswa;
use Illuminate\Http\Request;
use App\Models\view_kontrol;
use App\Models\Hari;
use App\Models\KrsModel;
use Illuminate\Support\Facades\Auth;

class JadwalKuliahController extends Controller
{
    public function viewJadwalKuliah(Request $request)
    {
        $data['kontrol'] = KrsModel::getViewKontrolData();

        $data['hari'] = Hari::getValueHari();

        $data['atts'] = [
            'width' => '900',
            'height' => '768',
            'scrollbars' => 'yes',
            'status' => 'yes',
            'resizable' => 'yes',
            'screenx' => '0',
            'screeny' => '0',
        ];

        return view('pages.perkuliahan.jadwal-kuliah', compact('data'));
    }
}

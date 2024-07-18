<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\AkademiModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AkademiController extends Controller
{
    public function viewKrs()
    {
        $halamanData = [
            'modulhalsiam' => 'akademik',
            'halamansiam' => 'krs',
        ];

        session()->put($halamanData);

        if (request()->has('semester') && request()->has('tahun')) {
            $tahun_semester = request('tahun') . request('semester');
            $data['getDataKrs'] = AkademiModel::getViewKrsAll(session('siam_user'), $tahun_semester);

            if (session('mobile') == 1) {
                $data['page'] = 'detail_krs_m';
            } else {
                $data['page'] = 'detail_krs';
            }

            $data['info_semester'] = request('semester');
            $data['info_tahun'] = request('tahun');
        } else {
            $data['mhs'] = AkademiModel::getDataMahasiswa(session('siam_user'));
            $data['kontrol'] = SystemModel::getViewKontrolData();

            if (session('mobile') == 1) {
                $data['page'] = 'lihat_krs_m';
            } else {
                $data['page'] = 'lihat_krs';
            }
        }

        $data['atts'] = [
            'width' => '950',
            'height' => '768',
            'scrollbars' => 'yes',
            'status' => 'yes',
            'resizable' => 'yes',
            'screenx' => '0',
            'screeny' => '0',
        ];

        return view($this->_template, $data);
    }
}

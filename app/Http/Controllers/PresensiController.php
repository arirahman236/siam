<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PresensiModel;
use App\Models\KrsModel;
use App\Models\view_presensi;
use App\Models\ViewDataMahasiswa;

class PresensiController extends Controller
{
    public function viewPresensi(Request $request)
    {
        $data['mhs'] = ViewDataMahasiswa::getDataMahasiswa(auth()->user()->NIM);

        if ($data['mhs']) {
            $data['kontrol'] = KrsModel::getViewKontrolData(auth()->user()->KODE_PRODi);
            $data['daftarMkPresensi'] = view_presensi::getDaftarMkPresensi($data['kontrol']->SEMESTER, auth()->user()->NIM);
        } else {
            $data['daftarMkPresensi'] = null;
            $data['mhs'] = null;
        }

        return view('pages.perkuliahan.presensi', compact('data'));
    }

    public function detailPresensi(Request $request)
    {
        $tahun_semester = $request->input('tahun_semester');
        $kode_mk = $request->input('mk');

        $presensiData = view_presensi::getPresensiData($tahun_semester, $kode_mk);
        $presensiDataNim = view_presensi::getPresensiDataNim(auth()->user()->NIM, $tahun_semester, $kode_mk);

        return view('pages.perkuliahan.DetailPresensi', compact('presensiData', 'presensiDataNim'));
    }
}

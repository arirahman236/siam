<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\e_mspst;
use App\Models\e_mspti;
use App\Models\e_tbbnl;
use App\Models\ViewDataMahasiswa;
use App\Models\view_kontrol;
use App\Models\view_prodi;
use App\Models\jabatan_pusat;
use App\Models\PD1;
use App\Models\view_khs_cetak;
use App\Models\view_khs_all;
use App\Models\polling_hasil_khs;
use Illuminate\Support\Facades\Session;

class AkadControllerRekapNilai extends Controller
{
    public function viewTranskrip()
    {
        $halamanData = [
            'modulhalsiam' => 'akademik',
            'halamansiam' => 'transkrip'
        ];

        session()->put($halamanData);
        $nim = auth()->user()->NIM;
        $data['boleh'] = e_mspst::allowNilai();
        $data['getDataTranskrip'] = view_khs_all::getViewKhsAllByNim($nim);
        $data['getDataTranskripDistinct'] = view_khs_all::getViewKhsAllDistinct($nim);
        $thsms = $data['getDataTranskrip']->first()->TAHUN_SEMESTER; //Perlu handler jika mahasiswa tidak memilih matkul

        foreach ($data['getDataTranskripDistinct'] as $transkrip_distinct) {
            $histori_nilai = view_khs_all::getViewKhsAllByKodeMk($nim, $transkrip_distinct->KODE_MATAKULIAH);
            $countKuliah = view_khs_all::countViewKhsAllByKodeMk($nim, $transkrip_distinct->KODE_MATAKULIAH);
        }

        return view('pages.akademik.rekap-nilai', compact('data', 'histori_nilai', 'countKuliah', 'nim', 'thsms'));
    }

    public function cetakTranskrip()
    {
        $data['dataMhs'] = ViewDataMahasiswa::getDetailDataMahasiswa(Session::get('siam_user'));
        $data['dataprodi'] = view_prodi::getProdiDetail($data['dataMhs']->KODE_PRODI);
        $data['cms_siakad'] = SystemModel::selectCmssiakad();
        $data['pt'] = SystemModel::selectEmspti1();
        $data['getDataTranskrip'] = AkadModel::getViewKhsAllByNim(Session::get('siam_user'));
        $data['getDataTranskripDistinct'] = AkadModel::getViewKhsAllDistinct(Session::get('siam_user'));

        return view('pages.akademik.rekap-nilai', $data);
    }

    public function alphabetToIntScoreNew($input = 'T', $kodeProdi)
    {
        $tahun = view_kontrol::getViewKontrolData();
        $tahun_semester = $tahun->SEMESTER;
        $dataNilai = e_tbbnl::getRentangNilaiAll($tahun_semester, $kodeProdi);

        $def = 0;
        foreach ($dataNilai as $nd) {
            if ($input == $nd->NLAKHTBBNL) {
                $def = $nd->BOBOTTBBNL;
            }
        }
        // dd($def);
        return $def;
    }
}

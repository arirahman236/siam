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

class AkadControllerKhs extends Controller
{
    public function viewKhs(Request $request)
    {
        $halamanData = [
            'modulhalsiam' => 'akademik',
            'halamansiam' => 'khs'
        ];

        session()->put($halamanData);

        if ($request->has('semester') && $request->has('tahun')) {
            $data['boleh'] = e_mspst::allowNilai();
            $nim = auth()->user()->NIM;
            $tahunSemester = $request->input('tahun') . $request->input('semester');
            $data['getDataKhs'] = view_khs_all::getViewKhsAll($nim, $tahunSemester);
            $data['getDataIpk'] = view_khs_all::getViewKhsAllByNim($nim);
            $data['tahun'] = $request->input('tahun');
            $data['semester'] = $request->input('semester');
            $data['dataMhs'] = ViewDataMahasiswa::getDataMahasiswa($nim);
            $data['smt'] = ($request->input('semester') % 2 == 0 ? "Genap" : "Ganjil");

            // $data['semester'] = ($data['dataMhs']->TAHUN_MASUK, $request->input('tahun') . $request->input('semester'));
            $jumlah_semester = $data['dataMhs']->TAHUN_MASUK - $request->input('tahun') . $request->input('semester') + 1;

            $sisa_pembagian = $jumlah_semester % 2;
            if ($sisa_pembagian == 0) {
                $jumlah_semester;
            } else {
                $jumlah_semester - 1;
            }
            $data['semester'] = $jumlah_semester;
            // dd($data['boleh']);

            return view('pages.akademik.detail-khs', compact('data'));
        } else {
            $data['mhs'] = ViewDataMahasiswa::getDataMahasiswa(auth()->user()->NIM ?? null);
            $data['kontrol'] = view_kontrol::getViewKontrolData();
            $data['page'] = 'lihat_khs';
        }

        $data['atts'] = [
            'width' => '950',
            'height' => '768',
            'scrollbars' => 'yes',
            'status' => 'yes',
            'resizable' => 'yes',
            'screenx' => '0',
            'screeny' => '0'
        ];

        $trap = 0;

        if (isset($data['getDataKhs'])) {
            foreach ($data['getDataKhs'] as $khsCek) {
                $id_smt = $khsCek->ID_MK_TERSEDIA;
                $cek = polling_hasil_khs::cekPolling($nim, $data['tahun'] . $data['semester'], $id_smt);

                if ($cek == 'FALSE') {
                    $trap++;
                }
            }
        }

        $data['trap'] = $trap;

        $identitas = e_mspti::selectEmspti1();

        return view('pages.akademik.KHS', compact('data', 'identitas'));
    }

    // public function semester_to_nama($smt)
    // {
    //     return (($smt % 2 == 0) ? "Genap" : "Ganjil");
    // }

    // public function get_semester_berapa($tahun_masuk, $tahun_semester)
    // {
    //     $jumlah_semester = $tahun_semester - $tahun_masuk + 1;

    //     $sisa_pembagian = $jumlah_semester % 2;
    //     if ($sisa_pembagian == 0) {
    //         return $jumlah_semester;
    //     } else {
    //         return $jumlah_semester - 1;
    //     }
    // }

    public function printKhs(Request $request)
    {
        $nim = auth()->user()->NIM;
        $data['boleh'] = e_mspst::allowNilai();
        $data['dataMhs'] = ViewDataMahasiswa::getDataMahasiswa($nim);
        $data['prodi'] = $nim;
        $data['dataprodi'] = view_prodi::getProdiDetail($data['dataMhs']->KODE_PRODI);
        $data['datapejabat'] = jabatan_pusat::getPejabat(2);
        $data['PD'] = PD1::getPD($data['dataprodi']->ID_FAKULTAS);
        $data['khs'] = view_khs_cetak::getViewKhsCetak($nim, $request->input('tahun') . $request->input('semester'));
        $data['title'] = "KHS-" . $nim;
        $data['tahun_ajaran'] = $request->input('tahun');
        $data['tahun_semester'] = $request->input('tahun') . $request->input('semester');

        $data['smt'] = semester_to_nama($request->input('semester'));

        $data['semester'] = get_semester_berapa($data['dataMhs']->TAHUN_MASUK, $request->input('tahun') . $request->input('semester'));

        return view('print_khs', $data);
    }

    public function hitungIpk($nim, $thsms)
    {
        // Mendapatkan data mahasiswa berdasarkan NIM
        $biodata = ViewDataMahasiswa::getDataMahasiswa($nim);

        // Hitung angkatan dan semester awal
        $angkatan = $biodata->TAHUN_MASUK;
        $smtawal = $angkatan . '1';

        // Inisialisasi array untuk menyimpan semester-semester
        $smt_array = [];

        $tahun = substr($thsms, 0, 4);
        $smstr = substr($thsms, 4, 1);
        $tahuna = substr($smtawal, 0, 4);
        $smstra = substr($smtawal, 4, 1);
        $loopnya = (int)$tahun - $angkatan;

        if ($smstr == 2) {
            $loopnya = ($loopnya * 2) + 1;
        } else {
            $loopnya = ($loopnya * 2);
        }

        array_push($smt_array, $smtawal);

        for ($a = 0; $a < $loopnya; $a++) {
            if ($smstra == 2) {
                $tahunl = $tahuna + 1;
                $smstrl = 1;
                $thsmsl = $tahunl . $smstrl;
                $tahuna = $tahunl;
                $smstra = $smstrl;
            } else {
                $tahunl = $tahuna;
                $smstrl = 2;
                $thsmsl = $tahunl . $smstrl;
                $tahuna = $tahunl;
                $smstra = $smstrl;
            }
            array_push($smt_array, $thsmsl);
        }

        $total_sks = 0;
        $total_nk = 0;
        $total_sks_semua = 0;

        // Mengambil data transkrip distinct per semester
        $data_transkrip_distinct = view_khs_all::getViewKhsAllDistinctPerSemester($nim, $smt_array);

        if ($data_transkrip_distinct) {
            foreach ($data_transkrip_distinct as $transkrip_distinct) {
                // Mengambil nilai terbaik berdasarkan kode mata kuliah
                $transkrip = view_khs_all::getViewKhsAllByNim_nilaiTerbaik($nim, $transkrip_distinct->KODE_MATAKULIAH);

                if ($transkrip) {
                    $nilai = $transkrip->NILAI_AKHIR_HURUF;
                    $total_sks_semua += $transkrip->SKS;

                    if ($nilai != '-' && $nilai != 'T') {
                        $total_sks += $transkrip->SKS;
                        $tahun_semester = $transkrip->TAHUN_SEMESTER;
                        $kode_prodi = $biodata->KODE_PRODI;
                        // dd($tahun_semester, $kode_prodi, $nilai);

                        // Mengambil bobot nilai
                        $tempor = e_tbbnl::getBobotNilai($tahun_semester, $kode_prodi, $nilai);
                        // dd($tempor);
                        if ($tempor) {
                            $nk = ($tempor->BOBOTTBBNL * $transkrip->SKS);
                            $total_nk += $nk;
                        } else {
                            $nk = 0;
                            $total_nk += $nk;
                        }
                    }
                }
            }
        }

        // Menghitung IPK
        if ($total_sks == 0) {
            $nilai_ipk = 0;
        } else {
            $nilai_ipk = $total_nk / $total_sks;
        }

        $data['ipk'] = number_format($nilai_ipk, 2);
        $data['sks'] = $total_sks;
        $data['sks_total'] = $total_sks_semua;
        $data['nk'] = $total_nk;

        return $data;
    }
}

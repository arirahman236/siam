<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TugasAkhirModel;
use App\Models\KrsModel;
use App\Models\JudulSkripsiModel;
use App\Models\e_trlsm;
use App\Models\e_mspst;
use App\Models\view_data_skripsi;
use App\Models\transaksi_tagihan_lain;
use Illuminate\Support\Facades\Session; // Import Session facade

class TugasAkhirController extends Controller
{
    public function judulSkripsi(Request $request)
    {

        $data['nim'] = e_trlsm::getSkripsiMhs(auth()->user()->NIM);
        $skripsi = view_data_skripsi::getSkripsiByNim(auth()->user()->NIM);
        $tagihan = transaksi_tagihan_lain::getSkripsiTagihanByNim(auth()->user()->NIM);
        
        $data['failed1'] = ($skripsi) ? TRUE : FALSE ;
        $data['failed2'] = ($tagihan) ? FALSE : TRUE ;
        $data['q'] = e_mspst::getKode(auth()->user()->KODE_PRODI);

        return view('pages.akademik.tugas-akhir', compact('data'));
    }

    public function insertJudulSkripsi(Request $request)
    {
        $judul = $request->input('judul');
        $viewKontrolData = KrsModel::getViewKontrolData();

        $nim = auth()->user()->NIM;
        $kode_prodi = auth()->user()->KODE_PRODI;
        $kode_pt = auth()->user()->KODE_PT;
        $kode_jen = auth()->user()->KODE_JENJANG_STUDI;
        $thn = $viewKontrolData->SEMESTER;
        $status = auth()->user()->KODE_STATUS_AKTIVITAS;

        $exec = e_trlsm::addJudulSkripsi($thn, $kode_pt, $kode_prodi, $kode_jen, $nim, $status, $judul);

        if ($exec) {
            $request->session()->flash('status', 'Data telah disimpan.');
            $request->session()->flash('clr', 'success');
        } else {
            $request->session()->flash('status', 'Data gagal disimpan, ulangi lagi.');
            $request->session()->flash('clr', 'error');
        }

        return redirect()->back();
    }

    public function judul(Request $request)
    {
        $nim = $request->user()->nim;

        $q = E_MSPST::where('NMPST', $nim)->first();

        if ($q) {
            $jenisMatakuliah = $q->getJenisMatakuliahAttribute();
        } else {
            $jenisMatakuliah = 'Skripsi';
        }

        $data = [
            'nim' => $nim,
            'jenis_matakuliah' => $jenisMatakuliah,
        ];

        return view('pages.akademik.tugas-akhir', compact('data'));
    }
}

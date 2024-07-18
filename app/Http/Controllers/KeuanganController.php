<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\KeuanganModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KeuanganController extends Controller
{
    public function keuangan(Request $request)
    {
        $dataPembayaran = KeuanganModel::where('NIM', auth()->user()->NIM)->orderBy('TANGGAL')->get();

        $no = 1;
        $jumlah_nominal_d = 0;
        $jumlah_nominal_k = 0;
        $jumlah_kredit = 0;

        $results = [];
        foreach ($dataPembayaran as $dp) {
            $row = [];
            $row['no'] = $no;
            $row['nama_transaksi'] = $dp->NAMA_TRANSAKSI . " " . KeuanganModel::tanggal_indonesia(date('Y-m-d', strtotime($dp->TANGGAL)));
            $keuanganModel = new KeuanganModel();
            $temp = $keuanganModel->getDetailTagihanById($dp->ID);

            if ($temp) {
                $detail = explode("#", $temp->DETAIL);
                $jmlh = count($detail) - 1;
                $smt = substr($temp->TAHUN_SEMESTER, 4);
                $thn = substr($temp->TAHUN_SEMESTER, 0, 4);

                $row['nama_transaksi'] .= "<br>" . $temp->NAMA_TRANSAKSI . " " . $thn . "/" . (($smt % 2 == 0) ? "Genap" : "Ganjil");



                for ($i = 0; $i < $jmlh; $i++) {
                    if ($i % 2 == 1) {
                        $row['nama_transaksi'] .= "<br>" . $detail[$i - 1] . " ( " . "Rp " . number_format($detail[$i], 2, ',', '.') . " )";
                    }
                }
            }

            $row['debet'] = $dp->JENIS_TRANSAKSI == 'D' ? "Rp " . number_format($dp->NOMINAL, 2, ',', '.') : '';
            $row['kredit'] = $dp->JENIS_TRANSAKSI == 'K' ? "Rp " . number_format($dp->NOMINAL, 2, ',', '.') : '';
            $row['saldo'] = "Rp " . number_format($jumlah_kredit - $jumlah_nominal_d, 2, ',', '.');

            $row['jumlah_nominal'] = "Rp " . number_format($jumlah_nominal_d += $dp->NOMINAL, 2, ',', '.');
            $row['jumlah_kredit'] = "Rp " . number_format($jumlah_kredit += $dp->NOMINAL, 2, ',', '.');

            $results[] = $row;
            $no++;
        }
        //dd($results);
        return view('pages.keuangan.keuangan', compact('results'));
    }
}

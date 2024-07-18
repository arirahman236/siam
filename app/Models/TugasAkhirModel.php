<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class TugasAkhirModel extends Model
{
    use HasFactory;

    protected $table = 'e_trlsm';

    protected $fillable = [
        'THSMSTRLSM',
        'JUDUL',
        'KDPTITRLSM',
        'KDPSTTRLSM',
        'KDJENTRLSM',
        'NIMHSTRLSM',
        'STMHSTRLSM',
    ];

    public function addJudulSkripsi($thn, $kode_pt, $kode_prodi, $kode_jen, $nim, $status, $judul)
    {
        $tugasAkhir = new TugasAkhirModel();
        $tugasAkhir->THSMSTRLSM = $thn;
        $tugasAkhir->JUDUL = $judul;
        $tugasAkhir->KDPTITRLSM = $kode_pt;
        $tugasAkhir->KDPSTTRLSM = $kode_prodi;
        $tugasAkhir->KDJENTRLSM = $kode_jen;
        $tugasAkhir->NIMHSTRLSM = $nim;
        $tugasAkhir->STMHSTRLSM = $status;

        $tugasAkhir->save();

        return $tugasAkhir;
    }

    public function getSkripsiMhs($nim)
    {
        return TugasAkhirModel::where('NIMHSTRLSM', $nim)->first();
    }

    public function getSkripsiByNim($nim)
    {
        return DB::table('view_data_skripsi')->where('NIM', $nim)->first();
    }

    public function getSkripsiTagihanByNim($nim)
    {
        return DB::table('transaksi_tagihan_lain')->where('NIM', $nim)->where('KODE_TAGIHAN', 1)->first();
    }
}

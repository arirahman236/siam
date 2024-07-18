<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class e_trlsm extends Model
{
    protected $table = 'e_trlsm';
    
    function getSkripsiMhs($nim) {
        $data = DB::table('e_trlsm')->where('NIMHSTRLSM', $nim)->first();
    
        return $data;
    }
    public function addJudulSkripsi($thn, $kode_pt, $kode_prodi, $kode_jen, $nim, $status, $judul)
    {
        // Menggunakan Query Builder untuk menyisipkan data
        $insert = DB::table('e_trlsm')->insert([
            'THSMSTRLSM' => $thn,
            'JUDUL' => $judul,
            'KDPTITRLSM' => $kode_pt,
            'KDPSTTRLSM' => $kode_prodi,
            'KDJENTRLSM' => $kode_jen,
            'NIMHSTRLSM' => $nim,
            'STMHSTRLSM' => $status,
        ]);

        if ($insert) {
            return true;
        } else {
            return false;
        }
    }
}

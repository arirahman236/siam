<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class view_presensi extends Model
{
    use HasFactory;
    protected $table = 'view_presensi';

    public function getDaftarMkPresensi($tahun_semester, $nim) {
        $data = DB::table('view_presensi')
            ->where('TAHUN_AJARAN', $tahun_semester)
            ->where('NIM', $nim)
            ->get();
    
        if ($data->isNotEmpty()) {
            return $data;
        } else {
            return null;
        }
    }
    function getPresensiData($tahun_semester, $kode_mk) {
        $sql = DB::table('view_presensi')
            ->where('KODE_PRODI', auth()->user()->KODE_PRODI)
            ->where('NIM', auth()->user()->NIM)
            ->where('TAHUN_AJARAN', $tahun_semester)
            ->where('ID_MK_TERSEDIA', $kode_mk)
            ->first();
    
        if ($sql) {
            $kelas = $sql->KELAS;
    
            $query = DB::table('view_presensi')
                ->where('KODE_PRODI', auth()->user()->KODE_PRODI)
                ->where('KELAS', $kelas)
                ->where('TAHUN_AJARAN', $tahun_semester)
                ->where('ID_MK_TERSEDIA', $kode_mk)
                ->orderBy('NIM', 'ASC')
                ->get();
    
            if ($query->count() > 0) {
                return $query;
            }
        }
    
        return null;
    }
    function getPresensiDataNim($nim, $tahun_semester, $kode_mk) {
        $data = DB::table('view_presensi')
            ->select('*')
            ->where('NIM', $nim)
            ->where('TAHUN_AJARAN', $tahun_semester)
            ->where('ID_MK_TERSEDIA', $kode_mk)
            ->first();
    
        return $data;
    }
}

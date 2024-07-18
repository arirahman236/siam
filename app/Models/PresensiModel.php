<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PresensiModel extends Model
{
    public function getDaftarMkPresensi($tahun_semester, $nim)
    {
        $data = DB::table('view_presensi')
            ->where('TAHUN_AJARAN', $tahun_semester)
            ->where('NIM', $nim)
            ->get();

        return $data->count() > 0 ? $data : null;
    }


    public function getPresensiData($tahun_semester, $kode_mk)
    {
        $userProdi = session('siam_user_prodi');
        $userNim = session('siam_user');

        $kelas = DB::table('view_presensi')
            ->where('KODE_PRODI', $userProdi)
            ->where('NIM', $userNim)
            ->where('TAHUN_AJARAN', $tahun_semester)
            ->where('ID_MK_TERSEDIA', $kode_mk)
            ->value('KELAS');

        $data = DB::table('view_presensi')
            ->where('KODE_PRODI', $userProdi)
            ->where('KELAS', $kelas)
            ->where('TAHUN_AJARAN', $tahun_semester)
            ->where('ID_MK_TERSEDIA', $kode_mk)
            ->orderBy('NIM', 'ASC')
            ->get();

        return $data->count() > 0 ? $data : null;
    }

    public function getPresensiDataNim($nim, $tahun_semester, $kode_mk)
    {
        $data = DB::table('view_presensi')
            ->where('NIM', $nim)
            ->where('TAHUN_AJARAN', $tahun_semester)
            ->where('ID_MK_TERSEDIA', $kode_mk)
            ->first();

        return $data;
    }
}

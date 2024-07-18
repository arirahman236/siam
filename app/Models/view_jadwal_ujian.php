<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class view_jadwal_ujian extends Model
{
    use HasFactory;
    protected $table = 'view_jadwal_ujian';
    public function getJadwalUjian($kode_prodi, $kode_semester, $kode_tahun)
    {
        $query = DB::table('view_jadwal_ujian')
            ->where('KODE_PRODI', $kode_prodi)
            ->where('SEMESTER', $kode_semester)
            ->where('TAHUN', $kode_tahun);

        return $query->orderBy(`TANGGAL_UJIAN`, `MULAI`, 'ASC')
            ->get();
    }

    public function getJadwalUjianByTgl($kode_prodi, $tahun_semester, $index_tgl)
    {
        $query = DB::table('view_jadwal_ujian')
            ->where('TAHUN_SEMESTER', $tahun_semester)
            ->where('KODE_PRODI', $kode_prodi)
            ->where('TANGGAL_UJIAN', $index_tgl);

        return $query->orderBy(`KODE_MK`, `MULAI`, 'ASC')
            ->get();
    }

    public function getJadwalUjianByTgl1($kode_prodi, $tahun_semester, $index_tgl)
    {
        $query = DB::table('view_jadwal_ujian')
            ->where('TAHUN_SEMESTER', $tahun_semester)
            ->where('KODE_PRODI', $kode_prodi)
            ->where('TANGGAL_UJIAN', $index_tgl);

        return $query->orderBy('KODE_MK', 'ASC')->orderBy('MULAI', 'ASC')->get();
    }


    public function getDistinctJadwalUjian($tahun_semester, $kode_prodi)
    {
        $query = DB::table('view_jadwal_ujian')
            ->where('TAHUN_SEMESTER', $tahun_semester)
            ->distinct('TANGGAL_UJIAN')
            ->orderBy('TANGGAL_UJIAN', 'ASC')
            ->get();

        return $query;
    }

}

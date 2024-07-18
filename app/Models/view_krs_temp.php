<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class view_krs_temp extends Model
{
    use HasFactory;
    protected $table = 'view_krs_temp';
    public function cekValidasi($nim, $tahun_semester)
    {
        return DB::table('view_krs_temp')
            ->where('NIM_MAHASISWA', $nim)
            ->where('TAHUN_SEMESTER', $tahun_semester)
            ->where('APPROVED', 1)
            ->first();
    }
    public function getViewKrsTemp($nim, $tahun_semester)
    {
        return DB::table('view_krs_temp')
            ->where('NIM_MAHASISWA', $nim)
            ->where('TAHUN_SEMESTER', $tahun_semester)
            ->get();
    }
    public function jumlahPeminatMk($kode_prodi, $kode_mk, $kelas, $tahun_akademik)
    {
            return DB::table('view_krs_temp')
                ->where('KODE_PRODI', $kode_prodi)
                ->where('KODE_MATAKULIAH', $kode_mk)
                ->where('KELAS', $kelas)
                ->where('TAHUN_SEMESTER', $tahun_akademik)
                ->count();
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class KrsModel extends Model
{
    protected $table = 'view_kontrol';
    // protected $table = 'view_data_mahasiswa';
    // protected $table = 'view_krs_temp';
    // protected $table = 'setting_global';
    // protected $table = 'view_khs_all';

    public function getDataMahasiswa($nim)
    {
        return DB::table('view_data_mahasiswa')
            ->where('NIM', $nim)
            ->first();
    }

    public function getViewKontrolData()
    {
        return DB::table('view_kontrol')
            ->first();
    }

    public function cekValidasi($nim, $tahun_semester)
    {
        return DB::table('view_krs_temp')
            ->where('NIM_MAHASISWA', $nim)
            ->where('TAHUN_SEMESTER', $tahun_semester)
            ->where('APPROVED', 1)
            ->first();
    }

    public function getMahasiswa($nim)
    {
        return DB::table('view_data_mahasiswa')
            ->where('NIM', $nim)
            ->select('STATUS_REGISTRASI')
            ->first();
    }

    public function getSettingGlobal()
    {
        return DB::table('setting_global')
            ->where('ID', 1)
            ->first();
    }

    public function getViewKhsAll($nim, $tahun_semester)
    {
        return DB::table('view_khs_all')
            ->where('NIM', $nim)
            ->where('TAHUN_SEMESTER', $tahun_semester)
            ->orderBy('NAMA_MATAKULIAH', 'ASC')
            ->get();
    }

    public function getViewKrsTemp($nim, $tahun_semester)
    {
        return DB::table('view_krs_temp')
            ->where('NIM_MAHASISWA', $nim)
            ->where('TAHUN_SEMESTER', $tahun_semester)
            ->get();
    }
}

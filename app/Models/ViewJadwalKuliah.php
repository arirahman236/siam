<?php
// app/Models/ViewJadwalKuliah.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ViewJadwalKuliah extends Model
{
    use HasFactory;

    protected $table = 'view_jadwal_kuliah';
    protected $primaryKey = 'ID_MK_TERSEDIA';

    public function kapasitasKelasMk($kode_prodi, $kode_mk, $kelas, $tahun_akademik)
        {
            return DB::table('view_jadwal_kuliah')
                ->where('KODE_PRODI', $kode_prodi)
                ->where('KODE_MK', $kode_mk)
                ->where('KELAS', $kelas)
                ->where('TAHUN', $tahun_akademik)
                ->max('KAPASITAS');
        }
        public static function cekSKSByMkTersedia($id_mk_tersedia)
        {
            $data = DB::table('view_jadwal_kuliah')
                ->where('ID_MK_TERSEDIA', $id_mk_tersedia)
                ->select('SKS')
                ->first();
    
            return $data;
        }
        public function getJadwalKuliahByIdHari($id_hari, $prodi, $tahun_semester, $count = false) {
            $query = DB::table('view_jadwal_kuliah')
                ->where('ID_HARI', $id_hari)
                ->where('TAHUN', $tahun_semester)
                ->where('KODE_PRODI', $prodi)
                ->orderBy('MULAI')
                ->orderBy('SELESAI')
                ->orderBy('NAMA_MK')
                ->orderBy('KELAS');
        
            if ($count) {
                return $query->count();
            } else {
                return $query->get();
            }
        }        

}

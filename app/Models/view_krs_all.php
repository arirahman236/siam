<?php
// app/Models/ViewJadwalKuliah.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class view_krs_all extends Model
{
    use HasFactory;

    protected $table = 'view_krs_all';

    public function getViewKrsAll($nim, $tahun_semester) {
        return DB::table('view_krs_all')
            ->where('NIM', $nim)
            ->where('TAHUN_SEMESTER', $tahun_semester)
            ->orderBy('NAMA_MATAKULIAH', 'ASC')
            ->get();
    }      

}

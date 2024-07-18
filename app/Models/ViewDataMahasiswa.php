<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class ViewDataMahasiswa extends Model
{
    use HasFactory;
    protected $table = 'view_data_mahasiswa';
    public function getDataMahasiswa($nim)
    {
        return DB::table('view_data_mahasiswa')
            ->where('NIM', $nim)
            ->first();
    }
    public function getMahasiswa($nim)
    {
        return DB::table('view_data_mahasiswa')
            ->where('NIM', $nim)
            ->select('STATUS_REGISTRASI')
            ->first();
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class view_mk_tersedia extends Model
{
    use HasFactory;
    protected $table = 'view_mk_tersedia';
    public function viewMkTersedia_cekPrasyarat($kode_prasyarat1, $kode_prasyarat2)
    {
        $query = DB::table('view_mk_tersedia')
            ->where('NO_MATAKULIAH', $kode_prasyarat1)
            ->orWhere('NO_MATAKULIAH', $kode_prasyarat2)
            ->get();

        if ($query->count() > 0) {
            return $query;
        } else {
            return null;
        }
    }
    public function dataMatakuliahTersediaById($kode_mkb)
    {
        $data = DB::table('view_mk_tersedia')
            ->where('ID_TERSEDIA', $kode_mkb)
            ->first();

        return $data;
    }

}

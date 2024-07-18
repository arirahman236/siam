<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class kelompok_kelas extends Model
{
    use HasFactory;
    protected $table = 'kelompok_kelas';
    public function kelas_to_huruf($kode){
        return DB::table('kelompok_kelas')
            ->where('ID', $kode)
            ->get();
       
    }
}

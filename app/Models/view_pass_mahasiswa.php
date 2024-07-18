<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class view_pass_mahasiswa extends Model
{
    use HasFactory;

    protected $table = 'view_pass_mahasiswa';

    public static function getPassMhs($nim, $pwd_lama)
    {
        return DB::table('view_pass_mahasiswa')
            ->where('NIM', $nim)
            ->where('PASSWORD', $pwd_lama)
            ->first();
    }
}

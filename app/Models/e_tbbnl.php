<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class e_tbbnl extends Model
{
    use HasFactory;
    protected $table = 'e_tbbnl';

    public function getBobotNilai($tahun_semester, $kode_prodi, $nilai)
    {
        $query = DB::table('e_tbbnl')
            ->where('THSMSTBBNL', $tahun_semester)
            ->where('KDPSTTBBNL', $kode_prodi)
            ->where('NLAKHTBBNL', $nilai)
            ->first();

        return $query;
    }

    public function getRentangNilaiAll($tahun_semester, $kode_prodi = 84202)
    {
        $data = DB::table('e_tbbnl')
            ->where('THSMSTBBNL', $tahun_semester)
            ->where('KDPSTTBBNL', $kode_prodi)
            ->orderByDesc('BOBOTTBBNL')
            ->get();

        return $data;
    }
}

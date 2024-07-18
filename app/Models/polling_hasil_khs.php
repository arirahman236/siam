<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class polling_hasil_khs extends Model
{
    use HasFactory;
    protected $table = 'polling_hasil_khs';
    public function cekPolling($nim, $tahunsmt, $idmk)
    {
        $result = DB::table('polling_hasil_khs')
            ->where('NIM', $nim)
            ->where('TAHUN_SEMESTER', $tahunsmt)
            ->where('ID_TRAKD', $idmk)
            ->count();

        return $result > 0 ? 'TRUE' : 'FALSE';
    }
}

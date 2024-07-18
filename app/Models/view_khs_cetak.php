<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class view_khs_cetak extends Model
{
    use HasFactory;
    protected $table = 'view_khs_cetak';
    public function getViewKhsCetak(string $nim, string $tahun_semester)
    {
        $data = view_khs_cetak::where('NIM', $nim)
            ->where('TAHUN_SEMESTER', $tahun_semester)
            ->get();

        if ($data->isNotEmpty()) {
            return $data;
        } else {
            return null;
        }
    }

}

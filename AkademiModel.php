<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AkademiModel extends Model
{
    protected $table = 'view_krs_all';

    public function getViewKrsAll($nim, $tahun_semester)
    {
        return $this->where('NIM', $nim)
            ->where('TAHUN_SEMESTER', $tahun_semester)
            ->orderBy('NAMA_MATAKULIAH', 'ASC')
            ->get();
    }

    public function getViewKrsTemp($nim, $tahun_semester)
    {
        return $this->where('NIM_MAHASISWA', $nim)
            ->where('TAHUN_SEMESTER', $tahun_semester)
            ->get();
    }
}

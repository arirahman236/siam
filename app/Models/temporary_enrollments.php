<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class temporary_enrollments extends Model
{
    use HasFactory;
    protected $table = 'temporary_enrollments';
    public $timestamps = false;

    public function insertDataKrs($tersedia, $nim)
    {
        DB::table('temporary_enrollments')->insert([
            'ID_TRAKD' => $tersedia,
            'NIM_MAHASISWA' => $nim,
            'APPROVED' => '0', // Sesuaikan dengan field lain yang perlu diisi
        ]);
    }

    public function dataDeleteKrs($nim, $id_mk_tersedia)
    {
        DB::table('temporary_enrollments')
            ->where('NIM_MAHASISWA', $nim)
            ->where('ID_TRAKD', $id_mk_tersedia)
            ->where('APPROVED', '<>', 1)
            ->delete();
    }

}

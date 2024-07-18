<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class view_khs_all extends Model
{
    use HasFactory;
    protected $table = 'view_khs_all';
    public function getViewKhsAll($nim, $tahun_semester = null)
    {
        $query = DB::table('view_khs_all')
            ->where('NIM', $nim);

        if ($tahun_semester !== null) {
            $query->where('TAHUN_SEMESTER', $tahun_semester);
        }

        return $query->orderBy('NAMA_MATAKULIAH', 'ASC')
            ->get();
    }

    public function getViewKhsAllByNim($nim)
    {
        $query = DB::table('view_khs_all')
            ->where('NIM', $nim);

        return $query->orderBy('NAMA_MATAKULIAH', 'ASC')
            ->get();
    }

    public function getViewKhsAllDistinct($nim)
    {
        $query = DB::table('view_khs_all')
            ->where('NIM', $nim)
            ->distinct('NO_MATAKULIAH')
            ->orderBy('NO_MATAKULIAH', 'ASC')
            ->get();

        return $query;
    }

    public function getViewKhsAllByNim_nilaiTerbaik($nim, $kode_matakuliah)
    {
        $query = DB::table('view_khs_all')
            ->where('NIM', $nim)
            ->where('KODE_MATAKULIAH', $kode_matakuliah)
            ->where('NILAI_AKHIR_ANGKA', function ($query) use ($nim, $kode_matakuliah) {
                $query->select(DB::raw('MAX(NILAI_AKHIR_ANGKA)'))
                    ->from('view_khs_all')
                    ->where('NIM', $nim)
                    ->where('KODE_MATAKULIAH', $kode_matakuliah)
                    ->where('NILAI_AKHIR_HURUF', '!=', 'T');
            })
            ->orderBy('KODE_MATAKULIAH', 'ASC')
            ->first();

        return $query;
    }

    public function getViewKhsAllByNim_nilaiBiasa($nim, $kode_matakuliah)
    {
        $query = DB::table('view_khs_all')
            ->where('NIM', $nim)
            ->where('KODE_MATAKULIAH', $kode_matakuliah)
            ->orderBy('NILAI_AKHIR_ANGKA', 'DESC')
            ->limit(1)
            ->first();

        return $query;
    }

    public function getViewKhsAllByKodeMk($nim, $kode_mk)
    {
        return DB::table('view_khs_all')
            ->where('NIM', $nim)
            ->where('KODE_MATAKULIAH', $kode_mk)
            ->orderBy('ID_MK_TERSEDIA', 'ASC')
            ->get();
    }

    public function countViewKhsAllByKodeMk($nim, $kode_mk)
    {
        return DB::table('view_khs_all')
            ->where('NIM', $nim)
            ->where('KODE_MATAKULIAH', $kode_mk)
            ->count();
    }

    public function getViewKhsAllDistinctPerSemester($nim, $arraynya)
    {
        $qs = "";
        if ($arraynya) {
            foreach ($arraynya as $data) {
                if ($qs) {
                    $qs .= " OR TAHUN_SEMESTER='" . $data . "'";
                } else {
                    $qs = " (TAHUN_SEMESTER='" . $data . "'";
                }
            }
            if ($qs) $qs .= ")";
        }

        $query = DB::table('view_khs_all')
            ->select('NO_MATAKULIAH', 'NAMA_MATAKULIAH', 'KODE_MATAKULIAH', 'SKS', 'TAHUN_SEMESTER')
            ->where('NIM', $nim);

        if ($qs) {
            $query->whereRaw($qs);
        }

        $query->orderBy('NO_MATAKULIAH', 'ASC');

        return $query->distinct()->get();
    }
}

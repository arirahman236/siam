<?php

namespace App\Http\Controllers;

use App\Models\view_kontrol;
use App\Models\view_jadwal_ujian;

class JadwalUjianController extends Controller
{
    public function viewJadwalUjian($request_day = 0)
    {
        $data['kontrol'] = view_kontrol::getViewKontrolData(auth()->user()->PRODI);

        $day = [];
        $index_day = 0;
        $distinct_tgl_ujian = view_jadwal_ujian::getDistinctJadwalUjian($data['kontrol']->SEMESTER, auth()->user()->PRODI);
        
        if ($distinct_tgl_ujian) {
            foreach ($distinct_tgl_ujian as $tgl_ujian) {
                $day[$index_day] = $tgl_ujian->TANGGAL_UJIAN;
                $index_day++;
            }
        }
        
        $request_day = ($request_day > $index_day - 1) ? '0' : $request_day;
        $data['max_day'] = $index_day;
        
        if ($index_day != 0) {
            $data['current_day'] = $day[$request_day];
            $data['current_request_day'] = $request_day;
        }

        if ($index_day == 0) {
            $data['jadwalUjian'] = 0;
        } else {
            $data['jadwalUjian'] = view_jadwal_ujian::getJadwalUjianByTgl1(auth()->user()->KODE_PRODI, $data['kontrol']->SEMESTER, $day[$request_day]);
            
        }
        return view('pages.perkuliahan.jadwal-ujian', compact('data'));
    }


}

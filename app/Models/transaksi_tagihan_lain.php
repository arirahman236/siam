<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class transaksi_tagihan_lain extends Model
{
    protected $table = 'transaksi_tagihan_lain';
    
    function GetSkripsiTagihanByNim($nim) {
        $data = DB::table('transaksi_tagihan_lain')
                    ->where('NIM', $nim)
                    ->where('KODE_TAGIHAN', 1)
                    ->first();
    
        return $data;
    }


}

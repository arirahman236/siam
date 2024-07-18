<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class e_mspst extends Model
{
    use HasFactory;
    protected $table = 'e_mspst';
    public function allowNilai()
    {
        return DB::table('e_mspst')
            ->where('KDPSTMSPST', auth()->user()->KODE_PRODI)
            ->select('NILAI')
            ->limit(1)
            ->first();
    }
    public function getKode($kode){
        return DB::table('e_mspst')
            ->where('KDPSTMSPST', $kode)
            ->get();
        
       
    }
}

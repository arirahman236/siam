<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class wisuda_persyaratan extends Model
{
    protected $table = 'wisuda_persyaratan';
    protected $fillable = ['NIM'];
    
    use HasFactory;

    public static function insertPersyaratan($nim,$cek_foto,$cek_doc,$cek_ijazah)
    {
        $data = [
            'NIM' => $nim,
            'FOTO' => $cek_foto,
            'SOFTCOPY' => $cek_doc,
            'IJAZAH' => $cek_ijazah,
        ];
    
        $inserted = DB::table('wisuda_persyaratan')->insert($data);
    
        if ($inserted) {
            return true;
        } else {
            return false;
        }
    }
    

}

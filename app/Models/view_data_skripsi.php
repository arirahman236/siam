<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class view_data_skripsi extends Model
{
    protected $table = 'view_data_skripsi';
    
    function getSkripsiByNim($nim) {
        $data = DB::table('view_data_skripsi')->where('NIM', $nim)->first();

        return $data;
    }
    

}

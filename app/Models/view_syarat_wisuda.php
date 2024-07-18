<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class view_syarat_wisuda extends Model
{
    protected $table = 'view_syarat_wisuda';
    
    public function cekPersyaratan($nim) {
        $query = view_syarat_wisuda::where('NIM', $nim)->count();

        return $query;
    }
    

}

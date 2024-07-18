<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class view_prodi extends Model
{
    use HasFactory;
    protected $table = 'view_prodi';
    public function getProdiDetail($prodi)
    {
        return DB::table('view_prodi')
            ->where('KODE_PRODI', $prodi)
            ->first();
    }
}

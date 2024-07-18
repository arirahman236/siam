<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class ViewDataMahasiswa extends Model
{
    use HasFactory;
    protected $table = 'cms_logosiakad';
    public function logoCetakWarna()
    {
        return DB::table('cms_logosiakad')
            ->where('ID', 1)
            ->first();
    }

    public function logoCetakHP()
    {
        return DB::table('cms_logosiakad')
            ->where('ID', 2)
            ->first();
    }
}

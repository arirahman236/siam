<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class jabatan_pusat extends Model
{
    use HasFactory;
    protected $table = 'jabatan_pusat';
    public function getPejabat($id)
    {
        return DB::table('jabatan_pusat')
            ->where('ID', $id)
            ->first();
    }
}

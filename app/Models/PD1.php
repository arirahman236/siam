<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class PD1 extends Model
{
    use HasFactory;
    protected $table = 'PD1';
    public function getPD($fak)
    {
        return DB::table('fakultas')
            ->where('ID', $fak)
            ->value('PD1');
    }
}

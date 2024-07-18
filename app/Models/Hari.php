<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class Hari extends Model
{
    use HasFactory;
    protected $table = 'hari';
    public function getValueHari()
    {
        return DB::table('hari')->get();
    }
}

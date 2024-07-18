<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BiodataModel extends Model
{
    use HasFactory;

    protected $table = 'feeder_mahasiswa';

    public static function getDetailBiodataFeeder($nim)
    {
        return self::where('NIM', $nim)->first();
    }

    public static function getFedderMhsPt($nim)
    {
        return self::where('NIM', $nim)->first();
    }
}

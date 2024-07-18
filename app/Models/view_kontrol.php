<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class view_kontrol extends Model
{
    use HasFactory;
    protected $table = 'view_kontrol';
    public function getViewKontrolData()
    {
        return DB::table('view_kontrol')
            ->limit(1)
            ->first();
    }
}

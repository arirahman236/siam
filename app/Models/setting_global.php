<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class setting_global extends Model
{
    use HasFactory;
    protected $table = 'setting_global';
    public function getSettingGlobal()
    {
        return DB::table('setting_global')
            ->where('ID', 1)
            ->first();
    }
}

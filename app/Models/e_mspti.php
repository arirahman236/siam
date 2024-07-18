<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class e_mspti extends Model
{
    use HasFactory;
    protected $table = 'e_mspti';
    public function selectEmspti1()
    {
        return DB::table('e_mspti')
            ->first();
    }
}

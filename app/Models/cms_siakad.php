<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class ViewDataMahasiswa extends Model
{
    use HasFactory;
    protected $table = 'cms_siakad';
    public function selectCmssiakad()
    {
        return DB::table('cms_siakad')
            ->first();
    }
}

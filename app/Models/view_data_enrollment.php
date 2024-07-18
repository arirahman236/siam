<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class view_data_enrollment extends Model
{
    use HasFactory;
    protected $table = 'view_data_enrollment';
    public function viewDataEnrollment($id_tersedia, $nim)
    {
        $query = DB::table('view_data_enrollment')
            ->where('ID_MK_TERSEDIA', $id_tersedia)
            ->where('NIM', $nim)
            ->count();

        return $query;
    }

}

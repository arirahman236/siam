<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class e_msmhsModel extends Model
{
    use HasFactory;

    protected $table = 'e_msmhs';
    protected $primaryKey = 'NIMHSMSMHS';
    public $timestamps = false;
    protected $keyType = 'string';
    public $incrementing = false;
    protected $fillable = ['TPLHRMSMHS', 'TGLHRMSMHS', 'ALAMAT_ASAL','ALAMAT','NO_TELP','NAMA_AYAH','NAMA_IBU','PEKERJAAN_AYAH','PEKERJAAN_IBU','PENGHASILAN_AYAH','PENGHASILAN_IBU','STATUS_UPDATE_BIODATA'];
    protected $casts = [
        'NIMHSMSMHS' => 'string',
    ];

    public static function updatePassMhs($nim, $pwd_baru)
    {
        DB::table('e_msmhs')
            ->where('NIMHSMSMHS', $nim)
            ->update(['PASSWORD' => $pwd_baru]);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'NIMHSMSMHS', 'NIM');
    }
}

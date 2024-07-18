<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class feeder_mahasiswa extends Model

{
    protected $table = 'feeder_mahasiswa';
    protected $primaryKey = 'NIM';
    public $timestamps = false;
    protected $keyType = 'string';
    public $incrementing = false;
    protected $fillable = ['AGAMA','NIK','RT','RW','DUSUN','KELURAHAN','KECAMATAN','KODE_POS','JENIS_TINGGAL','HP','PENERIMA_KPS','TANGGAL_LAHIR_AYAH','PENDIDIKAN_AYAH','TANGGAL_LAHIR_IBU','PENDIDIKAN_IBU'];
    protected $casts = [
        'NIM' => 'string',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'NIM', 'NIM');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JudulSkripsiModel extends Model
{
    protected $table = 'e_mspst';

    protected $fillable = [
        'KDPSTMSPST',
        'KDJENMSPST',
        'NMPST',
        'NMMHS',
        'KODE_PT',
        'KODE_PRODI',
        'KODE_JENJANG_STUDI',
        'SEMESTER',
        'THN_AJ',
        'BATAS_WAKTU',
        'STATUS_PEMBIMBING',
        'STATUS_PEMBIMBING2',
        'STATUS_PEMBIMBING3',
        'STATUS_PEMBIMBING4',
        'STATUS_PEMBIMBING5',
        'STATUS_PEMBIMBING6',
        'STATUS_PEMBIMBING7',
        'STATUS_PEMBIMBING8',
        'STATUS_PEMBIMBING9',
        'STATUS_PEMBIMBING10',
        'STATUS_PEMBIMBING11',
        'STATUS_PEMBIMBING12',
        'STATUS_PEMBIMBING13',
        'STATUS_PEMBIMBING14',
        'STATUS_PEMBIMBING15',
        'STATUS_PEMBIMBING16',
        'STATUS_PEMBIMBING17',
        'STATUS_PEMBIMBING18',
        'STATUS_PEMBIMBING19',
        'STATUS_PEMBIMBING20',
    ];

    public function getKodeProdiAttribute()
    {
        return $this->KODE_PRODI;
    }

    public function getJenisMatakuliahAttribute()
    {
        switch ($this->KDJENMSPST) {
            case 'C':
                return 'Skripsi';
            case 'B':
                return 'Thesis';
            default:
                return 'Tugas Akhir';
        }
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KeuanganModel extends Model
{
    use HasFactory;
    protected $table = 'keu_transaksimhs';

    public function getDetailTagihanById($id)
    {
        return $this->select('*')
            ->from('view_transaksimhs')
            ->where('ID_TRANSAKSI', $id)
            ->first();
    }

    public function tanggal_indonesia($tanggal)
    {

        $bulan = array(
            1 =>       'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
        );

        $var = explode('-', $tanggal);

        return $var[2] . ' ' . $bulan[(int)$var[1]] . ' ' . $var[0];
    }
}

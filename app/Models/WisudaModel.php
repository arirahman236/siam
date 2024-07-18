<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WisudaModel extends Model
{
    protected $fillable = ['NIM'];

    public function cekPersyaratan($nim)
    {
        $persyaratan = $this->where('NIM', $nim)->first();

        if ($persyaratan) {
            return $persyaratan;
        } else {
            return null;
        }
    }

    public function insertPersyaratan($nim)
    {
        $persyaratan = $this->create([
            'NIM' => $nim,
        ]);

        return $persyaratan;
    }
}

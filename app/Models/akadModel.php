<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class akadModel extends Model
{
    public $timestamps = false;
    protected $table = 'e_msmhs';
    use HasFactory;
    
    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'NIMHSMSMHS',
        'NMMHSMSMHS',
        'TPLHRMSMHS'
    ];
}

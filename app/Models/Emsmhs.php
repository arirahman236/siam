<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Support\Facades\Hash;

class Emsmhs extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $table = 'e_msmhs';
    protected $primaryKey = 'NIMHSMSMHS';

    protected $fillable = [
        'NIMHSMSMHS',
        'NMMHSMSMHS',
        'TPLHRMSMHS',
        'PASSWORD'
    ];

    protected $hidden = [
        'PASSWORD',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function setPasswordAttribute($password)
    {
        $this->attributes['PASSWORD'] = Hash::make($password);
    }

    public function getPasswordAttribute()
    {
        return $this->attributes['PASSWORD'];
    }

    public function getAuthPassword()
    {
        return $this->attributes['PASSWORD'];
    }
}


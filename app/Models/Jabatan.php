<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jabatan extends Model
{
    protected $table = 'jabatans';
    protected $primaryKey = 'kode_jabatan';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = ['kode_jabatan', 'nama_jabatan'];

    public function getRouteKeyName()
    {
        return 'kode_jabatan';
    }

    public function pegawai()
    {
        return $this->hasMany(Pegawai::class, 'kode_jabatan', 'kode_jabatan');
    }
    }

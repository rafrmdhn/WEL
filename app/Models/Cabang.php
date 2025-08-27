<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cabang extends Model
{
    protected $table = 'cabangs';
    protected $primaryKey = 'kode_cabang';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = ['kode_cabang', 'nama_cabang'];

    public function getRouteKeyName()
    {
        return 'kode_cabang';
    }

    public function pegawai()
    {
        return $this->hasMany(Pegawai::class, 'kode_cabang', 'kode_cabang');
    }
}

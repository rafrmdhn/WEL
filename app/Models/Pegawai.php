<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    protected $table = 'pegawais';
    protected $primaryKey = 'kode_pegawai';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'kode_pegawai', 
        'nama_pegawai', 
        'kode_cabang',
        'kode_jabatan', 
        'tanggal_mulai_kontrak',
        'tanggal_habis_kontrak', 
        'status_aktif'
    ];

    public function getRouteKeyName()
    {
        return 'kode_pegawai';
    }

    public function cabang() {
        return $this->belongsTo(Cabang::class, 'kode_cabang', 'kode_cabang');
    }

    public function jabatan() {
        return $this->belongsTo(Jabatan::class, 'kode_jabatan', 'kode_jabatan');
    }
}

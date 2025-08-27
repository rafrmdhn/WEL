<?php

namespace App\Imports;

use App\Models\Pegawai;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsFailures;

class PegawaiImport implements ToModel, WithHeadingRow, WithValidation, SkipsOnFailure
{
    use Importable, SkipsFailures;
    
    public function model(array $row)
    {
        return Pegawai::updateOrCreate(
            ['kode_pegawai' => $row['kode_pegawai']],
            [
                'nama_pegawai'           => $row['nama_pegawai'],
                'kode_cabang'            => $row['kode_cabang'],
                'kode_jabatan'           => $row['kode_jabatan'],
                'tanggal_mulai_kontrak'  => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['tanggal_mulai_kontrak'])->format('Y-m-d'),
                'tanggal_habis_kontrak'  => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['tanggal_habis_kontrak'])->format('Y-m-d'),
            ]
        );
    }
    
    public function rules(): array
    {
        return [
            'kode_pegawai' => 'required|max:10',
            'nama_pegawai' => 'required|max:255',
            'kode_cabang' => 'required|exists:cabangs,kode_cabang',
            'kode_jabatan' => 'required|exists:jabatans,kode_jabatan',
            'tanggal_mulai_kontrak' => 'required',
            'tanggal_habis_kontrak' => 'required',
        ];
    }
}
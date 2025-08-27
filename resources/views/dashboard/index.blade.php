@extends('layouts.app')

@section('content')
    <h1 class="mb-4">Dashboard Monitoring Kontrak</h1>
    <div class="row">
        <div class="col-md-3">
            <div class="card text-white bg-danger mb-3">
                <div class="card-header">Habis dalam 30 Hari</div>
                <div class="card-body">
                    <h2 class="card-title">{{ $habis_30_hari }} Pegawai</h2>
                    <p class="card-text">Perlu tindakan segera.</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-warning mb-3">
                <div class="card-header">Habis dalam 31-60 Hari</div>
                <div class="card-body">
                    <h2 class="card-title">{{ $habis_60_hari }} Pegawai</h2>
                    <p class="card-text">Segera lakukan evaluasi.</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-dark bg-info mb-3">
                <div class="card-header">Habis dalam 61-90 Hari</div>
                <div class="card-body">
                    <h2 class="card-title">{{ $habis_90_hari }} Pegawai</h2>
                    <p class="card-text">Persiapan evaluasi awal.</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-secondary mb-3">
                <div class="card-header">Kontrak Sudah Berakhir</div>
                <div class="card-body">
                    <h2 class="card-title">{{ $sudah_lewat }} Pegawai</h2>
                    <p class="card-text">Perlu review data.</p>
                </div>
            </div>
        </div>
    </div>
    {{-- Di sini bisa ditambahkan tabel daftar pegawai yang relevan --}}
@endsection
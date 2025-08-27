@extends('layouts.app')

@section('content')
    <h1>Tambah Jabatan Baru</h1>

    <form action="{{ route('jabatan.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="kode_jabatan" class="form-label">Kode Jabatan</label>
            <input type="text" class="form-control @error('kode_jabatan') is-invalid @enderror" id="kode_jabatan" name="kode_jabatan" value="{{ old('kode_jabatan') }}">
            @error('kode_jabatan') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
        <div class="mb-3">
            <label for="nama_jabatan" class="form-label">Nama Jabatan</label>
            <input type="text" class="form-control @error('nama_jabatan') is-invalid @enderror" id="nama_jabatan" name="nama_jabatan" value="{{ old('nama_jabatan') }}">
            @error('nama_jabatan') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('jabatan.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
@endsection
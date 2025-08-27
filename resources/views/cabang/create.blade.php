@extends('layouts.app')

@section('content')
    <h1>Tambah Cabang Baru</h1>

    <form action="{{ route('cabang.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="kode_cabang" class="form-label">Kode Cabang</label>
            <input type="text" class="form-control @error('kode_cabang') is-invalid @enderror" id="kode_cabang" name="kode_cabang" value="{{ old('kode_cabang') }}">
            @error('kode_cabang') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
        <div class="mb-3">
            <label for="nama_cabang" class="form-label">Nama Cabang</label>
            <input type="text" class="form-control @error('nama_cabang') is-invalid @enderror" id="nama_cabang" name="nama_cabang" value="{{ old('nama_cabang') }}">
            @error('nama_cabang') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('cabang.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
@endsection
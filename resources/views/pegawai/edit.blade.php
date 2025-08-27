@extends('layouts.app')

@section('content')
    <h1>Edit Data Pegawai</h1>

    <form action="{{ route('pegawai.update', $pegawai) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="kode_pegawai" class="form-label">Kode Pegawai</label>
                <input type="text" class="form-control @error('kode_pegawai') is-invalid @enderror" id="kode_pegawai" name="kode_pegawai" value="{{ old('kode_pegawai', $pegawai->kode_pegawai) }}">
                @error('kode_pegawai') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="col-md-6 mb-3">
                <label for="nama_pegawai" class="form-label">Nama Pegawai</label>
                <input type="text" class="form-control @error('nama_pegawai') is-invalid @enderror" id="nama_pegawai" name="nama_pegawai" value="{{ old('nama_pegawai', $pegawai->nama_pegawai) }}">
                @error('nama_pegawai') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="kode_cabang" class="form-label">Cabang</label>
                <select class="form-select @error('kode_cabang') is-invalid @enderror" id="kode_cabang" name="kode_cabang">
                    @foreach ($cabang as $item)
                        <option value="{{ $item->kode_cabang }}" {{ old('kode_cabang', $pegawai->kode_cabang) == $item->id ? 'selected' : '' }}>{{ $item->nama_cabang }}</option>
                    @endforeach
                </select>
                @error('kode_cabang') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="col-md-6 mb-3">
                <label for="kode_jabatan" class="form-label">Jabatan</label>
                <select class="form-select @error('kode_jabatan') is-invalid @enderror" id="kode_jabatan" name="kode_jabatan">
                    @foreach ($jabatan as $item)
                        <option value="{{ $item->kode_jabatan }}" {{ old('kode_jabatan', $pegawai->kode_jabatan) == $item->id ? 'selected' : '' }}>{{ $item->nama_jabatan }}</option>
                    @endforeach
                </select>
                @error('kode_jabatan') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
        </div>
        <div class="row">
             <div class="col-md-6 mb-3">
                <label for="tanggal_mulai_kontrak" class="form-label">Tanggal Mulai Kontrak</label>
                <input type="date" class="form-control @error('tanggal_mulai_kontrak') is-invalid @enderror" id="tanggal_mulai_kontrak" name="tanggal_mulai_kontrak" value="{{ old('tanggal_mulai_kontrak', $pegawai->tanggal_mulai_kontrak) }}">
                @error('tanggal_mulai_kontrak') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="col-md-6 mb-3">
                <label for="tanggal_habis_kontrak" class="form-label">Tanggal Habis Kontrak</label>
                <input type="date" class="form-control @error('tanggal_habis_kontrak') is-invalid @enderror" id="tanggal_habis_kontrak" name="tanggal_habis_kontrak" value="{{ old('tanggal_habis_kontrak', $pegawai->tanggal_habis_kontrak) }}">
                @error('tanggal_habis_kontrak') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('pegawai.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
@endsection
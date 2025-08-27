@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Daftar Pegawai</h1>
        <div class="d-flex gap-2">
            <a href="{{ route('pegawai.create') }}" class="btn btn-primary">Tambah Pegawai</a>
            <a href="{{ route('upload.form') }}" class="btn btn-success">Import Excel</a>
            <div>
                <form action="{{ route('pegawai.index') }}" method="GET">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Cari..." value="{{ request('search') }}">
                        <button class="btn btn-secondary" type="submit">Cari</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th>Kode</th>
                    <th>Nama Pegawai</th>
                    <th>Cabang</th>
                    <th>Jabatan</th>
                    <th>Mulai Kontrak</th>
                    <th>Selesai Kontrak</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($pegawai as $item)
                    <tr>
                        <td>{{ $item->kode_pegawai }}</td>
                        <td>{{ $item->nama_pegawai }}</td>
                        <td>{{ $item->cabang->nama_cabang ?? 'N/A' }}</td>
                        <td>{{ $item->jabatan->nama_jabatan ?? 'N/A' }}</td>
                        <td>{{ \Carbon\Carbon::parse($item->tanggal_mulai_kontrak)->format('d M Y') }}</td>
                        <td>{{ \Carbon\Carbon::parse($item->tanggal_habis_kontrak)->format('d M Y') }}</td>
                        <td>
                            <a href="{{ route('pegawai.edit', $item) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('pegawai.destroy', $item) }}" method="POST" class="d-inline" onsubmit="return confirm('Anda yakin ingin menghapus data ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">
                            {{-- Pesan disesuaikan jika sedang mencari --}}
                            @if (request('search'))
                                Data dengan kata kunci "{{ request('search') }}" tidak ditemukan.
                            @else
                                Tidak ada data pegawai.
                            @endif
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    {{-- Paginasi akan otomatis menyertakan query pencarian --}}
    {{ $pegawai->links() }}
@endsection
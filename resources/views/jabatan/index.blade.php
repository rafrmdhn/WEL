@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Daftar Jabatan</h1>
        <a href="{{ route('jabatan.create') }}" class="btn btn-primary">Tambah Jabatan</a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <table class="table table-bordered table-hover">
        <thead class="table-dark">
            <tr>
                <th>Kode Jabatan</th>
                <th>Nama Jabatan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($jabatan as $item)
                <tr>
                    <td>{{ $item->kode_jabatan }}</td>
                    <td>{{ $item->nama_jabatan }}</td>
                    <td>
                        <a href="{{ route('jabatan.edit', $item) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('jabatan.destroy', $item) }}" method="POST" class="d-inline" onsubmit="return confirm('Anda yakin ingin menghapus data ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="text-center">Tidak ada data.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    {{ $jabatan->links() }}
@endsection
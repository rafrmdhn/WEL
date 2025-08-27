@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Daftar Cabang</h1>
        <a href="{{ route('cabang.create') }}" class="btn btn-primary">Tambah Cabang</a>
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
                <th>Kode Cabang</th>
                <th>Nama Cabang</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($cabang as $item)
                <tr>
                    <td>{{ $item->kode_cabang }}</td>
                    <td>{{ $item->nama_cabang }}</td>
                    <td>
                        <a href="{{ route('cabang.edit', $item) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('cabang.destroy', $item) }}" method="POST" class="d-inline" onsubmit="return confirm('Anda yakin ingin menghapus data ini?');">
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
    {{ $cabang->links() }}
@endsection
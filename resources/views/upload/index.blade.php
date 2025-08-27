@extends('layouts.app')

@section('content')
    <div class="row">
        {{-- Kolom Kiri: Form Upload --}}
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4>Upload File Excel Pegawai</h4>
                </div>
                <div class="card-body">
                    {{-- Menampilkan Error Validasi dari Impor Excel --}}
                    @if (session('import_errors'))
                        <div class="alert alert-danger">
                            <h5>Gagal mengimpor beberapa baris:</h5>
                            <ul class="mb-0">
                                @foreach (session('import_errors') as $failure)
                                    <li>
                                        <strong>Baris {{ $failure->row() }}:</strong> {{ $failure->errors()[0] }}
                                        pada kolom <strong>'{{ $failure->attribute() }}'</strong>.
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('upload.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="file" class="form-label">Pilih file Excel (.xlsx atau .xls)</label>
                            <input type="file" class="form-control @error('file') is-invalid @enderror" id="file" name="file" required>
                            @error('file')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Upload dan Proses</button>
                        <a href="{{ route('pegawai.index') }}" class="btn btn-secondary">Kembali</a>
                    </form>
                </div>
                <div class="card-footer text-muted small">
                    <p class="mb-1"><strong>Petunjuk Format File Excel:</strong></p>
                    <p class="mb-0">Pastikan file Excel Anda memiliki header kolom berikut (nama harus persis dan huruf kecil):</p>
                    <code>kode_pegawai, nama_pegawai, kode_cabang, kode_jabatan, tanggal_mulai_kontrak, tanggal_habis_kontrak</code>
                </div>
            </div>
        </div>

        {{-- Kolom Kanan: Riwayat Upload --}}
        <div class="col-md-6">
            <h4>Riwayat Upload</h4>
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>Nama File</th>
                            <th>Ukuran</th>
                            <th>Status</th>
                            <th>Tanggal Upload</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($history as $item)
                            <tr>
                                <td>{{ $item->original_filename }}</td>
                                <td>{{ round($item->file_size / 1024, 2) }} KB</td>
                                <td><span class="badge bg-success">{{ $item->status }}</span></td>
                                <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d M Y H:i') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">Belum ada riwayat upload.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            {{-- Link Paginasi untuk Riwayat --}}
            {{ $history->links() }}
        </div>
    </div>
@endsection
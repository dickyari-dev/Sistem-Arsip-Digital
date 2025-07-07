@extends('layouts.app') {{-- Sesuaikan dengan layout proyek kamu --}}

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between flex-row">
            <div>
                <h4 class="card-title mb-3 ">Data Surat</h4>
                <p class="text-muted mb-0">Data surat terbaru</p>
            </div>
            <div class="mb-3">
                <a href="{{ route('admin.surat.create') }}" class="btn btn-primary">+ Tambah Surat</a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <div class="filter">
                    <form action="{{ route('admin.surat.filter') }}" method="post">
                        @csrf
                        <div class="input-group mb-3 flex-wrap">

                            <div class="me-2 mb-2">
                                <label for="nama_surat" class="form-label">Nama Surat</label>
                                <input type="text" name="nama_surat" class="form-control" placeholder="Nama Surat"
                                    value="{{ request('nama_surat') }}">
                            </div>

                            <div class="me-2 mb-2">
                                <label for="nomor_surat" class="form-label">Nomor Surat</label>
                                <input type="text" name="nomor_surat" class="form-control" placeholder="Nomor Surat"
                                    value="{{ request('nomor_surat') }}">
                            </div>

                            <div class="me-2 mb-2">
                                <label for="kode_surat" class="form-label">Kode Surat</label>
                                <input type="text" name="kode_surat" class="form-control" placeholder="Kode Surat"
                                    value="{{ request('kode_surat') }}">
                            </div>

                            <div class="me-2 mb-2">
                                <label for="status_disposisi" class="form-label">Status Disposisi</label>
                                <select name="status_disposisi" id="status_disposisi" class="form-select">
                                    <option value="">Semua</option>
                                    <option value="pending" {{ request('status_disposisi')=='pending' ? 'selected' : ''
                                        }}>Pending</option>
                                    <option value="revisi" {{ request('status_disposisi')=='revisi' ? 'selected' : ''
                                        }}>Revisi</option>
                                    <option value="disposisi" {{ request('status_disposisi')=='disposisi' ? 'selected'
                                        : '' }}>Disposisi</option>
                                </select>
                            </div>
                            <div class="me-2 mb-2">
                                <label for="status_revisi" class="form-label">Status Revisi</label>
                                <select name="status_revisi" id="status_revisi" class="form-select">
                                    <option value="">Semua</option>
                                    <option value="revisi" {{ request('status_revisi')=='revisi' ? 'selected' : ''
                                        }}>Perlu Revisi</option>
                                    <option value="disposisi" {{ request('status_revisi')=='selesai' ? 'selected'
                                        : '' }}>Selesai</option>
                                </select>
                            </div>

                            <div class="me-2 mb-2 d-flex align-items-end">
                                <button class="btn btn-primary me-2" type="submit">Cari</button>
                                <a href="{{ route('admin.surat') }}" class="btn btn-secondary">Clear</a>
                            </div>

                        </div>
                    </form>

                </div>
                <table class="table table-bordered table-striped">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Nama Surat</th>
                            <th>Camat Pendisposisi</th>
                            <th>Nomor</th>
                            <th>Kode</th>
                            <th>Tanggal Surat</th>
                            <th>Jenis</th>
                            <th>File</th>
                            <th>Keterangan Disposisi</th>
                            <th>Status Dibaca</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($surats as $index => $surat)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $surat->nama_surat }}</td>
                            <td>{{ $surat->nama_camat_pendisposisi }}</td>
                            <td>{{ $surat->nomor_surat }}</td>
                            <td>{{ $surat->kode_surat ?? '-' }}</td>
                            <td>{{ \Carbon\Carbon::parse($surat->tanggal_surat)->format('d/m/Y') }}</td>
                            <td>
                                @if ($surat->jenis_surat === 'masuk')
                                <span class="badge bg-primary">Surat Masuk</span>
                                @elseif ($surat->jenis_surat === 'keluar')
                                <span class="badge bg-danger">Surat Masuk</span>
                                @endif
                            </td>
                            <td>
                                @if($surat->file_surat)
                                <a href="{{ asset('storage/' . $surat->file_surat) }}" target="_blank"
                                    class="btn btn-sm btn-outline-primary">
                                    Lihat File
                                </a>
                                @else
                                <span class="text-muted">Tidak Ada File</span>
                                @endif
                            </td>
                            <td>{{ $surat->catatan ? $surat->catatan : '-' }}</td>
                            <td>
                                @if ($surat->status_dibaca === 'belum_dibaca')
                                    <span class="badge bg-secondary">Belum Dibaca</span>
                                @else
                                    <span class="badge bg-primary">Sudah Dibaca</span>
                                @endif
                            </td>
                            <td>
                                {{-- Tambahkan route edit/delete jika ada --}}
                                <a href="{{ route('surat.detail', $surat->slug) }}"
                                    class="btn btn-sm btn-info">Detail</a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="9" class="text-center text-muted">Belum ada surat.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
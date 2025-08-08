@extends('layouts.app') {{-- Sesuaikan dengan layout proyek kamu --}}

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between flex-row">
            <div>
                <h4 class="card-title mb-3 ">Data Surat</h4>
                <p class="text-muted mb-0">Data surat terbaru</p>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <div class="filter">
                    <form action="{{ route('camat.surat.filter') }}" method="post">
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
                                <label for="category_id" class="form-label">Kategori Surat</label>
                                <select name="category_id" id="category_id" class="form-select">
                                    <option value="">Semua</option>
                                    @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ request('category_id')==$category->id ?
                                        'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="me-2 mb-2 d-flex align-items-end">
                                <button class="btn btn-primary me-2" type="submit">Cari</button>
                                <a href="{{ route('camat.surat') }}" class="btn btn-secondary">Clear</a>
                            </div>

                        </div>
                    </form>

                </div>
                <table class="table table-bordered table-striped">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Nama Surat</th>
                            <th>Nomor</th>
                            <th>Kode</th>
                            <th>Tanggal</th>
                            <th>Kategori</th>
                            <th>Jenis</th>
                            <th>Status Disposisi</th>
                            <th>File</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($surats as $index => $surat)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $surat->nama_surat }}</td>
                            <td>{{ $surat->nomor_surat }}</td>
                            <td>{{ $surat->kode_surat ?? '-' }}</td>
                            <td>{{ \Carbon\Carbon::parse($surat->tanggal_surat)->format('d/m/Y') }}</td>
                            <td>
                                {{-- Kategori --}}
                                <span class="badge bg-info">{{ $surat->category->name ?? '-' }}</span>
                            </td>
                            <td>
                                @if ($surat->jenis_surat === 'masuk')
                                <span class="badge bg-primary">Masuk</span>
                                @elseif ($surat->jenis_surat === 'keluar')
                                <span class="badge bg-danger">Masuk</span>
                                @endif
                            </td>
                            <td>
                                @if($surat->status_disposisi === 'disposisi')
                                <span class="badge bg-primary">Sudah</span>
                                @elseif($surat->status_disposisi === 'revisi')
                                <span class="badge bg-warning text-dark">Perlu Revisi</span>
                                @else
                                <span class="badge bg-secondary">Pending</span>
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
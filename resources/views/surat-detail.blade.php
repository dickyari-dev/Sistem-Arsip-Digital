@extends('layouts.app')

@section('title', 'Detail Surat')

@section('content')
@if (Auth::user()->role == 'admin')
@if ($suratDetail->status_revisi == 'revisi')
    <div class="container position-relative">
    <div class="alert d-flex align-items-start shadow-sm border-start border-4 border-danger bg-light text-dark p-3 position-relative"
        role="alert" style="font-size: 16px;">

        <!-- Tombol di pojok kanan atas -->
        <a class="btn btn-lg btn-danger position-absolute end-0 m-2"
            href="{{ route('admin.surat.edit', $suratDetail->slug) }}">Revisi</a>

        <!-- Icon dan teks -->
        <i class="bi bi-exclamation-circle-fill text-danger me-3 fs-2 mt-1"></i>
        <div>
            <div class="fw-bold mb-2" style="font-size: 18px;">📌 Revisi dari Camat</div>
            <div style="font-style: italic; font-size: 16px; color: #444;">
                <i class="bi bi-quote"></i> {{ $suratDetail->keterangan_revisi }} <i class="bi bi-quote"></i>
            </div>
        </div>
    </div>
</div>
@endif
@endif




<div class="card mb-3">
    <div class="card-body">
        <div class="row">
            @if (Auth::user()->role == 'pegawai')
            {{-- Tombol Tandai Sudah Dibaca --}}
            <div class="container">
                <form action="{{ route('pegawai.surat.dibaca', $suratDetail->slug) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-primary">Tandai Sudah Dibaca</button>
                </form>
            </div>
            @endif
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4>Detail Surat - <span class="text-muted">{{ $suratDetail->nomor_surat }}</span></h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-borderless">
                            <tr>
                                <th>Nama / Judul Surat</th>
                                <td>:</td>
                                <td>{{ $suratDetail->nama_surat ? $suratDetail->nama_surat : '-' }}</td>
                            </tr>
                            <tr>
                                <th>Nomor Surat</th>
                                <td>:</td>
                                <td>{{ $suratDetail->nomor_surat ? $suratDetail->nomor_surat : '-' }}</td>
                            </tr>
                            <tr>
                                <th>Kode Surat</th>
                                <td>:</td>
                                <td>{{ $suratDetail->kode_surat ? $suratDetail->kode_surat : '-' }}</td>
                            </tr>
                            <tr>
                                <th>Tanggal Surat</th>
                                <td>:</td>
                                <td>{{ $suratDetail->tanggal_surat ? $suratDetail->tanggal_surat : '-' }}</td>
                            </tr>
                            <tr>
                                <th>Pengirim Surat</th>
                                <td>:</td>
                                <td>{{ $suratDetail->pengirim ? $suratDetail->pengirim : '-' }}</td>
                            </tr>
                            <tr>
                                <th>Perihal Surat</th>
                                <td>:</td>
                                <td>{{ $suratDetail->perihal ? $suratDetail->perihal : '-' }}</td>
                            </tr>

                            <tr>
                                <th>Jenis Surat</th>
                                <td>:</td>
                                <td>
                                    @if ($suratDetail->jenis_surat === 'masuk')
                                    <span class="badge bg-primary">Surat Masuk</span>
                                    @elseif ($suratDetail->jenis_surat === 'keluar')
                                    <span class="badge bg-danger">Surat Keluar</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Kategori Surat</th>
                                <td>:</td>
                                <td><span class="badge bg-info">{{ $suratDetail->category->name ? $suratDetail->category->name : '-' }}</span></td>
                            </tr>
                            <tr>
                                <th>Keterangan Surat</th>
                                <td>:</td>
                                <td>{{ $suratDetail->keterangan ? $suratDetail->keterangan : '-' }}</td>
                            </tr>
                            <tr>
                                <th>Status Disposisi</th>
                                <td>:</td>
                                <td>
                                    @if($suratDetail->status_disposisi === 'disposisi')
                                    <span class="badge bg-primary">Sudah</span>
                                    @elseif($suratDetail->status_disposisi === 'revisi')
                                    <span class="badge bg-warning text-dark">Perlu Revisi</span>
                                    @else
                                    <span class="badge bg-secondary">Pending / Menunggu Disposisi</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Revisi</th>
                                <td>:</td>
                                <td>
                                    @if ($suratDetail->status_revisi === 'revisi')
                                    <span class="badge bg-warning text-dark">Revisi</span>
                                    -
                                    @if ($suratDetail->keterangan_revisi)
                                    <span class="">{{ $suratDetail->keterangan_revisi }}</span>
                                    @else
                                    <span class="">Tidak Ada Keterangan Revisi</span>
                                    @endif
                                    @elseif ($suratDetail->status_revisi === 'proses')
                                    <span class="badge bg-primary">Proses</span>
                                    @elseif ($suratDetail->status_revisi === 'selesai')
                                    <span class="badge bg-success">Selesai</span>
                                    @endif
                                </td>
                            </tr>
                            @if ($suratDetail->jawaban_revisi !== '')
                            <tr>
                                <td>
                                    Jawaban Dari Admin
                                </td>
                                <td>:</td>
                                <td>
                                    {{ $suratDetail->jawaban_revisi }}
                                </td>
                            </tr>
                            @endif
                        </table>
                        <a href="{{ Storage::url($suratDetail->file_surat) }}" target="_blank" class="btn btn-primary"
                            style="width: 100%; margin-bottom: 10px"> <i class="bi bi-download"></i> Download Surat</a>
                        @if (Auth::user()->role == 'camat')
                        <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#revisi"
                            style="width: 100%; margin-bottom: 10px"><i class="bi bi-exclamation-circle"></i> Tandai
                            Revisi</button>
                        <div class="modal fade" id="revisi" tabindex="-1" aria-labelledby="revisiLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form action="{{ route('camat.surat.revisi.add') }}" method="POST">
                                        @csrf
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Revisi Surat</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label for="message-text" class="col-form-label">Keterangan
                                                    Revisi:</label>
                                                <input type="hidden" name="surat_id" value="{{ $suratDetail->id }}"
                                                    id="surat_id">
                                                <textarea class="form-control" id="message-text" rows="3"
                                                    name="keterangan_revisi" required></textarea>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-danger">Kirim Revisi</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4>Preview Surat - <span class="text-muted">{{ $suratDetail->nomor_surat }}</span></h4>
                    </div>
                    <div class="card-body">

                        <iframe src="{{ Storage::url($suratDetail->file_surat) }}" width="100%" height="600px"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    @if (Auth::user()->role == 'camat')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-12">
                        <h4>
                            Disposisi Surat -
                            <span class="text-muted">{{ $suratDetail->nomor_surat }}</span>
                        </h4>
                    </div>
                </div>

            </div>
            <div class="card-body">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#disposisi">
                    <i class="bi bi-send-fill"></i> Disposisi Surat
                </button>

                <!-- Modal -->
                <div class="modal fade" id="disposisi" tabindex="-1" aria-labelledby="disposisiLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form action="{{ route('camat.disposisi') }}" method="POST">
                                @csrf
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Disposisi Surat</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <input type="hidden" name="surat_id" value="{{ $suratDetail->id }}">
                                        <label for="recipient-name" class="col-form-label">Pegawai Penerima:</label>
                                        <select name="pegawai_id" id="pegawai_id" required class="form-select">
                                            <option value="">-- Pilih Pegawai --</option>
                                            @foreach ($pegawai as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="message-text" class="col-form-label">Pesan Disposisi:</label>
                                        <textarea class="form-control" name="catatan" id="message-text"
                                            rows="3"></textarea>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Pegawai yang Dituju</th>
                            <th>Nama Camat Pendisposisi</th>
                            <th>Isi Disposisi / Keterangan</th>
                            <th>Status Dibaca</th>
                            <th>Tanggal Disposisi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($disposisi as $disposisi)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $disposisi->pegawai->name }}</td>
                            <td>{{ $disposisi->camat->name }}</td>
                            <td>{{ $disposisi->catatan }}</td>
                            <td>
                                @if ($disposisi->status === 'dibaca')
                                <span class="badge bg-primary">Sudah Dibaca</span>
                                @else
                                <span class="badge bg-secondary">Belum Dibaca</span>
                                </thead>
                                @endif
                            </td>
                            <td>{{ \Carbon\Carbon::parse($disposisi->tanggal_disposisi)->format('d/m/Y') }}</td>
                            <td><a class="btn btn-danger" href="{{ route('camat.batal-disposisi', $disposisi->id) }}"><i
                                        class="fa fa-trash"></i></a></td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center">Belum Ada Disposisi</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @endif
</div>
</div>
@endsection
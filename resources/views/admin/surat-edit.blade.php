@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header d-flex flex-column align-items-start p-3">
            <h4 class="card-title mb-3 fw-bold">Update Surat Baru</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.surat.edit.post') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="nomor_surat" class="form-label">Nomor Surat</label>
                            <input type="hidden" name="id" id="id" value="{{ $surat->id }}">
                            <input type="text" name="nomor_surat" class="form-control" value="{{ $surat->nomor_surat }}"
                                required placeholder="Masukkan Nomor Surat">
                        </div>
                        <div class="mb-3">
                            <label for="kode_surat" class="form-label">Kode Surat</label>
                            <input type="text" name="kode_surat" class="form-control" value="{{ $surat->kode_surat }}"
                                required placeholder="Masukkan Kode Surat">
                        </div>
                        <div class="mb-3">
                            <label for="pengirim" class="form-label">Pengirim</label>
                            <input type="text" name="pengirim" class="form-control" value="{{ $surat->pengirim }}"
                                required placeholder="Masukkan Pengirim">
                        </div>
                        <div class="mb-3">
                            <label for="perihal" class="form-label">Perihal</label>
                            <textarea name="perihal" class="form-control">{{ $surat->perihal }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="keterangan" class="form-label">Keterangan</label>
                            <textarea name="keterangan" class="form-control">{{ $surat->keterangan }}</textarea>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="nama_surat" class="form-label">Nama Surat</label>
                            <input type="text" name="nama_surat" class="form-control" value="{{ $surat->nama_surat }}"
                                required placeholder="Masukkan Nama Surat">
                        </div>
                        <div class="mb-3">
                            <label for="tanggal_surat" class="form-label">Tanggal Surat</label>
                            <input type="date" name="tanggal_surat" class="form-control"
                                value="{{ $surat->tanggal_surat }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="penerima" class="form-label">Penerima</label>
                            <input type="text" name="penerima" class="form-control" value="{{ $surat->penerima }}"
                                required placeholder="Masukkan Penerima">
                        </div>
                        <div class="mb-3">
                            <label for="jenis_surat" class="form-label">Jenis Surat</label>
                            <select name="jenis_surat" class="form-select" required>
                                <option value="masuk" {{ $surat->jenis_surat=='masuk' ? 'selected' : '' }}>Masuk
                                </option>
                                <option value="keluar" {{ $surat->jenis_surat=='keluar' ? 'selected' : '' }}>Keluar
                                </option>
                                <option value="lainnya" {{ $surat->jenis_surat=='lainnya' ? 'selected' : '' }}>Lain-lain
                                </option>
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="file_surat" class="form-label fw-semibold">Upload File Surat (PDF)</label>
                            <div class="input-group">
                                <input type="file" name="file_surat" id="file_surat" class="form-control"
                                    accept="application/pdf">
                                @if (!empty($surat->file_surat))
                                <a href="{{ asset('storage/' . $surat->file_surat) }}" target="_blank"
                                    class="btn btn-outline-secondary">
                                    <i class="bi bi-eye me-1"></i> Lihat File Tersimpan
                                </a>
                                @endif
                            </div>
                            <div class="form-text text-muted">File harus berformat PDF / Word / Excel. Maksimal ukuran 2MB.</div>
                        </div>

                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Simpan Surat</button>
                <a href="{{ route('admin.surat') }}" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
</div>
@endsection
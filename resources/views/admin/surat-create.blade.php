@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header d-flex flex-column align-items-start p-3">
            <h4 class="card-title mb-3 fw-bold">Tambah Surat Baru</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.surat.create.post') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    {{-- Kolom Kiri --}}
                    <div class="col-md-6">
                        {{-- Nomor Surat --}}
                        <div class="mb-3">
                            <label for="nomor_surat" class="form-label">Nomor Surat</label>
                            <input type="text" name="nomor_surat" class="form-control" value="{{ old('nomor_surat') }}"
                                required placeholder="Masukkan Nomor Surat">
                        </div>

                        {{-- Kode Surat --}}
                        <div class="mb-3">
                            <label for="kode_surat" class="form-label">Kode Surat</label>
                            <input type="text" name="kode_surat" class="form-control" value="{{ old('kode_surat') }}"
                                placeholder="Masukkan Kode Surat">
                        </div>

                        {{-- Pengirim --}}
                        <div class="mb-3">
                            <label for="pengirim" class="form-label">Pengirim</label>
                            <input type="text" name="pengirim" class="form-control" value="{{ old('pengirim') }}"
                                required placeholder="Masukkan Pengirim">
                        </div>

                        {{-- Perihal --}}
                        <div class="mb-3">
                            <label for="perihal" class="form-label">Perihal</label>
                            <textarea name="perihal" class="form-control" rows="2"
                                placeholder="Masukkan Perihal">{{ old('perihal') }}</textarea>
                        </div>

                        {{-- Keterangan --}}
                        <div class="mb-3">
                            <label for="keterangan" class="form-label">Keterangan</label>
                            <textarea name="keterangan" class="form-control" rows="3"
                                placeholder="Masukkan Keterangan">{{ old('keterangan') }}</textarea>
                        </div>
                    </div>

                    {{-- Kolom Kanan --}}
                    <div class="col-md-6">
                        {{-- Nama Surat --}}
                        <div class="mb-3">
                            <label for="nama_surat" class="form-label">Nama Surat</label>
                            <input type="text" name="nama_surat" class="form-control" value="{{ old('nama_surat') }}"
                                required placeholder="Masukkan Nama Surat">
                        </div>

                        {{-- Tanggal Surat --}}
                        <div class="mb-3">
                            <label for="tanggal_surat" class="form-label">Tanggal Surat</label>
                            <input type="date" name="tanggal_surat" class="form-control"
                                value="{{ old('tanggal_surat') }}" required>
                        </div>

                        {{-- Penerima --}}
                        <div class="mb-3">
                            <label for="penerima" class="form-label">Penerima</label>
                            <input type="text" name="penerima" class="form-control" value="{{ old('penerima') }}"
                                required placeholder="Masukkan Penerima">
                        </div>

                        {{-- Jenis Surat --}}
                        <div class="mb-3">
                            <label for="jenis_surat" class="form-label">Jenis Surat</label>
                            <select name="jenis_surat" class="form-select" required>
                                <option value="masuk" {{ old('jenis_surat')=='masuk' ? 'selected' : '' }}>Masuk</option>
                                <option value="keluar" {{ old('jenis_surat')=='keluar' ? 'selected' : '' }}>Keluar
                                </option>
                            </select>
                        </div>

                        {{-- Category --}}
                        <div class="mb-3">
                            <label for="category_id" class="form-label">Kategori Surat</label>
                            <select name="category_id" class="form-select" required>
                                <option value="">-- Pilih Kategori --</option>
                                @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id')==$category->id ? 'selected' :
                                    '' }}>
                                    {{ $category->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- File Surat --}}
                        <div class="mb-3">
                            <label for="file_surat" class="form-label">Upload File Surat (PDF)</label>
                            <input type="file" name="file_surat" class="form-control" accept="application/pdf" required>
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
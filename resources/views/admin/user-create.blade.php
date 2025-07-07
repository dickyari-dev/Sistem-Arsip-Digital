@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header d-flex flex-column align-items-start">
            <h4 class="card-title mb-3">Tambah User Baru</h4>
            <p class="text-muted mb-0">Tambah User baru</p>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.user.create.post') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label">Nama Lengkap</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name') }}" required autofocus placeholder="Masukkan Nama Lengkap">
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email') }}" required placeholder="Masukkan Email">
                </div>

                <div class="mb-3">
                    <label for="role" class="form-label">Role</label>
                    <select name="role" class="form-select" required>
                        <option value="admin" {{ old('role')=='admin' ? 'selected' : '' }}>Admin</option>
                        <option value="camat" {{ old('role')=='camat' ? 'selected' : '' }}>Camat</option>
                        <option value="pegawai" {{ old('role')=='pegawai' ? 'selected' : '' }}>Pegawai</option>
                    </select>
                </div>


                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" required placeholder="Masukkan Password">
                </div>
                

                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" class="form-control" required placeholder="Masukkan Kembali Password">
                </div>

                
                <button type="submit" class="btn btn-primary">Simpan User</button>
                <a href="{{ route('admin.surat') }}" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
</div>
@endsection
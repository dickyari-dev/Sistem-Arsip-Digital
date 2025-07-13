@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header d-flex flex-column align-items-start">
            <h4 class="card-title mb-3">Tambah User Baru</h4>
            <p class="text-muted mb-0">Tambah User baru</p>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.user.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="name" class="form-label">Nama Lengkap</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required
                        autofocus placeholder="Masukkan Nama Lengkap">
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}"
                        required placeholder="Masukkan Email">
                </div>

                <div class="mb-3">
                    <label for="role" class="form-label">Role</label>
                    <select name="role" class="form-select" required>
                        <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="camat" {{ old('role', $user->role) == 'camat' ? 'selected' : '' }}>Camat</option>
                        <option value="pegawai" {{ old('role', $user->role) == 'pegawai' ? 'selected' : '' }}>Pegawai
                        </option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password <small class="text-muted">(Kosongkan jika tidak
                            ingin mengubah)</small></label>
                    <input type="password" name="password" class="form-control"
                        placeholder="Kosongkan jika tidak mengubah password">
                </div>

                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" class="form-control"
                        placeholder="Masukkan Kembali Password">
                </div>

                <button type="submit" class="btn btn-primary">Update User</button>
                <a href="{{ route('admin.surat') }}" class="btn btn-secondary">Kembali</a>
            </form>

        </div>
    </div>
</div>
@endsection
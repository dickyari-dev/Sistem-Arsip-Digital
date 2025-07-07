@extends('layouts.app') {{-- Sesuaikan dengan layout proyek kamu --}}

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between flex-row">
            <div>
                <h4 class="card-title mb-3 ">Data User Account</h4>
                <p class="text-muted mb-0">Data user terbaru</p>
            </div>
            <div class="mb-3">
                <a href="{{ route('admin.user.create') }}" class="btn btn-primary">+ Tambah Usser</a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <div class="filter">
                    <form action="{{ route('admin.user.filter') }}" method="post">
                        @csrf
                        <div class="input-group mb-3 flex-wrap">

                            <div class="me-2 mb-2">
                                <label for="name" class="form-label">Nama User</label>
                                <input type="text" name="name" class="form-control" placeholder="Nama User"
                                    value="{{ request('name') }}">
                            </div>


                            <div class="me-2 mb-2">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" placeholder="Email"
                                    value="{{ request('kode_surat') }}">
                            </div>

                            <div class="me-2 mb-2">
                                <label for="role" class="form-label">Level User</label>
                                <select name="role" id="role" class="form-select">
                                    <option value="">Semua</option>
                                    <option value="admin" {{ request('role')=='admin' ? 'selected' : ''
                                        }}>Admin</option>
                                    <option value="camat" {{ request('role')=='camat' ? 'selected' : ''
                                        }}>Camat</option>
                                    <option value="pegawai" {{ request('role')=='pegawai' ? 'selected'
                                        : '' }}>Pegawai</option>
                                </select>
                            </div>

                            <div class="me-2 mb-2 d-flex align-items-end">
                                <button class="btn btn-primary me-2" type="submit">Cari</button>
                                <a href="{{ route('admin.user') }}" class="btn btn-secondary">Clear</a>
                            </div>

                        </div>
                    </form>

                </div>
                <table class="table table-bordered table-striped">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Nama User</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Tanggal Dibuat</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $index => $user)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->role ?? '-' }}</td>
                            <td>{{ \Carbon\Carbon::parse($user->created_at)->format('d/m/Y') }}</td>
                            <td>
                                @if ($user->role === 'admin')
                                <span class="badge bg-primary">Admin</span>
                                @elseif ($user->role === 'camat')
                                <span class="badge bg-info">Camat</span>
                                @elseif ($user->role === 'pegawai')
                                <span class="badge bg-warning">Pegawai</span>
                                @endif
                            </td>
                            <td>
                                {{-- Tambahkan route edit/delete jika ada --}}
                                <a href="{{ route('admin.user.edit', $user->id) }}"
                                    class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('admin.user.delete') }}" method="POST"
                                    style="display:inline-block;"
                                    onsubmit="return confirm('Yakin ingin hapus user ini?')">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $user->id }}">
                                    <button class="btn btn-sm btn-danger">Hapus</button>
                                </form>
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
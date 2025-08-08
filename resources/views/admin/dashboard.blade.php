@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="row">
    <div class="col-xxl-12">
        <div class="card">
            <div class="card-header">
                <div class="card-icon">
                    <i class="fas fa-chart-bar fs-14 text-muted"></i>
                </div>
                <h4 class="card-title mb-0">Data Surat</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="d-flex justify-content-between align-content-end shadow-lg p-3">
                            <div>
                                <p class="text-muted text-truncate mb-2">Data Surat Masuk</p>
                                <h5 class="mb-0">{{ $suratMasukCount }}</h5>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="d-flex justify-content-between align-content-end shadow-lg p-3">
                            <div>
                                <p class="text-muted text-truncate mb-2">Data Surat Keluar</p>
                                <h5 class="mb-0">{{ $suratKeluarCount }}</h5>
                            </div>
                            <div class="text-success float-end">
                                <i class="mdi mdi-menu-up"> </i>2.1%
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="d-flex justify-content-between align-content-end shadow-lg p-3">
                            <div>
                                <p class="text-muted text-truncate mb-2">Semua Surat</p>
                                <h5 class="mb-0">{{ $suratCount }}</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
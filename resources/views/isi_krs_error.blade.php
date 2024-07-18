@extends('layouts.main')

@section('title', 'Tambah MK')

@section('master')
<div class="container-fluid py-4">
    <div class="card">
        <div class="card-body p-3">
            <p class="text-md mb-0 text-uppercase font-weight-bold">ENTRI KARTU RENCANA STUDI : SEMESTER {{ strtoupper($data['kontrol']->DESKRIPSI_SEMESTER) }} {{ $data['kontrol']->TAHUN_AKADEMIK }}</p>
        </div>
        <hr class="horizontal dark mt-0">
        <div class="container">
            <div class="alert alert-primary">
                <div class="row">
                    <div class="col-md-12">
                        <div class="content controls">
                            <div class="head bg-siam bg-light-ltr">
                                <h3 class="text text-white">Permintaan tidak dapat dilanjutkan</h3>
                            </div>
                            <div class="content mt-3">
                                <h5 class="text text-white">
                                    <i class="fas fa-exclamation-circle text-white"></i> {{ $data['error'] }}
                                </h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="btn-group">
                <a class="btn btn-primary" href="/entri-krs">Kembali</a>
            </div>
        </div>
    </div>
</div>
@endsection
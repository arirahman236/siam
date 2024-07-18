@extends('layouts.main')

@section('title')
{{ 'Tugas Akhir' }}
@endsection

@section('master')

<div class="container-fluid py-4">
    <div class="row">
        <div class="col mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="numbers">
                        <p class="text-md mb-0 text-uppercase font-weight-bold">JUDUL @if ($data['q'][0]->KDJENMSPST == "C")
                            Skripsi
                            @elseif ($data['q'][0]->KDJENMSPST == "B")
                            Thesis
                            @elseif (in_array($data['q'][0]->KDJENMSPST, ["E", "F", "G"]))
                            TUGAS AKHIR
                            @else
                            Skripsi
                            @endif</p>
                    </div>
                    <hr class="horizontal dark" />

                    @if($data['failed2'])
                    <div class="alert alert-danger text-white">
                        <h4 class="alert-heading">Perhatian!</h4>
                        <p>Anda belum melakukan pembayaran @if ($data['q'][0]->KDJENMSPST == "C")
                            Skripsi
                            @elseif ($data['q'][0]->KDJENMSPST == "B")
                            Thesis
                            @elseif (in_array($data['q'][0]->KDJENMSPST, ["E", "F", "G"]))
                            Tugas Akhir
                            @else
                            Skripsi
                            @endif.</p>
                        <p>Silahkan lakukan pembayaran terlebih dahulu.</p>
                    </div>
                    @elseif($data['nim'] != '')
                    <div class="alert alert-primary text-white">
                        <h4 class="alert-heading">Perhatian!</h4>
                        <p>Data @if ($data['q'][0]->KDJENMSPST == "C")
                            Skripsi
                            @elseif ($data['q'][0]->KDJENMSPST == "B")
                            Thesis
                            @elseif (in_array($data['q'][0]->KDJENMSPST, ["E", "F", "G"]))
                            Tugas Akhir
                            @else
                            Skripsi
                            @endif sudah ada.</p>
                        <p>Silahkan hubungi admin prodi untuk melakukan perubahan / validasi dosen pembimbing.</p>
                    </div>
                    @else
                    <form method="POST" action="{{ route('insert-akhir') }}" class="block-content form" id="simple_form">
                        @csrf
                        <div class="content controls">
                            <div class="form-row">
                                <div class="col-md-9">
                                    <input type="text" name="judul" class="form-control" placeholder="Judul" aria-label="Recipient's username" aria-describedby="basic-addon2">
                                </div>
                            </div>
                        </div>
                        <div class="content controls mt-3">
                            <div class="footer tar pull-right">
                                <div class="btn-group">
                                    <button type="submit" class="btn btn-primary" value="Tambah" name="Simpan">Simpan</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
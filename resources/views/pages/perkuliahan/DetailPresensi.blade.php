@extends('layouts.main')

@section('title', 'Presensi Kuliah')

@section('master')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-12">
                            <div class="block block-drop-shadow">
                                <div class="numbers">
                                    <hp class="text-md mb-0 text-uppercase font-weight-bold">Presensi Kuliah</p>
                                </div>
                                <hr class="horizontal dark mt-0">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-12">
                                            @if ($presensiData && $presensiDataNim)
                                            <div class="content controls">
                                                <div class="form-row">
                                                    <div class="col-md-2">Matakuliah</div>
                                                    <div class="col-md-9"><b>{{ $presensiDataNim->NAMA_MK }}</b></div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="col-md-3">Kode MK</div>
                                                    <div class="col-md-9"><b>{{ $presensiDataNim->KODE_MK }}</b></div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="col-md-3">Kelas</div>
                                                    <div class="col-md-9"><b>{{ $presensiDataNim->KELAS }}</b></div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="col-md-3">Dosen</div>
                                                    <div class="col-md-9"><b>{{ $presensiDataNim->DOSEN }}{{ ($presensiDataNim->GELAR_DOSEN)? ', '.$presensiDataNim->GELAR_DOSEN:'' }}</b></div>
                                                </div>
                                            </div>
                                            <div class="header">
                                                <h6>Presensi : {{ $presensiDataNim->REALISASI_TATAP_MUKA }}</h6>
                                            </div>
                                            <div class="content" style="overflow-x: auto;">
                                                <table cellpadding="0" cellspacing="0" width="100%" class="table table-bordered table-striped">
                                                    <thead>
                                                        <tr bgcolor="#FFFFFF" align="center">
                                                            <th @if ($presensiDataNim->REALISASI_TATAP_MUKA > 0) rowspan="2" @endif width="10">No.</th>
                                                            <th @if ($presensiDataNim->REALISASI_TATAP_MUKA > 0) rowspan="2" @endif width="210">Nama</th>
                                                            <th style="text-align:center;" @if ($presensiDataNim->REALISASI_TATAP_MUKA > 0) colspan="{{ $presensiDataNim->REALISASI_TATAP_MUKA }}" @endif height="40">Pertemuan</th>
                                                        </tr>
                                                        @if ($presensiDataNim->REALISASI_TATAP_MUKA > 0)
                                                        <tr class="font_white" align="center">
                                                            @for ($i = 1; $i <= $presensiDataNim->REALISASI_TATAP_MUKA; $i++)
                                                                <th width="30" style="text-align:center;">{{ $i }}</th>
                                                                @endfor
                                                        </tr>
                                                        @endif
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td align="center" style="padding-right:5px">1.</td>
                                                            <td align="left" height="25" style="padding-left:10px">{{ $presensiDataNim->MAHASISWA }}</td>
                                                            @for ($j = 1; $j <= $presensiDataNim->REALISASI_TATAP_MUKA; $j++)
                                                                <?php $pertemuan = 'HARI_' . $j; ?>
                                                                <td style="text-align:center;">
                                                                    @if ($presensiDataNim->$pertemuan == 1)
                                                                    <i class="fas fa-check text-success"></i>
                                                                    @elseif ($presensiDataNim->$pertemuan == 0)
                                                                    <i class="fas fa-times text-danger"></i>
                                                                    @endif
                                                                </td>
                                                                @endfor
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            @else
                                            <div class="alert alert-primary">
                                                <div class=" head bg-siam bg-light-ltr">
                                                    <h2 class="text text-white">Data tidak tersedia</h2>
                                                </div>
                                                <div class="content">
                                                    <h5 class="text text-white">Message</h5>
                                                    <p class="text text-white">Data tidak ditemukan.</p>
                                                </div>
                                            </div>
                                            @endif
                                            <div class="content controls">
                                                <div class="footer tar pull-right">
                                                    <div class="btn-group">
                                                        <button class="btn btn-primary" onclick="self.location='{{ route('presensi') }}'" name="batal" value="Batal" type="button">Kembali</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@extends('layouts.main')
@section('title')
{{ 'KHS' }}
@endsection

@section('master')
@php
use App\Http\Controllers\AkadControllerKrs;
use App\Http\Controllers\AkadControllerKhs;
use App\Models\KrsModel;
@endphp

<style>
    .wi {
        width: 100%;
    }
</style>

<div class="container-fluid py-4">
    <div class="card">
        <div class="row">
            <div class="col-md-12">
                <div class="block">
                    <div class="card-header">
                        <h4>KARTU HASIL STUDI (KHS)</h4>
                        @if (isset($data['getDataKhs']))
                        <div class="text-end my-0">
                            <div class="btn-group pull-right">
                                @if (isset($data['trap']) == 0)
                                <!-- <button class="btn btn-primary btn-clean dropdown-toggle" data-toggle="dropdown">
                                                <span class="caret">Cetak</span>
                                            </button> -->
                                <ul class="dropdown-menu" role="menu">
                                    @php
                                    $linkku = 'siam/cetak-khs/' . $data['tahun'] . '/' . $data['semester'] . '.html';
                                    @endphp
                                    {{-- <li>{{ anchor_popup($linkku, 'CETAK KHS', $data['atts']) }}</li> --}}
                                </ul>
                                @endif
                            </div>
                        </div>
                        @endif
                        @if (isset($data['getDataKhs']))
                        @foreach ($data['getDataKhs'] as $khsValue)
                        @php
                        $tahun = substr($khsValue->TAHUN_SEMESTER, 0, 4);
                        $semester = substr($khsValue->TAHUN_SEMESTER, 4, 1);
                        @endphp
                        <div class="content controls">
                            <div class="form-row">
                                <div class="col-md-3">Nama</div>
                                <div class="col-md-9"><b>{{ strtoupper($khsValue->NAMA) }}</b></div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-3">NIM</div>
                                <div class="col-md-9"><b>{{ $khsValue->NIM }}</b></div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-3">Semester</div>
                                <div class="col-md-9">
                                    <b>{{ $data['smt'] }}</b>
                                </div>
                            </div>
                        </div>
                        @break;
                        @endforeach
                        @endif
                    </div>
                </div>
                @if (isset($data['trap']) == 0)
                <div class="content p-3" style="overflow-x: auto;">
                    <table cellpadding="0" cellspacing="0" width="100%" class="table table-bordered table-striped sortable">
                        <thead>
                            <tr align="center">
                                <th>No.</th>
                                <th>Kode MK</th>
                                <th>Nama MK</th>
                                <th>SKS</th>
                                <th>Nilai</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $seq_number = 1;
                            @endphp
                            @foreach ($data['getDataKhs'] as $khsValue)
                            <tr align="center">
                                <td align="right">{{ $seq_number }}</td>
                                <td>{{ strtoupper($khsValue->KODE_MATAKULIAH) }}</td>
                                <td align="left" style="padding-left:7px">
                                    {{ $khsValue->NAMA_MATAKULIAH }}
                                </td>
                                <td>{{ $khsValue->SKS }}</td>
                                <td>
                                    @if ($data['boleh']->NILAI)
                                    {{ $khsValue->NILAI_AKHIR_HURUF }}
                                    @else
                                    -
                                    @endif
                                </td>
                            </tr>
                            @php
                            $seq_number++;
                            @endphp
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <div class="footer footer-defaut tac" style="background: rgba(0, 0, 0, 0.62) none repeat scroll 0 0">
                    <div class="pull-left">
                        <p class="gothamMedium" style="color:#fff"><b>*Polling belum lengkap, silahkan
                                mengisi
                                polling sebelum melihat KHS.</b><a href="{{ site_url('siam/pilih-prodi-poling/' . $tahunsmt . '.html') }}" style="color:#fff"><u> Klik disini</u> </a></p>
                    </div>
                </div>
                @endif
                @if (isset($data['trap']) == 0)
                @if ($data['boleh']->NILAI)
                <div class="content tasks px-4 pb-2">
                    <div class="task-item priority-low">
                        <div class="task-item-content">
                            <div class="task-item-head">Indeks Prestasi Semester :
                                @php
                                $ips = App\Http\Controllers\AkadControllerKrs::ipsByThsms($data['tahun'] . $data['semester'], auth()->user()->NIM);
                                echo $ips['ips'];
                                @endphp
                            </div>
                            <div class="task-item-head">Indeks Prestasi Kumulatif :
                                @php
                                $ipk = App\Http\Controllers\AkadControllerKhs::hitungIpk(auth()->user()->NIM, $data['tahun'] . $data['semester']);
                                echo $ipk['ipk'];
                                @endphp
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                @else
                <div class="head bg-siam bg-light-ltr">
                    <h2>Data tidak tersedia</h2>
                </div>
                <div class="content">
                    <h5>Message</h5>
                    <p>Data KHS tidak tersedia</p>
                </div>
                <div class="content controls">
                    <div class="footer tar pull-right">
                        <div class="btn-group">
                            <button class="btn btn-warning" onclick="self.location('{{ base_url() . 'siam/lihat-khs.html' }}')" name="batal" value="Batal" type="button">Kembali</button>
                        </div>
                    </div>
                </div>
                @endif
                <div class="btn-group ms-4">
                    <a class="btn btn-primary" href="/KHS">Kembali</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
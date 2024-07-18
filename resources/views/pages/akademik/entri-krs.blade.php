@extends('layouts.main')
@section('title')
{{ 'Entri-KRS' }}
@endsection

@section('master')

@php
use App\Http\Controllers\AkadControllerKrs;
@endphp
<div class="container-fluid py-4">
    <div class="row">
        <div class="col mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="numbers">
                        <p class="text-md mb-0 text-uppercase font-weight-bold">ENTRI KARTU RENCANA STUDI : SEMESTER {{ $data['kontrol']->DESKRIPSI_SEMESTER.' '.$data['kontrol']->TAHUN_AKADEMIK }}</p>
                    </div>
                    <hr class="horizontal dark" />
                    <div class="d-flex justify-content-between">
                        <div class="mt-2"> <!-- IP semester lalu -->
                            <div class="form-row ms-4">
                                <div class="col">
                                    <i class="ni ni-atom text-success"></i> IP semester lalu :
                                    @php
                                    $ips=App\Http\Controllers\AkadControllerKrs::ipsByThsmsLalu($data['kontrol']->SEMESTER,auth()->user()->NIM);

                                    @endphp
                                    @if(isset($ips['ips_print']))
                                    {{ $ips['ips_print'] }}
                                    @else
                                    0.00
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="btn-group">
                            <a href="/tambah-mk" class="btn bg-gradient-success">
                                <i class=" fa fa-plus"></i> Tambah MK
                            </a>
                        </div>
                    </div>
                </div>

                <div class="content p-3" style="overflow-x: auto;">
                    <table cellpadding="0" cellspacing="0" width="100%" class="table table-bordered table-striped">
                        <thead>
                            <tr align="center">
                                <th>No.</th>
                                <th>Kode MK</th>
                                <th>Nama MK</th>
                                <th>SKS</th>
                                <th>Kelas</th>
                                <th>BATAL</th>
                                <th>Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- {{dd($data['getDataKhs'])}} --}}
                            @php $seq_number = 1; @endphp
                            @php $jumlah_sks_diambil = 0;@endphp
                            @php if($data['krs']): @endphp
                            @php foreach($data['krs'] as $valueKrs): @endphp

                            <tr align="center">
                                <td align="center">{{ $seq_number }}.</td>
                                <td><?php echo strtoupper($valueKrs->KODE_MATAKULIAH); ?></td>
                                <td align="left" style="padding-left:10px"><?php echo $valueKrs->NAMA_MATAKULIAH; ?></td>
                                <td><?php echo $valueKrs->SKS ?></td>
                                <td><?php echo $valueKrs->KELAS ?></td>
                                <td><a class="btn btn-warning" href="{{ url('hapus-mk/' . $valueKrs->ID) }}">Hapus</a></td>
                                <td align="left" style="padding-left:10px"></td>
                            </tr>
                            @php $seq_number++; @endphp
                            @php $jumlah_sks_diambil = $jumlah_sks_diambil + $valueKrs->SKS; @endphp
                            @php endforeach; @endphp
                            @php endif; @endphp

                            <tr align="center">
                                <td height="20"></td>
                                <td></td>
                                <td align="right"><b>Jumlah SKS</b></td>


                                <td>{{ $jumlah_sks_diambil; }}</td> <!-- Contoh data statis -->
                                <td></td>
                                <td align="left">&nbsp;</td>
                                <td></td>
                            </tr>

                            <tr align="center">
                                <td height="20"></td>
                                <td></td>
                                <td align="right"><b>Jumlah Maksimum SKS</b></td>

                                <td>{{$data['ipsMax']}}</td> <!-- Contoh data statis -->
                                <td></td>
                                <td align="left">&nbsp;</td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@extends('layouts.main')
@section('title', 'KRS')

@section('master')
<style>
    .wi {
        width: 100%;
    }
</style>
<div class="container-fluid py-4">
    <div class="card">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-12">
                    <div class="block">
                        <div class="card-header">
                            <h4>KARTU RENCANA STUDI @if($data['getDataKrs']):
                                <b>SEMESTER @foreach($data['getDataKrs'] as $krs)
                                    @php

                                    $tahun = substr($krs->TAHUN_SEMESTER, 0, 4);
                                    $semester = substr($krs->TAHUN_SEMESTER, 4, 1);
                                    @endphp
                                    <?php
                                    if ($semester % 2 == 0) {
                                        echo "GENAP ";
                                    } else {
                                        echo "GANJIL ";
                                    }
                                    echo $tahun
                                    ?>
                                    @break
                                    @endforeach
                                    @endif
                                </b>
                            </h4>
                            <div class="side pull-right">
                                <div class="btn-group pull-right">
                                    <!-- <button class="btn btn-primary btn-clean dropdown-toggle"
                                        data-toggle="dropdown"><span class="caret">Cetak</span></button> -->
                                    <ul class="dropdown-menu" role="menu">
                                        <li>
                                            @php
                                            $linkku = 'siam/cetak-krs/' . $data['info_tahun'] . $data['info_semester'] . '.html';
                                            @endphp
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        @if ($data['getDataKrs'])
                        <div class="content p-3" style="overflow-x: auto;">
                            <table cellpadding="0" cellspacing="0" width="100%" class="table table-bordered table-striped sortable">
                                <thead>
                                    <tr align="center">
                                        <th>No.</th>
                                        <th>Kode MK</th>
                                        <th>Nama MK</th>
                                        <th>SKS</th>
                                        <th>Kelas</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $total_sks = 0;
                                    $seq_number = 1;
                                    @endphp
                                    @foreach ($data['getDataKrs'] as $krs)
                                    <tr align="center">
                                        <td align="right">{{ $seq_number }}</td>
                                        <td>{{ strtoupper($krs->KODE_MATAKULIAH) }}</td>
                                        <td align="left">{{ $krs->NAMA_MATAKULIAH }}</td>
                                        <td>{{ $krs->SKS }}</td>
                                        <td>{{ $krs->KELAS }}</td>
                                    </tr>
                                    @php
                                    $total_sks += $krs->SKS;
                                    $seq_number++;
                                    @endphp
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="content tasks">
                            <div class="task-item priority-low">
                                <div class="task-item-content px-4 pb-2">
                                    <div class="task-item-head">Jumlah SKS : {{ $total_sks }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="btn-group mt-3 ms-4">
                            <a class="btn btn-primary" href="/KRS">Kembali</a>
                        </div>
                        @else
                        <div class="head bg-siam bg-light-ltr">
                            <h2>Data tidak tersedia</h2>
                        </div>
                        <div class="content">
                            <h5>Mungkin disebabkan</h5>
                            <p>
                                <b>1)</b>. Belum ada data KRS pada Semester
                                @php
                                $semester = $data['info_semester'] == 2 ? 'Genap' : 'Ganjil';
                                @endphp
                                {{ $semester }} {{ $data['info_tahun'] }}.
                                &nbsp;&nbsp;&nbsp;&nbsp;
                                <b>2)</b>. KRS Semester
                                @php
                                $semester = $data['info_semester'] == 2 ? 'Genap' : 'Ganjil';
                                @endphp
                                {{ $semester }} {{ $data['info_tahun'] }} belum divalidasi (Silakan hubungi
                                dosen PA).
                            </p>
                        </div>
                        <div class="content controls">
                            <div class="footer tar pull-right">
                                <div class="btn-group">
                                    <button class="btn btn-warning" onclick="self.location('{{ base_url() . 'siam/lihat-krs.html' }}')" name="batal" value="Batal" type="button">Kembali</button>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
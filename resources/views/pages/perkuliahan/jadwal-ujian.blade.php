@extends('layouts.main')

@section('title', 'Jadwal Ujian')

@section('master')
@php
use App\Models\KeuanganModel;
@endphp
<div class="container-fluid py-4">
    <div class="row">
        <div class="col mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-12">
                            <div class="block block-drop-shadow">
                                <div class="numbers">
                                    <p class="text-md mb-0 text-uppercase font-weight-bold">Jadwal Ujian</p>
                                    <hr class="horizontal dark" />
                                </div>
                                @php
                                // $jadwalUjian = [
                                // (object) [
                                // 'MULAI' => '08:00',
                                // 'SELESAI' => '10:00',
                                // 'KODE_MK' => 'MK001',
                                // 'NAMA_MK' => 'Mata Kuliah 1',
                                // 'KELAS' => 'A',
                                // 'NAMA_DOSEN' => 'Dosen 1',
                                // ],
                                // // Tambahkan data ujian lainnya di sini
                                // ];
                                // $current_day = now(); // Tanggal ujian saat ini
                                // $max_day = 5; // Ganti sesuai kebutuhan
                                // $current_request_day = 0; // Ganti sesuai permintaan pengguna saat ini
                                @endphp
                                @if (isset($data['jadwalUjian']))
                                <div class="content controls">
                                    <div class="form-row ms-3">
                                        <div class="col-md-3">TANGGAL : </div>
                                        <div class="col-md-9">
                                            {{ KeuanganModel::tanggal_indonesia(date('Y-m-d', strtotime($data['current_day']))) }}
                                        </div>
                                    </div>
                                </div>
                                @endif
                                <div class="content p-3" style="overflow-x: auto;">
                                    <table cellpadding="0" cellspacing="0" width="100%" class="table table-bordered table-striped sortable">
                                        <thead>
                                            <tr align="center">
                                                <th>No</th>
                                                <th>Jam</th>
                                                <th>Kode MK</th>
                                                <th>Nama MK</th>
                                                <th>Kelas</th>
                                                <th>Dosen</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (isset($data['jadwalUjian']))
                                            @php
                                            $seq_number = 1;
                                            $color_no = 1;
                                            @endphp
                                            @foreach ($data['jadwalUjian'] as $jadwalValue)
                                            @php $color = ($color_no % 2 == 0) ? '#FFFFFF' : '#F0F1F4'; @endphp
                                            <tr align="center">
                                                <td align="right" height="25" style="padding-right:5px">{{ $seq_number }}</td>
                                                <td>{{ $jadwalValue->MULAI }} - {{ $jadwalValue->SELESAI }}</td>
                                                <td>{{ strtoupper($jadwalValue->KODE_MK) }}</td>
                                                <td align="left" style="padding-left:10px">
                                                    {{ ucwords(strtolower($jadwalValue->NAMA_MK)) }}
                                                </td>
                                                <td>{{ $jadwalValue->KELAS }}</td>
                                                <td align="left" style="padding-left:5px">{{ $jadwalValue->NAMA_DOSEN }}</td>
                                            </tr>
                                            @php
                                            $seq_number++;
                                            $color_no++;
                                            @endphp
                                            @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                                {{-- <div class="content">
                @if (isset($data['jadwalUjian']))
                    <br><br>
                    <div class="form-row">
                        <ul class="pagination justify-content-left ms-3">
                            @for ($index = 0; $index < $data['max_day']; $index++)
                                <li class="page-item">
                                    <a href="{{ url('jadwal-ujian/' . $index) }}"
                                class="page-link {{ $data['current_request_day'] == $index ? 'font-weight-bold' : '' }}">
                                {{ $index + 1 }}
                                </a>
                                </li>
                                @endfor
                                </ul>
                            </div>
                            @endif
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
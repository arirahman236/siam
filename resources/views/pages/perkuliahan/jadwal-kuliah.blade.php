@extends('layouts.main')

@section('title', 'Jadwal Kuliah')

@section('master')
    @php
        use App\Models\ViewJadwalKuliah;
        use App\Models\view_krs_all;
    @endphp
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="numbers">
                            <p class="text-md mb-0 text-uppercase font-weight-bold"><b>Kuliah</b>&nbsp;: Semester
                                {{ session('kontrol')->DESKRIPSI_SEMESTER . ' ' . session('kontrol')->TAHUN_AKADEMIK }}
                            </p>
                            <hr class="horizontal dark mt-0">
                        </div>
                        <div class="content p-3" style="overflow-x: auto;">
                            <table cellpadding="0" cellspacing="0" width="100%"
                                class="table table-bordered table-striped">
                                <thead>
                                    <tr align="center">
                                        <th>Hari</th>
                                        <th>Jam</th>
                                        <th>Kode MK</th>
                                        <th>Nama MK</th>
                                        <th>SKS</th>
                                        <th>Kelas</th>
                                        <th>Ruang</th>
                                        <th>Dosen Pengampu</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data['hari'] as $day)
                                        @php
                                            $total_row = 0;
                                            $tahun = substr(session('kontrol')->SEMESTER, 0, 4);
                                            $semester = substr(session('kontrol')->SEMESTER, 4, 1);
                                            $dataJadwalKuliah = ViewJadwalKuliah::getJadwalKuliahByIdHari($day->ID, auth()->user()->KODE_PRODI, session('kontrol')->SEMESTER);
                                        @endphp

                                        @if ($dataJadwalKuliah)
                                            @php $rowspan = true; @endphp

                                            @foreach ($dataJadwalKuliah as $jadwal)
                                                @php
                                                    $dataKrs = view_krs_all::getViewKrsAll(auth()->user()->NIM, session('kontrol')->SEMESTER);
                                                @endphp

                                                @if ($dataKrs)
                                                    @foreach ($dataKrs as $krs)
                                                        @if ($jadwal->KODE_MK == $krs->KODE_MATAKULIAH && $jadwal->KELAS == $krs->KELAS)
                                                            @php $total_row++; @endphp
                                                        @endif
                                                    @endforeach
                                                @endif
                                            @endforeach

                                            @if ($total_row > 0)
                                                @foreach ($dataJadwalKuliah as $jadwal)
                                                    @php
                                                        $dataKrs = view_krs_all::getViewKrsAll(auth()->user()->NIM, $data['kontrol']->SEMESTER);
                                                    @endphp

                                                    <tr align="center">
                                                        @if ($dataKrs)
                                                            @foreach ($dataKrs as $krs)
                                                                @if ($jadwal->KODE_MK == $krs->KODE_MATAKULIAH && $jadwal->KELAS == $krs->KELAS)
                                                                    @if ($rowspan)
                                                                        <td rowspan="{{ $total_row }}">
                                                                            {{ ucwords(strtolower($day->NAMA_HARI)) }}
                                                                        </td>
                                                                        @php $rowspan = false; @endphp
                                                                    @endif
                                                                    <td>{{ substr($jadwal->MULAI, 0, 5) }} -
                                                                        {{ substr($jadwal->SELESAI, 0, 5) }}</td>
                                                                    <td>{{ strtoupper($jadwal->KODE_MK) }}</td>
                                                                    <td align="left" style="padding-left:10px">
                                                                        {{ $jadwal->NAMA_MK }}</td>
                                                                    <td>{{ $jadwal->SKS }}</td>
                                                                    <td>{{ $jadwal->KELAS }}</td>
                                                                    <td>{{ $jadwal->RUANG }}</td>
                                                                    <td align="left" style="padding-left:10px">
                                                                        {{ $jadwal->NAMA_DOSEN }}{{ $jadwal->GELAR ? ', ' . $jadwal->GELAR : '' }}
                                                                    </td>
                                                                @endif
                                                            @endforeach
                                                        @endif
                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr align="center">
                                                    <td>{{ ucwords(strtolower($day->NAMA_HARI)) }}</td>
                                                    <td align="left" colspan="8">-</td>
                                                </tr>
                                            @endif
                                        @else
                                            <tr align="center">
                                                <td>{{ ucwords(strtolower($day->NAMA_HARI)) }}</td>
                                                <td align="left" colspan="8">-</td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

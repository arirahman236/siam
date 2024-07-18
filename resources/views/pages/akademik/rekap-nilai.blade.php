@extends('layouts.main')

@section('title', 'Rekap Nilai')

@section('master')
    @php
        use App\Http\Controllers\AkadControllerKhs;
        use App\Http\Controllers\AkadControllerRekapNilai;
    @endphp
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="numbers">
                            <p class="text-md mb-0 text-uppercase font-weight-bold">Rekap Nilai</p>
                        </div>
                        <hr class="horizontal dark" />
                        @if ($data)
                            @foreach ($data['getDataTranskrip'] as $transkrip)
                                <div class="content controls">
                                    <div class="form-row">
                                        <div class="col-md-3">Nama</div>
                                        <div class="col-md-9">
                                            <b>{{ strtoupper($transkrip->NAMA) }}</b>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-3">NIM</div>
                                        <div class="col-md-9"><b>{{ $transkrip->NIM }}</b></div>
                                    </div>
                                </div>
                            @break
                        @endforeach

                        <div class="content" style="overflow-x: auto;">
                            <table cellpadding="0" cellspacing="0" width="100%"
                                class="table table-bordered table-striped sortable">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Kode MK</th>
                                        <th>Nama MK</th>
                                        <th>SKS</th>
                                        <th>Nilai</th>
                                        <th>N x SKS</th>
                                        <th>Ditempuh</th>
                                        <th>Histori Nilai</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $seq_number = 1; @endphp
                                    @foreach ($data['getDataTranskripDistinct'] as $transkrip_distinct)
                                        <tr align="center">
                                            <td height="18" align="right">{{ $seq_number }}</td>
                                            <td>{{ strtoupper($transkrip_distinct->KODE_MATAKULIAH) }}</td>
                                            <td align="left">{{ $transkrip_distinct->NAMA_MATAKULIAH }}</td>
                                            <td>{{ $transkrip_distinct->SKS }}</td>
                                            <td>
                                                @if ($data['boleh']->NILAI == 1)
                                                    @if ($transkrip)
                                                        {{ $transkrip->NILAI_AKHIR_HURUF ?? '-' }}
                                                    @else
                                                        -
                                                    @endif
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td align="center">
                                                @if ($transkrip)
                                                    @php
                                                        $kodeProdi = session('siam_user_prodi');
                                                        $nilaiInt = App\Http\Controllers\AkadControllerRekapNilai::alphabetToIntScoreNew($transkrip->NILAI_AKHIR_HURUF, $kodeProdi);
                                                    @endphp

                                                    @if ($nilaiInt !== null)
                                                        @php
                                                            $nk = $nilaiInt * $transkrip->SKS;
                                                        @endphp
                                                        {{ number_format($nk, 2, '.', ',') }}
                                                    @else
                                                        0
                                                    @endif
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td>
                                                @if ($transkrip)
                                                    {{ $countKuliah }}
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td align="center">
                                                @php $i = 0; @endphp
                                                @if ($data['boleh']->NILAI == 1)
                                                    @if ($histori_nilai)
                                                        @foreach ($histori_nilai as $value)
                                                            @php
                                                                $array[$i] = $value->NILAI_AKHIR_HURUF;
                                                                $i++;
                                                            @endphp
                                                        @endforeach
                                                        {{ implode(', ', $array) }}
                                                        @php unset($array); @endphp
                                                    @else
                                                        &nbsp;
                                                    @endif
                                                @else
                                                    -
                                                @endif
                                            </td>
                                        </tr>
                                        @php $seq_number++; @endphp
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="content tasks">
                            <div class="task-item priority-low">
                                <div class="task-item-content">
                                    <div class="task-item-head">Indeks Prestasi Kumulatif :
                                        @php
                                            $ipk = App\Http\Controllers\AkadControllerKhs::hitungIpk(auth()->user()->NIM, $thsms);
                                            echo $ipk['ipk'];
                                        @endphp
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="content controls">
                            <div class="head bg-siam bg-light-ltr">
                                <h2>Data tidak tersedia</h2>
                            </div>
                            <div class="content">
                                <h5>Message</h5>
                                <p>Data Transkrip Akademik tidak tersedia</p>
                                <p><b>Event type:</b> data is null<br><b>Page:</b> Lihat Transkrip Akademik</p>
                            </div>
                        </div>
                    @endif
                    {{-- Hapus blok ini
        @else
        <div class="content controls">
          <div class="head bg-siam bg-light-ltr">
            <h2>Halaman tidak dapat ditampilkan</h2>
          </div>
          <div class="content">
            <h5><img align='top' src="{{ site_url('images_siakad/deny.png') }}">&nbsp; rentang nilai belum didefinisikan oleh super user, harap hubungi Tim IT</h5>
                </div>
            </div>
            @endif
            --}}

                </div>
            </div>
        </div>
    @endsection

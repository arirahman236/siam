@extends('layouts.main')
@section('title')
{{ 'Profile' }}
@endsection
@php
use App\Models\AkademiModel;
use App\Http\Controllers\AkadControllerKrs;
use Carbon\Carbon;
@endphp
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
                                    <p class="text-md mb-0 text-uppercase font-weight-bold">Biodata</p>
                                </div>
                                <hr class="horizontal dark" />
                            </div>

                            <div class="row mt-2">
                                <div class="col-auto">
                                    <div class="avatar avatar-xl position-relative">
                                        <img src="/img/belum-ada-foto.jpg" alt="profile_image" class="w-100 border-radius-full shadow-sm">
                                    </div>
                                </div>
                                <div class="col-auto my-auto">
                                    <div class="h-100">
                                        <h6 class="mt-3 mb-1 d-md-block d-none">{{ auth()->user()->NAMA_MAHASISWA }}</h6>
                                        <p class="mb-0 text-xs font-weight-bolder text-warning text-gradient text-uppercase">{{ auth()->user()->NIM }}</p>
                                    </div>
                                </div>
                                <div class="col-auto ms-auto">
                                    <div class="btn-group">
                                        <a href="edit-profile" class="btn bg-gradient-info btn-clean">
                                            <i class="fas fa-edit"></i>
                                            Edit
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="content controls">
                            <div class="block">
                                <div class="nav-wrapper">
                                    <ul class="nav nav-pills nav-fill p-1" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link mb-0 px-0 py-1 active" data-bs-toggle="tab" href="#tab1" role="tab" aria-controls="data-mahasiswa" aria-selected="true">
                                                Data Mahasiswa
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link mb-0 px-0 py-1" data-bs-toggle="tab" href="#tab2" role="tab" aria-controls="data-keluarga" aria-selected="false">
                                                Data Keluarga
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link mb-0 px-0 py-1" data-bs-toggle="tab" href="#tab3" role="tab" aria-controls="data-feeder" aria-selected="false">
                                                Data Feeder
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="content content-transparent tab-content m-2">
                                    <div class="tab-pane active" id="tab1">
                                        <table class="table-responsive">
                                            <tbody>
                                                <tr>
                                                    <th class="col-md-3">Nama Lengkap</th>
                                                    <td class="col-md-9">{{ auth()->user()->NAMA_MAHASISWA }}</td>
                                                </tr>
                                                <tr>
                                                    <th class="col-md-3">Program Studi</th>
                                                    <td class="col-md-9">{{ ucwords(strtolower(auth()->user()->NAMA_PRODI)) }}</td>
                                                </tr>
                                                <tr>
                                                    <th class="col-md-3">NIM</th>
                                                    <td class="col-md-9">{{ auth()->user()->NIM }}</td>
                                                </tr>
                                                <tr>
                                                    <th class="col-md-3">Dosen Pembimbing</th>
                                                    <td class="col-md-9">{{ auth()->user()->DOSEN_PEMBIMBING . ' ' . auth()->user()->GELAR }}</td>
                                                </tr>
                                                <tr>
                                                    <th class="col-md-3">Tempat Lahir</th>
                                                    <td class="col-md-9">{{ auth()->user()->TEMPAT_LAHIR }}</td>
                                                </tr>
                                                <tr>
                                                    <th class="col-md-3">Tanggal Lahir</th>
                                                    <td class="col-md-9">{{ date('d-m-Y', strtotime(auth()->user()->TGL_LAHIR)) }}</td>
                                                </tr>
                                                <tr>
                                                    <th class="col-md-3">Status Registrasi</th>
                                                    <td class="col-md-9">
                                                        @php
                                                        $warna = auth()->user()->STATUS_REGISTRASI == 0 ? 'red' : 'green';
                                                        @endphp
                                                        <span style="color:{{ $warna }};">
                                                            <b>{{ auth()->user()->DESKRIPSI_STATUS_REGISTRASI }}</b>
                                                        </span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th class="col-md-3">Jenis Kelamin</th>
                                                    <td class="col-md-9">{{ ucwords(strtolower(auth()->user()->JENIS_KELAMIN)) }}</td>
                                                </tr>
                                                <tr>
                                                    <th class="col-md-3">Agama</th>
                                                    <td class="col-md-9">{{ ucwords(strtolower(auth()->user()->AGAMA)) }}</td>
                                                </tr>
                                                <tr>
                                                    <th class="col-md-3">Alamat Asal</th>
                                                    <td class="col-md-9">{{ auth()->user()->ALAMAT_ASAL }}</td>
                                                </tr>
                                                <tr>
                                                    <th class="col-md-3">Alamat Sekarang</th>
                                                    <td class="col-md-9">{{ auth()->user()->ALAMAT }}</td>
                                                </tr>
                                                <tr>
                                                    <th class="col-md-3">Nomor Telepon</th>
                                                    <td class="col-md-9">{{ auth()->user()->NO_TELP }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="tab-pane" id="tab2">
                                        <table class="table-responsive">
                                            <tbody>
                                                <tr>
                                                    <th class="col-md-3">Nama Ayah</th>
                                                    <td class="col-md-9">{{ auth()->user()->NAMA_AYAH }}</td>
                                                </tr>
                                                <tr>
                                                    <th class="col-md-3">Nama Ibu</th>
                                                    <td class="col-md-9">{{ auth()->user()->NAMA_IBU }}</td>
                                                </tr>
                                                <tr>
                                                    <th class="col-md-3">Pekerjaan Ayah</th>
                                                    <td class="col-md-9">{{ !empty(auth()->user()->PEKERJAAN_AYAH) ? auth()->user()->PEKERJAAN_AYAH : '-' }}</td>
                                                </tr>
                                                <tr>
                                                    <th class="col-md-3">Pekerjaan Ibu</th>
                                                    <td class="col-md-9">{{ !empty(auth()->user()->PEKERJAAN_IBU) ? auth()->user()->PEKERJAAN_IBU : '-' }}</td>
                                                </tr>
                                                <tr>
                                                    <th class="col-md-3">Penghasilan Ayah</th>
                                                    <td class="col-md-9">
                                                        @php $penghasilan_ayah = 'Rp. '.number_format(auth()->user()->PENGHASILAN_AYAH, 2, ',', '.'); @endphp
                                                        {{ !empty(auth()->user()->PENGHASILAN_AYAH) ? $penghasilan_ayah : '-' }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th class="col-md-3">Penghasilan Ibu</th>
                                                    <td class="col-md-9">
                                                        @php $penghasilan_ibu = 'Rp. '.number_format(auth()->user()->PENGHASILAN_IBU, 2, ',', '.'); @endphp
                                                        {{ !empty(auth()->user()->PENGHASILAN_IBU) ? $penghasilan_ibu : '-' }}
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="tab-pane" id="tab3">
                                        <table class="table-responsive">
                                            <tbody>
                                                <tr>
                                                    <th class="col-md-3">NIK</th>
                                                    <td class="col-md-9">{{ $data['feeder']->NIK }}</td>
                                                </tr>
                                                <tr>
                                                    <th class="col-md-3">Alamat Asal RT/RW</th>
                                                    <td class="col-md-9">{{ $data['feeder']->RT }} / {{ $data['feeder']->RW }}</td>
                                                </tr>
                                                <tr>
                                                    <th class="col-md-3">Dusun Asal</th>
                                                    <td class="col-md-9">{{ $data['feeder']->DUSUN }}</td>
                                                </tr>
                                                <tr>
                                                    <th class="col-md-3">Kelurahan Asal</th>
                                                    <td class="col-md-9">{{ $data['feeder']->KELURAHAN }}</td>
                                                </tr>
                                                <tr>
                                                    <th class="col-md-3">Kecamatan Asal</th>
                                                    <td class="col-md-9">{{ $data['feeder']->KECAMATAN }}</td>
                                                </tr>
                                                <tr>
                                                    <th class="col-md-3">Kode Pos Asal</th>
                                                    <td class="col-md-9">{{ $data['feeder']->KODE_POS }}</td>
                                                </tr>
                                                <tr>
                                                    <th class="col-md-3">Jenis Tinggal</th>
                                                    <td class="col-md-9">
                                                        @if ($data['feeder']->JENIS_TINGGAL == 1)
                                                        Bersama Orang Tua
                                                        @elseif($data['feeder']->JENIS_TINGGAL == 2)
                                                        Bersama Wali
                                                        @elseif($data['feeder']->JENIS_TINGGAL == 3)
                                                        Kost
                                                        @elseif($data['feeder']->JENIS_TINGGAL == 4)
                                                        Asrama
                                                        @elseif($data['feeder']->JENIS_TINGGAL == 5)
                                                        Panti Asuhan
                                                        @elseif($data['feeder']->JENIS_TINGGAL == 99)
                                                        Bersama Wali
                                                        @endif
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th class="col-md-3">HP</th>
                                                    <td class="col-md-9">{{ $data['feeder']->HP }}</td>
                                                </tr>
                                                <tr>
                                                    <th class="col-md-3">Penerimaan KPS</th>
                                                    <td class="col-md-9">{{ $data['feeder']->PENERIMA_KPS }}</td>
                                                </tr>
                                                <tr>
                                                    <th class="col-md-3">Tanggal Lahir Ayah</th>
                                                    <td class="col-md-9">
                                                        <?php if ($data['feeder']->TANGGAL_LAHIR_AYAH != "0000-00-00") : ?>
                                                            <?php echo Carbon::parse($data['feeder']->TANGGAL_LAHIR_AYAH)->translatedFormat('l, j F Y'); ?>
                                                        <?php endif ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th class="col-md-3">Pendidikan Ayah</th>
                                                    <td class="col-md-9">{{ $data['feeder']->PENDIDIKAN_AYAH }}</td>
                                                </tr>
                                                <tr>
                                                    <th class="col-md-3">Tanggal Lahir Ibu</th>
                                                    <td class="col-md-9">
                                                        <?php if ($data['feeder']->TANGGAL_LAHIR_IBU != "0000-00-00") : ?>
                                                            <?php echo Carbon::parse($data['feeder']->TANGGAL_LAHIR_IBU)->translatedFormat('l, j F Y'); ?>
                                                        <?php endif ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th class="col-md-3">Pendidikan Ibu</th>
                                                    <td class="col-md-9">{{ $data['feeder']->PENDIDIKAN_IBU }}</td>
                                                </tr>
                                                <tr>
                                                    <th class="col-md-3">Nama Wali</th>
                                                    <td class="col-md-9">{{ $data['feeder']->NAMA_WALI }}</td>
                                                </tr>
                                                <tr>
                                                    <th class="col-md-3">Tanggal Lahir Wali</th>
                                                    <td class="col-md-9">
                                                        <?php if ($data['feeder']->TANGGAL_LAHIR_WALI != "0000-00-00") : ?>
                                                            <?php echo Carbon::parse($data['feeder']->TANGGAL_LAHIR_WALI)->translatedFormat('l, j F Y'); ?>
                                                        <?php endif ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th class="col-md-3">Pendidikan Wali</th>
                                                    <td class="col-md-9">{{ $data['feeder']->PENDIDIKAN_WALI }}</td>
                                                </tr>
                                                <tr>
                                                    <th class="col-md-3">Pekerjaan Wali</th>
                                                    <td class="col-md-9">{{ $data['feeder']->PEKERJAAN_WALI }}</td>
                                                </tr>
                                                <tr>
                                                    <th class="col-md-3">Penghasilan Wali</th>
                                                    <td class="col-md-9">{{ $data['hasil']->NM_PENGHASILAN }}</td>
                                                </tr>
                                                <tr>
                                                    <th class="col-md-3">Jenis Pendaftaran</th>
                                                    <td class="col-md-9">
                                                        {{ $data['jns_daftar']->NM_JNS_DAFTAR ?? '' }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th class="col-md-3">Jenis Keluar</th>
                                                    <td class="col-md-9">
                                                        {{ $data['jns_keluar']->KET_KELUAR ?? '' }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th class="col-md-3">Keterangan</th>
                                                    <td class="col-md-9">{{ $data['mhs_pt']->KET ?? '' }}</td>
                                                </tr>
                                                <tr>
                                                    <th class="col-md-3">No SKHUN</th>
                                                    <td class="col-md-9">{{ $data['mhs_pt']->SKHUN ?? '' }}</td>
                                                </tr>
                                                <tr>
                                                    <th class="col-md-3">Pernah Paud</th>
                                                    <td class="col-md-9">
                                                        @if ($data['mhs_pt'] == null)
                                                        Tidak Pernah
                                                        @elseif($data['mhs_pt']->A_PERNAH_PAUD == 0)
                                                        Tidak Pernah
                                                        @elseif($data['mhs_pt']->A_PERNAH_PAUD == 1)
                                                        Pernah
                                                        @endif
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th class="col-md-3">Pernah TK</th>
                                                    <td class="col-md-9">
                                                        @if ($data['mhs_pt'] == null)
                                                        Tidak Pernah
                                                        @elseif($data['mhs_pt']->A_PERNAH_TK == 0)
                                                        Tidak Pernah
                                                        @elseif($data['mhs_pt']->A_PERNAH_TK == 1)
                                                        Pernah
                                                        @endif
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th class="col-md-3">Jalur Skripsi</th>
                                                    <td class="col-md-9">
                                                        @if ($data['mhs_pt'] == null)
                                                        Tidak Pernah
                                                        @elseif($data['mhs_pt']->JALUR_SKRIPSI == 0)
                                                        Tidak Pernah
                                                        @elseif($data['mhs_pt']->JALUR_SKRIPSI == 1)
                                                        Pernah
                                                        @endif
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th class="col-md-3">Judul Skripsi</th>
                                                    <td class="col-md-9">
                                                        {{ $data['mhs_pt']->JUDUL_SKRIPSI ?? 'Tidak Pernah' }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th class="col-md-3">Bulan Awal Bimbingan</th>
                                                    <td class="col-md-9">
                                                        @if ($data['mhs_pt'] == null)
                                                        0000-00-00
                                                        @elseif($data['mhs_pt']->BLN_AWAL_BIMBINGAN)
                                                        {{ Carbon::parse($data['mhs_pt']->BLN_AWAL_BIMBINGAN) }}
                                                        @endif
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th class="col-md-3">Bulan Akhir Bimbingan</th>
                                                    <td class "col-md-9">
                                                        @if ($data['mhs_pt'] == null)
                                                        0000-00-00
                                                        @elseif($data['mhs_pt']->BLN_AKHIR_BIMBINGAN)
                                                        {{ Carbon::parse($data['mhs_pt']->BLN_AKHIR_BIMBINGAN) }}
                                                        @endif
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th class="col-md-3">SK Yudisium</th>
                                                    <td class="col-md-9">
                                                        {{ $data['mhs_pt']->SK_YUDISIUM ?? '-' }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th class="col-md-3">Tanggal SK Yudisium</th>
                                                    <td class="col-md-9">
                                                        @if ($data['mhs_pt'] == null)
                                                        0000-00-00
                                                        @elseif($data['mhs_pt']->TGL_SK_YUDISIUM)
                                                        {{ Carbon::parse($data['mhs_pt']->TGL_SK_YUDISIUM) }}
                                                        @endif
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th class="col-md-3">IPK</th>
                                                    <td class="col-md-9">{{ $data['mhs_pt']->IPK ?? '-' }}</td>
                                                </tr>
                                                <tr>
                                                    <th class="col-md-3">Sertifikasi Profesi</th>
                                                    <td class="col-md-9">{{ $data['mhs_pt']->SERT_PROF ?? '-' }}</td>
                                                </tr>
                                                <tr>
                                                    <th class="col-md-3">Mahasiswa Asing</th>
                                                    <td class="col-md-9">
                                                        @if ($data['mhs_pt'] == null)
                                                        Tidak Pernah
                                                        @elseif($data['mhs_pt']->A_PINDAH_MHS_ASING == 0)
                                                        Tidak
                                                        @elseif($data['mhs_pt']->A_PINDAH_MHS_ASING == 1)
                                                        Ya
                                                        @endif
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
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
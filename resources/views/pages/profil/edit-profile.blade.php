@extends('layouts.main')
@section('title')
{{ 'Profile' }}
@endsection

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
                                    <p class="text-md mb-0 text-uppercase font-weight-bold"> Edit Biodata</p>
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

                            </div>
                            <div class="content controls">
                                <div class="block">
                                    <div class="nav-wrapper">
                                        <ul class="nav nav-pills nav-fill p-1" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link mb-0 px-0 py-1 active" data-bs-toggle="tab" href="#tab1" role="tab" aria-controls="data-mahasiswa" aria-selected="true">
                                                    Edit Biodata
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link mb-0 px-0 py-1" data-bs-toggle="tab" href="#tab2" role="tab" aria-controls="data-feeder" aria-selected="false">
                                                    Edit Password Akun
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="content content-transparent tab-content m-2">
                                        <div class="tab-pane active" id="tab1">
                                            <form method="post" action="{{ route('update_profile') }}">
                                                @csrf
                                                <div class="content controls">
                                                    {{-- Data Mahasiswa --}}
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <h4>Data Mahasiswa</h4>
                                                        </div>
                                                    </div>
                                                    <div class="row my-2">
                                                        <div class="col-md-3">Nama Lengkap</div>
                                                        <div class="col-md-9">
                                                            {{ auth()->user()->NAMA_MAHASISWA }}
                                                        </div>
                                                    </div>
                                                    <div class="row my-2">
                                                        <div class="col-md-3">Program Studi</div>
                                                        <div class="col-md-9">
                                                            {{ ucwords(strtolower(auth()->user()->NAMA_PRODI)) }}
                                                        </div>
                                                    </div>
                                                    <div class="row my-2">
                                                        <div class="col-md-3">NIM</div>
                                                        <div class="col-md-9">
                                                            {{ auth()->user()->NIM }}
                                                        </div>
                                                    </div>
                                                    <div class="row my-2">
                                                        <div class="col-md-3">Dosen Pembimbing</div>
                                                        <div class="col-md-9">
                                                            {{ auth()->user()->DOSEN_PEMBIMBING . ' ' . auth()->user()->GELAR }}
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-3 my-2">Tempat Lahir&nbsp;<span style='color:red'>*Wajib</span></div>
                                                        <div class="col-md-9">
                                                            <div class="form-group">
                                                                <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" placeholder="{{ old('tempat_lahir', isset(auth()->user()->TEMPAT_LAHIR) ? strtoupper(strtolower(auth()->user()->TEMPAT_LAHIR)) : '') }}
                                                                            " required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-3 my-2">Tanggal Lahir&nbsp;<span style='color:red'>*Wajib</span></div>
                                                        @php
                                                        $tgl = date('d', strtotime(auth()->user()->TGL_LAHIR));
                                                        $bln = date('m', strtotime(auth()->user()->TGL_LAHIR));
                                                        $thn = date('Y', strtotime(auth()->user()->TGL_LAHIR));
                                                        @endphp

                                                        <div class="col-md-2">
                                                            <div class="form-group">
                                                                <select name="tgl_lahir" id="tgl_lahir" onchange="return checkDate('tgl_lahir', 'bln_lahir', 'thn_lahir');" class="form-control">
                                                                    @for ($i = 1; $i <= 31; $i++) <option value="{{ $i }}" {{ old('tgl_lahir', isset($tgl) ? $tgl : '') == $i ? 'selected' : '' }}>
                                                                        {{ $i }}</option>
                                                                        @endfor
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <select name="bln_lahir" id="bln_lahir" onchange="return checkDate('tgl_lahir', 'bln_lahir', 'thn_lahir');" class="form-control">
                                                                    @for ($i = 1; $i <= 12; $i++) <option value="{{ $i }}" {{ old('bln_lahir', isset($bln) ? $bln : '') == $i ? 'selected' : '' }}>
                                                                        {{ $i }}</option>
                                                                        @endfor
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <div class="form-group">
                                                                <select name="thn_lahir" id="thn_lahir" onchange="return checkDate('tgl_lahir', 'bln_lahir', 'thn_lahir');" class="form-control">
                                                                    @for ($i = 1940; $i <= date('Y'); $i++) <option value="{{ $i }}" {{ old('thn_lahir', isset($thn) ? $thn : '') == $i ? 'selected' : '' }}>
                                                                        {{ $i }}</option>
                                                                        @endfor
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-3">Status Registrasi</div>
                                                        <div class="col-md-9">
                                                            <div class="form-group">
                                                                @php
                                                                $warna = auth()->user()->STATUS_REGISTRASI == 0 ? 'red' : 'green';
                                                                @endphp
                                                                <span style="color:{{ $warna }};">
                                                                    <b>{{ auth()->user()->DESKRIPSI_STATUS_REGISTRASI }}</b>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-3 my-2">Jenis Kelamin</div>
                                                        <div class="col-md-9">
                                                            {{ ucwords(strtolower(auth()->user()->JENIS_KELAMIN)) }}
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-3 my-2">Agama&nbsp;<span style='color:red'>*Wajib</span></div>
                                                        <div class="col-md-9">
                                                            <div class="form-group">
                                                                <select name="agama" id="agama" style="width:100%" class="select2 form-control">
                                                                    <option {{ $data['feeder'] && $data['feeder']->KODE_AGAMA == '1' ? 'selected' : '' }} value="1">Islam</option>
                                                                    <option {{ $data['feeder'] && $data['feeder']->KODE_AGAMA == '2' ? 'selected' : '' }} value="2">Kristen</option>
                                                                    <option {{ $data['feeder'] && $data['feeder']->KODE_AGAMA == '3' ? 'selected' : '' }} value="3">Katolik</option>
                                                                    <option {{ $data['feeder'] && $data['feeder']->KODE_AGAMA == '4' ? 'selected' : '' }} value="4">Hindu</option>
                                                                    <option {{ $data['feeder'] && $data['feeder']->KODE_AGAMA == '5' ? 'selected' : '' }} value="5">Budha</option>
                                                                    <option {{ $data['feeder'] && $data['feeder']->KODE_AGAMA == '6' ? 'selected' : '' }} value="6">Konghuchu</option>
                                                                    <option {{ $data['feeder'] && $data['feeder']->KODE_AGAMA == '7' ? 'selected' : '' }} value="7">Lain-lain</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-3 my-2">Alamat Asal&nbsp;<span style='color:red'>*Wajib</span></div>
                                                        <div class="col-md-9">
                                                            <div class="form-group">
                                                                <input type="text" class="form-control" id="alamat_asal" name="alamat_asal" placeholder="{{ old('alamat_asal', isset(auth()->user()->ALAMAT_ASAL) ? auth()->user()->ALAMAT_ASAL : '') }}" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-3 my-2">Alamat Sekarang&nbsp;<span style='color:red'>*Wajib</span></div>
                                                        <div class="col-md-9">
                                                            <div class="form-group">
                                                                <input type="text" class="form-control" id="alamat_sekarang" name="alamat_sekarang" placeholder="{{ old('alamat', isset(auth()->user()->ALAMAT) ? auth()->user()->ALAMAT : '') }}" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-3 my-2">Nomor Telepon&nbsp;<span style='color:red'>*Wajib</span></div>
                                                        <div class="col-md-9">
                                                            <div class="form-group">
                                                                <input type="number" class="form-control" id="no_telp" name="no_telp" placeholder="{{ old('no_telp', isset(auth()->user()->NO_TELP) ? auth()->user()->NO_TELP : '') }}" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                {{-- Data Keluarga --}}
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <h4>Data Keluarga</h4>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-3 my-2">Nama Ayah&nbsp;<span style='color:red'>*Wajib</span></div>
                                                    <div class="col-md-9">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" id="nama_ayah" name="nama_ayah" placeholder="{{ old('nama_ayah', isset(auth()->user()->NAMA_AYAH) ? auth()->user()->NAMA_AYAH : '') }}" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-3 my-2">Nama Ibu&nbsp;<span style='color:red'>*Wajib</span></div>
                                                    <div class="col-md-9">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" id="nama_ibu" name="nama_ibu" placeholder="{{ old('nama_ibu', isset(auth()->user()->NAMA_IBU) ? auth()->user()->NAMA_IBU : '') }}" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-3 my-2">Pekerjaan Ayah&nbsp;<span style='color:red'>*Wajib</span></div>
                                                    <div class="col-md-9">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" id="pekerjaan_ayah" name="pekerjaan_ayah" placeholder="{{ old('pekerjaan_ayah', isset(auth()->user()->PEKERJAAN_AYAH) ? auth()->user()->PEKERJAAN_AYAH : '') }}" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-3 my-2">Pekerjaan Ibu&nbsp;<span style='color:red'>*Wajib</span></div>
                                                    <div class="col-md-9">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" id="pekerjaan_ibu" name="pekerjaan_ibu" placeholder="{{ old('pekerjaan_ibu', isset(auth()->user()->PEKERJAAN_IBU) ? auth()->user()->PEKERJAAN_IBU : '') }}" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-3 my-2">Penghasilan Ayah&nbsp;<span style='color:red'>*Wajib</span></div>
                                                    <div class="col-md-9">
                                                        <div class="form-group input-group">
                                                            <span class="input-group-text">Rp</span>
                                                            <input type="number" class="form-control" id="penghasilan_ayah" name="penghasilan_ayah" aria-label="Amount (to the nearest dollar)" placeholder="{{ old('penghasilan_ayah', isset(auth()->user()->PENGHASILAN_AYAH) ? auth()->user()->PENGHASILAN_AYAH : '') }}" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-3 my-2">Penghasilan Ibu&nbsp;<span style='color:red'>*Wajib</span></div>
                                                    <div class="col-md-9">
                                                        <div class="form-group input-group">
                                                            <span class="input-group-text">Rp</span>
                                                            <input type="number" class="form-control" id="penghasilan_ibu" name="penghasilan_ibu" aria-label="Amount (to the nearest dollar)" placeholder="{{ old('penghasilan_ibu', isset(auth()->user()->PENGHASILAN_IBU) ? auth()->user()->PENGHASILAN_IBU : '') }}" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                {{-- Data Feeder --}}
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <h4>Data Feeder</h4>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-3 my-2">NIK&nbsp;<span style='color:red'>*Wajib</span></div>
                                                    <div class="col-md-9">
                                                        <div class="form-group">
                                                            <input type="number" class="form-control" id="nik" name="nik" placeholder="{{ $data['feeder'] ? $data['feeder']->NIK : '' }}" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-3 my-2">Alamat Asal&nbsp;<span style='color:red'>*Wajib</span></div>
                                                    <div class="col-md-1 my-2">
                                                        RT
                                                    </div>
                                                    <div class="col-md-1">
                                                        <div class="form-group">
                                                            <input type="text" required="" name="rt" id="rt" value="{{ $data['feeder'] ? $data['feeder']->RT : '' }}" class="data_input form-control" style="width:50px;" placeholder="RT" />
                                                        </div>
                                                    </div>
                                                    <div class="col-md-1 my-2">
                                                        RW
                                                    </div>
                                                    <div class="col-md-1">
                                                        <div class="form-group">
                                                            <input type="text" required="" name="rw" id="rw" value="{{ $data['feeder'] ? $data['feeder']->RW : '' }}" class="data_input form-control" style="width:50px;" placeholder="RW" />
                                                            <div class="form-group">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-3 my-2">Dusun Asal&nbsp;<span style='color:red'>*Wajib</span></div>
                                                    <div class="col-md-9">
                                                        <div class="form-group">
                                                            <input type="text" required class="form-control" id="dusun" name="dusun" placeholder="{{ $data['feeder'] ? $data['feeder']->DUSUN : '' }}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-3 my-2">Kelurahan Asal&nbsp;<span style='color:red'>*Wajib</span></div>
                                                    <div class="col-md-9">
                                                        <div class="form-group">
                                                            <input type="text" required class="form-control" id="kelurahan" name="kelurahan" placeholder="{{ $data['feeder'] ? $data['feeder']->KELURAHAN : '' }}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-3 my-2">Kecamatan Asal&nbsp;<span style='color:red'>*Wajib</span></div>
                                                    <div class="col-md-9">
                                                        <div class="form-group">
                                                            <input type="text" required class="form-control" id="kecamatan" name="kecamatan" placeholder="{{ $data['feeder'] ? $data['feeder']->KECAMATAN : '' }}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-3 my-2">Kode Pos Asal&nbsp;<span style='color:red'>*Wajib</span></div>
                                                    <div class="col-md-9">
                                                        <div class="form-group">
                                                            <input type="number" required class="form-control" id="kode_pos" name="kode_pos" placeholder="{{ $data['feeder'] ? $data['feeder']->KODE_POS : '' }}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-3 my-2">Jenis Tinggal&nbsp;<span style='color:red'>*Wajib</span></div>
                                                    <div class="col-md-9">
                                                        <div class="form-group">
                                                            <select name="jenis_tinggal" id="jenis_tinggal" style="width:100%" class="select2 form-control">
                                                                <option {{ $data['feeder'] && $data['feeder']->JENIS_TINGGAL == '1' ? 'selected' : '' }} value="1">Bersama Orang Tua</option>
                                                                <option {{ $data['feeder'] && $data['feeder']->JENIS_TINGGAL == '2' ? 'selected' : '' }} value="2">Bersama Wali</option>
                                                                <option {{ $data['feeder'] && $data['feeder']->JENIS_TINGGAL == '3' ? 'selected' : '' }} value="3">Kost</option>
                                                                <option {{ $data['feeder'] && $data['feeder']->JENIS_TINGGAL == '4' ? 'selected' : '' }} value="4">Asrama</option>
                                                                <option {{ $data['feeder'] && $data['feeder']->JENIS_TINGGAL == '5' ? 'selected' : '' }} value="5">Panti Asuhan</option>
                                                                <option {{ $data['feeder'] && $data['feeder']->JENIS_TINGGAL == '99' ? 'selected' : '' }} value="99">Lainnya</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-3 my-2">HP&nbsp;<span style='color:red'>*Wajib</span></div>
                                                    <div class="col-md-9">
                                                        <div class="form-group">
                                                            <input type="number" required class="form-control" id="hp" name="hp" placeholder="{{ $data['feeder'] ? $data['feeder']->HP : '' }}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-3 my-2">Penerimaan KPS&nbsp;<span style='color:red'>*Wajib</span></div>
                                                    <div class="col-md-9">
                                                        <div class="form-group">
                                                            <select name="penerima_kps" id="penerima_kps" style="width:100%" class="select2 form-control">
                                                                <option {{ $data['feeder'] && $data['feeder']->PENERIMA_KPS == 'YA' ? 'selected' : '' }} value="YA">YA</option>
                                                                <option {{ $data['feeder'] && $data['feeder']->PENERIMA_KPS == 'TIDAK' ? 'selected' : '' }} value="TIDAK">TIDAK</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-3 my-2">Tanggal Lahir
                                                        Ayah&nbsp;<span style='color:red'>*Wajib</span>
                                                    </div>
                                                    <?php
                                                    $js_tgl_ayah = 'id="tgl_lahir_ayah" onchange="return checkDate(\'tgl_lahir_ayah\',\'bln_lahir_ayah\',\'thn_lahir_ayah\");';
                                                    $js_bln_ayah = 'id="bln_lahir_ayah" onchange="return checkDate(\'tgl_lahir_ayah\',\'bln_lahir_ayah\',\'thn_lahir_ayah\");';
                                                    $js_thn_ayah = 'id="thn_lahir_ayah" onchange="return checkDate(\'tgl_lahir_ayah\',\'bln_lahir_ayah\',\'thn_lahir_ayah\");';
                                                    if ($data['feeder']) {
                                                        $all = explode('-', $data['feeder']->TANGGAL_LAHIR_AYAH);
                                                        $tanggal_ayah = $all[2];
                                                        $bulan_ayah = $all[1];
                                                        $tahun_ayah = $all[0];
                                                    } else {
                                                        $tanggal_ayah = '';
                                                        $bulan_ayah = '';
                                                        $tahun_ayah = '';
                                                    }
                                                    ?>
                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <select name="tgl_lahir_ayah" id="tgl_lahir_ayah" onchange="return checkDate('tgl_lahir_ayah', 'bln_lahir_ayah', 'thn_lahir_ayah');" class="form-control">
                                                                @for ($i = 1; $i <= 31; $i++) <option value="{{ $i }}" {{ old('tgl_lahir_ayah', isset($tanggal_ayah) ? $tanggal_ayah : '') == $i ? 'selected' : '' }}>
                                                                    {{ $i }}
                                                                    </option>
                                                                    @endfor
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <select name="bln_lahir_ayah" id="bln_lahir_ayah" onchange="return checkDate('tgl_lahir_ayah', 'bln_lahir_ayah', 'thn_lahir_ayah');" class="form-control">
                                                                @for ($i = 1; $i <= 12; $i++) <option value="{{ $i }}" {{ old('bln_lahir_ayah', isset($bulan_ayah) ? $bulan_ayah : '') == $i ? 'selected' : '' }}>
                                                                    {{ $i }}
                                                                    </option>
                                                                    @endfor
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <select name="thn_lahir_ayah" id="thn_lahir_ayah" onchange="return checkDate('tgl_lahir_ayah', 'bln_lahir_ayah', 'thn_lahir_ayah');" class="form-control">
                                                                @for ($i = 1940; $i <= date('Y'); $i++) <option value="{{ $i }}" {{ old('thn_lahir_ayah', isset($tahun_ayah) ? $tahun_ayah : '') == $i ? 'selected' : '' }}>
                                                                    {{ $i }}
                                                                    </option>
                                                                    @endfor
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-3 my-2">Pendidikan Ayah&nbsp;<span style='color:red'>*Wajib</span></div>
                                                    <div class="col-md-9">
                                                        <div class="form-group">
                                                            <select name="pendidikan_ayah" id="pendidikan_ayah" style="width:100%" class="select2 form-control">
                                                                <option {{ $data['feeder'] && $data['feeder']->PENDIDIKAN_AYAH == 'pasca_sarjana' ? 'selected' : '' }} value="pasca_sarjana">Pasca Sarjana
                                                                </option>
                                                                <option {{ $data['feeder'] && $data['feeder']->PENDIDIKAN_AYAH == 'sarjana' ? 'selected' : '' }} value="sarjana">Sarjana</option>
                                                                <option {{ $data['feeder'] && $data['feeder']->PENDIDIKAN_AYAH == 'diploma' ? 'selected' : '' }} value="diploma">Diploma</option>
                                                                <option {{ $data['feeder'] && $data['feeder']->PENDIDIKAN_AYAH == 'sma' ? 'selected' : '' }} value="sma">SMA</option>
                                                                <option {{ $data['feeder'] && $data['feeder']->PENDIDIKAN_AYAH == 'smp' ? 'selected' : '' }} value="smp">SMP</option>
                                                                <option {{ $data['feeder'] && $data['feeder']->PENDIDIKAN_AYAH == 'sd' ? 'selected' : '' }} value="sd">SD</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-3 my-2">Tanggal Lahir
                                                        Ibu&nbsp;<span style='color:red'>*Wajib</span>
                                                    </div>
                                                    <?php
                                                    $js_tgl_ibu = 'id="tgl_lahir_ibu" onchange="return checkDate(\'tgl_lahir_ibu\',\'bln_lahir_ibu\',\'thn_lahir_ibu\");';
                                                    $js_bln_ibu = 'id="bln_lahir_ibu" onchange="return checkDate(\'tgl_lahir_ibu\',\'bln_lahir_ibu\',\'thn_lahir_ibu\");';
                                                    $js_thn_ibu = 'id="thn_lahir_ibu" onchange="return checkDate(\'tgl_lahir_ibu\',\'bln_lahir_ibu\',\'thn_lahir_ibu\");';
                                                    if ($data['feeder']) {
                                                        $all = explode('-', $data['feeder']->TANGGAL_LAHIR_IBU);
                                                        $tanggal_ibu = $all[2];
                                                        $bulan_ibu = $all[1];
                                                        $tahun_ibu = $all[0];
                                                    } else {
                                                        $tanggal_ibu = '';
                                                        $bulan_ibu = '';
                                                        $tahun_ibu = '';
                                                    }
                                                    ?>
                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <select name="tgl_lahir_ibu" id="tgl_lahir_ibu" onchange="return checkDate('tgl_lahir_ibu', 'bln_lahir_ibu', 'thn_lahir_ibu');" class="form-control">
                                                                @for ($i = 1; $i <= 31; $i++) <option value="{{ $i }}" {{ old('tgl_lahir_ibu', isset($tanggal_ibu) ? $tanggal_ibu : '') == $i ? 'selected' : '' }}>
                                                                    {{ $i }}
                                                                    </option>
                                                                    @endfor
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <select name="bln_lahir_ibu" id="bln_lahir_ibu" onchange="return checkDate('tgl_lahir_ibu', 'bln_lahir_ibu', 'thn_lahir_ibu');" class="form-control">
                                                                @for ($i = 1; $i <= 12; $i++) <option value="{{ $i }}" {{ old('bln_lahir_ibu', isset($bulan_ibu) ? $bulan_ibu : '') == $i ? 'selected' : '' }}>
                                                                    {{ $i }}
                                                                    </option>
                                                                    @endfor
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <select name="thn_lahir_ibu" id="thn_lahir_ibu" onchange="return checkDate('tgl_lahir_ibu', 'bln_lahir_ibu', 'thn_lahir_ibu');" class="form-control">
                                                                @for ($i = 1940; $i <= date('Y'); $i++) <option value="{{ $i }}" {{ old('thn_lahir_ibu', isset($tahun_ibu) ? $tahun_ibu : '') == $i ? 'selected' : '' }}>
                                                                    {{ $i }}
                                                                    </option>
                                                                    @endfor
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-3 my-2">Pendidikan Ibu&nbsp;<span style='color:red'>*Wajib</span></div>
                                                    <div class="col-md-9">
                                                        <div class="form-group">
                                                            <select name="pendidikan_ibu" id="pendidikan_ibu" style="width:100%" class="select2 form-control">
                                                                <option {{ $data['feeder'] && $data['feeder']->PENDIDIKAN_IBU == 'pasca_sarjana' ? 'selected' : '' }} value="pasca_sarjana">Pasca Sarjana
                                                                </option>
                                                                <option {{ $data['feeder'] && $data['feeder']->PENDIDIKAN_IBU == 'sarjana' ? 'selected' : '' }} value="sarjana">Sarjana</option>
                                                                <option {{ $data['feeder'] && $data['feeder']->PENDIDIKAN_IBU == 'diploma' ? 'selected' : '' }} value="diploma">Diploma</option>
                                                                <option {{ $data['feeder'] && $data['feeder']->PENDIDIKAN_IBU == 'sma' ? 'selected' : '' }} value="sma">SMA</option>
                                                                <option {{ $data['feeder'] && $data['feeder']->PENDIDIKAN_IBU == 'smp' ? 'selected' : '' }} value="smp">SMP</option>
                                                                <option {{ $data['feeder'] && $data['feeder']->PENDIDIKAN_IBU == 'sd' ? 'selected' : '' }} value="sd">SD</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-3 my-2">Nama Wali</div>
                                                    <div class="col-md-9">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" id="nama_wali" placeholder="{{ $data['feeder'] ? $data['feeder']->NAMA_WALI : '' }}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-3 my-2">Tanggal Lahir
                                                        Wali
                                                    </div>
                                                    <?php
                                                    $js_tgl_wali = 'id="tgl_lahir_wali" onchange="return checkDate(\'tgl_lahir_wali\',\'bln_lahir_wali\',\'thn_lahir_wali\");';
                                                    $js_bln_wali = 'id="bln_lahir_wali" onchange="return checkDate(\'tgl_lahir_wali\',\'bln_lahir_wali\',\'thn_lahir_wali\");';
                                                    $js_thn_wali = 'id="thn_lahir_wali" onchange="return checkDate(\'tgl_lahir_wali\',\'bln_lahir_wali\',\'thn_lahir_wali\");';
                                                    if ($data['feeder']) {
                                                        $all = explode('-', $data['feeder']->TANGGAL_LAHIR_WALI);
                                                        $tanggal_wali = $all[2];
                                                        $bulan_wali = $all[1];
                                                        $tahun_wali = $all[0];
                                                    } else {
                                                        $tanggal_wali = '';
                                                        $bulan_wali = '';
                                                        $tahun_wali = '';
                                                    }
                                                    ?>
                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <select name="tgl_lahir_wali" id="tgl_lahir_wali" onchange="return checkDate('tgl_lahir_wali', 'bln_lahir_wali', 'thn_lahir_wali');" class="form-control">
                                                                @for ($i = 1; $i <= 31; $i++) <option value="{{ $i }}" {{ old('tgl_lahir_wali', isset($tanggal_wali) ? $tanggal_wali : '') == $i ? 'selected' : '' }}>
                                                                    {{ $i }}
                                                                    </option>
                                                                    @endfor
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <select name="bln_lahir_wali" id="bln_lahir_wali" onchange="return checkDate('tgl_lahir_wali', 'bln_lahir_wali', 'thn_lahir_wali');" class="form-control">
                                                                @for ($i = 1; $i <= 12; $i++) <option value="{{ $i }}" {{ old('bln_lahir_wali', isset($bulan_wali) ? $bulan_wali : '') == $i ? 'selected' : '' }}>
                                                                    {{ $i }}
                                                                    </option>
                                                                    @endfor
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <select name="thn_lahir_wali" id="thn_lahir_wali" onchange="return checkDate('tgl_lahir_wali', 'bln_lahir_wali', 'thn_lahir_wali');" class="form-control">
                                                                @for ($i = 1940; $i <= date('Y'); $i++) <option value="{{ $i }}" {{ old('thn_lahir_wali', isset($tahun_wali) ? $tahun_wali : '') == $i ? 'selected' : '' }}>
                                                                    {{ $i }}
                                                                    </option>
                                                                    @endfor
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-3 my-2">Pendidikan Wali</div>
                                                    <div class="col-md-9">
                                                        <div class="form-group">
                                                            <select name="pendidikan_wali" id="pendidikan_wali" style="width:100%" class="select2 form-control">
                                                                <option {{ $data['feeder'] && $data['feeder']->PENDIDIKAN_WALI == 'pasca_sarjana' ? 'selected' : '' }} value="pasca_sarjana">Pasca Sarjana
                                                                </option>
                                                                <option {{ $data['feeder'] && $data['feeder']->PENDIDIKAN_AYAH == 'sarjana' ? 'selected' : '' }} value="sarjana">Sarjana</option>
                                                                <option {{ $data['feeder'] && $data['feeder']->PENDIDIKAN_AYAH == 'diploma' ? 'selected' : '' }} value="diploma">Diploma</option>
                                                                <option {{ $data['feeder'] && $data['feeder']->PENDIDIKAN_AYAH == 'sma' ? 'selected' : '' }} value="sma">SMA</option>
                                                                <option {{ $data['feeder'] && $data['feeder']->PENDIDIKAN_AYAH == 'smp' ? 'selected' : '' }} value="smp">SMP</option>
                                                                <option {{ $data['feeder'] && $data['feeder']->PENDIDIKAN_AYAH == 'sd' ? 'selected' : '' }} value="sd">SD</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-3 my-2">Pekerjaan Wali</div>
                                                    <div class="col-md-9">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" id="pekerjaan_wali" placeholder="{{ $data['feeder'] ? $data['feeder']->PEKERJAAN_WALI : '' }}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-3 my-2">Penghasilan Wali</div>
                                                    <div class="col-md-9">
                                                        <div class="form-group input-group">
                                                            <select name="penghasilan_wali" id="penghasilan_wali" class="form-control">
                                                                <option {{ $data['feeder'] && $data['feeder']->PENGHASILAN_WALI == '11' ? 'selected' : '' }} value="11">Kurang dari Rp. 500000
                                                                </option>
                                                                <option {{ $data['feeder'] && $data['feeder']->PENGHASILAN_WALI == '12' ? 'selected' : '' }} value="12">Rp. 500000 - Rp. 999999
                                                                </option>
                                                                <option {{ $data['feeder'] && $data['feeder']->PENGHASILAN_WALI == '13' ? 'selected' : '' }} value="13">Rp. 1000000 - Rp. 1999999
                                                                </option>
                                                                <option {{ $data['feeder'] && $data['feeder']->PENGHASILAN_WALI == '14' ? 'selected' : '' }} value="14">Rp. 2000000 - Rp. 4999999
                                                                </option>
                                                                <option {{ $data['feeder'] && $data['feeder']->PENGHASILAN_WALI == '15' ? 'selected' : '' }} value="15">Rp. 5000000 - Rp. 20000000
                                                                </option>
                                                                <option {{ $data['feeder'] && $data['feeder']->PENGHASILAN_WALI == '16' ? 'selected' : '' }} value="16">Lebih dari Rp. 20000000
                                                                </option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-auto ms-auto">
                                                        <button type="submit" name="simpan" value="Simpan" id="simpan" class="btn bg-gradient-success">Simpan
                                                        </button>
                                                        <input type="hidden" name="status_update_bidata" id="status_update_bidata" value="1" />
                                                        <div class="btn-group">
                                                            <a class="btn btn-primary btn-clean" href="profile">Back</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="tab-pane" id="tab2">
                                            <form method="post" action="{{ route('update-password') }}">
                                                @csrf
                                                <div class="content controls">
                                                    <div class="row">
                                                        <div class="col-md-3 my-2">Password Lama</div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <input type="password" class="form-control data_input" id="exampleFormControlInput1" placeholder="password lama" name="pass_lama">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-3 my-2">Password Baru</div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <input type="password" class="form-control data_input" id="exampleFormControlInput1" placeholder="password baru" name="pass_baru">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-3 my-2">Konfirmasi Password Baru</div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <input type="password" class="form-control data_input" id="exampleFormControlInput1" placeholder="konfirmasi password baru" name="pass_baru_2">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-auto ms-auto">
                                                        <button class="btn bg-gradient-success" name="simpan" type="submit" value="Simpan"><span class="ok">Simpan
                                                            </span></button>
                                                        <input type="hidden" name="key" value="1" />
                                                        <div class="btn-group">
                                                            <a class="btn btn-primary btn-clean" href="profile">Back</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
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
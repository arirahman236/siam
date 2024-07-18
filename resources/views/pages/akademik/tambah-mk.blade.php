@extends('layouts.main')
@section('title', 'Tambah Mata Kuliah')

@section('master')
    @php
        use App\Models\AkademiModel;
        use App\Models\view_krs_temp;
        use App\Models\ViewJadwalKuliah;
        use App\Models\kelompok_kelas;
        use App\Http\Controllers\AkadControllerKrs;
    @endphp

    <div class="container-fluid py-4">
        <div class="row">
            <div class="col mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="numbers">
                            <p class="text-md mb-0 text-uppercase font-weight-bold">MATA KULIAH YANG DITAWARKAN SEMESTER
                                {{ $data['kontrol']->DESKRIPSI_SEMESTER . ' ' . $data['kontrol']->TAHUN_AKADEMIK }}</p>
                        </div>
                        <hr class="horizontal dark" />

                        <div class="content controls">
                            <div class="form-row">
                                <div class="col-md-12">
                                    <ul id="notifications">
                                        <li style="" class='sisakrs'>
                                            Kuota SKS : 15 sks <!-- Ganti dengan data statis -->
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="content" style="overflow-x: auto;">
                            <table class="table table-bordered table-striped sortable">
                                <thead>
                                    <tr align="center">
                                        <th>No.</th>
                                        <th>Hari</th>
                                        <th>Jam</th>
                                        <th>Kode</th>
                                        <th>Nama</th>
                                        <th>Kelas</th>
                                        <th>Ruang</th>
                                        <th>SKS</th>
                                        <th>Smt.</th>
                                        <th>W/P</th>
                                        <th>Prasyarat</th>
                                        <th>Pst.</th>
                                        <th>Maks.</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($data['getDataMkDitawarkan'])

                                        @php $seq_number = 1; @endphp
                                        @foreach ($data['getDataMkDitawarkan'] as $mk)
                                            @php

                                                $jumlah_peminat = view_krs_temp::jumlahPeminatMk($mk->KODE_PRODI, $mk->KODE_MK, $mk->KELAS, $mk->TAHUN);
                                                $maks_kapasitas_kelas = ViewJadwalKuliah::kapasitasKelasMk($mk->KODE_PRODI, $mk->KODE_MK, $mk->KELAS, $mk->TAHUN);
                                                $cek_prasyarat_mk = AkadControllerKrs::check_prasyarat_mk(auth()->user()->NIM, $mk->KODE_PRASYARAT1, $mk->KODE_PRASYARAT2);
                                                $cek_prasyarat_mk = App\Http\Controllers\AkadControllerKrs::check_prasyarat_mk(auth()->user()->NIM, $mk->KODE_PRASYARAT1, $mk->KODE_PRASYARAT2);
                                                $mk_prasyarat1 = AkademiModel::getKodeMkByNoMk($mk->KODE_PRASYARAT1);
                                                $mk_prasyarat2 = AkademiModel::getKodeMkByNoMk($mk->KODE_PRASYARAT2);

                                                $has_entried = 0;

                                            @endphp

                                            @if ($data['krs'])
                                                @foreach ($data['krs'] as $krsValue)
                                                    @if ($mk->KODE_MK == $krsValue->KODE_MATAKULIAH)
                                                        @php $has_entried = 1; @endphp
                                                    @endif
                                                @endforeach
                                            @endif

                                            <tr style="color:#000" align="center">
                                                <td height="28">
                                                    @php
                                                        if ($jumlah_peminat < $maks_kapasitas_kelas && $cek_prasyarat_mk > 0 && $has_entried == 0) {
                                                            $btn = 'btn btn-info';
                                                        } else {
                                                            $btn = 'btn btn-success';
                                                        }
                                                    @endphp

                                                    <button class="button_submit {{ $btn }}" type="button"
                                                        value="{{ $mk->ID_MK_TERSEDIA }}" name="mk"
                                                        @if ($jumlah_peminat < $maks_kapasitas_kelas && $cek_prasyarat_mk > 0 && $has_entried == 0) @else disabled="disabled" @endif>Pilih</button>

                                                </td>
                                                <td align="left" style="padding-left:10px">
                                                    {{ ucwords(strtolower($mk->HARI)) }}</td>
                                                <td>{{ $mk->MULAI . ' - ' . $mk->SELESAI }}</td>
                                                <td>{{ strtoupper($mk->KODE_MK) }}</td>
                                                <td align="left" style="padding-left:10px">{{ $mk->NAMA_MK }}</td>
                                                @php
                                                    $kelas = kelompok_kelas::kelas_to_huruf($mk->KELAS);
                                                @endphp
                                                <td>{{ $kelas[0]->KELAS }}</td>
                                                <td>{{ $mk->RUANG }}</td>
                                                <td>{{ $mk->SKS }}</td>
                                                <td>{{ $mk->SEMESTER_MK }}</td>
                                                <td>{{ $mk->SIFAT }}</td>
                                                <td>
                                                    @if ($mk->KODE_PRASYARAT1)
                                                        {{ $mk_prasyarat1->KODE_MK }}
                                                    @endif
                                                    @if ($mk->KODE_PRASYARAT1 && $mk->KODE_PRASYARAT2)
                                                        ,
                                                    @endif
                                                    @if ($mk->KODE_PRASYARAT2)
                                                        {{ $mk_prasyarat2->KODE_MK }}
                                                    @endif
                                                </td>
                                                <td>{{ $jumlah_peminat }}</td>
                                                <td>{{ $maks_kapasitas_kelas }}</td>
                                            </tr>

                                            @php $seq_number++; @endphp
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        <div class="content controls mt-4">
                            <div class="footer text-right">
                                <a href="/entri-krs" class="btn btn-primary" name="batal">Kembali</a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).on('click', '.button_submit', function() {
            var tombol = $(this).val();
            var data = {
                mk: tombol,
                _token: $('meta[name="csrf-token"]').attr('content')
            };

            // Validasi data mata kuliah
            if (data.mk == '') {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal',
                    text: 'Silakan pilih mata kuliah terlebih dahulu.'
                });
                return false;
            }

            // Kontrol kuota KRS
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "POST",
                url: "{{ route('ajaxCekKrs') }}",
                data: data,
                cache: false,
                success: function(html) {
                    if (html == "FALSE") {
                        Swal.fire({
                            icon: 'error',
                            title: 'Kuota KRS tidak mencukupi!',
                            text: 'Anda tidak dapat mengambil mata kuliah ini karena kuota KRS Anda sudah habis.'
                        });
                        return false;
                    } else {
                        Swal.fire({
                            icon: 'success',
                            title: 'Mata Kuliah berhasil ditambahkan'
                        }).then(function() {
                            location.reload();
                        });
                    }
                },
                error: function() {
                    // Tampilkan pesan error jika terjadi kesalahan
                    Swal.fire({
                        icon: 'error',
                        title: 'Terjadi kesalahan',
                        text: 'Mohon coba lagi nanti.'
                    });
                }
            });
        });
    </script>

@endsection

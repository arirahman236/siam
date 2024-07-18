<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\KrsModel;
use App\Models\ViewDataMahasiswa;
use App\Models\view_krs_temp;
use App\Models\setting_global;
use App\Models\view_khs_all;
use App\Models\view_krs_all;
use App\Models\ViewJadwalKuliah;
use App\Models\AkademiModel;
use App\Models\view_data_enrollment;
use App\Models\view_mk_tersedia;
use App\Models\view_khs_cetak;
use App\Models\e_tbbnl;
use App\Models\kelompok_kelas;
use App\Models\temporary_enrollments;

use Illuminate\Support\Facades\DB;

class AkadControllerKrs extends Controller
{
    public function insertKrs()
    {
        $mhs = ViewDataMahasiswa::getDataMahasiswa(auth()->user()->NIM);

        $data['atts'] = [
            'width' => '950',
            'height' => '768',
            'scrollbars' => 'yes',
            'status' => 'yes',
            'resizable' => 'yes',
            'screenx' => '0',
            'screeny' => '0'
        ];
        $data['krs'] = null;

        if ($mhs != NULL) {
            $data['kontrol'] = KrsModel::getViewKontrolData();

            $validasi = DB::table('view_krs_temp')
                ->where('NIM_MAHASISWA', auth()->user()->NIM)
                ->where('TAHUN_SEMESTER', $data['kontrol']->SEMESTER)
                ->where('APPROVED', 1)
                ->first();

            $registrasimahasiswa = DB::table('view_data_mahasiswa')
                ->select('STATUS_REGISTRASI')
                ->where('NIM', auth()->user()->NIM)
                ->first();

            $mahasiswa = auth()->user()->NIM;
            $setting = setting_global::getSettingGlobal();

            if ($setting->PEMBAYARAN_SKS == 1) {

                if ($data['kontrol']->STATUS != 1) {

                    $data['error'] = "Error: Saat ini diluar masa entri KRS.";
                    $data['page'] = 'isi_krs_error';
                } elseif ($validasi) {
                    $data['error'] = "Error: Anda tidak bisa melakukan pengisian KRS karena KRS telah divalidasi oleh Dosen Pembimbing Akademik.";
                    $data['page'] = 'isi_krs_error';
                } else {
                    $tahun = substr($data['kontrol']->SEMESTER, 0, 4);
                    $semester = substr($data['kontrol']->SEMESTER, 4, 1);
                    if (substr($data['kontrol']->SEMESTER, 4, 1) == 1) {
                        $semester = 2;
                        $tahun = substr($data['kontrol']->SEMESTER, 0, 4) - 1;
                    } elseif ($semester == 2) {
                        $semester = $semester - 1;
                        $tahun = $tahun;
                    }
                    $tahun_semester_lalu = $tahun . $semester;

                    $data['getDataKhs'] = view_khs_all::getViewKhsAll(auth()->user()->NIM, $tahun_semester_lalu);

                    $data['krs'] = view_krs_temp::getViewKrsTemp(auth()->user()->NIM, $data['kontrol']->SEMESTER);
                    $data['page'] = 'pages.akademik.entri-krs';
                }
            } else {
                if ($data['kontrol']->STATUS != 1) {
                    $data['error'] = "Error: Saat ini diluar masa entri KRS.";
                    $data['page'] = 'isi_krs_error';
                } elseif ($registrasimahasiswa->STATUS_REGISTRASI == 0) {
                    $data['error'] = "Error: Anda tidak bisa melakukan pengisian KRS karena belum melakukan registrasi.";
                    $data['page'] = 'isi_krs_error';
                } elseif ($validasi) {
                    $data['error'] = "Error: Anda tidak bisa melakukan pengisian KRS karena KRS telah divalidasi oleh Dosen Pembimbing Akademik.";
                    $data['page'] = 'isi_krs_error';
                } else {
                    $tahun = substr($data['kontrol']->SEMESTER, 0, 4);
                    $semester = substr($data['kontrol']->SEMESTER, 4, 1);
                    if ($semester == 1) {
                        $semester = 2;
                        $tahun = $tahun - 1;
                    } elseif ($semester == 2) {
                        $semester = $semester - 1;
                        $tahun = $tahun;
                    }
                    $tahun_semester_lalu = $tahun . $semester;

                    $data['getDataKhs'] = view_khs_all::getViewKhsAll(auth()->user()->NIM, $tahun_semester_lalu);
                    $data['krs'] = view_krs_temp::getViewKrsTemp(auth()->user()->NIM, $data['kontrol']->SEMESTER);
                    $data['page'] = 'pages.akademik.entri-krs';
                }
            }
        } else {
            $data['kontrol'] = NULL;
            $data['error'] = "Error: Maaf, data tidak dapat ditampilkan. Mungkin ada gangguan teknis. Silakan menghubungi bagian terkait.";
            $data['page'] = 'isi_krs_error';
        }
        $data['ipsMax'] = $this->maxSksDiambilByIpsKemarin($data['kontrol']->SEMESTER, auth()->user()->NIM);
        $data['ips'] = $this->ipsByThsmsLalu($data['kontrol']->SEMESTER, auth()->user()->NIM);
        //dd($data['ips']);
        //dd($data['ipsMax']);
        return view('pages.akademik.entri-krs', compact('data'));
    }


    public function insertMkDitawarkan(Request $request)
    {
        $mhs = ViewDataMahasiswa::getDataMahasiswa(auth()->user()->NIM);
        $data['krs'] = null;
        if ($mhs != NULL) {
            $data['kontrol'] = KrsModel::getViewKontrolData($mhs->KODE_PRODI);

            $validasi = DB::table('view_krs_temp')
                ->where('NIM_MAHASISWA', auth()->user()->NIM)
                ->where('TAHUN_SEMESTER', $data['kontrol']->SEMESTER)
                ->where('APPROVED', 1)
                ->first();

            $registrasimahasiswa = DB::table('view_data_mahasiswa')
                ->select('STATUS_REGISTRASI')
                ->where('NIM', auth()->user()->NIM)
                ->first();

            $mahasiswa = auth()->user()->NIM;

            $data['atts'] = [
                'width' => '950',
                'height' => '768',
                'scrollbars' => 'yes',
                'status' => 'yes',
                'resizable' => 'yes',
                'screenx' => '0',
                'screeny' => '0',
            ];

            $setting = KrsModel::getSettingGlobal();
            if ($setting->PEMBAYARAN_SKS == 1) {
                if ($data['kontrol']->STATUS != 1) {
                    $data['error'] = "Error: Saat ini diluar masa entri KRS.";
                    return view('isi_krs_error',  compact('data'));
                } else if ($validasi) {
                    $data['error'] = "Error: Anda tidak bisa melakukan pengisian KRS karena KRS telah divalidasi oleh Dosen Pembimbing Akademik.";

                    return view('isi_krs_error',  compact('data'));
                } else if (!$request->has('mk') && !$request->has('nim')) {
                    $data['getDataMkDitawarkan'] = $this->getViewJadwalKuliah($data['kontrol']->SEMESTER, $mhs->KODE_PRODI);
                    $data['krs'] = view_krs_temp::getViewKrsTemp(auth()->user()->NIM, $data['kontrol']->SEMESTER);
                    $jumlah_sks_sudah_diambil = 0;

                    if ($data['krs']) {
                        foreach ($data['krs'] as $valueKrs) {
                            $jumlah_sks_sudah_diambil += $valueKrs->SKS;
                        }
                    }

                    $data['jumlah_sks_sudah_diambil'] = $jumlah_sks_sudah_diambil;
                    
                    return view('pages.akademik.tambah-mk', compact('data'));
                } else if ($request->has('mk') || $request->has('nim')) {
                    $this->prosesEntriKrs();
                }
            } else {
                if ($data['kontrol']->STATUS != 1) {
                    $data['error'] = "Error: Saat ini diluar masa entri KRS.";

                    return view('isi_krs_error', compact('data')); // Gantilah 'your_template_view' dengan nama file view yang sesuai.
                } else if ($mahasiswa->STATUS_REGISTRASI == 0) {
                    $data['error'] = "Error: Anda tidak bisa melakukan pengisian KRS karena belum melakukan registrasi.";

                    return view('isi_krs_error', compact('data')); // Gantilah 'your_template_view' dengan nama file view yang sesuai.
                } else if ($validasi) {
                    $data['error'] = "Error: Anda tidak bisa melakukan pengisian KRS karena KRS telah divalidasi oleh Dosen Pembimbing Akademik.";

                    return view('isi_krs_error', compact('data')); // Gantilah 'your_template_view' dengan nama file view yang sesuai.
                } else if (!$request->has('mk') && !$request->has('nim')) {
                    $data['getDataMkDitawarkan'] = $this->getViewJadwalKuliah($data['kontrol']->SEMESTER, $mhs->KODE_PRODI);
                    $data['krs'] = view_krs_temp::getViewKrsTemp(auth()->user()->NIM, $data['kontrol']->SEMESTER);
                    $jumlah_sks_sudah_diambil = 0;

                    if ($data['krs']) {
                        foreach ($data['krs'] as $valueKrs) {
                            $jumlah_sks_sudah_diambil += $valueKrs->SKS;
                        }
                    }

                    $data['jumlah_sks_sudah_diambil'] = $jumlah_sks_sudah_diambil;
                    $data['kelas_to_huruf'] = kelompok_kelas::kelas_to_huruf($data['getDataMkDitawarkan']->KELAS);
                    return view('pages.akademik.tambah-mk', compact('data')); // Gantilah 'your_template_view' dengan nama file view yang sesuai.
                } else if ($request->has('mk') || $request->has('nim')) {
                    $this->prosesEntriKrs();
                }
            }
        } else if ($mhs == NULL) {
            $data['kontrol'] = NULL;
            $data['error'] = "Error: Maaf, data tidak dapat ditampilkan. Mungkin ada gangguan teknis. Silakan menghubungi bagian terkait.";

            return view('isi_krs_error', compact('data')); // Gantilah 'your_template_view' dengan nama file view yang sesuai.
        }
    }
    function prosesEntriKrs(Request $request)
    {
        $mhs = ViewDataMahasiswa::getDataMahasiswa(auth()->user()->NIM);
        $data['krs'] = null;
        if ($mhs != NULL) {
            $data['kontrol'] = KrsModel::getViewKontrolData();

            $validasi = DB::table('view_krs_temp')
                ->where('NIM_MAHASISWA', auth()->user()->NIM)
                ->where('TAHUN_SEMESTER', $data['kontrol']->SEMESTER)
                ->where('APPROVED', 1)
                ->first();

            $mahasiswa = auth()->user()->NIM;

            if ($data['kontrol']->STATUS != 1) {
                $data['error'] = "Error: Saat ini diluar masa entri KRS.";
                return view('isi_krs_error', compact('data'));
            } elseif ($mahasiswa->STATUS_REGISTRASI == 0) {
                $data['error'] = "Error: Anda tidak bisa melakukan pengisian KRS karena belum melakukan registrasi.";
                return view('isi_krs_error', compact('data'));
            } elseif ($validasi) {
                $data['error'] = "Error: Anda tidak bisa melakukan pengisian KRS karena KRS telah divalidasi oleh Dosen Pembimbing Akademik.";
                $data['page'] = 'isi_krs_error';
                return view('isi_krs_error', compact('data'));
            } elseif (!$request->input('nim')) {
                $tahun = substr($data['kontrol']->SEMESTER, 0, 4);
                $semester = substr($data['kontrol']->SEMESTER, 4, 1);

                if ($semester == 1) {
                    $semester = 2;
                    $tahun = $tahun - 1;
                } elseif ($semester == 2) {
                    $semester = $semester - 1;
                    $tahun = $tahun;
                }

                $data['getDataKhs'] = view_khs_all::getViewKhsAll(auth()->user()->NIM, $tahun, $semester);
                $data['krs'] = view_krs_temp::getViewKrsTemp(auth()->user()->NIM, $data['kontrol']->SEMESTER);
                $data['matakuliahBaru'] = view_mk_tersedia::dataMatakuliahTersediaById($request->input('mk'));


                return view('proses_krs', compact('data'));
            } else {
                if ($request->input('tersedia') != "0000") {
                    temporary_enrollment::insertDataKrs($request->input('tersedia'), $request->input('nim'));
                }

                return redirect('pages.akademik.entri-krs')->refresh();
            }
        } elseif ($mhs == NULL) {
            $data['kontrol'] = NULL;
            $data['error'] = "Error: Maaf, data tidak dapat ditampilkan. Mungkin ada gangguan teknis. Silakan menghubungi bagian terkait.";

            return view('isi_krs_error', compact('data'));
        }
    }

    public function ajaxCekKrs(Request $request)
    {
        $mhs = ViewDataMahasiswa::getDataMahasiswa(auth()->user()->NIM);
        $data['kontrol'] = KrsModel::getViewKontrolData($mhs->KODE_PRODI);
        $data['krs'] = null;

        if ($mhs != NULL) {


            $validasi = DB::table('view_krs_temp')
                ->where('NIM_MAHASISWA', auth()->user()->NIM)
                ->where('TAHUN_SEMESTER', $data['kontrol']->SEMESTER)
                ->where('APPROVED', 1)
                ->first();

            $mahasiswa = auth()->user()->NIM;

            $data['atts'] = [
                'width' => '950',
                'height' => '768',
                'scrollbars' => 'yes',
                'status' => 'yes',
                'resizable' => 'yes',
                'screenx' => '0',
                'screeny' => '0',
            ];

            if ($data['kontrol']->STATUS != 1) {
                $data['error'] = "Error: Saat ini diluar masa entri KRS.";
                return view('isi_krs_error', compact('data'));
            } elseif (auth()->user()->STATUS_REGISTRASI == 0) {
                $data['error'] = "Error: Anda tidak bisa melakukan pengisian KRS karena belum melakukan registrasi.";
                return view('isi_krs_error', compact('data'));
            } elseif ($validasi) {
                $data['error'] = "Error: Anda tidak bisa melakukan pengisian KRS karena KRS telah divalidasi oleh Dosen Pembimbing Akademik.";
                return view('isi_krs_error', compact('data'));
            } elseif (!$request->filled('mk')) {

                $data['getDataMkDitawarkan'] = $this->getViewJadwalKuliah($data['kontrol']->SEMESTER, $mhs->KODE_PRODI);
                $data['krs'] = view_krs_temp::getViewKrsTemp(auth()->user()->NIM, $data['kontrol']->SEMESTER);
                $data['kelas_to_huruf'] = kelompok_kelas::kelas_to_huruf($data['getDataMkDitawarkan']->KELAS);
                return view('pages.akademik.tambah-mk', compact('data'));
            } elseif ($request->filled('mk')) {

                $krsnya_sekarang = view_krs_temp::getViewKrsTemp(auth()->user()->NIM, $data['kontrol']->SEMESTER);
                $jumlah_sks_sekarang = 0;

                if ($krsnya_sekarang) {
                    foreach ($krsnya_sekarang as $valueKrs) {
                        $jumlah_sks_sekarang += $valueKrs->SKS;
                    }
                }

                $sisa = ($this->maxSksDiambilByIpsKemarin($data['kontrol']->SEMESTER, auth()->user()->NIM)) - $jumlah_sks_sekarang;
                $sks = ViewJadwalKuliah::cekSKSByMkTersedia($request->input('mk'));

                if ($sisa >= $sks->SKS) {
                    temporary_enrollments::insertDataKrs($request->input('mk'), auth()->user()->NIM);
                } else {
                    return 'FALSE';
                }

                $data['getDataMkDitawarkan'] = $this->getViewJadwalKuliah($data['kontrol']->SEMESTER, $mhs->KODE_PRODI);
                $data['krs'] = view_krs_temp::getViewKrsTemp(auth()->user()->NIM, $data['kontrol']->SEMESTER);
                $jumlah_sks_sudah_diambil = 0;

                if ($data['krs']) {
                    foreach ($data['krs'] as $valueKrs) {
                        $jumlah_sks_sudah_diambil += $valueKrs->SKS;
                    }
                }

                $data['jumlah_sks_sudah_diambil'] = $jumlah_sks_sudah_diambil;
                return 'TRUE';
                // return redirect()->route('tambah-mk')->with(['clr' => 'success', 'status' => 'Mata Kuliah berhasil ditambahkan'])->refresh();
            }
        } else {
            $data['kontrol'] = NULL;
            $data['error'] = "Error: Maaf, data tidak dapat ditampilkan. Mungkin ada gangguan teknis. Silakan menghubungi bagian terkait.";
            return view('isi_krs_error', compact('data'));
        }
    }
    public function deleteKrs($id_mk_tersedia)
    {
        $ok = view_mk_tersedia::dataMatakuliahTersediaById($id_mk_tersedia);

        if (!$ok) {
            $data['kontrol'] = NULL;
            $data['error'] = "Error: Maaf, data tidak dapat ditampilkan. Mungkin ada gangguan teknis. Silakan menghubungi bagian terkait.";
            return view('isi_krs_error', compact('data'));
        } else {
            temporary_enrollments::dataDeleteKrs(auth()->user()->NIM, $id_mk_tersedia);
            return redirect()->route('entri-krs')->with(['clr' => 'success', 'status' => 'Mata Kuliah berhasil dihapus']);
        }
    }

    public function getViewJadwalKuliah($tahun_semester, $kode_prodi)
    {
        $nim = auth()->user()->NIM;
        $qu = ViewDataMahasiswa::where('NIM', $nim)->first();

        if ($qu) {
            $kelas = $qu->KELOMPOK_KELAS;

            $data = ViewJadwalKuliah::where('TAHUN', $tahun_semester)
                ->where('KODE_PRODI', $kode_prodi)
                ->where('KELAS', $kelas)
                ->orderBy('SEMESTER_MK', 'ASC')
                ->get();

            return $data->isEmpty() ? null : $data;
        }

        return null;
    }
    public function check_prasyarat_mk($nim, $kode_prasyarat1 = null, $kode_prasyarat2 = null)
    {
        $status = 0;

        if ($kode_prasyarat2 != null) {
            $cek_mk_prasyarat1 = view_mk_tersedia::viewMkTersedia_cekPrasyarat($kode_prasyarat1, $kode_prasyarat2);

            if ($cek_mk_prasyarat1) {
                foreach ($cek_mk_prasyarat1 as $value1) {
                    $cek_enrollment1 = view_data_enrollment::viewDataEnrollment($value1->ID_TERSEDIA, $nim);
                    $status = $status + $cek_enrollment1;
                }
            } else {
                $status = 0;
            }
        } else if ($kode_prasyarat1 != null) {
            $cek_mk_prasyarat1 = view_mk_tersedia::viewMkTersedia_cekPrasyarat($kode_prasyarat1, $kode_prasyarat2);

            if ($cek_mk_prasyarat1) {
                foreach ($cek_mk_prasyarat1 as $value1) {
                    $cek_enrollment1 = view_data_enrollment::viewDataEnrollment($value1->ID_TERSEDIA, $nim);
                    $status = $status + $cek_enrollment1;
                }
            } else {
                $status = 0;
            }
        } else {
            $status = 1;
        }

        return $status;
    }

    function kelas_to_huruf($angka)
    {
        $angka = (int)$angka;

        $huruf = str_replace(
            ['1', '2', '3', '4', '5', '6', '7', '8', '9'],
            ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I'],
            $angka
        );

        return $huruf;
    }
    function ipsByThsms(int $thsms, string $nim)
    {
        $total_sks = 0;
        $total_ips = 0;

        $prodi = auth()->user()->KODE_PRODI;
        $khs = view_khs_cetak::getViewKhsCetak($nim, $thsms);

        $sks_lulus = 0;
        $sks_semua = 0;
        $score = 0;
        $bobotNilai = 0;
        $lulus = 0;

        if ($khs) {
            foreach ($khs as $key) {
                $no_mk = $key->NO_MATAKULIAH;

                $cek = DB::table('konversi')
                    ->where('NIM', $nim)
                    ->where('MK_TUJUAN', $no_mk)
                    ->first();

                if ($cek) {
                    $nilainya = $cek->NILAI;
                } else {
                    $nilainya = $key->NILAI_AKHIR_HURUF;
                }

                if ($nilainya != '-' && $nilainya != 'T') {
                    $t = e_tbbnl::getBobotNilai($thsms, $prodi, $nilainya);

                    if ($t) {
                        $bobotNilai = $t->BOBOTTBBNL;
                    } else {
                        $bobotNilai = 0;
                    }

                    $sks_lulus += $key->SKS;
                    $score += ($key->SKS * $bobotNilai);
                }

                $sks_semua += $key->SKS;
            }
        }

        if ($sks_semua != 0) {
            $ips_value = $score / $sks_lulus;
        } else {
            $ips_value = 0;
        }

        $data = [
            'lulus' => $sks_lulus,
            'sks' => $sks_semua,
            'ips' => number_format($ips_value, 2, '.', ''),
        ];

        return $data;
    }
    function maxSksDiambilByIpsKemarin(string $thsms, string $nim)
    {
        $maba = 22;
        $tahun = substr($thsms, 0, 4);
        $smstr = substr($thsms, 4, 1);

        if ($smstr === '2') {
            $tahunl = $tahun;
            $smstrl = '1';
            $thsmsl = $tahunl . $smstrl;
        } else {
            $tahunl = $tahun - 1;
            $smstrl = '2';
            $thsmsl = $tahunl . $smstrl;
        }

        $dataKHSLalu = $this->ipsByThsms($thsmsl, $nim);
        $ips = number_format($dataKHSLalu['ips'], 2);

        if ($ips) {
            if ($ips > 0) {
                if ($ips >= 1.5) {
                    if ($ips >= 2) {
                        if ($ips >= 2.5) {
                            if ($ips >= 3) {
                                $max = 24;
                            } else {
                                $max = 22;
                            }
                        } else {
                            $max = 20;
                        }
                    } else {
                        $max = 16;
                    }
                } else {
                    $max = 12;
                }
            } else {
                $max = 22;
            }
        } else {
            $max = $maba;
        }

        return $max;
    }


    public function ipsByThsmsLalu($thsms, $nim)
    {
        $total_sks = 0;
        $total_ips = 0;
        $tahun = substr($thsms, 0, 4);
        $smstr = substr($thsms, 4, 1);

        if ($smstr == 2) {
            $tahunl = $tahun;
            $smstrl = 1;
            (int) $thsmsl = (int) $tahunl . (int) $smstrl;
        } else {
            $tahunl = $tahun - 1;
            $smstrl = 2;
            (int) $thsmsl = (int) $tahunl . (int) $smstrl;
        }
        $prodi = auth()->user()->KODE_PRODI;
        $khs = view_khs_cetak::getViewKhsCetak($nim, (int) $thsmsl);


        $sks_lulus = 0;
        $sks_semua = 0;
        $score = 0;
        $bobotNilai = 0;
        $lulus = 0;
        if ($khs) {
            foreach ($khs as $key) {

                if ($key->NILAI_AKHIR_HURUF != '-' || $key->NILAI_AKHIR_HURUF != 'T') {
                    $bobotNilai = e_tbbnl::getBobotNilai((int) $thsmsl, $prodi, $key->NILAI_AKHIR_HURUF)->BOBOTTBBNL;
                    $sks_lulus = $sks_lulus + $key->SKS;
                    $score = $score + ($key->SKS * $bobotNilai);
                }
                $sks_semua = $sks_semua + $key->SKS;
            }
        }

        if ($sks_semua != 0)
            $ips_value = $score / $sks_lulus;
        else
            $ips_value = 0;

        $data['lulus'] = $sks_lulus;
        $data['sks'] = $sks_semua;
        $data['ips'] = $ips_value;
        $data['ips_print'] = number_format($ips_value, 2, '.', '');

        return $data;
    }

    public function KRS(Request $request)
    {
        $data['mhs'] = ViewDataMahasiswa::getDataMahasiswa(auth()->user()->NIM);
        $data['kontrol'] = KrsModel::getViewKontrolData();

        return view('pages.akademik.KRS', compact('data'));
    }

    public function viewKrs(Request $request)
    {


        if ($request->has('semester') && $request->has('tahun')) {
            $tahun_semester = $request->input('tahun') . $request->input('semester');
            $data['getDataKrs'] = view_krs_all::getViewKrsAll(auth()->user()->NIM, $tahun_semester);
            //dd($data['getDataKrs']);
            $data['info_semester'] = $request->input('semester');
            $data['info_tahun'] = $request->input('tahun');
            return view('pages.akademik.detail_krs', compact('data'));
        } else {
            $data['mhs'] = ViewDataMahasiswa::getDataMahasiswa(auth()->user()->NIM);
            $data['kontrol'] = KrsModel::getViewKontrolData();

            return view('pages.akademik.KRS', compact('data'));
        }

        $data['atts'] = [
            'width' => '950',
            'height' => '768',
            'scrollbars' => 'yes',
            'status' => 'yes',
            'resizable' => 'yes',
            'screenx' => '0',
            'screeny' => '0'
        ];
    }
}

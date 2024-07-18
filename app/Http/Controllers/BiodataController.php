<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\BiodataModel;
use App\Models\e_msmhsModel;
use App\Models\view_pass_mahasiswa;
use App\Models\feeder_mahasiswa;
use App\Models\f_ref_penghasilan;
use App\Models\f_ref_jenis_pendaftaran;
use App\Models\f_ref_jenis_keluar;
use App\Models\feeder_mahasiswa_pt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class BiodataController extends Controller
{
    public function profile(Request $request)
    {
        $user = auth()->user();
        // $biodata = BiodataModel::where('NIM', $user->NIM)->first();

        // $mahasiswaPt = $biodata->mahasiswaPt;
        // $jenisPendaftaran = $biodata->refJenisPendaftaran;
        // $jenisKeluar = $biodata->refJenisKeluar;
        // $penghasilan = $biodata->refPenghasilan;
        $data['feeder'] = feeder_mahasiswa::where('NIM', auth()->user()->NIM)->first();
        $data['hasil'] = f_ref_penghasilan::where('ID_PENGHASILAN', $data['feeder']->PENGHASILAN_WALI)->first();
        $data['mhs_pt'] = feeder_mahasiswa_pt::where('NIM', auth()->user()->NIM)->first();
        // dd($data);
        if ($data['mhs_pt']) {
            $data['jns_daftar'] = f_ref_jenis_pendaftaran::where('ID_JNS_DAFTAR', $data['mhs_pt']->ID_JNS_DAFTAR)->first();
            $data['jns_keluar'] = f_ref_jenis_keluar::where('ID_JNS_KELUAR', $data['mhs_pt']->ID_JNS_KELUAR)->first();
        } else {
            $data['jns_daftar'] = null;
            $data['jns_keluar'] = null;
        }
        return view('pages.profil.profile', compact('data'));
    }

    public function editProfil(Request $request)
    {
        $user = auth()->user();
        $data['feeder'] = feeder_mahasiswa::where('NIM', auth()->user()->NIM)->first();
        if (isset($data['feeder'])) {
            $data['hasil'] = f_ref_penghasilan::where('ID_PENGHASILAN', $data['feeder']->PENGHASILAN_WALI)->first();
        }

        $data['mhs_pt'] = feeder_mahasiswa_pt::where('NIM', auth()->user()->NIM)->first();

        if ($data['mhs_pt']) {
            $data['jns_daftar'] = f_ref_jenis_pendaftaran::where('ID_JNS_DAFTAR', $data['mhs_pt']->ID_JNS_DAFTAR)->first();
            $data['jns_keluar'] = f_ref_jenis_keluar::where('ID_JNS_KELUAR', $data['mhs_pt']->ID_JNS_KELUAR)->first();
        } else {
            $data['jns_daftar'] = null;
            $data['jns_keluar'] = null;
        }
        return view('pages.profil.edit-profile', compact('data'));
    }

    public function update(Request $request)
    {
        $validate = $this->validate($request, [
            'tempat_lahir' => 'required',
            'tgl_lahir' => 'required',
            'bln_lahir' => 'required',
            'thn_lahir' => 'required',
            'alamat_asal' => 'required',
            'alamat_sekarang' => 'required',
            'no_telp' => 'required',
            'nama_ayah' => 'required',
            'nama_ibu' => 'required',
            'pekerjaan_ayah' => 'required',
            'pekerjaan_ibu' => 'required',
            'penghasilan_ayah' => 'required',
            'penghasilan_ibu' => 'required',
            'agama' => 'required',
            'nik' => 'required',
            'rt' => 'required',
            'rw' => 'required',
            'dusun' => 'required',
            'kelurahan' => 'required',
            'kecamatan' => 'required',
            'kode_pos' => 'required',
            'jenis_tinggal' => 'required',
            'hp' => 'required',
            'penerima_kps' => 'required',
            'tgl_lahir_ayah' => 'required',
            'bln_lahir_ayah' => 'required',
            'thn_lahir_ayah' => 'required',
            'pendidikan_ayah' => 'required',
            'tgl_lahir_ibu' => 'required',
            'bln_lahir_ibu' => 'required',
            'thn_lahir_ibu' => 'required',
            'pendidikan_ibu' => 'required',
            'status_update_bidata' => 'required'
        ]);
        $tgl_lahir = $request->thn_lahir . '-' . str_pad($request->bln_lahir, 2, '0', STR_PAD_LEFT) . '-' . str_pad($request->tgl_lahir, 2, '0', STR_PAD_LEFT);
        $tgl_lahir_ayah = $request->thn_lahir_ayah . '-' . $request->bln_lahir_ayah . '-' . $request->tgl_lahir_ayah;
        $tgl_lahir_ibu = $request->thn_lahir_ibu . '-' . $request->bln_lahir_ibu . '-' . $request->tgl_lahir_ibu;
        if ($validate) {
            $msmhs = e_msmhsModel::where('NIMHSMSMHS', auth()->user()->NIM)
                ->update([
                    'TPLHRMSMHS' => $request->tempat_lahir,
                    'TGLHRMSMHS' => $tgl_lahir,
                    'ALAMAT_ASAL' => $request->alamat_asal,
                    'ALAMAT' => $request->alamat_sekarang,
                    'NO_TELP' => $request->no_telp,
                    'NAMA_AYAH' => $request->nama_ayah,
                    'NAMA_IBU' => $request->nama_ibu,
                    'PEKERJAAN_AYAH' => $request->pekerjaan_ayah,
                    'PEKERJAAN_IBU' => $request->pekerjaan_ibu,
                    'PENGHASILAN_AYAH' => $request->penghasilan_ayah,
                    'PENGHASILAN_IBU' => $request->penghasilan_ibu,
                    'STATUS_UPDATE_BIODATA' => $request->status_update_bidata,
                ]);
            $feeder = feeder_mahasiswa::where('NIM', auth()->user()->NIM)
                ->update([
                    'AGAMA' => $request->agama,
                    'NIK' => $request->nik,
                    'RT' => $request->rt,
                    'RW' => $request->rw,
                    'DUSUN' => $request->dusun,
                    'KELURAHAN' => $request->kelurahan,
                    'KECAMATAN' => $request->kecamatan,
                    'KODE_POS' => $request->kode_pos,
                    'JENIS_TINGGAL' => $request->jenis_tinggal,
                    'HP' => $request->hp,
                    'PENERIMA_KPS' => $request->penerima_kps,
                    'TANGGAL_LAHIR_AYAH' => $tgl_lahir_ayah,
                    'PENDIDIKAN_AYAH' => $request->pendidikan_ayah,
                    'TANGGAL_LAHIR_IBU' => $tgl_lahir_ibu,
                    'PENDIDIKAN_IBU' => $request->pendidikan_ibu,
                ]);

            return redirect()->route('edit-profile')->with(['clr' => 'success', 'status' => 'Biodata berhasil diperbarui']);
        } else {
            return redirect()->route('edit-profile')->with(['clr' => 'danger', 'status' => 'Ulangi Update Biodata']);
        }
    }

    public function updatePassword(Request $request)
    {
        $this->validate($request, [
            'pass_lama' => 'required',
            'pass_baru' => 'required',
            'pass_baru_2' => 'required',
        ]);

        $nim = auth()->user()->NIM;
        $data = DB::table('e_msmhs')->where('NIMHSMSMHS', '=', $nim)->first();

        if (!$data) {
            return redirect()->route('edit-profile')->with(['clr' => 'danger', 'status' => 'Data tidak ditemukan']);
        }

        if ($request->input('pass_baru') == $request->input('pass_baru_2') && $request->input('pass_lama') == $data->PASSWORD) {

            $pass_baru = $request->input('pass_baru');

            e_msmhsModel::updatePassMhs($data->NIMHSMSMHS, $pass_baru);

            return redirect()->route('edit-profile')->with(['clr' => 'success', 'status' => 'Password berhasil diperbarui']);
        } else {
            return redirect()->route('edit-profile')->with(['clr' => 'danger', 'status' => 'Ulangi Re-password baru']);
        }
    }
}

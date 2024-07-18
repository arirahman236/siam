<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WisudaModel;
use App\Models\view_data_skripsi;
use App\Models\view_syarat_wisuda;
use App\Models\wisuda_persyaratan;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class WisudaController extends Controller
{
    protected $_template = 'wisuda';
    public function viewUploadWisuda()
    {
        $data['cek'] = view_data_skripsi::getSkripsiByNim(auth()->user()->NIM);
        return view('pages.akademik.wisuda', compact('data'));
    }

    public function prosesUploadWisuda(Request $request)
    {
        $request->validate([
            'foto' => 'image|mimes:jpg,png|max:10000',
            'doc' => 'file|mimes:pdf|max:10000',
            'ijazah' => 'image|mimes:jpg|max:10000',
        ]);

        $nim = auth()->user()->NIM;

        $uploadPath = 'upload/doc_mhs';

        $foto = $request->file('foto');
        $doc = $request->file('doc');
        $ijazah = $request->file('ijazah');
        

        $cek_foto = null;
        $cek_doc = null;
        $cek_ijazah = null;

        if ($foto != null) {
            $cek_foto = base64_encode(file_get_contents($foto->getRealPath()));
        }

        if ($doc != null) {
            $cek_doc = base64_encode(file_get_contents($doc->getRealPath()));
        }

        if ($ijazah != null) {
            $cek_ijazah = base64_encode(file_get_contents($ijazah->getRealPath()));
        }


        $jumlahSyaratWisuda = view_syarat_wisuda::cekPersyaratan($nim);
        

        if ($jumlahSyaratWisuda != 0) {
            $query = "";
        } else {
            $query = wisuda_persyaratan::insertPersyaratan($nim,$cek_foto,$cek_doc,$cek_ijazah);
            
        }

        if ($cek_foto && $cek_doc && $cek_ijazah && $query) {
            $statusMessage = "Upload sukses!";
            $clr = "success";
        } else {
            $statusMessage = "Upload gagal! karena file sudah ada atau format file salah";
            $clr = "danger";
        }

        return redirect('wisuda')->with(['status' => $statusMessage, 'clr' => $clr]);
    }
}

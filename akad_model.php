<?php
//echo 'susu';exit();
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Akad_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function getMahasiswa($nim) {
        $query = "SELECT `STATUS_REGISTRASI` FROM view_data_mahasiswa WHERE `NIM`='$nim' LIMIT 1";
        $query = $this->db->query($query);

        if ($query->num_rows() > 0) {
            $data = $query->row();
        }
        else
            $data = NULL;

        return $data;
    }

    function getDataMahasiswa($nim) {
        $query = "SELECT * FROM view_data_mahasiswa WHERE `NIM`='$nim' LIMIT 1";
        $query = $this->db->query($query);

        if ($query->num_rows() > 0) {
            $data = $query->row();
        }
        else
            $data = NULL;

        return $data;
    }

    function getJadwalKuliah($kode_prodi, $kode_semester, $kode_tahun, $id_hari) {

        $query = "SELECT * FROM view_jadwal_kuliah WHERE `KODE_PRODI`='$kode_prodi' AND `SEMESTER`='$kode_semester' AND `TAHUN`='$kode_tahun' AND `ID_HARI`='$id_hari' ORDER BY `MULAI` ASC";
        $query = $this->db->query($query);

        if ($query->num_rows() > 0) {
            $data = $query->result();
        }
        else
            $data = NULL;

        return $data;
    }

    function getJadwalUjian($kode_prodi, $kode_semester, $kode_tahun) {

        $query = "SELECT * FROM view_jadwal_ujian WHERE `KODE_PRODI`='$kode_prodi' AND `SEMESTER`='$kode_semester' AND `TAHUN`='$kode_tahun' ORDER BY `TANGGAL_UJIAN`,`MULAI` ASC";
        $query = $this->db->query($query);

        if ($query->num_rows() > 0) {
            $data = $query->result();
        }
        else
            $data = NULL;

        return $data;
    }

    function getJadwalUjianByTgl($kode_prodi, $tahun_semester, $index_tgl) {
        $query = "SELECT * FROM view_jadwal_ujian WHERE TAHUN_SEMESTER = '$tahun_semester' AND KODE_PRODI='$kode_prodi' AND TANGGAL_UJIAN='$index_tgl' ORDER BY `KODE_MK`,`MULAI` ASC";
        $query = $this->db->query($query);

        if ($query->num_rows() > 0) {
            $data = $query->result();
        }
        else
            $data = NULL;

        return $data;
    } 
    function getJadwalUjianByTgl1($kode_prodi, $tahun_semester, $index_tgl) {
        $query = "SELECT * FROM view_jadwal_ujian WHERE TAHUN_SEMESTER = '$tahun_semester' AND KODE_PRODI='$kode_prodi' AND TANGGAL_UJIAN='$index_tgl'  ORDER BY `KODE_MK`,`MULAI` ASC";
        //echo $query;exit();
        $query = $this->db->query($query);

        if ($query->num_rows() > 0) {
            $data = $query->result();
        }
        else
            $data = NULL;

        return $data;
    }
    function getJamById($id) {
        $query = "SELECT * FROM waktu_ujian WHERE ID='$id'";
        //echo $query;exit();
        $query = $this->db->query($query);

        if ($query->num_rows() > 0) {
            $data = $query->row();
        }
        else
            $data = NULL;

        return $data;
    }
    function getJadwalUjianByTgl2($kode_prodi, $tahun_semester, $index_tgl) {
        $query = "SELECT * FROM view_jadwal_uts WHERE TAHUN_SEMESTER = '$tahun_semester' AND KODE_PRODI='$kode_prodi' AND TANGGAL_UTS='$index_tgl'  ORDER BY `KODE_MK`,`MULAI_UTS` ASC";
        $query = $this->db->query($query);

        if ($query->num_rows() > 0) {
            $data = $query->result();
        }
        else
            $data = NULL;

        return $data;
    }

    function getDistinctJadwalUjian($tahun_semester, $kode_prodi) {
        $sql = "SELECT DISTINCT TANGGAL_UJIAN FROM view_jadwal_ujian WHERE TAHUN_SEMESTER ={$tahun_semester} ORDER BY TANGGAL_UJIAN ASC";
        $query = $this->db->query($sql);

        if ($query->num_rows() > 0) {
            $data = $query->result();
        }
        else
            $data = NULL;

        return $data;
    } 
    function getDistinctJadwalUjianUts($tahun_semester, $kode_prodi) {
        $sql = "SELECT DISTINCT TANGGAL_UTS FROM view_jadwal_uts WHERE TAHUN_SEMESTER ={$tahun_semester} ORDER BY TANGGAL_UJIAN ASC";
        $query = $this->db->query($sql);

        if ($query->num_rows() > 0) {
            $data = $query->result();
        }
        else
            $data = NULL;

        return $data;
    }

    function getDaftarMkPresensi($tahun_semester, $nim) {
        $query = "SELECT * FROM view_presensi WHERE `TAHUN_AJARAN`='$tahun_semester' AND `NIM`='$nim'";
        $query = $this->db->query($query);

        if ($query->num_rows() > 0) {
            $data = $query->result();
        }
        else
            $data = NULL;

        return $data;
    }

    function getPresensiData($tahun_semester, $kode_mk) {
        $sql = "SELECT * FROM view_presensi where KODE_PRODI =  '{$this->session->userdata('siam_user_prodi')}' and NIM = '{$this->session->userdata('siam_user')}' and `TAHUN_AJARAN`='$tahun_semester' and `ID_MK_TERSEDIA`='$kode_mk'";
        $sql = $this->db->query($sql);

        $kelas = $sql->row();
        $kelas = $kelas->KELAS;

        $query = "SELECT * FROM view_presensi where KODE_PRODI =   '{$this->session->userdata('siam_user_prodi')}' and KELAS = '$kelas'  and `TAHUN_AJARAN`='$tahun_semester'   and `ID_MK_TERSEDIA`='$kode_mk' ORDER BY NIM ASC";
        $query = $this->db->query($query);

        if ($query->num_rows() > 0) {
            $data = $query->result();
        }
        else
            $data = NULL;

        return $data;
    }

    function getPresensiDataNim($nim, $tahun_semester, $kode_mk) {
        $query = "SELECT * FROM view_presensi where `NIM`='$nim' and `TAHUN_AJARAN`='$tahun_semester' and `ID_MK_TERSEDIA`='$kode_mk'";
        //echo $query; exit();
        $query = $this->db->query($query);

        if ($query->num_rows() > 0) {
            $data = $query->row();
        }
        else
            $data = NULL;

        return $data;
    }

    function getDetailDataMahasiswa($nim) {
        $query = "SELECT * FROM view_data_mahasiswa WHERE NIM = '$nim'";
        $query = $this->db->query($query);

        if ($query->num_rows() > 0)
            $data = $query->row();
        else
            $data = NULL;

        return $data;
    }

    function getProdiDetail($prodi) {
        $query = "SELECT * FROM view_prodi WHERE KODE_PRODI = " . $prodi;
        $query = $this->db->query($query);

        if ($query->num_rows() > 0)
            $data = $query->row();
        else
            $data = NULL;

        return $data;
    }

    function getProdi($nim) {
        $query = "SELECT * FROM view_data_mahasiswa WHERE NIM = " . $nim;
        $query = $this->db->query($query);

        if ($query->num_rows() > 0)
            $data = $query->row();
        else
            $data = NULL;

        return $data;
    }


    function getPejabat() {
        $query = "SELECT * FROM jabatan_pusat WHERE `ID`=2";
        $query = $this->db->query($query);

        if ($query->num_rows() > 0) {
            $data = $query->row();
        }
        else
            $data = NULL;

        return $data;
    }

    function getViewKhsAllCetak($nim, $tahun_semester) {
        $query = "SELECT * FROM view_khs_cetak WHERE `NIM`='$nim' and `TAHUN_SEMESTER`='$tahun_semester'";
        //echo $query;exit();
        $query = $this->db->query($query);

        if ($query->num_rows() > 0) {
            $data = $query->result();
        }
        else
            $data = NULL;

        return $data;
    }

    function getViewKhsAll($nim, $tahun_semester) {
        $query = "SELECT * FROM view_khs_all WHERE `NIM`='$nim' and `TAHUN_SEMESTER`='$tahun_semester' ORDER BY NAMA_MATAKULIAH ASC";
        $query = $this->db->query($query);

        if ($query->num_rows() > 0) {
            $data = $query->result();
        }
        else
            $data = NULL;

        return $data;
    }

    function getViewKhsAllByNim($nim) {
        $query = "SELECT * FROM view_khs_all where `NIM`='$nim' ORDER BY KODE_MATAKULIAH ASC";
        $query = $this->db->query($query);

        if ($query->num_rows() > 0) {
            $data = $query->result();
        }
        else
            $data = NULL;

        return $data;
    }

    function getViewKhsAllDistinct($nim) {
        $query = "SELECT DISTINCT(NO_MATAKULIAH) AS NO_MATAKULIAH, NAMA_MATAKULIAH, KODE_MATAKULIAH, SKS FROM view_khs_all where `NIM`='$nim' ORDER BY NO_MATAKULIAH ASC";
        $query = $this->db->query($query);

        if ($query->num_rows() > 0) {
            $data = $query->result();
        }
        else
            $data = NULL;

        return $data;
    }

    function getViewKhsAllByNim_nilaiTerbaik($nim, $kode_matakuliah) {
        $query = "SELECT * FROM view_khs_all
                  WHERE
                   `NIM`='$nim' and
                    KODE_MATAKULIAH ='$kode_matakuliah' and
                    NILAI_AKHIR_ANGKA = (SELECT max(NILAI_AKHIR_ANGKA) FROM view_khs_all WHERE `NIM`='$nim' and KODE_MATAKULIAH = '$kode_matakuliah' and NILAI_AKHIR_HURUF != 'T')
                  ORDER BY KODE_MATAKULIAH ASC";
               //   echo $query;
        $query = $this->db->query($query);

        if ($query->num_rows() > 0) {
            $data = $query->row();
        }
        else
            $data = NULL;

        return $data;
    }

        function getViewKhsAllByNim_nilaiBiasa($nim, $kode_matakuliah) {
        $query = "SELECT * FROM view_khs_all
                  WHERE
                   `NIM`='$nim' and
                    KODE_MATAKULIAH ='$kode_matakuliah'
                  ORDER BY NILAI_AKHIR_ANGKA DESC LIMIT 1";
               //   echo $query;
        $query = $this->db->query($query);

        if ($query->num_rows() > 0) {
            $data = $query->row();
        }
        else
            $data = NULL;

        return $data;
    }

    function getViewKhsAllByKodeMk($nim, $kode_mk) {
        $query = "SELECT * FROM view_khs_all where `NIM`='$nim' and KODE_MATAKULIAH = '$kode_mk' ORDER BY ID_MK_TERSEDIA ASC";
        $query = $this->db->query($query);

        if ($query->num_rows() > 0) {
            $data = $query->result();
        }
        else
            $data = NULL;

        return $data;
    }

    function countViewKhsAllByKodeMk($nim, $kode_mk) {
        $query = "SELECT * FROM view_khs_all where `NIM`='$nim' and KODE_MATAKULIAH = '$kode_mk' ORDER BY ID_MK_TERSEDIA ASC";
        $query = $this->db->query($query);

        return $query->num_rows();
    }

    function getViewKrsAll($nim, $tahun_semester) {
        $query = "SELECT * FROM view_krs_all WHERE `NIM`='$nim' and `TAHUN_SEMESTER`='$tahun_semester' ORDER BY NAMA_MATAKULIAH ASC";
        //echo $query;exit();
        $query = $this->db->query($query);

        if ($query->num_rows() > 0) {
            $data = $query->result();
        }
        else
            $data = NULL;

        return $data;
    }

    function getViewKrsTemp($nim, $tahun_semester) {
        $query = "SELECT * FROM view_krs_temp where `NIM_MAHASISWA`='$nim' AND TAHUN_SEMESTER='$tahun_semester'";
        $query = $this->db->query($query);

        if ($query->num_rows() > 0) {
            $data = $query->result();
        }
        else
            $data = NULL;

        return $data;
    }

    function getJumlahSks($nim, $tahun_semester) {
        $query = "SELECT SUM(SKS) as jumlah FROM view_krs_temp where `NIM_MAHASISWA`='$nim' AND TAHUN_SEMESTER='$tahun_semester'";
        $query = $this->db->query($query);

        if ($query->num_rows() > 0) {
            $data = $query->row();
        }
        else
            $data = NULL;

        return $data;
    }

    function dataMatakuliahTersediaById($kode_mkb) {
        $query = "SELECT * FROM view_mk_tersedia where `ID_TERSEDIA`='$kode_mkb'";
        $query = $this->db->query($query);

        if ($query->num_rows() > 0) {
            $data = $query->row();
        }
        else
            $data = NULL;

        return $data;
    }

    function dataJamKuliah($id_mk_tersedia) {

        $query = "SELECT * FROM view_jadwal_kuliah WHERE `ID_MK_TERSEDIA`='$id_mk_tersedia'";
        $query = $this->db->query($query);

        if ($query->num_rows() > 0) {
            $data = $query->row();
        }

        return $data;
    }

    function getViewJadwalKuliah($tahun_semester, $kode_prodi) {
        $nim = $this->session->userdata('siam_user');
        $qu = $this->db->query("SELECT * FROM e_msmhs WHERE NIMHSMSMHS='$nim'")->row();
        //echo $this->db->last_query();exit();
        $kelas = $qu->KELOMPOK_KELAS;
        //echo $kelas;exit();
        $query = "SELECT * FROM view_jadwal_kuliah WHERE TAHUN = '$tahun_semester' AND KODE_PRODI='$kode_prodi' AND KELAS='$kelas' ORDER BY SEMESTER_MK ASC";
        //echo $query;exit();

        $query = $this->db->query($query);

        if ($query->num_rows() > 0) {
            $data = $query->result();
        }
        else
            $data = NULL;

        return $data;
    }

    function getSemesterSkrg($tahun_masuk,$tahunsmt)
    {
        $tahun = substr($tahunsmt, 0, 4);
        $smt = substr($tahunsmt, 4, 1);
        $selisih=$tahun-$tahun_masuk;
        $semester=($selisih*2)+$smt;
        if($semester<0) $semester=0;

        return $semester;
    }

    function getViewJadwalKuliahByTahunMasuk($tahun_masuk,$tahun_semester, $kode_prodi) {
        $semester = $this->getSemesterSkrg($tahun_masuk,$tahun_semester);

        $query = "SELECT * FROM view_jadwal_kuliah WHERE TAHUN = '$tahun_semester' AND KODE_PRODI='$kode_prodi' AND SEMESTER_MK<=$semester ORDER BY ID_HARI,MULAI";

        $query = $this->db->query($query);

        if ($query->num_rows() > 0) {
            $data = $query->result();
        }
        else
            $data = NULL;

        return $data;
    }

    function jumlahPeminatMk($kode_prodi, $kode_mk, $kelas, $tahun_akademik) {
        $query = "SELECT * FROM view_krs_temp WHERE KODE_PRODI='{$kode_prodi}' AND KODE_MATAKULIAH = '{$kode_mk}' AND KELAS='{$kelas}' AND TAHUN_SEMESTER=$tahun_akademik";
        $query = $this->db->query($query);

        return $query->num_rows();
    }

    function kapasitasKelasMk($kode_prodi, $kode_mk, $kelas, $tahun_akademik) {
        $query = "SELECT MAX(KAPASITAS)AS KAPASITAS FROM view_jadwal_kuliah WHERE KODE_PRODI='{$kode_prodi}' AND KODE_MK = '{$kode_mk}' AND KELAS='{$kelas}' AND TAHUN=$tahun_akademik";
        $query = $this->db->query($query);

        return $query->row();
    }

    function jadwalKuliahRelated($id_mk_tersedia, $kode_prodi, $kode_mk, $kelas, $tahun_semester) {
        $query = "SELECT * FROM view_jadwal_kuliah WHERE ID_MK_TERSEDIA<>$id_mk_tersedia AND KODE_PRODI='{$kode_prodi}' AND KODE_MK = '{$kode_mk}' AND KELAS='{$kelas}' AND TAHUN=$tahun_semester";
        $query = $this->db->query($query);

        if ($query->num_rows() > 0) {
            $data = $query->result();
        }
        else
            $data = NULL;

        return $data;
    }

    function viewMkTersedia_cekPrasyarat($kode_prasyarat1, $kode_prasyarat2) {
        $query = "SELECT `ID_TERSEDIA` FROM view_mk_tersedia WHERE NO_MATAKULIAH= '$kode_prasyarat1' OR NO_MATAKULIAH = '$kode_prasyarat2'";
        $query = $this->db->query($query);

        if ($query->num_rows() > 0) {
            $data = $query->result();
        }
        else
            $data = NULL;

        return $data;
    }

    function viewDataEnrollment($id_tersedia, $nim) {
        $query = "SELECT * FROM view_data_enrollment WHERE ID_MK_TERSEDIA = '$id_tersedia' AND NIM = '$nim'";
        $query = $this->db->query($query);

        return $query->num_rows();
    }

    function getKodeMkByNoMk($NO_MATAKULIAH = NULL) {
        $query = "SELECT * FROM view_mata_kuliah WHERE NO_MATAKULIAH = '$NO_MATAKULIAH'";
        $query = $this->db->query($query);

        return $query->row();
    }

    function insertDataKrs($tersedia, $nim) {
        $query = "INSERT INTO temporary_enrollments VALUES ('{$tersedia}','{$nim}','')";
        $query = $this->db->query($query);
    }

    function dataDeleteKrs($nim, $id_mk_tersedia) {
        $query = "DELETE FROM temporary_enrollments WHERE `NIM_MAHASISWA`='$nim' AND `ID_TRAKD`='$id_mk_tersedia' AND `APPROVED` <> 1";
        $query = $this->db->query($query);
    }

    function cekValidasi($nim, $tahun_semester) {
        $query = "SELECT * FROM view_krs_temp where `NIM_MAHASISWA`='$nim' AND TAHUN_SEMESTER='$tahun_semester' AND APPROVED = 1";
        $query = $this->db->query($query);

        if ($query->num_rows())
            $data = $query->row();
        else
            $data = NULL;

        return $data;
    }

    function getNeraca($nim) {
        $query = "SELECT * FROM view_data_neraca WHERE `NIM`='$nim' ORDER BY `NAMA_TAHUN`";
        $query = $this->db->query($query);

        if ($query->num_rows())
            $data = $query->row();
        else
            $data = NULL;

        return $data;
    }

    function seeFakultas($prodi) {
        $query = $this->db->query("SELECT * FROM view_kontrol WHERE KODE_PRODI = '{$prodi}'");
        $result = $query->row();
        return $result;
    }

    function selectEMatakuliahSiam($tahun)
    {
        $query_kurikulum="SELECT KurikulumID FROM e_msmhs WHERE NIMHSMSMHS='{$this->session->userdata('siam_user')}'";
        $hasil_kurikulum = $this->db->query($query_kurikulum);
        if($hasil_kurikulum->num_rows()) {
	        $dataKur = $hasil_kurikulum->row();
	       // echo $dataKur; exit();
	        $kurikulum = $dataKur->KurikulumID;
        } else {
        	  $kurikulum = 0;
        }
        $query = "SELECT * FROM e_matakuliah WHERE KurikulumID = '$kurikulum' ORDER BY SEMESTBKMK ASC, KDKMKTBKMK ASC";
        $query = $this->db->query($query);

        if($query->num_rows()>0)
          $data = $query->result();
        else
          $data = NULL;

        return $data;
    }
    
     function allowNilai() {
        $query = "SELECT NILAI FROM e_mspst WHERE KDPSTMSPST = '{$this->session->userdata('siam_user_prodi')}' LIMIT 1";
        $query = $this->db->query($query);

        if ($query->num_rows() > 0) {
            $data = $query->row();
        }
        else
            $data = NULL;

        return $data;
    }
	
	function addJudulSkripsi($thn, $kode_pt, $kode_prodi, $kode_jen, $nim, $status, $judul){
		$query = "INSERT INTO `e_trlsm`(
		`THSMSTRLSM`,
		`JUDUL`, 
		`KDPTITRLSM`, 
		`KDPSTTRLSM`, 
		`KDJENTRLSM`, 
		`NIMHSTRLSM`, 
		`STMHSTRLSM` 
		) VALUES (
		'$thn',
		'$judul',
		'$kode_pt',
		'$kode_prodi',
		'$kode_jen',
		'$nim',
		'$status'
		)";
        $query = $this->db->query($query);	
		if($query)
        {
          return TRUE;
        }
        else
        {
          return FALSE;
        }
	}
	
	function getSkripsiMhs($nim){
		$query = "SELECT * FROM e_trlsm WHERE NIMHSTRLSM = '$nim'";
        $query = $this->db->query($query);

        if ($query->num_rows() > 0) {
            $data = $query->row();
        }
        else
            $data = NULL;

        return $data;
	}
     function cekSKSByMkTersedia($id_mk_tersedia) {
        $query = "SELECT SKS FROM view_jadwal_kuliah WHERE ID_MK_TERSEDIA = '$id_mk_tersedia'"; 
        $query = $this->db->query($query);
          if ($query->num_rows() > 0) {
            $data = $query->row();
        }
        else
            $data = NULL;

        return $data;   
        }
        
        function getSkripsiByNim($nim) {
        $query = "SELECT * FROM `view_data_skripsi` WHERE NIM ='$nim'";

        $query = $this->db->query($query);

        if ($query->num_rows() > 0)
            $data = $query->row();
        else
            $data = FALSE;

        return $data;
    }
    function GetSkripsiTagihanByNim($nim) {
        $query = "SELECT * FROM `transaksi_tagihan_lain` WHERE NIM ='$nim' AND `KODE_TAGIHAN` = 1";

        $query = $this->db->query($query);

        if ($query->num_rows() > 0)
            $data = $query->row();
        else
            $data = FALSE;

        return $data;
    }

    function getRentangNilai($tahun_semester,$kode_prodi)
      {
        $query = "SELECT * FROM  e_tbbnl WHERE THSMSTBBNL = '$tahun_semester' AND KDPSTTBBNL='$kode_prodi' ORDER BY BOBOTTBBNL DESC";
        $query = $this->db->query($query);

		if($query->num_rows()>0){
          $data = $query->result();
        }
        else $data = NULL;

		return $data;
      }

    function getBobotNilai($tahun_semester,$kode_prodi,$nilai)
      {
      	if($nilai=='-') $nilai='T';
        $query = "SELECT * FROM  e_tbbnl WHERE THSMSTBBNL = '$tahun_semester' AND KDPSTTBBNL='$kode_prodi' AND NLAKHTBBNL='$nilai'";
        //echo "<b>".$query."</b><br>";
        //exit();
        $query = $this->db->query($query);

		if($query->num_rows()>0){
          $data = $query->row();
          //print_r($data);exit();
        }
        else $data = FALSE;

		return $data;
      }

      function getPD($fak){
        $query = "SELECT PD1 FROM  fakultas WHERE ID = '$fak' LIMIT 1";
        //echo $query;exit();
        $query = $this->db->query($query);

		if($query->num_rows()>0){
          $data = $query->row();
        }
        else $data = NULL;

		return $data;
      }
      
      function cekSkripsiByNim($nim){
		$query = "SELECT * FROM `view_data_skripsi` WHERE NIM ='$nim' LIMIT 1";

        $query = $this->db->query($query);

        if ($query->num_rows() > 0)
            $data = $query->row();
        else
            $data = FALSE;

        return $data;
	}
	
	function cekPersyaratan($nim){
		$query = "SELECT count(NIM) as JUMLAH FROM `view_syarat_wisuda` WHERE NIM ='$nim' LIMIT 1";

        $query = $this->db->query($query);

        if ($query->num_rows() > 0)
            $data = $query->row();
        else
            $data = FALSE;

        return $data;
	}
	
	function insertPersyaratan($nim){
		$query = "INSERT INTO `wisuda_persyaratan`(
		`NIM`
		) VALUES (
		'$nim'
		)";
        $query = $this->db->query($query);	
		if($query)
        {
          return TRUE;
        }
        else
        {
          return FALSE;
        }
	}
	//----|poling|-----/
	function cekpernahisi($nisn,$id_question){
    $sql="SELECT * FROM polling_hasil where NISN='$nisn' AND ID_QUESTION='$id_question'  LIMIT 1";
	//echo $sql;exit();
    $query = $this->db->query($sql);
    if($query->num_rows()>0){
          $data = $query->row();
          return $data;
      }
      else{
        return FALSE;
      }
  	}
	function ambildatapollinguser(){
	    $sql="SELECT * FROM polling_question where AKTIF>0";
		
	    $query = $this->db->query($sql);
	    if($query->num_rows()>0){
	          $data = $query->row();
	          return $data;
	      }
	      else{
	        return FALSE;
	      }
	}
	function insertPollingHasilModel($nim,$smt,$id_trakd,$answer1,$answer2,$answer3,$answer4,$answer5,$answer6,$answer7,$answer8,$answer9,$answer10,$answer11,$answer12,$answer13,$answer14,$answer15,$answer16,$answer17,$answer18,$answer19,$answer20,$answer21,$answer22,$answer23,$answer24,$answer25,$answer26,$answer27,$answer28,$answer29,$answer30,$answer31,$answer32,$answer33,$answer34,$answer35)
		{
			//echo $nim."akhir"; exit();
			$sql="INSERT INTO polling_hasil_khs VALUES 
			(NULL,
			'$nim',
			'$smt',
			'$id_trakd',
			'$answer1',
			'$answer2',
			'$answer3',
			'$answer4',
			'$answer5',
			'$answer6',
			'$answer7',
			'$answer8',
			'$answer9',
			'$answer10',
			'$answer11',
			'$answer12',
			'$answer13',
			'$answer14',
			'$answer15',
			'$answer16',
			'$answer17',
			'$answer18',
			'$answer19',
			'$answer20',
            '$answer21',
            '$answer22',
            '$answer23',
            '$answer24',
            '$answer25',
            '$answer26',
            '$answer27',
            '$answer28',
            '$answer29',
            '$answer30',
            '$answer31',
            '$answer32',
            '$answer33',
            '$answer34',
            '$answer35'
            )";
	  		//echo $sql; exit();
	    	$query = $this->db->query($sql);
	    	if($query){
	          return TRUE;
	      	}
	      	else{
	        	return FALSE;
	      	} 
	}
	function ambilMk($nim,$tahunsmt){
	    $sql="SELECT * FROM view_data_enrollment_dual where NIM='$nim' AND TAHUN_SEMESTER='$tahunsmt'";
		//echo $sql;exit();
	    $query = $this->db->query($sql);
	    if($query->num_rows()>0){
	          $data = $query->result();
	          return $data;
	      }
	      else{
	        return FALSE;
	      }
	}
	function cekIsi($nim,$idtrakd){
	    $sql="SELECT * FROM polling_hasil_khs WHERE NIM='$nim' AND ID_TRAKD='$idtrakd'";
		//echo $sql;exit();
	    $query = $this->db->query($sql);
	    if($query->num_rows()>0){
	          return TRUE;
	      }
	      else{
	        return FALSE;
	      }
	}
	function prosestampil(){
	    $sql="SELECT * FROM polling_question where AKTIF>0 ";
		//echo $sql;exit();
	    $query = $this->db->query($sql);
	    if($query->num_rows()>0){
	          $data = $query->result();
	          return $data;
	      }
	      else{
	        return FALSE;
	      }
	}
	function ambilenrollment($nim){
	    $sql="SELECT * FROM view_data_enrollment_dual where NIM='$nim'";
		//echo $sql;exit();
	    $query = $this->db->query($sql);
	    if($query->num_rows()>0){
	          $data = $query->row();
	          return $data;
	      }
	      else{
	        return FALSE;
	      }
	}
	function cekPolling($nim,$tahunsmt,$idmk){
	    $sql="SELECT * FROM polling_hasil_khs WHERE NIM='$nim' AND TAHUN_SEMESTER='$tahunsmt' AND ID_TRAKD='$idmk'";
		
	    $query = $this->db->query($sql);
	    if($query->num_rows()>0){
	          return 'TRUE';
	      }
	      else{
	        return 'FALSE';
	      }
	}

       function getViewKhsAllDistinctPerSemester($nim,$arraynya) {
        $qs="";     
        if($arraynya)
        {       
            foreach($arraynya AS $data){
                if($qs){
                    $qs .= " OR TAHUN_SEMESTER='".$data."'";  
                } else {
                    $qs = " AND ( TAHUN_SEMESTER='".$data."'";          
                }       
            }
            if($qs) $qs .= ")";         
        }
            
        $query = "SELECT DISTINCT(NO_MATAKULIAH) AS NO_MATAKULIAH, NAMA_MATAKULIAH, KODE_MATAKULIAH, SKS, TAHUN_SEMESTER FROM view_khs_all where `NIM`='$nim' $qs ORDER BY NO_MATAKULIAH ASC";
            //echo $query; exit();        
        $query = $this->db->query($query);

        if ($query->num_rows() > 0) {
            $data = $query->result();
        }
        else
            $data = NULL;

        return $data;
    }
function getKelasByKelas($id)
			{
			$querynya = "SELECT *  FROM kelompok_kelas where ID='$id'";
			       $query = $this->db->query($querynya);

			if($query){
			   return $query->row();
			}
			else{
				return FALSE;				
				}
				}

}


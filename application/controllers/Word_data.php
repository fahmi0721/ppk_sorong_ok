<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Word_data extends CI_Controller {



	/**

	 * Index Page for this controller.

	 *

	 * Maps to the following URL

	 * 		http://example.com/index.php/welcome

	 *	- or -

	 * 		http://example.com/index.php/welcome/index

	 *	- or -

	 * Since this controller is set as the default controller in

	 * config/routes.php, it's displayed at http://example.com/

	 *

	 * So any other public methods not prefixed with an underscore will

	 * map to /index.php/welcome/<method_name>

	 * @see https://codeigniter.com/user_guide/general/urls.html

	 */

	protected $myGuzzle;
	protected $token;
	protected $api_url;
	protected $api_url_anggaran;
	protected $api_url_pejabat;
	protected $api_url_penunjukan_peyedia;
	protected $api_url_spk;
	protected $api_url_hps;
	protected $api_url_pphp;
	protected $api_url_baphp;
	protected $api_url_bastb;
	protected $result;

	function __construct(){
		parent::__construct();
		$this->load->model('M_Login','ml');
		$this->ml->cek_login();
		$this->load->library('GuzzleMe');
		$this->load->library('MyLib');
		$this->myGuzzle = new GuzzleMe();
		$this->api_url_penunjukan_peyedia = base_url().'api/penunjukan_penyedia';
		$this->api_url_spk = base_url().'api/spk';
		$this->api_url_hps = base_url().'api/hps';
		$this->api_url_pphp = base_url().'api/pphp';
		$this->api_url_baphp = base_url().'api/baphp';
		$this->api_url_bastb = base_url().'api/bastb';
		$this->api_url_ba_bayar = base_url().'api/ba_bayar';
		$this->api_url_kwitansi = base_url().'api/kwitansi';
		$this->token = $this->session->userdata('token');
	}

    public function hps(){
        if(!empty($this->uri->segment(3))){
			$data['Id'] = $this->uri->segment(3);
			$param= array(
					"query" => $data,
					"headers" => array("Authorization" => $this->token)
			);
			$response = json_decode($this->myGuzzle->request_get($this->api_url_hps,$param),true);
			$dt = $response['data'][0];
            $anggaran = json_decode($dt['DataAnggaran'],true);
            $pejabat = json_decode($dt['DataPejabat'],true);
			$datas = [
                'NoHps' => $dt['NoSurat'],
                'Pekerjaan' => $dt['Pekerjaan'],
                'NamaAnggaran' => $anggaran['Nama'],
                'TahunAnggaran' => $anggaran['Tahun'],
                'NoAggaran' => $anggaran['Nomor'],
                'TglAnggaran' => $this->mylib->tgl_indo($anggaran['Tanggal']),
                'Tgl' => $this->mylib->tgl_indo($dt['Tgl']),
                'Pejabat' => $pejabat['Nama'],
                'Nip' => $pejabat['Nip'],
                'HariIni' => $this->mylib->hari_indo($dt['Tgl']),
            ];
            $this->load->library('word');
            $this->word->filename = 'surat_hps.docx';
            $this->word->data = $datas;
            $this->word->templ = "./application/docs/temp/hps.docx";
            $this->word->load_template();
		}else{
			redirect('data_pekerjaan');
		}
    }

	public function penunjukan_penyedia(){
		if(!empty($this->uri->segment(3))){
			$data['Id'] = $this->uri->segment(3);
			$param= array(
					"query" => $data,
					"headers" => array("Authorization" => $this->token)
			);
			$response = json_decode($this->myGuzzle->request_get($this->api_url_penunjukan_peyedia,$param),true);
			$dt = $response['data'][0];
			$Hps = json_decode($dt['DataHps'],true);
			$Vendor = json_decode($dt['DataVendor'],true);
			$Pejabat = json_decode($dt['DataPejabat'],true);
			$datas = [
                'NoSurat' => $dt['NoSurat'],
                'Tgl' => $this->mylib->tgl_indo($dt['Tgl']),
                'NamaVendor' => $Vendor['Nama'],
                'AlamatVendor' => $Vendor['Alamat'],
                'Pekerjaan' => strtolower($Hps['Pekerjaan']),
                'TglPenawaran' => $this->mylib->tgl_indo($dt['TglPenawaran']),
                'NilaiSepakat' => $this->mylib->rupiah1($dt['HargaSepakat']),
                'TerbilangSepakat' => $this->mylib->Terbilang($dt['HargaSepakat']),
                'Pejabat' => $Pejabat['Nama'],
                'PejabatNip' => $Pejabat['Nip']
            ];
            $this->load->library('word');
            $this->word->filename = 'surat_penunjukan_penyedia.docx';
            $this->word->data = $datas;
            $this->word->templ = "./application/docs/temp/pp.docx";
            $this->word->load_template();
		}else{
			redirect('data_pekerjaan');
		}
	}
	public function spk(){
		if(!empty($this->uri->segment(3))){
			$data['Id'] = $this->uri->segment(3);
			$param= array(
					"query" => $data,
					"headers" => array("Authorization" => $this->token)
			);
			$response = json_decode($this->myGuzzle->request_get($this->api_url_spk,$param),true);
			$dt = $response['data'][0];
			$pp = json_decode($dt['DataPP'],true);
			$Hps = json_decode($pp['DataHps'],true);
			$Anggaran = json_decode($Hps['DataAnggaran'],true);
			$Vendor = json_decode($pp['DataVendor'],true);
			$Pejabat = json_decode($dt['DataPejabat'],true);
			
			$Itemsd = json_decode($dt['DataItem'],true);
			$clonr = array();
			$clonrValue = array();
			$No = 1;
			$Jumlah =0;
			foreach($Itemsd as $key => $iData){
				$clonr['No'] =$No;
				foreach($iData as $kysData => $values){
					if($kysData == "NamaKegiatan"){
						$clonr['Kegiatan'] = $values;
					}elseif($kysData == "Volume"){
						$clonr['Vol'] = $this->mylib->rupiah1($values);
					}elseif($kysData == "SatuanUkuran"){
						$clonr['Satuan'] = $values;
					}elseif($kysData == "HargaSatuan"){
						$clonr['Harga'] = $this->mylib->rupiah1($values);
					}
				}
				$ttl = $iData['HargaSatuan'] * $iData['Volume'];
				$clonr['Total'] = $this->mylib->rupiah1($ttl);
				$clonrValue[] = $clonr;
				$Jumlah = $Jumlah + $ttl;
				$No++;
			}
			$iClonerow = array("No"=>$clonrValue);
			

			$datas = [
                'NoSpk' => $dt['NoSpk'],
                'NoSuratUndangan' => $dt['NoSuratUndangan'],
                'NoSuratBa' => $dt['NoBaPl'],
                'WaktuKerja' => $dt['WaktuKerja'],
                'WaktuKerjaTerbilang' => $this->mylib->Terbilang($dt['WaktuKerja']),
                'TglSuratUndangan' => $this->mylib->tgl_indo($dt['TglSuratUndangan']),
                'TglDari' => $this->mylib->tgl_indo($dt['TglDari']),
                'TglSampai' => $this->mylib->tgl_indo($dt['TglSampai']),
                'TglSuratBa' => $this->mylib->tgl_indo($dt['TglBaPl']),
                'TglSpk' => $this->mylib->tgl_indo($dt['Tgl']),
                'NamaVendor' => $Vendor['Nama'],
                'VendorNama' => $Vendor['NamaPimpinan'],
                'VendorJabatan' => $Vendor['Jabatan'],
                'AlamatVendor' => $Vendor['Alamat'],
                'PekerjaanUp' => strtoupper($Hps['Pekerjaan']),
                'Pekerjaan' => strtolower($Hps['Pekerjaan']),
                'NamaAnggaran' => strtoupper($Anggaran['Nama']),
                'TahunAnggaran' => $Anggaran['Tahun'],
                'NoAnggaran' => $Anggaran['Nomor'],
				'TglAnggaran' => $this->mylib->tgl_indo($Anggaran['Tanggal']),
                'NilaiKontrak' => $this->mylib->rupiah1($dt['NilaiKontrak']),
                'Terbilang' => $this->mylib->Terbilang($dt['NilaiKontrak']),
                'Pejabat' => $Pejabat['Nama'],
                'PejabatNip' => $Pejabat['Nip'],
				'Jumlah' => $this->mylib->rupiah1($Jumlah),
				'Pembulatan' => $this->mylib->rupiah1($dt['Pembulatan']),
				'Ppn' => $this->mylib->rupiah1($dt['Ppn']),
            ];
            $this->load->library('word');
            $this->word->filename = 'spk.docx';
            $this->word->data = $datas;
			$this->word->cloneRow = $iClonerow;

            $this->word->templ = "./application/docs/temp/spk.docx";
			$this->word->load_template();
		}else{
			redirect('data_pekerjaan');
		}
	}


	public function pphp(){
		if(!empty($this->uri->segment(3))){
			$data['Id'] = $this->uri->segment(3);
			$param= array(
					"query" => $data,
					"headers" => array("Authorization" => $this->token)
			);
			$response = json_decode($this->myGuzzle->request_get($this->api_url_pphp,$param),true);
			$dt = $response['data'][0];
			$spk = json_decode($dt['DataSpk'],true);
			$pp = json_decode($spk['DataPP'],true);
			$Hps = json_decode($pp['DataHps'],true);
			$Anggaran = json_decode($Hps['DataAnggaran'],true);
			$Vendor = json_decode($pp['DataVendor'],true);
			$Pejabat = json_decode($dt['DataPejabat'],true);
			$datas = [
                'NoSpk' => $spk['NoSpk'],
                'NoSurat' => $dt['NoSurat'],
                'pekerjaan' => strtolower($Hps['Pekerjaan']),
				'Tgl' => $this->mylib->tgl_indo($dt['Tgl']),
				'TglSpk' => $this->mylib->tgl_indo($spk['Tgl']),
				'TglPermintaan' => $this->mylib->tgl_indo($dt['TglPermintaan']),
				'NamaVendor' => $Vendor['Nama'],
                'Pejabat' => $Pejabat['Nama'],
                'PejabatNip' => $Pejabat['Nip']
            ];
            $this->load->library('word');
            $this->word->filename = 'pphp.docx';
            $this->word->data = $datas;
            $this->word->templ = "./application/docs/temp/pphp.docx";
			$this->word->load_template();
		}else{
			redirect('data_pekerjaan');
		}
	}

	public function baphp(){
		if(!empty($this->uri->segment(3))){
			$data['Id'] = $this->uri->segment(3);
			$param= array(
					"query" => $data,
					"headers" => array("Authorization" => $this->token)
			);
			$response = json_decode($this->myGuzzle->request_get($this->api_url_baphp,$param),true);
			$dt = $response['data'][0];
			$pphp = json_decode($dt['DataPphp'],true);
			$pemeriksa = json_decode($dt['DataPemeriksa'],true);
			$spk = json_decode($pphp['DataSpk'],true);
			$pp = json_decode($spk['DataPP'],true);
			$Hps = json_decode($pp['DataHps'],true);
			$Anggaran = json_decode($Hps['DataAnggaran'],true);
			$Vendor = json_decode($pp['DataVendor'],true);
			$Pejabat = json_decode($pemeriksa['DataPemeriksa'],true);
			$datas = [
                'NoSpk' => $spk['NoSpk'],
                'NoSurat' => $dt['NoSurat'],
                'NoSuratPphp' => $pphp['NoSurat'],
                'Pekerjaan' => strtolower($Hps['Pekerjaan']),
				'Tgl' => $this->mylib->tgl_indo($pphp['Tgl']),
				'TglPphp' => $this->mylib->tgl_indo($dt['Tgl']),
				'HariIni' => $this->mylib->hari_indo($dt['Tgl']),
				'TglSpk' => $this->mylib->tgl_indo($spk['Tgl']),
				'NoSk' => $pemeriksa['NoSk'],
				'TahunAnggaran' => $Anggaran['Tahun'],
				'TglSk' => $this->mylib->tgl_indo($pemeriksa['Tanggal']),
				'NamaVendor' => $Vendor['Nama'],
				'VendorNama' => $Vendor['NamaPimpinan'],
				'VendorJabatan' => $Vendor['Jabatan'],
				'PejabatSk0' => $Pejabat[0]['Nama'],
				'PejabatNipSk0' => $Pejabat[0]['Nip'],
				'PejabatSk1' => $Pejabat[1]['Nama'],
				'PejabatNipSk1' => $Pejabat[1]['Nip'],
				'PejabatSk2' => $Pejabat[2]['Nama'],
				'PejabatNipSk2' => $Pejabat[2]['Nip'],
				'PejabatSk3' => $Pejabat[3]['Nama'],
				'PejabatNipSk3' => $Pejabat[3]['Nip'],
            ];
            $this->load->library('word');
            $this->word->filename = 'baphp.docx';
            $this->word->data = $datas;
            $this->word->templ = "./application/docs/temp/baphp.docx";
			$this->word->load_template();
		}else{
			redirect('data_pekerjaan');
		}
	}

	public function bastb(){
		if(!empty($this->uri->segment(3))){
			$data['Id'] = $this->uri->segment(3);
			$param= array(
					"query" => $data,
					"headers" => array("Authorization" => $this->token)
			);
			$response = json_decode($this->myGuzzle->request_get($this->api_url_bastb,$param),true);
			$dt = $response['data'][0];
			$baphp = json_decode($dt['DataBaPhp'],true);
			$pphp = json_decode($baphp['DataPphp'],true);
			$spk = json_decode($pphp['DataSpk'],true);
			$pp = json_decode($spk['DataPP'],true);
			$Hps = json_decode($pp['DataHps'],true);
			$Anggaran = json_decode($Hps['DataAnggaran'],true);
			$Vendor = json_decode($pp['DataVendor'],true);
			$Pejabat = json_decode($dt['DataPejabat'],true);
			$datas = [
                'NoSpk' => $spk['NoSpk'],
                'NoSurat' => $dt['NoSurat'],
                'NoBaphp' => $baphp['NoSurat'],
                'WaktuKerjaTerbilang' => $this->mylib->Terbilang($spk['WaktuKerja']),
                'TglDari' => $this->mylib->tgl_indo($spk['TglDari']),
                'TglSampai' => $this->mylib->tgl_indo($spk['TglSampai']),
                'TglBaphp' => $this->mylib->tgl_indo($baphp['Tgl']),
                'TglSpk' => $this->mylib->tgl_indo($spk['Tgl']),
                'HariIni' => $this->mylib->hari_indo($dt['Tgl']),
                'Pejabat' => $Pejabat['Nama'],
                'PejabatNip' => $Pejabat['Nip'],
                'PejabatDeskripsiPekerjaan' => $Pejabat['DeskripsiJabatan'],
                'PejabatAlamat' => $Pejabat['Alamat'],
                'VendorNama' => $Vendor['NamaPimpinan'],
                'VendorJabatan' => $Vendor['Jabatan'],
                'VendorAlamat' => $Vendor['Alamat'],
                'NamaVendor' => $Vendor['Nama'],
                'WaktuKerja' => $spk['WaktuKerja'],
                'Pekerjaan' => strtolower($Hps['Pekerjaan']),
            ];
            $this->load->library('word');
            $this->word->filename = 'bastb.docx';
            $this->word->data = $datas;
            $this->word->templ = "./application/docs/temp/bastb.docx";
			$this->word->load_template();
		}else{
			redirect('data_pekerjaan');
		}
	}

	public function ba_bayar(){
		if(!empty($this->uri->segment(3))){
			$data['Id'] = $this->uri->segment(3);
			$param= array(
					"query" => $data,
					"headers" => array("Authorization" => $this->token)
			);
			$response = json_decode($this->myGuzzle->request_get($this->api_url_ba_bayar,$param),true);
			$dt = $response['data'][0];
			$ba_bayar = json_decode($dt['DataBastb'],true);
			$baphp = json_decode($ba_bayar['DataBaPhp'],true);
			$pphp = json_decode($baphp['DataPphp'],true);
			$spk = json_decode($pphp['DataSpk'],true);
			$pp = json_decode($spk['DataPP'],true);
			$Hps = json_decode($pp['DataHps'],true);
			$Anggaran = json_decode($Hps['DataAnggaran'],true);
			$Vendor = json_decode($pp['DataVendor'],true);
			$Pejabat = json_decode($dt['DataPejabat'],true);
			$datas = [
                'NoSpk' => $spk['NoSpk'],
                'NoSurat' => $dt['NoSurat'],
                'NoBaphp' => $baphp['NoSurat'],
                'TglBaphp' => $this->mylib->tgl_indo($baphp['Tgl']),
                'TglSpk' => $this->mylib->tgl_indo($spk['Tgl']),
                'HariIni' => $this->mylib->hari_indo($dt['Tgl']),
                'Pejabat' => $Pejabat['Nama'],
                'PejabatNip' => $Pejabat['Nip'],
                'PejabatJabatan' => $Pejabat['Jabatan'],
                'PejabatAlamat' => $Pejabat['Alamat'],
                'VendorNama' => $Vendor['NamaPimpinan'],
                'VendorJabatan' => $Vendor['Jabatan'],
                'VendorAlamat' => $Vendor['Alamat'],
                'NamaVendor' => $Vendor['Nama'],
                'AnggaranNama' => $Anggaran['Nama'],
                'TahunAnggaran' => $Anggaran['Tahun'],
                'TglAnggaran' => $this->mylib->tgl_indo($Anggaran['Tanggal']),
                'Pekerjaan' => strtolower($Hps['Pekerjaan']),
				'HargaSepakat' => $this->mylib->rupiah1($pp['HargaSepakat']),
                'HargaSepakatTerbilang' => $this->mylib->Terbilang($pp['HargaSepakat']),
                'Bank' => $Vendor['Bank'],
                'AtasNama' => $Vendor['AnBank'],
                'NoRek' => $Vendor['NoRek'],
                'DIbuatdi' => $dt['Dibuatdi'],
                'Tgl' => $this->mylib->tgl_indo($dt['Tgl']),

            ];
            $this->load->library('word');
            $this->word->filename = 'babayar.docx';
            $this->word->data = $datas;
            $this->word->templ = "./application/docs/temp/ba_bayar.docx";
			$this->word->load_template();
		}else{
			redirect('data_pekerjaan');
		}
	}


	public function kwitansi(){
		if(!empty($this->uri->segment(3))){
			$data['Id'] = $this->uri->segment(3);
			$param= array(
					"query" => $data,
					"headers" => array("Authorization" => $this->token)
			);
			$response = json_decode($this->myGuzzle->request_get($this->api_url_kwitansi,$param),true);
			$dt = $response['data'][0];
			$ba_bayar = json_decode($dt['DataBaBayar'],true);
			$bastb = json_decode($ba_bayar['DataBastb'],true);
			$baphp = json_decode($bastb['DataBaPhp'],true);
			$pphp = json_decode($baphp['DataPphp'],true);
			$spk = json_decode($pphp['DataSpk'],true);
			$pp = json_decode($spk['DataPP'],true);
			$Hps = json_decode($pp['DataHps'],true);
			$Anggaran = json_decode($Hps['DataAnggaran'],true);
			$Vendor = json_decode($pp['DataVendor'],true);
			$Pejabat = json_decode($dt['DataPejabat'],true);
			$PejabatTj = json_decode($dt['DataPejabatTj'],true);
			$datas = [
                'NoBukti' => $dt['NoBukti'],
                'Tgl' => $this->mylib->tgl_indo($dt['Tgl']),
                'TahunAnggaran' => $this->mylib->tgl_indo($Anggaran['Tahun']),
                'Pekerjaan' => strtolower($Hps['Pekerjaan']),
				'HargaSepakat' => $this->mylib->rupiah1($pp['HargaSepakat']),
                'HargaSepakatTerbilang' => $this->mylib->Terbilang($pp['HargaSepakat']),
                'Pejabat' => $Pejabat['Nama'],
                'PejabatNip' => $Pejabat['Nip'],
                'PejabatTj' => $PejabatTj['Nama'],
                'PejabatTjNip' => $PejabatTj['Nip'],
				'VendorNama' => $Vendor['NamaPimpinan'],
                'VendorJabatan' => $Vendor['Jabatan'],
                'VendorAlamat' => $Vendor['Alamat'],
                'NamaVendor' => $Vendor['Nama'],
            ];
            $this->load->library('word');
            $this->word->filename = 'kwitansi.docx';
            $this->word->data = $datas;
            $this->word->templ = "./application/docs/temp/kwitansi.docx";
			$this->word->load_template();
		}else{
			redirect('data_pekerjaan');
		}
	}



	/** PENUNJUKAN LANGSUNG */
	public function pl_penawaran(){
		if(!empty($this->uri->segment(3))){
			$Id = $this->uri->segment(3);
			$this->load->model("M_Pl_undangan","m");
			$dt = $this->m->detail_data($Id);
			$Kegiatans = json_decode($dt->Kegiatan,true);
			$Ttd = json_decode($dt->Pejabat,true);
			$datas = [
                'NoSurat' => $dt->NoSurat,
                'TglSurat' => $this->mylib->tgl_indo($dt->TglSurat),
                'Kepada' => $dt->Kepada,
                'AlamatVendor' => $dt->AlamatVendor,
                'KotaVendor' => $dt->KotaVendor,
                'Perihal' => $dt->Perihal,
                'Lampiran' => $dt->Lampiran,
                'Pekerjaan' => $dt->Pekerjaan,
                'LikPekerjaan' => $dt->LikPekerjaan,
                'NilaiHps' => $dt->NilaiHps,
                'SumberDana' => $dt->SumberDana,
                'TglKegiatan1' => $this->mylib->hari_indo($Kegiatans[0]).", ".$this->mylib->tgl_indo($Kegiatans[0]),
                'TglKegiatan2' => $this->mylib->hari_indo($Kegiatans[1]).", ".$this->mylib->tgl_indo($Kegiatans[1]),
                'TglKegiatan3' => $this->mylib->hari_indo($Kegiatans[2]).", ".$this->mylib->tgl_indo($Kegiatans[2]),
                'TglKegiatan4' => $this->mylib->hari_indo($Kegiatans[3]).", ".$this->mylib->tgl_indo($Kegiatans[3]),
				'JamKegiatan1' => $this->mylib->jam_indo($Kegiatans[0]),
                'JamKegiatan2' => $this->mylib->jam_indo($Kegiatans[1]),
                'JamKegiatan3' => $this->mylib->jam_indo($Kegiatans[2]),
                'JamKegiatan4' => $this->mylib->jam_indo($Kegiatans[3]),
                'Pejabat' => $Ttd[0],
                'Jabatan' => $Ttd[1],
                'Nip' => $Ttd[2],
               
            ];
            $this->load->library('word');
            $this->word->filename = 'pl_penawaran.docx';
            $this->word->data = $datas;
            $this->word->templ = "./application/docs/temp/pl_penawaran.docx";
			$this->word->load_template();
			// echo "<pre>";
			// print_r($datas);
		}else{
			redirect('data_pekerjaan');
		}
	}

	

}


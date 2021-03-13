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
                'HargaSepakat' => $this->mylib->rupiah1($pp['HargaSepakat']),
                'TerbilangSepakat' => $this->mylib->Terbilang($pp['HargaSepakat']),
                'Pejabat' => $Pejabat['Nama'],
                'PejabatNip' => $Pejabat['Nip']
            ];
            $this->load->library('word');
            $this->word->filename = 'spk.docx';
            $this->word->data = $datas;
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
			$data['data'] = $response['data'][0];
			$this->load->library('pdf');
			$this->pdf->setPaper('A4', 'potrait');
			$this->pdf->filename = "surat-baphp.pdf";
			$this->pdf->load_view('cetak_pdf/baphp',$data);
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
			$data['data'] = $response['data'][0];
			$this->load->library('pdf');
			$this->pdf->setPaper('A4', 'potrait');
			$this->pdf->filename = "surat-bastb.pdf";
			$this->pdf->load_view('cetak_pdf/bastb',$data);
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
			$data['data'] = $response['data'][0];
			$this->load->library('pdf');
			$this->pdf->setPaper('A4', 'potrait');
			$this->pdf->filename = "surat-ba-bayar.pdf";
			$this->pdf->load_view('cetak_pdf/ba_bayar',$data);
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
			$data['data'] = $response['data'][0];
			$this->load->library('pdf');
			$this->pdf->setPaper('A4', 'potrait');
			$this->pdf->filename = "surat-ba-bayar.pdf";
			$this->pdf->load_view('cetak_pdf/kwitansi',$data);
		}else{
			redirect('data_pekerjaan');
		}
	}

	
	

}


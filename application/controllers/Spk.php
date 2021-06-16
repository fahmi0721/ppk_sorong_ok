<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Spk extends CI_Controller {

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
	protected $lib;
	protected $token;
	protected $api_url_hps;
	protected $api_url_pejabat;
	protected $api_url_pp;
	protected $api_url;
	protected $result;



	function __construct(){
		parent::__construct();
		$this->load->model('M_Login','ml');
		$this->ml->cek_login();
		$this->load->library('GuzzleMe');
		$this->myGuzzle = new GuzzleMe();
		$this->token = $this->session->userdata('token');
		$this->api_url_hps = base_url().'api/hps';
		$this->api_url_pejabat = base_url().'api/pejabat';
		$this->api_url_pp = base_url().'api/data_pekerjaan/penunjukan_penuedia';
		$this->api_url = base_url().'api/spk';
		
		
	}

	public function tambah()
	{	
		if($this->uri->segment(3) != ""){
			/**
			 * getData HPS
			 */
			$data['Id'] = $this->uri->segment(3);
			$param= array(
					"query" => $data,
					"headers" => array("Authorization" => $this->token)
			);
			$response = json_decode($this->myGuzzle->request_get($this->api_url_hps,$param),true);
			$data['hps'] = $response['data'][0];
			/**
			 * getData Pejabat
			 */
			$param_all= array(
				"headers" => array("Authorization" => $this->token)
			);
			
			$response_pejabat = json_decode($this->myGuzzle->request_get($this->api_url_pejabat,$param_all),true);
			$data['pejabat'] = $response_pejabat['data'];
			/**
			 * getData Penunjukan Penyedia/Vendor
			 */
			$datas['NoSuratHps'] = $data['hps']['NoSurat'];
			$param_penunjukan_peyedia= array(
					"form_params" => $datas,
					"headers" => array("Authorization" => $this->token)
			);
			$response_penunjukan_peyedia = json_decode($this->myGuzzle->request_post($this->api_url_pp,$param_penunjukan_peyedia),true);
			unset($datas['NoSuratHps']);
			$data['pp'] = $response_penunjukan_peyedia['data'];
			if(!empty($this->session->userdata('ItemData'))){
				$this->session->set_userdata('ItemData', array());	
			}
			$this->ClearSpkBantu();
			$this->load->view('_template/header');
			$this->load->view('_template/sidebar');
			$this->load->view('spk/form_add',$data);
			$this->load->view('_template/footer');
		}else{
			redirect('/data_pekerjaan');
		}
	}

	public function ClearSpkBantu(){
		$Token = $this->session->userdata("token");
		$this->load->model('M_Spk_bantu','m');
		$data = $this->m->delete_by_token($Token);
	}

	public function edit()
	{	
		if($this->uri->segment(3) != ""){
			$this->load->library('MyLib');
			$this->lib = new MyLib();
			$this->ClearSpkBantu();
			$data['Id'] = $this->uri->segment(3);
			$param= array(
					"query" => $data,
					"headers" => array("Authorization" => $this->token)
			);
			$param_all= array(
				"headers" => array("Authorization" => $this->token)
			);
			$response = json_decode($this->myGuzzle->request_get($this->api_url,$param),true);
			$response_pejabat = json_decode($this->myGuzzle->request_get($this->api_url_pejabat,$param_all),true);
			$data['spk'] = $response['data'][0];
			$data['pejabat'] = $response_pejabat['data'];
			$data['pp'] = json_decode($data['spk']['DataPP'],true);
			$data['hps'] = json_decode($data['pp']['DataHps'],true);
			if(!empty($data['spk']['DataItem'])){
				$this->LastUpdateSpkBantu($data['spk']['DataItem']);
			}
			$data['spk']['Pembulatan'] = $this->lib->rupiah1($data['spk']['Pembulatan']);
			$this->load->view('_template/header');
			$this->load->view('_template/sidebar');
			$this->load->view('spk/form_edit',$data);
			$this->load->view('_template/footer');
		}else{
			redirect('/data_pekerjaan');
		}
	}

	public function LastUpdateSpkBantu($data){
		$data = json_decode($data,true);
		$this->load->model('M_Spk_bantu','m');
		foreach($data as $iData){
			$datas['NamaKegiatan'] = $iData['NamaKegiatan'];
			$datas['Volume'] = $iData['Volume'];
			$datas['SatuanUkuran'] = $iData['SatuanUkuran'];
			$datas['HargaSatuan'] = $iData['HargaSatuan'];
			$datas['UserId'] = $this->session->userdata('token');
			$this->m->save_data($datas);
		}
		return true;
		
	}

	// public function coba(){
	// 	$this->load->library('MyLib');
	// 	$this->lib = new MyLib();
	// 	echo $this->lib->SelisihWaktu("2020-11-01","2020-12-31");
	// }

	public function load_session(){
		$this->load->model('M_Spk_bantu','m');
		$data = $this->m->detail_data();
		echo json_encode($data);
	}
	
	public function hapus_session(){
		$Id = $this->input->post('Id');
		$this->load->model('M_Spk_bantu','m');
		$this->m->hapus_data($Id);
	}
	
	public function daftar_session(){
		$this->load->library('MyLib');
		$this->lib = new MyLib();
		$this->load->model('M_Spk_bantu','m');
		$data['NamaKegiatan'] = $this->input->post('NamaKegiatan');
		$data['Volume'] = $this->lib->angka($this->input->post('Volume'));
		$data['SatuanUkuran'] = $this->input->post('SatuanUkuran');
		$data['HargaSatuan'] = $this->lib->angka($this->input->post('HargaSatuan'));
		$data['UserId'] = $this->session->userdata('token');
		$this->m->save_data($data);
		$res['status'] = true;
		$res['message'] = "Berhasil menambah uraian SPK";
		echo json_encode($res);

	}


	public function simpan()
	{	
		$this->load->library('MyLib');
		$this->lib = new MyLib();
		$this->load->model('M_Spk_bantu','m');

		$data['NoSuratHps'] = $this->input->post('NoSuratHps');
		$data['NoSuratPP'] = $this->input->post('NoSuratPP');
		$data['NoSpk'] = $this->input->post('NoSpk');
		$data['Tgl'] = $this->input->post('Tgl');
		$data['TglSuratUndangan'] = $this->input->post('TglSuratUndangan');
		$data['NoSuratUndangan'] = $this->input->post('NoSuratUndangan');
		$data['NoBaPl'] = $this->input->post('NoBaPl');
		$data['TglBaPl'] = $this->input->post('TglBaPl');
		$data['TglDari'] = $this->input->post('TglDari');
		$data['TglSampai'] = $this->input->post('TglSampai');
		$data['WaktuKerja'] = $this->lib->SelisihWaktu($data['TglDari'],$data['TglSampai']);
		$data['KodePejabat'] = $this->input->post('KodePejabat');
		$data['DataItem'] = json_encode($this->m->ambil_data());
		$data['Pembulatan'] = $this->lib->angka($this->input->post('Pembulatan'));
		$data['Ppn'] = $this->lib->angka($this->input->post('Pembulatan')) * (10/100);
		$data['NilaiKontrak'] = $this->lib->angka($this->input->post('Pembulatan')) + $data['Ppn'];

		$param= array(
				"form_params" => $data,
				"headers" => array("Authorization" => $this->token)
		);
		$response = $this->myGuzzle->request_post($this->api_url,$param);
		echo $response;
	}

	public function update()
	{	

		$this->load->library('MyLib');
		$this->lib = new MyLib();
		$this->load->model('M_Spk_bantu','m');

		$data['Id'] = $this->input->post('Id');
		$data['NoSuratHps'] = $this->input->post('NoSuratHps');
		$data['NoSuratPP'] = $this->input->post('NoSuratPP');
		$data['NoSpk'] = $this->input->post('NoSpk');
		$data['Tgl'] = $this->input->post('Tgl');
		$data['TglSuratUndangan'] = $this->input->post('TglSuratUndangan');
		$data['NoSuratUndangan'] = $this->input->post('NoSuratUndangan');
		$data['NoBaPl'] = $this->input->post('NoBaPl');
		$data['TglBaPl'] = $this->input->post('TglBaPl');
		$data['TglDari'] = $this->input->post('TglDari');
		$data['TglSampai'] = $this->input->post('TglSampai');
		$data['WaktuKerja'] = $this->lib->SelisihWaktu($data['TglDari'],$data['TglSampai']);
		$data['KodePejabat'] = $this->input->post('KodePejabat');
		$data['DataItem'] = json_encode($this->m->ambil_data());
		$data['Pembulatan'] = $this->lib->angka($this->input->post('Pembulatan'));
		$data['Ppn'] = $this->lib->angka($this->input->post('Pembulatan')) * (10/100);
		$data['NilaiKontrak'] = $this->lib->angka($this->input->post('Pembulatan')) + $data['Ppn'];
		$param= array(
				"form_params" => $data,
				"headers" => array("Authorization" => $this->token)
		);
		$response = $this->myGuzzle->request_put($this->api_url,$param);
		echo $response;
	}
	

	public function delete()
	{	
		$data['Id'] = $this->input->post('Id');
		$param= array(
				"form_params" => $data,
				"headers" => array("Authorization" => $this->token)
		);
		$response = $this->myGuzzle->request_delete($this->api_url,$param);
		echo $response;
	}
	


	
}

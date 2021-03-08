<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Data_pekerjaan extends CI_Controller {



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
	protected $api_url_pphp;
	protected $api_url_baphp;
	protected $api_url_bastb;
	protected $api_url_ba_bayar;
	protected $result;

	function __construct(){
		parent::__construct();
		$this->load->model('M_Login','ml');
		$this->ml->cek_login();
		$this->load->library('GuzzleMe');
		$this->myGuzzle = new GuzzleMe();
		$this->api_url = base_url().'api/hps';
		$this->api_url_anggaran = base_url().'api/anggaran';
		$this->api_url_pejabat = base_url().'api/pejabat';
		$this->api_url_penunjukan_peyedia = base_url().'api/data_pekerjaan/penunjukan_penuedia';
		$this->api_url_spk = base_url().'api/data_pekerjaan/spk';
		$this->api_url_pphp = base_url().'api/data_pekerjaan/pphp';
		$this->api_url_baphp = base_url().'api/data_pekerjaan/baphp';
		$this->api_url_bastb = base_url().'api/data_pekerjaan/bastb';
		$this->api_url_ba_bayar = base_url().'api/data_pekerjaan/ba_bayar';
		$this->token = $this->session->userdata('token');
	}



	public function index()
	{	
		$param= array(
			"headers" => array("Authorization" => $this->token)
		);
		$response = json_decode($this->myGuzzle->request_get($this->api_url,$param),true);
		if($response['status'] === true){
			$this->result['data'] = $response['data'];
			$this->load->view('_template/header');
			$this->load->view('_template/sidebar');
			$this->load->view('data_pekerjaan/main',$this->result);
			$this->load->view('_template/footer');
		}else{
			redirect('pekerjaan_baru');
		}
	}

	public function edit()
	{	
		$data = array();
		$param= array(
				"headers" => array("Authorization" => $this->token)
		);
		$data['Id'] = $this->uri->segment(3);
		$param_item= array(
			"query" => $data,
			"headers" => array("Authorization" => $this->token)
	)	;
		$response_anggaran = json_decode($this->myGuzzle->request_get($this->api_url_anggaran,$param),true);
		$response_pejabat = json_decode($this->myGuzzle->request_get($this->api_url_pejabat,$param),true);
		$response = json_decode($this->myGuzzle->request_get($this->api_url,$param_item),true);
		$data['anggaran'] = $response_anggaran['data'];
		$data['pejabat'] = $response_pejabat['data'];
		$data['item'] = $response['data'][0];
		$this->load->view('_template/header');
		$this->load->view('_template/sidebar');
		$this->load->view('data_pekerjaan/form_edit',$data);
		$this->load->view('_template/footer');
	}

	public function update()
	{	
		$data['Id'] = $this->input->post('Id');
		$data['NoSurat'] = $this->input->post('NoSurat');
		$data['Pekerjaan'] = $this->input->post('Pekerjaan');
		$data['KodeAnggaran'] = $this->input->post('KodeAnggaran');
		$data['Tgl'] = $this->input->post('Tgl');
		$data['KodePejabat'] = $this->input->post('KodePejabat');
		$param= array(
				"form_params" => $data,
				"headers" => array("Authorization" => $this->token)
		);
		$response = $this->myGuzzle->request_put($this->api_url,$param);
		echo $response;
	}

	public function cetak(){
		if(!empty($this->uri->segment(3))){
			$data['Id'] = $this->uri->segment(3);
			$param= array(
					"query" => $data,
					"headers" => array("Authorization" => $this->token)
			);
			$response = json_decode($this->myGuzzle->request_get($this->api_url,$param),true);
			$data['hps'] = $response['data'][0];
			$this->load->library('pdf');
			$this->pdf->setPaper('A4', 'potrait');
			$this->pdf->filename = "surat-penetapan-harga-perkiraan-sendiri.pdf";
			$this->pdf->load_view('cetak_pdf/hps', $data);
		}else{
			redirect('data_pekerjaan');
		}
	}

	public function progres()
	{	
		if($this->uri->segment(3) != ""){
			$Tot =1;
			/** 
			 * getData HPS
			 * 
			*/
			$data['Id'] = $this->uri->segment(3);
			$param= array(
					"query" => $data,
					"headers" => array("Authorization" => $this->token)
			);
			$response = json_decode($this->myGuzzle->request_get($this->api_url,$param),true);
			$data['hps'] = $response['data'][0];

			/**
			 * getData Penunjukan Penyedia/Vendor
			 */
			$datas['NoSuratHps'] = $data['hps']['NoSurat'];
			$param_penunjukan_peyedia= array(
					"form_params" => $datas,
					"headers" => array("Authorization" => $this->token)
			);
			$response_penunjukan_peyedia = json_decode($this->myGuzzle->request_post($this->api_url_penunjukan_peyedia,$param_penunjukan_peyedia),true);
			unset($datas['NoSuratHps']);
			$data['penunjukan_peyedia'] = $response_penunjukan_peyedia;
			$Tot = $response_penunjukan_peyedia['row'] > 0 ? $Tot + 1 : $Tot;
			/**
			 * getData SPK
			 * 
			 */
			$datas['NoSuratHps'] = $data['hps']['NoSurat'];
			$param_spk= array(
					"form_params" => $datas,
					"headers" => array("Authorization" => $this->token)
			);
			$response_spk = json_decode($this->myGuzzle->request_post($this->api_url_spk,$param_spk),true);
			unset($datas['NoSuratHps']);
			$data['spk'] = $response_spk;
			$Tot = $response_spk['row'] > 0 ? $Tot + 1 : $Tot;
			

			/**
			 * getData PPHP
			 * 
			 */
			$datas['NoSuratHps'] = $data['hps']['NoSurat'];
			$param_pphp= array(
					"form_params" => $datas,
					"headers" => array("Authorization" => $this->token)
			);
			$response_pphp = json_decode($this->myGuzzle->request_post($this->api_url_pphp,$param_pphp),true);
			unset($datas['NoSuratHps']);
			$data['pphp'] = $response_pphp;
			$Tot = $response_pphp['row'] > 0 ? $Tot + 1 : $Tot;

			/**
			 * getData BASTB
			 * 
			 */
			$datas['NoSuratHps'] = $data['hps']['NoSurat'];
			$param_bastb= array(
					"form_params" => $datas,
					"headers" => array("Authorization" => $this->token)
			);
			$response_bastb = json_decode($this->myGuzzle->request_post($this->api_url_bastb,$param_bastb),true);
			unset($datas['NoSuratHps']);
			$data['bastb'] = $response_bastb;
			$Tot = $response_bastb['row'] > 0 ? $Tot + 1 : $Tot;

			/**
			 * getData BAPHP
			 * 
			 */
			$datas['NoSuratHps'] = $data['hps']['NoSurat'];
			$param_baphp= array(
					"form_params" => $datas,
					"headers" => array("Authorization" => $this->token)
			);
			$response_baphp = json_decode($this->myGuzzle->request_post($this->api_url_baphp,$param_baphp),true);
			unset($datas['NoSuratHps']);
			$data['baphp'] = $response_baphp;
			$Tot = $response_baphp['row'] > 0 ? $Tot + 1 : $Tot;
			/**
			 * getData BA_BAYAR
			 * 
			 */
			$datas['NoSuratHps'] = $data['hps']['NoSurat'];
			$param_ba_bayar= array(
					"form_params" => $datas,
					"headers" => array("Authorization" => $this->token)
			);
			$response_ba_bayar = json_decode($this->myGuzzle->request_post($this->api_url_ba_bayar,$param_ba_bayar),true);
			unset($datas['NoSuratHps']);
			$data['ba_bayar'] = $response_ba_bayar;
			$Tot = $response_ba_bayar['row'] > 0 ? $Tot + 1 : $Tot;
			
			$data['Tot'] = $Tot;
			$data['Progress'] = ($Tot/8)*100;
			$this->load->view('_template/header');
			$this->load->view('_template/sidebar');
			$this->load->view('data_pekerjaan/progres',$data);
			$this->load->view('_template/footer');
		}else{
			redirect('/data_pekerjaan');
		}

	}

	

	


	

}


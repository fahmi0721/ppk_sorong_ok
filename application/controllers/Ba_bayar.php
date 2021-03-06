<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ba_bayar
 extends CI_Controller {

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
	protected $api_url_bastb;
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
		$this->api_url_bastb = base_url().'api/data_pekerjaan/bastb';
		$this->api_url = base_url().'api/ba_bayar';
		
		
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
			 * getData Pejabat & Pemeriksa
			 */
			$param_all= array(
				"headers" => array("Authorization" => $this->token)
			);
			
			$response_pejabat = json_decode($this->myGuzzle->request_get($this->api_url_pejabat,$param_all),true);
			$data['pejabat'] = $response_pejabat['data'];
			/**
			 * getData Bastb
			 */
			$datas['NoSuratHps'] = $data['hps']['NoSurat'];
			$param_bastb= array(
					"form_params" => $datas,
					"headers" => array("Authorization" => $this->token)
			);
			$response_bastb = json_decode($this->myGuzzle->request_post($this->api_url_bastb,$param_bastb),true);
			unset($datas['NoSuratHps']);
			$data['bastb'] = $response_bastb['data'];

			$this->load->view('_template/header');
			$this->load->view('_template/sidebar');
			$this->load->view('ba_bayar/form_add',$data);
			$this->load->view('_template/footer');
		}else{
			redirect('/data_pekerjaan');
		}
	}

	public function edit()
	{	
		if($this->uri->segment(3) != ""){
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
			$data['ba_bayar'] = $response['data'][0];
			$hps = json_decode($data['ba_bayar']['DataBastb'],true);
			$hps = json_decode($hps['DataBaPhp'],true);
			$hps = json_decode($hps['DataPphp'],true);
			$hps = json_decode($hps['DataSpk'],true);
			$hps = json_decode($hps['DataPP'],true);
			$data['hps'] = json_decode($hps['DataHps'],true);
			$data['pejabat'] = $response_pejabat['data'];
			$this->load->view('_template/header');
			$this->load->view('_template/sidebar');
			$this->load->view('ba_bayar/form_edit',$data);
			$this->load->view('_template/footer');
		}else{
			redirect('/data_pekerjaan');
		}
	}

	public function simpan()
	{	
		
		$data['NoSuratHps'] = $this->input->post('NoSuratHps');
		$data['NoSurat'] = $this->input->post('NoSurat');
		$data['NoBastb'] = $this->input->post('NoBastb');
		$data['Dibuatdi'] = $this->input->post('Dibuatdi');
		$data['Tgl'] = $this->input->post('Tgl');
		$data['KodePejabat'] = $this->input->post('KodePejabat');
		$param= array(
				"form_params" => $data,
				"headers" => array("Authorization" => $this->token)
		);
		$response = $this->myGuzzle->request_post($this->api_url,$param);
		echo $response;
	}

	public function update()
	{	
		$data['Id'] = $this->input->post('Id');
		$data['NoSuratHps'] = $this->input->post('NoSuratHps');
		$data['NoSurat'] = $this->input->post('NoSurat');
		$data['NoBastb'] = $this->input->post('NoBastb');
		$data['Dibuatdi'] = $this->input->post('Dibuatdi');
		$data['Tgl'] = $this->input->post('Tgl');
		$data['KodePejabat'] = $this->input->post('KodePejabat');
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

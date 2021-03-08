<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kwitansi
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
	protected $api_url_ba_bayar;
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
		$this->api_url_ba_bayar = base_url().'api/data_pekerjaan/ba_bayar';
		$this->api_url = base_url().'api/kwitansi';
		
		
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
			$param_ba_bayar= array(
					"form_params" => $datas,
					"headers" => array("Authorization" => $this->token)
			);
			$response_ba_bayar = json_decode($this->myGuzzle->request_post($this->api_url_ba_bayar,$param_ba_bayar),true);
			unset($datas['NoSuratHps']);
			$data['ba_bayar'] = $response_ba_bayar['data'];

			$this->load->view('_template/header');
			$this->load->view('_template/sidebar');
			$this->load->view('kwitansi/form_add',$data);
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
			$data['kwitansi'] = $response['data'][0];
			$hps = json_decode($data['kwitansi']['DataBaBayar'],true);
			$hps = json_decode($hps['DataBastb'],true);
			$hps = json_decode($hps['DataBaPhp'],true);
			$hps = json_decode($hps['DataPphp'],true);
			$hps = json_decode($hps['DataSpk'],true);
			$hps = json_decode($hps['DataPP'],true);
			$data['hps'] = json_decode($hps['DataHps'],true);
			$data['pejabat'] = $response_pejabat['data'];
			$this->load->view('_template/header');
			$this->load->view('_template/sidebar');
			$this->load->view('kwitansi/form_edit',$data);
			$this->load->view('_template/footer');
		}else{
			redirect('/data_pekerjaan');
		}
	}

	public function simpan()
	{	
		
		$data['NoBukti'] = $this->input->post('NoBukti');
		$data['NoBaBayar'] = $this->input->post('NoBaBayar');
		$data['NoSuratHps'] = $this->input->post('NoSuratHps');
		$data['Tgl'] = $this->input->post('Tgl');
		$data['KodePejabat'] = $this->input->post('KodePejabat');
		$data['KodePejabatTj'] = $this->input->post('KodePejabatTj');
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
		$data['NoBukti'] = $this->input->post('NoBukti');
		$data['NoBaBayar'] = $this->input->post('NoBaBayar');
		$data['NoSuratHps'] = $this->input->post('NoSuratHps');
		$data['Tgl'] = $this->input->post('Tgl');
		$data['KodePejabat'] = $this->input->post('KodePejabat');
		$data['KodePejabatTj'] = $this->input->post('KodePejabatTj');
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

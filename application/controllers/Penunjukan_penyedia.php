<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penunjukan_penyedia extends CI_Controller {

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
	protected $api_url_hps;
	protected $api_url_pejabat;
	protected $api_url_vendor;
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
		$this->api_url_vendor = base_url().'api/vendor';
		$this->api_url = base_url().'api/penunjukan_penyedia';
		
		
	}

	public function tambah()
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
			$response = json_decode($this->myGuzzle->request_get($this->api_url_hps,$param),true);
			$response_pejabat = json_decode($this->myGuzzle->request_get($this->api_url_pejabat,$param_all),true);
			$response_vendor = json_decode($this->myGuzzle->request_get($this->api_url_vendor,$param_all),true);
			$data['hps'] = $response['data'][0];
			$data['pejabat'] = $response_pejabat['data'];
			$data['vendor'] = $response_vendor['data'];
			$this->load->view('_template/header');
			$this->load->view('_template/sidebar');
			$this->load->view('penunjukan_penyedia/form_add',$data);
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
			$response_vendor = json_decode($this->myGuzzle->request_get($this->api_url_vendor,$param_all),true);
			$data['penunjukan_penyedia'] = $response['data'][0];
			$data['pejabat'] = $response_pejabat['data'];
			$data['vendor'] = $response_vendor['data'];
			$data['hps'] = json_decode($data['penunjukan_penyedia']['DataHps'],true);
			$this->load->view('_template/header');
			$this->load->view('_template/sidebar');
			$this->load->view('penunjukan_penyedia/form_edit',$data);
			$this->load->view('_template/footer');
		}else{
			redirect('/data_pekerjaan');
		}
	}

	

	public function simpan()
	{	
		$data['NoSuratHps'] = $this->input->post('NoSuratHps');
		$data['NoSurat'] = $this->input->post('Nomor');
		$data['TglPenawaran'] = $this->input->post('TglPenawaran');
		$data['Tgl'] = $this->input->post('Tgl');
		$data['KodePejabat'] = $this->input->post('KodePejabat');
		$data['KodeVendor'] = $this->input->post('KodeVendor');
		$data['HargaSepakat'] = preg_replace( '/[^0-9]/', '',$this->input->post('HargaSepakat'));
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
		$data['NoSurat'] = $this->input->post('Nomor');
		$data['NoSuratHps'] = $this->input->post('NoSuratHps');
		$data['TglPenawaran'] = $this->input->post('TglPenawaran');
		$data['HargaSepakat'] = preg_replace( '/[^0-9]/', '',$this->input->post('HargaSepakat'));
		$data['Tgl'] = $this->input->post('Tgl');
		$data['KodePejabat'] = $this->input->post('KodePejabat');
		$data['KodeVendor'] = $this->input->post('KodeVendor');
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

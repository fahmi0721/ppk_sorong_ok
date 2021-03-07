<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pekerjaan_baru extends CI_Controller {

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
	protected $result;



	function __construct(){
		parent::__construct();
		$this->load->model('M_Login','ml');
		$this->ml->cek_login();
		$this->load->library('GuzzleMe');
		$this->myGuzzle = new GuzzleMe();
		$this->token = $this->session->userdata('token');
		$this->api_url = base_url().'/api/hps';
		$this->api_url_anggaran = base_url().'/api/anggaran';
		$this->api_url_pejabat = base_url().'/api/pejabat';
		
		
	}

	public function index()
	{	
		$data = array();
		$param= array(
				"headers" => array("Authorization" => $this->token)
		);
		try{
			$response_anggaran = json_decode($this->myGuzzle->request_get($this->api_url_anggaran,$param),true);
			$response_pejabat = json_decode($this->myGuzzle->request_get($this->api_url_pejabat,$param),true);
			$data['anggaran'] = in_array("data", $response_anggaran) ? $response_anggaran['data'] : "";
			$data['pejabat'] = in_array("data", $response_pejabat) ? $response_pejabat['data'] : "";
			$this->load->view('_template/header');
			$this->load->view('_template/sidebar');
			$this->load->view('pekerjaan_baru/form_add',$data);
			$this->load->view('_template/footer');
		}catch(Exception $e){
			echo $e->getMessage();
		}
	}

	

	public function simpan()
	{	
		$data['NoSurat'] = $this->input->post('NoSurat');
		$data['Pekerjaan'] = $this->input->post('Pekerjaan');
		$data['KodeAnggaran'] = $this->input->post('KodeAnggaran');
		$data['Tgl'] = $this->input->post('Tgl');
		$data['KodePejabat'] = $this->input->post('KodePejabat');
		$param= array(
				"form_params" => $data,
				"headers" => array("Authorization" => $this->token)
		);
		$response = $this->myGuzzle->request_post($this->api_url,$param);
		echo $response;
	}
	
	


	
}

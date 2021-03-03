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
			redirect('auth');
		}
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
			$data['Id'] = $this->uri->segment(3);
			$param= array(
					"query" => $data,
					"headers" => array("Authorization" => $this->token)
			);
			$response = json_decode($this->myGuzzle->request_get($this->api_url,$param),true);
			$data['hps'] = $response['data'][0];
			$datas['NoSuratHps'] = $data['hps']['NoSurat'];
			$param_penunjukan_peyedia= array(
					"form_params" => $datas,
					"headers" => array("Authorization" => $this->token)
			);
			$response_penunjukan_peyedia = json_decode($this->myGuzzle->request_post($this->api_url_penunjukan_peyedia,$param_penunjukan_peyedia),true);
			unset($datas['penunjukan_peyedia']);
			$data['penunjukan_peyedia'] = $response_penunjukan_peyedia;
			// print_r($data); exit;
			$this->load->view('_template/header');
			$this->load->view('_template/sidebar');
			$this->load->view('data_pekerjaan/progres',$data);
			$this->load->view('_template/footer');
		}else{
			redirect('/data_pekerjaan');
		}

	}

	public function coba(){
		$data['NoSuratHps'] = "PL.103/16/12/Poltekpel.Btn-2020";
		
		echo $response;
	}



	

}


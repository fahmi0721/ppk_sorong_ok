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

	public function coba(){
		if($this->uri->segment(3) != ""){
			$data['Id'] = $this->uri->segment(3);
			$param= array(
					"query" => $data,
					"headers" => array("Authorization" => $this->token)
			);
			$response = json_decode($this->myGuzzle->request_get($this->api_url,$param),true);
			$data['hps'] = $response['data'][0];
			// var_dump($data);exit;
			$this->load->library('pdf');
		
			$this->pdf->setPaper('A4', 'potrait');
			$this->pdf->filename = "surat-penetapan-hasil-perkiraan-sndiri.pdf";
			$this->pdf->load_view('cetak_pdf/hps', $data);
		}
	    
	}

	public function cetak_pdf(){
		if($this->uri->segment(3) != ""){
			$data['Id'] = $this->uri->segment(3);
			$param= array(
					"query" => $data,
					"headers" => array("Authorization" => $this->token)
			);
			$response = json_decode($this->myGuzzle->request_get($this->api_url,$param),true);
			$data['hps'] = $response['data'][0];
			// var_dump($data);exit;
			$this->load->library('pdf');
		
			$this->pdf->setPaper('A4', 'potrait');
			$this->pdf->filename = "surat-penetapan-hasil-perkiraan-sndiri.pdf";
			$this->pdf->load_view('cetak_pdf/hps', $data);
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
			// var_dump($data);exit;
			$this->load->view('_template/header');
			$this->load->view('_template/sidebar');
			$this->load->view('data_pekerjaan/progres',$data);
			$this->load->view('_template/footer');
		}else{
			redirect('/data_pekerjaan');
		}
	}

	public function simpan()
	{	
		$data['Nomor'] = $this->input->post('Nomor');
		$data['Nama'] = $this->input->post('Nama');
		$data['Tahun'] = $this->input->post('Tahun');
		$data['Tanggal'] = $this->input->post('Tanggal');
		$param= array(
				"form_params" => $data,
				"headers" => array("Authorization" => $this->token)
		);
		$response = $this->myGuzzle->request_post($this->api_url,$param);
		echo $response;
	}

	public function edit()
	{	
		if($this->uri->segment(3)!= ""){
			$data['id'] = $this->uri->segment(3);
			$param= array(
					"query" => $data,
					"headers" => array("Authorization" => $this->token)
			);
			$response = json_decode($this->myGuzzle->request_get($this->api_url,$param),true);
			$iData = array();
			$param2= array(
					"headers" => array("Authorization" => $this->token)
			);
			$response_anggaran = json_decode($this->myGuzzle->request_get($this->api_url_anggaran,$param2),true);
			$response_pejabat = json_decode($this->myGuzzle->request_get($this->api_url_pejabat,$param2),true);
			
			if($response['status'] === true){
				$iData['anggaran'] = $response_anggaran['data'];
				$iData['pejabat'] = $response_pejabat['data'];
				$iData['item'] = $response['data'][0];
				$this->load->view('_template/header');
				$this->load->view('_template/sidebar');
				$this->load->view('data_pekerjaan/form_edit',$iData);
				$this->load->view('_template/footer');
			}else{
				echo $response;
			}
		}else{
			redirect('users');
		}
		
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

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Panitia extends CI_Controller {

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
	protected $result;



	function __construct(){
		parent::__construct();
		$this->load->model('M_Login','ml');
		$this->ml->cek_login();
		$this->load->library('guzzleme');
		$this->myGuzzle = new GuzzleMe();
		$this->token = $this->session->userdata('token');
		$this->api_url = base_url().'/api/panitia_pemeriksa';
		
		
	}

	public function index()
	{	
		$this->session->set_userdata('data_pemeriksa',array());
		$param= array(
					"headers" => array("Authorization" => $this->token)
			);
		
		$response = json_decode($this->myGuzzle->request_get($this->api_url,$param),true);
		if($response['status'] === true){
			$this->result['data'] = $response['data'];
			$this->load->view('_template/header');
			$this->load->view('_template/sidebar');
			$this->load->view('panitia/main',$this->result);
			$this->load->view('_template/footer');
		}else{
			redirect('auth');
		}
	}
	

	public function load_pemeriksa(){
		// $this->session->unset_userdata('data_pemeriksa');
		if(is_array($this->session->userdata('data_pemeriksa'))){
			if(!empty($this->session->userdata('data_pemeriksa'))){
				$messg = [
					"status" => 200,
					"data" => $this->session->userdata('data_pemeriksa')
				];
			}else{
				$messg = [
					"status" => 201,
					"data" => array()
				];
			}
			echo json_encode($messg);
		}else{
			$this->session->set_userdata('data_pemeriksa',array());
			$messg = [
				"status" => 201,
				"data" => array()
			];
			echo json_encode($messg);
		}
		
	}

	public function add_data_to_session(){
		$oldData = empty($this->session->userdata('data_pemeriksa')) ? array() : $this->session->userdata('data_pemeriksa');
		$keys = rand(0,99).time();
		$rData = array(
			"Nama" => $this->input->post('NamaPemeriksa'),
			"Nip" => $this->input->post('Nip'),
			"Key" => $keys
		);
		array_push($oldData,$rData);
		$this->session->set_userdata('data_pemeriksa',$oldData);
		$meesage = [
			"status" => TRUE,
			"Message" => "Data berhasil di tambahkan"
		];
		echo json_encode($meesage);
	}

	public function hapus_data_to_session(){
		$Id = $this->input->post('Id');
		$Data = $this->session->userdata('data_pemeriksa');
		unset($Data[$Id]);
		$Data = $this->session->set_userdata('data_pemeriksa',$Data);
		$meesage = [
			"status" => TRUE,
			"Message" => "Data berhasil di hapus"
		];
		echo json_encode($meesage);
	}

	public function tambah()
	{	
		// $this->load_pemeriksa();
		$this->load->view('_template/header');
		$this->load->view('_template/sidebar');
		$this->load->view('panitia/form_add');
		$this->load->view('_template/footer');
		
	}

	public function simpan()
	{	
		$data['Nama'] = $this->input->post('Nama');
		$data['NoSk'] = $this->input->post('NoSk');
		$data['Perihal'] = $this->input->post('Perihal');
		$data['Tahun'] = $this->input->post('Tahun');
		$data['Tanggal'] = $this->input->post('Tanggal');
		$data['DataPemeriksa'] = json_encode($this->session->userdata('data_pemeriksa'));
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
			$data['Id'] = $this->uri->segment(3);
			$param= array(
					"query" => $data,
					"headers" => array("Authorization" => $this->token)
			);
			$response = json_decode($this->myGuzzle->request_get($this->api_url,$param),true);
			if($response['status'] === true){
				$iData = $response['data'][0];
				$this->session->set_userdata('data_pemeriksa',json_decode($iData['DataPemeriksa']),true);
				$this->load->view('_template/header');
				$this->load->view('_template/sidebar');
				$this->load->view('panitia/form_edit',$iData);
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
		$data['Nama'] = $this->input->post('Nama');
		$data['NoSk'] = $this->input->post('NoSk');
		$data['Perihal'] = $this->input->post('Perihal');
		$data['Tahun'] = $this->input->post('Tahun');
		$data['Tanggal'] = $this->input->post('Tanggal');
		$data['DataPemeriksa'] = json_encode($this->session->userdata('data_pemeriksa'));
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

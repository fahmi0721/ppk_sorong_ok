<?php
defined('BASEPATH') OR exit('No direct script access allowed');
// use GuzzleHttp\Client;
// use GuzzleHttp\Exception\ClientException;

class Auth extends CI_Controller {

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
	protected $message;
	function __construct(){
		parent::__construct();
		$this->load->library('guzzleme');
		$this->myGuzzle = new GuzzleMe();
		
	}

	public function index()
	{
		$this->load->view('login');
	}

	public function logout(){
		$this->session->unset_userdata('token');
		$this->session->unset_userdata('Nama');
		$this->session->unset_userdata('Jabatan');
		$this->session->unset_userdata('Level');
		$this->session->unset_userdata('is_login');
		redirect('/');
	}


	public function proses()
	{
		$Username = $this->input->post('Username');
		$Password = $this->input->post('Password');
		
		$param= array("form_params" => array(
						"Username" => $Username,
						"Password" => $Password
					)
			);
		$response = $this->myGuzzle->request_auth($param);
		$result = json_decode($response,true);
		
		if($result['status'] === TRUE){
			$this->session->set_userdata('token',$result['data']['token']);
			$this->session->set_userdata('Nama',$result['data']['Nama']);
			$this->session->set_userdata('Jabatan',$result['data']['Jabatan']);
			$this->session->set_userdata('Level',$result['data']['Level']);
			$this->session->set_userdata('is_login',TRUE);
			$this->message = [
				"status" => TRUE,
				"type" => "success",
				"message" => "Login Berhasil"
			];
			echo json_encode($this->message);
		}else{
			$this->message = [
				"status" => FALSE,
				"type" => "error",
				"message" => $result['message']
			];
			echo json_encode($this->message);
		}
	}


}

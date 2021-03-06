<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Cetak_data extends CI_Controller {



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
	protected $result;

	function __construct(){
		parent::__construct();
		$this->load->model('M_Login','ml');
		$this->ml->cek_login();
		$this->load->library('GuzzleMe');
		$this->myGuzzle = new GuzzleMe();
		$this->api_url_penunjukan_peyedia = base_url().'api/penunjukan_penyedia';
		$this->api_url_spk = base_url().'api/spk';
		$this->api_url_pphp = base_url().'api/pphp';
		$this->api_url_baphp = base_url().'api/baphp';
		$this->api_url_bastb = base_url().'api/bastb';
		$this->api_url_ba_bayar = base_url().'api/ba_bayar';
		$this->api_url_kwitansi = base_url().'api/kwitansi';
		$this->token = $this->session->userdata('token');
	}



	public function penunjukan_penyedia(){
		if(!empty($this->uri->segment(3))){
			$data['Id'] = $this->uri->segment(3);
			$param= array(
					"query" => $data,
					"headers" => array("Authorization" => $this->token)
			);
			$response = json_decode($this->myGuzzle->request_get($this->api_url_penunjukan_peyedia,$param),true);
			$data['data'] = $response['data'][0];
			$this->load->library('pdf');
			$this->pdf->setPaper('A4', 'potrait');
			$this->pdf->filename = "surat-penunjukan-penyedia.pdf";
			$this->pdf->load_view('cetak_pdf/penunjukan_penyedia',$data);
		}else{
			redirect('data_pekerjaan');
		}
	}
	public function spk(){
		if(!empty($this->uri->segment(3))){
			$data['Id'] = $this->uri->segment(3);
			$param= array(
					"query" => $data,
					"headers" => array("Authorization" => $this->token)
			);
			$response = json_decode($this->myGuzzle->request_get($this->api_url_spk,$param),true);
			$data['data'] = $response['data'][0];
			$this->load->library('pdf');
			$this->pdf->setPaper('A4', 'potrait');
			$this->pdf->filename = "surat-spk.pdf";
			$this->pdf->load_view('cetak_pdf/spk',$data);
		}else{
			redirect('data_pekerjaan');
		}
	}


	public function pphp(){
		if(!empty($this->uri->segment(3))){
			$data['Id'] = $this->uri->segment(3);
			$param= array(
					"query" => $data,
					"headers" => array("Authorization" => $this->token)
			);
			$response = json_decode($this->myGuzzle->request_get($this->api_url_pphp,$param),true);
			$data['data'] = $response['data'][0];
			$this->load->library('pdf');
			$this->pdf->setPaper('A4', 'potrait');
			$this->pdf->filename = "surat-pphp.pdf";
			$this->pdf->load_view('cetak_pdf/pphp',$data);
		}else{
			redirect('data_pekerjaan');
		}
	}

	public function baphp(){
		if(!empty($this->uri->segment(3))){
			$data['Id'] = $this->uri->segment(3);
			$param= array(
					"query" => $data,
					"headers" => array("Authorization" => $this->token)
			);
			$response = json_decode($this->myGuzzle->request_get($this->api_url_baphp,$param),true);
			$data['data'] = $response['data'][0];
			$this->load->library('pdf');
			$this->pdf->setPaper('A4', 'potrait');
			$this->pdf->filename = "surat-baphp.pdf";
			$this->pdf->load_view('cetak_pdf/baphp',$data);
		}else{
			redirect('data_pekerjaan');
		}
	}

	public function bastb(){
		if(!empty($this->uri->segment(3))){
			$data['Id'] = $this->uri->segment(3);
			$param= array(
					"query" => $data,
					"headers" => array("Authorization" => $this->token)
			);
			$response = json_decode($this->myGuzzle->request_get($this->api_url_bastb,$param),true);
			$data['data'] = $response['data'][0];
			$this->load->library('pdf');
			$this->pdf->setPaper('A4', 'potrait');
			$this->pdf->filename = "surat-bastb.pdf";
			$this->pdf->load_view('cetak_pdf/bastb',$data);
		}else{
			redirect('data_pekerjaan');
		}
	}

	public function ba_bayar(){
		if(!empty($this->uri->segment(3))){
			$data['Id'] = $this->uri->segment(3);
			$param= array(
					"query" => $data,
					"headers" => array("Authorization" => $this->token)
			);
			$response = json_decode($this->myGuzzle->request_get($this->api_url_ba_bayar,$param),true);
			$data['data'] = $response['data'][0];
			$this->load->library('pdf');
			$this->pdf->setPaper('A4', 'potrait');
			$this->pdf->filename = "surat-ba-bayar.pdf";
			$this->pdf->load_view('cetak_pdf/ba_bayar',$data);
		}else{
			redirect('data_pekerjaan');
		}
	}


	public function kwitansi(){
		if(!empty($this->uri->segment(3))){
			$data['Id'] = $this->uri->segment(3);
			$param= array(
					"query" => $data,
					"headers" => array("Authorization" => $this->token)
			);
			$response = json_decode($this->myGuzzle->request_get($this->api_url_kwitansi,$param),true);
			$data['data'] = $response['data'][0];
			$this->load->library('pdf');
			$this->pdf->setPaper('A4', 'potrait');
			$this->pdf->filename = "surat-ba-bayar.pdf";
			$this->pdf->load_view('cetak_pdf/kwitansi',$data);
		}else{
			redirect('data_pekerjaan');
		}
	}

	
	

}


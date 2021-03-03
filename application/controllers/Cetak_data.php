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
	protected $result;

	function __construct(){
		parent::__construct();
		$this->load->model('M_Login','ml');
		$this->ml->cek_login();
		$this->load->library('GuzzleMe');
		$this->myGuzzle = new GuzzleMe();
		// $this->api_url = base_url().'api/hps';
		// $this->api_url_anggaran = base_url().'api/anggaran';
		// $this->api_url_pejabat = base_url().'api/pejabat';
		$this->api_url_penunjukan_peyedia = base_url().'api/penunjukan_penyedia';
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
			// $this->load->view('cetak_pdf/penunjukan_penyedia',$data);
		}else{
			redirect('data_pekerjaan');
		}
	}

	
	

}


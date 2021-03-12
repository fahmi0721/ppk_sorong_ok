<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Example extends CI_Controller {

    public function index()
	{
	
		$data = [
			'NoHps' => 'PL.135/3/5/POLTEKPEL.SRG-2021',
			'Pekerjaan' => 'Instalasi Jaringan CCTV',
			'NamaAnggaran' => 'DIPA Satker Politeknik Pelayaran Sorong',
			'TahunAnggaran' => '2020',
			'NoAggaran' => 'SP DIPA022.12.1.654603/2020',
			'TglAnggaran' => '26 November 2020',
			'Pejabat' => 'Baco',
			'Nip' => '19900318 201503 1 006',
			'HariIni' => 'Kamis',
		];
		$this->load->library('word');
		$this->word->filename = 'surat_hps_fix.docx';
		$this->word->data = $data;
		$this->word->templ = "./application/docs/temp/hps.docx";
		$this->word->load_template();
	}
}

<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Pl_undangan extends CI_Controller {



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


	function __construct(){
		parent::__construct();
		$this->load->model('M_Login','ml');
		$this->load->model('M_Pl_undangan','m');
		$this->load->library('MyLib');
		$this->ml->cek_login();
	}

	public function ListKegiatan($dt){
		$res = "";
		$res .= "1. Pemasukan Dokumen Kualifikasi : ".$dt[0]."<br>";
		$res .= "2. Pemasukan Dokumen Penawaran   : ".$dt[1]."<br>";
		$res .= "3. Pembukaan Dokumen Penawaran, Evaluasi, Klarifikasi Teknis dan Negosiasi Harga : ".$dt[2]."<br>";
		$res .= "4. Penandatanganan SPK : ".$dt[3];
		return $res;
	}


	function get_data_peserta()
    {
        $list = $this->m->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $field) {
			$Pejabat = json_decode($field->Pejabat,true);
			$Kegiatan = json_decode($field->Kegiatan,true);
			$Kegiatan = $this->ListKegiatan($Kegiatan);
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $field->Perihal."<br><small>No Surat :".$field->NoSurat."</small><br><small>Tanggal Surat : ".$this->mylib->tgl_indo($field->TglSurat)."<br>Perihal : ".$field->Perihal."</small>";
            $row[] = $field->Kepada."<br><small>Alamat Vendor : ".$field->AlamatVendor."<br>Kota Vendor : ".$field->KotaVendor."</small>";
            $row[] = $this->mylib->rupiah1($field->NilaiHps);
            $row[] = $field->Pekerjaan;
            $row[] = "<small>".$Kegiatan."</small>";
            $row[] = $Pejabat[0]."<br><small>Jabatan : ".$Pejabat[1]."<br>NIP : ".$Pejabat[2]."</small>";
            $row[] = "<center><span class='btn-group'><a data-toggle='tooltip' href='".base_url()."pl_undangan/form_lampiran?Id=".$field->Id."' title='Tambah Lampiran' class='btn btn-primary btn-xs'><i class='fa fa-plus'></i></a><a data-toggle='tooltip' href='".base_url()."pl_undangan/edit?Id=".$field->Id."' title='Ubah Data' class='btn btn-info btn-xs'><i class='fa fa-edit'></i></a><a data-toggle='tooltip' href='javascript:void(0)' title='Hapus Data' onclick='ShowConfirm(".$field->Id.")' class='btn btn-danger btn-xs'><i class='fa fa-trash-o'></i></a></span></center>";
            $data[] = $row;
        }
 
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->m->count_all(),
            "recordsFiltered" => $this->m->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
	}

	public function index()
	{	
		
		$this->load->view('_template/header');
		$this->load->view('_template/sidebar');
		$this->load->view('pl_undangan/main');
		$this->load->view('_template/footer');
	
	}

	public function edit()
	{	
		$Id = $this->input->get("Id");
		$data['data'] = $this->m->detail_data($Id);
		$this->load->view('_template/header');
		$this->load->view('_template/sidebar');
		$this->load->view('pl_undangan/form_edit',$data);
		$this->load->view('_template/footer');
	
	}

	public function form_tambah()
	{	
		
		$this->load->view('_template/header');
		$this->load->view('_template/sidebar');
		$this->load->view('pl_undangan/form_tambah');
		$this->load->view('_template/footer');
	
	}


	public function save(){
		$data['NoSurat'] = $this->input->post('NoSurat');
		$data['TglSurat'] = $this->input->post('TglSurat');
		$data['Lampiran'] = $this->input->post('Lampiran');
		$data['Perihal'] = $this->input->post('Perihal');
		$data['Kepada'] = $this->input->post('Kepada');
		$data['KotaVendor'] = $this->input->post('KotaVendor');
		$data['AlamatVendor'] = $this->input->post('AlamatVendor');
		$data['SumberDana'] = $this->input->post('SumberDana');
		$data['Pekerjaan'] = $this->input->post('Pekerjaan');
		$data['LikPekerjaan'] = $this->input->post('LikPekerjaan');
		$data['NilaiHps'] = $this->input->post('NilaiHps');
		$data['Kegiatan'] = json_encode($this->input->post('Kegiatan'));
		$data['Pejabat'] = json_encode($this->input->post('Pejabat'));
		try {
			$this->m->save_data($data);
			$msg['status'] = TRUE;
			$msg['pesan'] = "Data berhasil tersimpan!";
			echo json_encode($msg);
		} catch (Exception $e) {
			$msg['status'] = FALSE;
			$msg['pesan'] = "Data gagal tersimpan!";
			echo json_encode($msg);
		}
	
	}

	public function update(){
		$Id= $this->input->post('Id');
		$data['NoSurat'] = $this->input->post('NoSurat');
		$data['TglSurat'] = $this->input->post('TglSurat');
		$data['Lampiran'] = $this->input->post('Lampiran');
		$data['Perihal'] = $this->input->post('Perihal');
		$data['Kepada'] = $this->input->post('Kepada');
		$data['KotaVendor'] = $this->input->post('KotaVendor');
		$data['AlamatVendor'] = $this->input->post('AlamatVendor');
		$data['SumberDana'] = $this->input->post('SumberDana');
		$data['Pekerjaan'] = $this->input->post('Pekerjaan');
		$data['LikPekerjaan'] = $this->input->post('LikPekerjaan');
		$data['NilaiHps'] = $this->input->post('NilaiHps');
		$data['Kegiatan'] = json_encode($this->input->post('Kegiatan'));
		$data['Pejabat'] = json_encode($this->input->post('Pejabat'));
		try {
			$this->m->update_data($Id,$data);
			$msg['status'] = TRUE;
			$msg['pesan'] = "Data berhasil trupdate!";
			echo json_encode($msg);
		} catch (Exception $e) {
			$msg['status'] = FALSE;
			$msg['pesan'] = "Data gagal trupdate!";
			echo json_encode($msg);
		}
	
	}

	public function hapus(){
		$Id= $this->input->post('Id');
		try {
			$this->m->hapus_data($Id);
			$msg['status'] = TRUE;
			$msg['pesan'] = "Data berhasil hapus!";
			echo json_encode($msg);
		} catch (Exception $e) {
			$msg['status'] = FALSE;
			$msg['pesan'] = "Data gagal hapus!";
			echo json_encode($msg);
		}
	
	}

}


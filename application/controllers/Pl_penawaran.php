<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Pl_penawaran extends CI_Controller {



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
		$this->load->library('session');
		$this->load->model('M_Login','ml');
		$this->load->model('M_Pl_penawaran','m');
		$this->load->library('MyLib');
		$this->ml->cek_login();
	}



	function get_data_peserta()
    {
        $list = $this->m->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $field) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $field->Perihal."<br><small>No Surat :".$field->NoSurat."</small><br><small>Tanggal Surat : ".$this->mylib->tgl_indo($field->TglSurat)."<br>Perihal : ".$field->Perihal."</small>";
            $row[] = $field->Vendor."<br><small>Pimpinan: ".$field->NamaVendor."</small>";
            $row[] = $field->NoPl;
            $row[] = $field->Pekerjaan."<br><small>Waktu Pelaksanaan : ".$field->WaktuPelaksanaan."<br>Masa Berlaku : ".$field->MasaBerlaku."</small>";

			$btntb = "<a data-toggle='tooltip' href='".base_url()."pl_penawaran/form_fakta?Id=".$field->Id."' title='Fakta Integritas' class='btn btn-primary btn-xs'><i class='fa fa-plus'></i></a>";
			$btntb .= "<a data-toggle='tooltip' href='".base_url()."pl_penawaran/form_formulir?Id=".$field->Id."' title='Formulir Isian Kualifikasi' class='btn btn-warning btn-xs'><i class='fa fa-plus'></i></a>";
			$btntb .= "<a data-toggle='tooltip' href='".base_url()."pl_penawaran/form_da?Id=".$field->Id."' title='Data Administrasi' class='btn btn-primary btn-xs'><i class='fa fa-plus'></i></a>";
			$btntb .= "<a data-toggle='tooltip' href='".base_url()."pl_penawaran/form_lh?Id=".$field->Id."' title='Landasan Hukum Pendirian Perusahaan ' class='btn btn-warning btn-xs'><i class='fa fa-plus'></i></a>";
			$btntb .= "<a data-toggle='tooltip' href='".base_url()."pl_penawaran/form_pbu?Id=".$field->Id."' title='Pengurus Badan Usaha' class='btn btn-success btn-xs'><i class='fa fa-plus'></i></a>";


            $row[] = "<center><span class='btn-group'>".$btntb."<a data-toggle='tooltip' href='".base_url()."pl_penawaran/edit?Id=".$field->Id."' title='Ubah Data' class='btn btn-info btn-xs'><i class='fa fa-edit'></i></a><a data-toggle='tooltip' href='javascript:void(0)' title='Hapus Data' onclick='ShowConfirm(".$field->Id.")' class='btn btn-danger btn-xs'><i class='fa fa-trash-o'></i></a></span></center>";
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
		$this->load->view('pl_penawaran/main');
		$this->load->view('_template/footer');
	
	}

	public function form_fakta(){
		$Id = $this->input->get("Id");
		$data['data'] = $this->m->detail_fakta($Id);
		$data['data']['Id'] = $Id;
		$this->load->view('_template/header');
		$this->load->view('_template/sidebar');
		$this->load->view('pl_penawaran/form_fakta',$data);
		$this->load->view('_template/footer');
	}

	public function update_fakta(){
		$Id = $this->input->post('Id');
		$result['Nama'] = $this->input->post('Nama');
		$result['NoId'] = $this->input->post('NoId');
		$result['Jabatan'] = $this->input->post('Jabatan');
		$result['an'] = $this->input->post('an');
		$result['Perihal'] = $this->input->post('Perihal');
		$result['TglSurat'] = $this->input->post('TglSurat');
		$data['fakta_integritas'] = json_encode($result);
		try {
			$this->m->update_data($Id,$data);
			$msg['status'] = TRUE;
			$msg['pesan'] = "Data Fakta Integritas bersahil disimpan!";
			echo json_encode($msg);
		} catch (Exception $e) {
			$msg['status'] = FALSE;
			$msg['pesan'] = "Data gagal trupdate!";
			echo json_encode($msg);
		}
		
	}

	public function form_formulir(){
		$Id = $this->input->get("Id");
		$data['data'] = $this->m->detail_formulir($Id);
		$data['data']['Id'] = $Id;
		$this->load->view('_template/header');
		$this->load->view('_template/sidebar');
		$this->load->view('pl_penawaran/form_formulir',$data);
		$this->load->view('_template/footer');
	}

	public function update_formulir(){
		$Id = $this->input->post('Id');
		$result['Nama'] = $this->input->post('Nama');
		$result['NoId'] = $this->input->post('NoId');
		$result['Jabatan'] = $this->input->post('Jabatan');
		$result['an'] = $this->input->post('an');
		$result['Alamat'] = $this->input->post('Alamat');
		$result['NoTelp'] = $this->input->post('NoTelp');
		$result['Email'] = $this->input->post('Email');
		$result['Pernyataan'] = $this->input->post('Pernyataan');
		$data['formulir_isian'] = json_encode($result);
		try {
			$this->m->update_data($Id,$data);
			$msg['status'] = TRUE;
			$msg['pesan'] = "Data Formulir Isian Kualifikasi  bersahil disimpan!";
			echo json_encode($msg);
		} catch (Exception $e) {
			$msg['status'] = FALSE;
			$msg['pesan'] = "Data gagal trupdate!";
			echo json_encode($msg);
		}
		
	}


	public function form_da(){
		$Id = $this->input->get("Id");
		$data['data'] = $this->m->detail_da($Id);
		$data['data']['Id'] = $Id;
		$this->load->view('_template/header');
		$this->load->view('_template/sidebar');
		$this->load->view('pl_penawaran/form_da',$data);
		$this->load->view('_template/footer');
	}

	public function update_da(){
		$Id = $this->input->post('Id');
		$result['Nama'] = $this->input->post('Nama');
		$result['Status'] = $this->input->post('Status');
		$result['AlamatPusat'] = $this->input->post('AlamatPusat');
		$result['NoTelpPusat'] = $this->input->post('NoTelpPusat');
		$result['FaxPusat'] = $this->input->post('FaxPusat');
		$result['EmailPusat'] = $this->input->post('EmailPusat');
		$result['AlamatCabang'] = $this->input->post('AlamatCabang');
		$result['NoTelpCabang'] = $this->input->post('NoTelpCabang');
		$result['FaxCabang'] = $this->input->post('FaxCabang');
		$result['EmailCabang'] = $this->input->post('EmailCabang');
		$data['data_administrasi'] = json_encode($result);
		try {
			$this->m->update_data($Id,$data);
			$msg['status'] = TRUE;
			$msg['pesan'] = "Data Data Administrasi  bersahil disimpan!";
			echo json_encode($msg);
		} catch (Exception $e) {
			$msg['status'] = FALSE;
			$msg['pesan'] = "Data gagal trupdate!";
			echo json_encode($msg);
		}
		
	}


	public function form_lh(){
		$Id = $this->input->get("Id");
		$data['data'] = $this->m->detail_lh($Id);
		$data['data']['Id'] = $Id;
		$this->load->view('_template/header');
		$this->load->view('_template/sidebar');
		$this->load->view('pl_penawaran/form_lh',$data);
		$this->load->view('_template/footer');
	}

	public function update_lh(){
		$Id = $this->input->post('Id');
		$result['Nomor'] = $this->input->post('Nomor');
		$result['Tanggal'] = $this->input->post('Tanggal');
		$result['Nama'] = $this->input->post('Nama');
		$result['NoPengesahaan'] = $this->input->post('NoPengesahaan');
		$result['NomorPerubahan'] = $this->input->post('NomorPerubahan');
		$result['TanggalPerubahan'] = $this->input->post('TanggalPerubahan');
		$result['NamaPerubahan'] = $this->input->post('NamaPerubahan');
		$data['landasan_hukum'] = json_encode($result);
		try {
			$this->m->update_data($Id,$data);
			$msg['status'] = TRUE;
			$msg['pesan'] = "Data Landasan Hukum Pendirian Perusahaan  bersahil disimpan!";
			echo json_encode($msg);
		} catch (Exception $e) {
			$msg['status'] = FALSE;
			$msg['pesan'] = "Data gagal trupdate!";
			echo json_encode($msg);
		}
	}

	public function form_pbu(){
		$Id = $this->input->get("Id");
		$data['data']['Id'] = $Id;
		$data['iData'] = $idata = $this->m->detail_pbu($Id);
		$this->load->view('_template/header');
		$this->load->view('_template/sidebar');
		$this->load->view('pl_penawaran/form_pbu',$data);
		$this->load->view('_template/footer');
	}

	public function hapus_item_pbu(){
		$Id = $this->input->get("Id");
		$Key = $this->input->get("Key");
		$idata = $this->m->detail_pbu($Id);
		unset($idata[$Key]);
		$data['pengurus_badan'] = json_encode($idata);
		$this->m->update_data($Id,$data);
		redirect("pl_penawaran/form_pbu?Id=".$Id);
	}

	public function coba(){
		$idata = $this->m->detail_pbu(4);
		unset($idata[1]);
		echo "<pre>";
		print_r($idata);
	}

	public function update_pbu_opsi($old,$new){
		$idta = array();
		foreach($old as $key => $data){
			$idta[] = $data;
		}
		array_push($idta,$new);
		return $idta;
	}

	public function update_pbu(){
		$Id = $this->input->post('Id');
		$bc = array();
		$idata = $this->m->detail_pbu($Id);
		if(count($idata) > 0){
			$newData = array(
				"Nama" => $this->input->post("Nama"),
				"NoId" => $this->input->post("NoId"),
				"Jabatan" => $this->input->post("Jabatan")
			);
			$bc = $this->update_pbu_opsi($idata,$newData);

		}else{
			$newData = array(
				"Nama" => $this->input->post("Nama"),
				"NoId" => $this->input->post("NoId"),
				"Jabatan" => $this->input->post("Jabatan")
			);
			array_push($bc,$newData);
		}
		$data['pengurus_badan'] = json_encode($bc);
		try {
			$this->m->update_data($Id,$data);
			$msg['status'] = TRUE;
			$msg['pesan'] = "Data Landasan Hukum Pendirian Perusahaan  bersahil disimpan!";
			$this->session->unset_userdata('data_pbu');
			echo json_encode($msg);
		} catch (Exception $e) {
			$msg['status'] = FALSE;
			$msg['pesan'] = "Data gagal trupdate!";
			$this->session->unset_userdata('data_pbu');
			echo json_encode($msg);
		}
	}

	public function edit()
	{	
		$Id = $this->input->get("Id");
		$data['data'] = $this->m->detail_data($Id);
		$this->load->view('_template/header');
		$this->load->view('_template/sidebar');
		$this->load->view('pl_penawaran/form_edit',$data);
		$this->load->view('_template/footer');
	
	}

	public function form_tambah()
	{	
		
		$this->load->view('_template/header');
		$this->load->view('_template/sidebar');
		$this->load->view('pl_penawaran/form_tambah');
		$this->load->view('_template/footer');
	
	}


	public function save(){
		$data['NoSurat'] = $this->input->post('NoSurat');
		$data['TglSurat'] = $this->input->post('TglSurat');
		$data['Lampiran'] = $this->input->post('Lampiran');
		$data['Perihal'] = $this->input->post('Perihal');
		$data['NoPl'] = $this->input->post('NoPl');
		$data['Pekerjaan'] = $this->input->post('Pekerjaan');
		$data['WaktuPelaksanaan'] = $this->input->post('WaktuPelaksanaan');
		$data['MasaBerlaku'] = $this->input->post('MasaBerlaku');
		$data['NamaVendor'] = $this->input->post('NamaVendor');
		$data['Vendor'] = $this->input->post('Vendor');
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
		$data['NoPl'] = $this->input->post('NoPl');
		$data['Pekerjaan'] = $this->input->post('Pekerjaan');
		$data['WaktuPelaksanaan'] = $this->input->post('WaktuPelaksanaan');
		$data['MasaBerlaku'] = $this->input->post('MasaBerlaku');
		$data['NamaVendor'] = $this->input->post('NamaVendor');
		$data['Vendor'] = $this->input->post('Vendor');
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


<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Surat_penunjukan extends CI_Controller {



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
		$this->load->model('M_Surat_penunjukan','m');
		$this->load->library('MyLib');
		$this->ml->cek_login();
	}


	function get_data_peserta()
    {
        $list = $this->m->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $field) {
			$Pejabat = json_decode($field->Pejabat,true);
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = "Surat Penunjukan Pengadaan Barang dan Jasa Pada POLTEKPEL Sorong ".$field->Perihal."<br><small>No Surat :".$field->NoSurat."</small><br><small>Tanggal Surat : ".$this->mylib->tgl_indo($field->TglSurat)."</small>";
            $row[] = "<small>".$field->Dipa."</small>";
            $row[] = "<small>Pejabat Pengadaan Barang dan Jasa POLTEKPEL SORONG ".$field->Kepada."</small>";
            $row[] = $Pejabat[0]."<br><small>Jabatan : ".$Pejabat[1]."<br>NIP : ".$Pejabat[2]."</small>";
            $row[] = "<center><span class='btn-group'><a data-toggle='tooltip' href='".base_url()."surat_penunjukan/form_lampiran?Id=".$field->Id."' title='Tambah Lampiran' class='btn btn-primary btn-xs'><i class='fa fa-plus'></i></a><a data-toggle='tooltip' href='".base_url()."surat_penunjukan/edit?Id=".$field->Id."' title='Ubah Data' class='btn btn-info btn-xs'><i class='fa fa-edit'></i></a><a data-toggle='tooltip' href='javascript:void(0)' title='Hapus Data' onclick='ShowConfirm(".$field->Id.")' class='btn btn-danger btn-xs'><i class='fa fa-trash-o'></i></a></span></center>";
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
		$this->load->view('surat_penunjukan/main');
		$this->load->view('_template/footer');
	
	}

	public function edit()
	{	
		$Id = $this->input->get("Id");
		$data['data'] = $this->m->detail_data($Id);
		$this->load->view('_template/header');
		$this->load->view('_template/sidebar');
		$this->load->view('surat_penunjukan/form_edit',$data);
		$this->load->view('_template/footer');
	
	}

	public function form_tambah()
	{	
		
		$this->load->view('_template/header');
		$this->load->view('_template/sidebar');
		$this->load->view('surat_penunjukan/form_tambah');
		$this->load->view('_template/footer');
	
	}


	public function save(){
		$data['NoSurat'] = $this->input->post('NoSurat');
		$data['TglSurat'] = $this->input->post('TglSurat');
		$data['Lampiran'] = $this->input->post('Lampiran');
		$data['Perihal'] = $this->input->post('Perihal');
		$data['Kepada'] = $this->input->post('Kepada');
		$data['Dipa'] = $this->input->post('Dipa');
		$data['Pekerjaan'] = $this->input->post('Pekerjaan');
		$data['Pelaksanaan'] = $this->input->post('Pelaksanaan');
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
		$data['Dipa'] = $this->input->post('Dipa');
		$data['Pekerjaan'] = $this->input->post('Pekerjaan');
		$data['Pelaksanaan'] = $this->input->post('Pelaksanaan');
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


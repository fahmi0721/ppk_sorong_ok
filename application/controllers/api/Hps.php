<?php

defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
/** @noinspection PhpIncludeInspection */
require APPPATH . '/libraries/REST_Controller.php';

// use namespace
use Restserver\Libraries\REST_Controller;

/**
 * This is an example of a few basic user interaction methods you could use
 * all done with a hardcoded array
 *
 * @package         CodeIgniter
 * @subpackage      Rest Server
 * @category        Controller
 * @author          Phil Sturgeon, Chris Kacerguis
 * @license         MIT
 * @link            https://github.com/chriskacerguis/codeigniter-restserver
 */
class Hps extends REST_Controller {
    private $UserId;
    function __construct(){
        parent::__construct();
        $this->load->library("Authorization_Token");  
        $this->load->model('api/M_Hps','m');
        $is_valid_token = $this->authorization_token->validateToken();
        if(!empty($is_valid_token) && $is_valid_token['status'] === TRUE){
            $dtUser = $this->authorization_token->userData();
            $this->UserId = $dtUser->id;
        }
    }

    public function index_get(){
        /**
         * Get Data Vendor
         * @param: id
         * @return: data Vendor
         */
        $is_valid_token = $this->authorization_token->validateToken();
        if(!empty($is_valid_token) && $is_valid_token['status'] === TRUE){
            try {
                $Id = $this->get('Id');
                if(!empty($Id) && $Id != NULL){
                    $data = $this->m->loadData($Id);
                    if(!empty($data)){
                        $message = [
                            "status" => TRUE,
                            "data" => $data
                        ];
                        $this->response($message, REST_Controller::HTTP_OK);
                    }else{
                        $message = [
                            "status" => FALSE,
                            "message" => "data empty in table"
                        ];
                        $this->response($message, REST_Controller::HTTP_NOT_FOUND);
                    }
                }else{
                    $data = $this->m->loadData();
                    if(!empty($data)){
                        $message = [
                            "status" => TRUE,
                            "data" => $data
                        ];
                        $this->response($message, REST_Controller::HTTP_OK);
                    }else{
                        $message = [
                            "status" => FALSE,
                            "message" => "data empty in table"
                        ];
                        $this->response($message, REST_Controller::HTTP_NOT_FOUND);
                    }
                }
                
            } catch (\Exception $e) {
                $this->response($e->getMessage(), REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
            }
            
            
            
        }else{
            $this->response($is_valid_token , REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
        }
        
        
    }

    public function index_post(){
        /**
         * Cretae Vendor
         * @param: NamaPimpinan,Jabatan,Alamat,NoTelp, Bank,AnBank,NoRek,UserId
         * @return: status,message => jika gagal
         */

        $is_valid_token = $this->authorization_token->validateToken();
        if(!empty($is_valid_token) && $is_valid_token['status'] === TRUE){
            try {
                $res['NoSurat'] = $this->post('NoSurat');
                $res['Pekerjaan'] = $this->post('Pekerjaan');
                $res['KodeAnggaran'] = $this->post('KodeAnggaran');
                $res['DataAnggaran'] = $this->m->getDataAnggaran($this->post('KodeAnggaran'));
                $res['Tgl'] = $this->post('Tgl');
                $res['KodePejabat'] = $this->post('KodePejabat');
                $res['DataPejabat'] = $this->m->getDataPejabat($this->post('KodePejabat'));
                $res['UserId'] = $this->UserId;
                if($this->m->cekDataExits($res['NoSurat']) <= 0){
                    if($this->m->createData($res) > 0){
                        $message = [
                            "status" => TRUE,
                            "message" => "Harga Perkiraan Sendri dengan No Surat ".$res['NoSurat']." berhasil dibuat"
                        ];
                        $this->response($message, REST_Controller::HTTP_CREATED);
                    }else{
                        $message = [
                            "status" => FALSE,
                            "message" => "Harga Perkiraan Sendri gagal dibuat"
                        ];
                        $this->response($message, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
                    }
                }else{
                    $message = [
                        "status" => FALSE,
                        "message" => "Harga Perkiraan Sendri dengan Nomor ".$res['NoSurat']." telah ada dalam sistem, mohon diperiksa kembali"
                    ];
                $this->response($message, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
                }
            } catch (\Exception $e) {
                $this->response($e->getMessage(), REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
            }
            
            
            
        }else{
            $this->response($is_valid_token , REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
        }
    }

    public function index_put(){
         /**
         * Update Vendor
         * @param: NamaPimpinan,Jabatan,Alamat,NoTelp, Bank,AnBank,NoRek,UserId
         * @return: status,message => jika gagal
         */

        $is_valid_token = $this->authorization_token->validateToken();
        if(!empty($is_valid_token) && $is_valid_token['status'] === TRUE){
            try {
                $Id = $this->put('Id');
                $res['NoSurat'] = $this->put('NoSurat');
                $res['Pekerjaan'] = $this->put('Pekerjaan');
                $res['KodeAnggaran'] = $this->put('KodeAnggaran');
                $res['DataAnggaran'] = $this->m->getDataAnggaran($this->put('KodeAnggaran'));
                $res['Tgl'] = $this->put('Tgl');
                $res['KodePejabat'] = $this->put('KodePejabat');
                $res['DataPejabat'] = $this->m->getDataPejabat($this->put('KodePejabat'));
                $res['UserId'] = $this->UserId;
                if($this->m->updateData($res,$Id) > 0){
                    $message = [
                        "status" => TRUE,
                        "message" => "Harga Perkiraan Sendri berhasil diupdate"
                    ];
                    $this->response($message, REST_Controller::HTTP_CREATED);
                }else{
                    $message = [
                        "status" => FALSE,
                        "message" => "tidak terjadi perubahan data"
                    ];
                    $this->response($message, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
                }
            } catch (\Exception $e) {
                $this->response($e->getMessage(), REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
            }
            
            
            
        }else{
            $this->response($is_valid_token , REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
        }
    }

    public function index_delete(){
        /**
         * Deletes Data Panitia Pemeriksa
         * @param: Id
         * @return: message success
         */

        $is_valid_token = $this->authorization_token->validateToken();
        if(!empty($is_valid_token) && $is_valid_token['status'] === TRUE){
            try {
                $Id = $this->delete('Id');
                if($this->m->deleteData($Id) > 0){
                    $message = [
                        "status" => TRUE,
                        "message" => "Harga Perkiraan Sendri berhasil dihapus"
                    ];
                    $this->response($message, REST_Controller::HTTP_CREATED);
                }else{
                    $message = [
                        "status" => FALSE,
                        "message" => "Harga Perkiraan Sendri gagal dihapus"
                    ];
                    $this->response($message, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
                }
            } catch (\Exception $e) {
                $this->response($e->getMessage(), REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
            }
            
        }else{
            $this->response($is_valid_token , REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
        }
    }
    

    

}

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
class Panitia_pemeriksa extends REST_Controller {
    private $UserId;
    function __construct(){
        parent::__construct();
        $this->load->library("Authorization_Token");  
        $this->load->model('api/M_Panitia_pemeriksa','ModelPP');
        $is_valid_token = $this->authorization_token->validateToken();
        if(!empty($is_valid_token) && $is_valid_token['status'] === TRUE){
            $dtUser = $this->authorization_token->userData();
            $this->UserId = $dtUser->id;
        }
    }

    public function index_get(){
        /**
        * Get Data Panitia Pemeriksa
        * @param: id
        * @return: data Panitia Pemeriksa
        */

        // $data[0]['Nama']="ANDESVAN GUMAY";
        // $data[0]['Nip']="19840626 200912 1 002";
        // $data[1]['Nama']="HENRA GUNAWAN";
        // $data[1]['Nip']="19780910 199803 1 002";
        // $data[2]['Nama']="BUDIARJO";
        // $data[2]['Nip']="19650110 198903 1 003";
        // $data[3]['Nama']="RESMA DANA SCENDI S";
        // $data[3]['Nip']="19881215 200712 1 001";
        // $this->response($data, REST_Controller::HTTP_OK);
        $is_valid_token = $this->authorization_token->validateToken();
        if(!empty($is_valid_token) && $is_valid_token['status'] === TRUE){
            try {
                $Id = $this->get('Id');
                if(!empty($Id) && $Id != NULL){
                    $data = $this->ModelPP->loadData($Id);
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
                    $data = $this->ModelPP->loadData();
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
         * Cretae Panitia Pemeriksa
         * @param: NoSk,Perihal,Tanggal,Nama, UserId,Tahun,DataPemeriksa
         * @return: status,message => jika gagal
         */

        $is_valid_token = $this->authorization_token->validateToken();
        if(!empty($is_valid_token) && $is_valid_token['status'] === TRUE){
            try {
                $res['Kode'] = $this->ModelPP->generateKode();
                $res['NoSk'] = $this->post('NoSk');
                $res['Tanggal'] = $this->post('Tanggal');
                $res['Tahun'] = $this->post('Tahun');
                $res['Perihal'] = $this->post('Perihal');
                $res['DataPemeriksa'] = $this->post('DataPemeriksa');
                $res['Nama'] = $this->post('Nama');
                $res['UserId'] = $this->UserId;
                if($this->ModelPP->cekData($res['NoSk']) > 0){
                    $message = [
                        "status" => FALSE,
                        "message" => "Nomor SK telah ada dalam sistem, masukkan Nomor SK yang lainnya"
                    ];
                    $this->response($message, REST_Controller::HTTP_CREATED);
                }else{
                    if($this->ModelPP->createData($res) > 0){
                        $message = [
                            "status" => TRUE,
                            "message" => "Panitia Pemeriksa berhasil dibuat"
                        ];
                        $this->response($message, REST_Controller::HTTP_CREATED);
                    }else{
                        $message = [
                            "status" => FALSE,
                            "message" => "Panitia Pemeriksa gagal dibuat"
                        ];
                        $this->response($message, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
                    }
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
         * Update Panitia Pemeriksa
         * @param: NoSk,Perihal,Tanggal,Nama, UserId,Tahun,DataPemeriksa
         * @return: status,message => jika gagal
         */

        $is_valid_token = $this->authorization_token->validateToken();
        if(!empty($is_valid_token) && $is_valid_token['status'] === TRUE){
            try {
                $Id = $this->put('Id');
                $res['NoSk'] = $this->put('NoSk');
                $res['Tanggal'] = $this->put('Tanggal');
                $res['Tahun'] = $this->put('Tahun');
                $res['Perihal'] = $this->put('Perihal');
                $res['DataPemeriksa'] = $this->put('DataPemeriksa');
                $res['Nama'] = $this->put('Nama');
                $res['UserId'] = $this->UserId;
                if($this->ModelPP->updateData($res,$Id) > 0){
                    $message = [
                        "status" => TRUE,
                        "message" => "Panitia Pemeriksa berhasil diupdate"
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
                if($this->ModelPP->deleteData($Id) > 0){
                    $message = [
                        "status" => TRUE,
                        "message" => "Panitia Pemeriksa berhasil dihapus"
                    ];
                    $this->response($message, REST_Controller::HTTP_CREATED);
                }else{
                    $message = [
                        "status" => FALSE,
                        "message" => "Panitia Pemeriksa gagal dihapus"
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

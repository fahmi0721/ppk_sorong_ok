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
class Ba_bayar extends REST_Controller {
    private $UserId;
    function __construct(){
        parent::__construct();
        $this->load->library("Authorization_Token");  
        $this->load->model('api/M_Ba_bayar','m');
        $is_valid_token = $this->authorization_token->validateToken();
        if(!empty($is_valid_token) && $is_valid_token['status'] === TRUE){
            $dtUser = $this->authorization_token->userData();
            $this->UserId = $dtUser->id;
        }
    }

    public function index_get(){
        /**
         * GET B E R I T A  A C A R A  P E M B A Y A R A N
         * @param: id
         * @return: data B E R I T A  A C A R A  P E M B A Y A R A N
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
         * Create BERITA ACARA PEMBAYARAN
         * @param: NoSurat,Tgl,NoSuratHps,NoBastb,KodePejabat,UserId,Dibuatdi
         * @return: status,message => jika gagal
         */

        $is_valid_token = $this->authorization_token->validateToken();
        if(!empty($is_valid_token) && $is_valid_token['status'] === TRUE){
            try {
                $res['NoSurat'] = $this->post('NoSurat');
                $res['Tgl'] = $this->post('Tgl');
                $res['NoSuratHps'] = $this->post('NoSuratHps');
                $res['NoBastb'] = $this->post('NoBastb');
                $res['DataBastb'] = $this->m->getDataBastb($this->post('NoBastb'));
                $res['KodePejabat'] = $this->post('KodePejabat');
                $res['DataPejabat'] = $this->m->getDataPejabat($this->post('KodePejabat'));
                $res['Dibuatdi'] = $this->post('Dibuatdi');
                $res['UserId'] = $this->UserId;
                if($this->m->cekDataExits($res['NoSurat']) <= 0){
                    if($this->m->createData($res) > 0){
                        $message = [
                            "status" => TRUE,
                            "message" => "Berita Acara Pembayaran dengan Nomor ".$res['NoSurat']." berhasil dibuat"
                        ];
                        $this->response($message, REST_Controller::HTTP_CREATED);
                    }else{
                        $message = [
                            "status" => FALSE,
                            "message" => "Berita Acara Pembayaran gagal dibuat"
                        ];
                        $this->response($message, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
                    }
                }else{
                    $message = [
                            "status" => FALSE,
                            "message" => "Berita Acara Pembayaran dengan Nomor ".$res['NoSurat']." telah ada dalam sistem, mohon diperiksa kembali"
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
         * UPDATE BERITA ACARA PEMBAYARAN
         * @param: NoSurat,Tgl,NoSuratHps,NoBastb,KodePejabat,UserId,Dibuatdi
         * @return: status,message => jika gagal
         */
        $is_valid_token = $this->authorization_token->validateToken();
        if(!empty($is_valid_token) && $is_valid_token['status'] === TRUE){
            try {
                $Id = $this->put('Id');
                $res['NoSurat'] = $this->put('NoSurat');
                $res['Tgl'] = $this->put('Tgl');
                $res['NoSuratHps'] = $this->put('NoSuratHps');
                $res['NoBastb'] = $this->put('NoBastb');
                $res['DataBastb'] = $this->m->getDataBastb($this->put('NoBastb'));
                $res['KodePejabat'] = $this->put('KodePejabat');
                $res['DataPejabat'] = $this->m->getDataPejabat($this->put('KodePejabat'));
                $res['Dibuatdi'] = $this->put('Dibuatdi');
                $res['UserId'] = $this->UserId;
                if($this->m->updateData($res,$Id) > 0){
                    $message = [
                        "status" => TRUE,
                        "message" => "Berita Acara Pembayaran berhasil diupdate"
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
         * BERITA ACARA PEMBAYARAN
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
                        "message" => "Berita Acara Pembayaran berhasil dihapus"
                    ];
                    $this->response($message, REST_Controller::HTTP_CREATED);
                }else{
                    $message = [
                        "status" => FALSE,
                        "message" => "Berita Acara Pembayaran gagal dihapus"
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

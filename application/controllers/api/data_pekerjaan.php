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
class Data_pekerjaan extends REST_Controller {
    private $UserId;
    function __construct(){
        parent::__construct();
        $this->load->library("Authorization_Token");  
        $this->load->model('api/M_Data_pekerjaan','m');
        $is_valid_token = $this->authorization_token->validateToken();
        if(!empty($is_valid_token) && $is_valid_token['status'] === TRUE){
            $dtUser = $this->authorization_token->userData();
            $this->UserId = $dtUser->id;
        }
    }

    public function penunjukan_penuedia_post(){
        /**
         * Get Penunjukan Penyedia
         * @param: id
         * @return: data Penunjukan Penyedia
         */
        $is_valid_token = $this->authorization_token->validateToken();
        if(!empty($is_valid_token) && $is_valid_token['status'] === TRUE){
            try {
                $NoSuratHps = $this->post('NoSuratHps');
                // echo $NoSuratHps; exit;
                if(!empty($NoSuratHps) && $NoSuratHps != NULL){
                    $data = $this->m->loadData($NoSuratHps);
                    if(!empty($data)){
                        $message = [
                            "status" => TRUE,
                            "data" => $data['data'],
                            "row" => $data['row'],
                        ];
                        $this->response($message, REST_Controller::HTTP_OK);
                    }else{
                        $message = [
                            "status" => FALSE,
                            "data" => 0,
                            "row" => 0,
                        ];
                        $this->response($message, REST_Controller::HTTP_NOT_FOUND);
                    }
                }else{
                    $data = $this->m->loadData();
                    if(!empty($data)){
                        $message = [
                            "status" => FALSE,
                            "data" => 0,
                            "row" => 0,
                        ];
                        $this->response($message, REST_Controller::HTTP_OK);
                    }else{
                        $message = [
                            "status" => FALSE,
                            "data" => 0,
                            "row" => 0,
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

    public function spk_post(){
        /**
         * Get SPK
         * @param: id
         * @return: data SPK
         */
        $is_valid_token = $this->authorization_token->validateToken();
        if(!empty($is_valid_token) && $is_valid_token['status'] === TRUE){
            try {
                $NoSuratHps = $this->post('NoSuratHps');
                // echo $NoSuratPP; exit;
                if(!empty($NoSuratHps) && $NoSuratHps != NULL){
                    $data = $this->m->loadDataSpk($NoSuratHps);
                    if(!empty($data)){
                        $message = [
                            "status" => TRUE,
                            "data" => $data['data'],
                            "row" => $data['row'],
                        ];
                        $this->response($message, REST_Controller::HTTP_OK);
                    }else{
                        $message = [
                            "status" => FALSE,
                            "data" => 0,
                            "row" => 0,
                        ];
                        $this->response($message, REST_Controller::HTTP_NOT_FOUND);
                    }
                }else{
                    $message = [
                        "status" => FALSE,
                        "data" => 0,
                        "row" => 0,
                    ];
                    $this->response($message, REST_Controller::HTTP_BAD_REQUEST);
                }
                
            } catch (\Exception $e) {
                $this->response($e->getMessage(), REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
            }
            
        }else{
            $this->response($is_valid_token , REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
        }
        
        
    }

    public function pphp_post(){
        /**
         * Get Penunjukan Penyedia
         * @param: id
         * @return: data Penunjukan Penyedia
         */
        $is_valid_token = $this->authorization_token->validateToken();
        if(!empty($is_valid_token) && $is_valid_token['status'] === TRUE){
            try {
                $NoSuratHps = $this->post('NoSuratHps');
                // echo $NoSuratHps; exit;
                if(!empty($NoSuratHps) && $NoSuratHps != NULL){
                    $data = $this->m->loadDataPphp($NoSuratHps);
                    if(!empty($data)){
                        $message = [
                            "status" => TRUE,
                            "data" => $data['data'],
                            "row" => $data['row'],
                        ];
                        $this->response($message, REST_Controller::HTTP_OK);
                    }else{
                       $message = [
                            "status" => FALSE,
                            "data" => 0,
                            "row" => 0,
                        ];
                        $this->response($message, REST_Controller::HTTP_NOT_FOUND);
                    }
                }else{
                    $message = [
                        "status" => FALSE,
                        "message" => "data empty in table"
                    ];
                    $this->response($message, REST_Controller::HTTP_BAD_REQUEST);
                }
                
            } catch (\Exception $e) {
                $this->response($e->getMessage(), REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
            }
            
        }else{
            $this->response($is_valid_token , REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
        }
        
        
    }

    public function baphp_post(){
        /**
         * Get Penunjukan Penyedia
         * @param: id
         * @return: data Penunjukan Penyedia
         */
        $is_valid_token = $this->authorization_token->validateToken();
        if(!empty($is_valid_token) && $is_valid_token['status'] === TRUE){
            try {
                $NoSuratHps = $this->post('NoSuratHps');
                // echo $NoSuratHps; exit;
                if(!empty($NoSuratHps) && $NoSuratHps != NULL){
                    $data = $this->m->loadDataBaphp($NoSuratHps);
                    if(!empty($data)){
                        $message = [
                            "status" => TRUE,
                            "data" => $data['data'],
                            "row" => $data['row'],
                        ];
                        $this->response($message, REST_Controller::HTTP_OK);
                    }else{
                       $message = [
                            "status" => FALSE,
                            "data" => 0,
                            "row" => 0,
                        ];
                        $this->response($message, REST_Controller::HTTP_NOT_FOUND);
                    }
                }else{
                    $message = [
                        "status" => FALSE,
                        "message" => "data empty in table"
                    ];
                    $this->response($message, REST_Controller::HTTP_BAD_REQUEST);
                }
                
            } catch (\Exception $e) {
                $this->response($e->getMessage(), REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
            }
            
        }else{
            $this->response($is_valid_token , REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
        }
        
        
    }

    public function bastb_post(){
        /**
         * Get Penunjukan Penyedia
         * @param: id
         * @return: data Penunjukan Penyedia
         */
        $is_valid_token = $this->authorization_token->validateToken();
        if(!empty($is_valid_token) && $is_valid_token['status'] === TRUE){
            try {
                $NoSuratHps = $this->post('NoSuratHps');
                // echo $NoSuratHps; exit;
                if(!empty($NoSuratHps) && $NoSuratHps != NULL){
                    $data = $this->m->loadDataBastb($NoSuratHps);
                    if(!empty($data)){
                        $message = [
                            "status" => TRUE,
                            "data" => $data['data'],
                            "row" => $data['row'],
                        ];
                        $this->response($message, REST_Controller::HTTP_OK);
                    }else{
                        $message = [
                            "status" => FALSE,
                            "data" => 0,
                            "row" => 0,
                        ];
                        $this->response($message, REST_Controller::HTTP_NOT_FOUND);
                    }
                }else{
                    $message = [
                        "status" => FALSE,
                        "message" => "data empty in table"
                    ];
                    $this->response($message, REST_Controller::HTTP_BAD_REQUEST);
                }
                
            } catch (\Exception $e) {
                $this->response($e->getMessage(), REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
            }
            
        }else{
            $this->response($is_valid_token , REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
        }
        
        
    }

    public function ba_bayar_post(){
        /**
         * Get Penunjukan Penyedia
         * @param: id
         * @return: data Penunjukan Penyedia
         */
        $is_valid_token = $this->authorization_token->validateToken();
        if(!empty($is_valid_token) && $is_valid_token['status'] === TRUE){
            try {
                $NoSuratHps = $this->post('NoSuratHps');
                // echo $NoSuratHps; exit;
                if(!empty($NoSuratHps) && $NoSuratHps != NULL){
                    $data = $this->m->loadDataBa_bayar($NoSuratHps);
                    if(!empty($data)){
                        $message = [
                            "status" => TRUE,
                            "data" => $data['data'],
                            "row" => $data['row'],
                        ];
                        $this->response($message, REST_Controller::HTTP_OK);
                    }else{
                        $message = [
                            "status" => FALSE,
                            "data" => 0,
                            "row" => 0,
                        ];
                        $this->response($message, REST_Controller::HTTP_NOT_FOUND);
                    }
                }else{
                    $message = [
                        "status" => FALSE,
                        "message" => "data empty in table"
                    ];
                    $this->response($message, REST_Controller::HTTP_BAD_REQUEST);
                }
                
            } catch (\Exception $e) {
                $this->response($e->getMessage(), REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
            }
            
        }else{
            $this->response($is_valid_token , REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
        }
        
        
    }

    public function kwitansi_post(){
        /**
         * Get Kwitansi
         * @param: id
         * @return: data Kwitansi
         */
        $is_valid_token = $this->authorization_token->validateToken();
        if(!empty($is_valid_token) && $is_valid_token['status'] === TRUE){
            try {
                $NoSuratHps = $this->post('NoSuratHps');
                // echo $NoSuratHps; exit;
                if(!empty($NoSuratHps) && $NoSuratHps != NULL){
                    $data = $this->m->loadDataKwitansi($NoSuratHps);
                    if(!empty($data)){
                        $message = [
                            "status" => TRUE,
                            "data" => $data['data'],
                            "row" => $data['row'],
                        ];
                        $this->response($message, REST_Controller::HTTP_OK);
                    }else{
                        $message = [
                            "status" => FALSE,
                            "data" => 0,
                            "row" => 0,
                        ];
                        $this->response($message, REST_Controller::HTTP_NOT_FOUND);
                    }
                }else{
                    $message = [
                        "status" => FALSE,
                        "data" => 0,
                        "row" => 0,
                    ];
                    $this->response($message, REST_Controller::HTTP_BAD_REQUEST);
                }
                
            } catch (\Exception $e) {
                $this->response($e->getMessage(), REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
            }
            
        }else{
            $this->response($is_valid_token , REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
        }
        
        
    }

   
    public function spk_tahun_ini_get(){
        try{
            $data = $this->m->spk_tahun_ini_jalan();
            $message = [
                "status" => TRUE,
                "data" => $data,
            ];
            $this->response($message, REST_Controller::HTTP_OK);
            
        } catch (\Exception $e) {
            $this->response($e->getMessage(), REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
        }
    
        
    }

    

}

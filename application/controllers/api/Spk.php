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
class Spk extends REST_Controller {
    private $UserId;
    function __construct(){
        parent::__construct();
        $this->load->library("Authorization_Token");  
        $this->load->model('api/M_Spk','m');
        $is_valid_token = $this->authorization_token->validateToken();
        if(!empty($is_valid_token) && $is_valid_token['status'] === TRUE){
            $dtUser = $this->authorization_token->userData();
            $this->UserId = $dtUser->id;
        }
    }

    public function index_get(){
        /**
         * Get Penunjukan Penyedia
         * @param: id
         * @return: data Penunjukan Penyedia
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
         * Create Surat SPK
         * @param: NoSpk,Tgl,NoSuratPP,DataPP, NoSuratUndangan,TglSuratUndangan,NoBaPl,TglBaPl,WaktuKerja,TglDari,TglSampai,TglSampai,KodePejabat,DataPejabat,UserId
         * @return: status,message => jika gagal
         */

        $is_valid_token = $this->authorization_token->validateToken();
        if(!empty($is_valid_token) && $is_valid_token['status'] === TRUE){
            try {
                $res['NoSpk'] = $this->post('NoSpk');
                $res['Tgl'] = $this->post('Tgl');
                $res['NoSuratHps'] = $this->post('NoSuratHps');
                $res['NoSuratPP'] = $this->post('NoSuratPP');
                $res['DataPP'] = $this->m->getDataPP($this->post('NoSuratPP'));
                $res['NoSuratUndangan'] = $this->post('NoSuratUndangan');
                $res['TglSuratUndangan'] = $this->post('TglSuratUndangan');
                $res['NoBaPl'] = $this->post('NoBaPl');
                $res['TglBaPl'] = $this->post('TglBaPl');
                $res['WaktuKerja'] = $this->post('WaktuKerja');
                $res['TglDari'] = $this->post('TglDari');
                $res['TglSampai'] = $this->post('TglSampai');
                $res['DataItem'] = $this->post('DataItem');
                $res['Pembulatan'] = $this->input->post('Pembulatan');
                $res['Ppn'] = $this->input->post('Ppn');
                $res['NilaiKontrak'] = $this->input->post('NilaiKontrak');
                $res['KodePejabat'] = $this->post('KodePejabat');
                $res['DataPejabat'] = $this->m->getDataPejabat($this->post('KodePejabat'));
                $res['UserId'] = $this->UserId;
                if($this->m->cekDataExits($res['NoSpk']) <= 0){
                    if($this->m->createData($res) > 0){
                        $message = [
                            "status" => TRUE,
                            "message" => "SPK dengan Nomor ".$res['NoSpk']." berhasil dibuat"
                        ];
                        $this->response($message, REST_Controller::HTTP_CREATED);
                    }else{
                        $message = [
                            "status" => FALSE,
                            "message" => "Surat Penunjukan Penyedia gagal dibuat"
                        ];
                        $this->response($message, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
                    }
                }else{
                    $message = [
                            "status" => FALSE,
                            "message" => "SPK dengan Nomor ".$res['NoSpk']." telah ada dalam sistem, mohon diperiksa kembali"
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
         * Update Surat SPK
         * @param: NoSpk,Tgl,NoSuratPP,DataPP, NoSuratUndangan,TglSuratUndangan,NoBaPl,TglBaPl,WaktuKerja,TglDari,TglSampai,TglSampai,KodePejabat,DataPejabat,UserId
         * @return: status,message => jika gagal
         */

        $is_valid_token = $this->authorization_token->validateToken();
        if(!empty($is_valid_token) && $is_valid_token['status'] === TRUE){
            try {
                $Id = $this->put('Id');
                $res['NoSpk'] = $this->put('NoSpk');
                $res['Tgl'] = $this->put('Tgl');
                $res['NoSuratPP'] = $this->put('NoSuratPP');
                $res['NoSuratHps'] = $this->put('NoSuratHps');
                $res['DataPP'] = $this->m->getDataPP($this->put('NoSuratPP'));
                $res['NoSuratUndangan'] = $this->put('NoSuratUndangan');
                $res['TglSuratUndangan'] = $this->put('TglSuratUndangan');
                $res['NoBaPl'] = $this->put('NoBaPl');
                $res['TglBaPl'] = $this->put('TglBaPl');
                $res['WaktuKerja'] = $this->put('WaktuKerja');
                $res['TglDari'] = $this->put('TglDari');
                $res['TglSampai'] = $this->put('TglSampai');
                $res['KodePejabat'] = $this->put('KodePejabat');
                $res['DataPejabat'] = $this->m->getDataPejabat($this->put('KodePejabat'));
                $res['UserId'] = $this->UserId;
                if($this->m->updateData($res,$Id) > 0){
                    $message = [
                        "status" => TRUE,
                        "message" => "SPK  berhasil diupdate"
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
         * Deletes Data SPK
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
                        "message" => "SPK berhasil dihapus"
                    ];
                    $this->response($message, REST_Controller::HTTP_CREATED);
                }else{
                    $message = [
                        "status" => FALSE,
                        "message" => "SPK gagal dihapus"
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

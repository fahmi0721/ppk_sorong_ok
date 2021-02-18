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
class Users extends REST_Controller {

    function __construct(){
        parent::__construct();
        $this->load->library("Authorization_Token");  
        $this->load->model('api/M_Users','ModelUsers');
    }

    public function index_get(){
        /**
         * Get Data Users
         * @param: id
         * @return: data users
         */

        $is_valid_token = $this->authorization_token->validateToken();
        if(!empty($is_valid_token) && $is_valid_token['status'] === TRUE){
            try {
                $id = $this->get('id');
                if(!empty($id) && $id != NULL){
                    $data = $this->ModelUsers->loadData($id);
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
                    $data = $this->ModelUsers->loadData();
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
         * Cretae Users
         * @param: Username,Password,Nama,Jabatan, Level
         * @return: status,message => jika gagal
         */

        $is_valid_token = $this->authorization_token->validateToken();
        if(!empty($is_valid_token) && $is_valid_token['status'] === TRUE){
            try {
                $res['Username'] = $this->post('Username');
                $res['Nama'] = $this->post('Nama');
                $res['Level'] = $this->post('Level');
                $res['Jabatan'] = $this->post('Jabatan');
                $res['Created_at'] = date("Y-m-d H:i:s");
                $res['Password'] = md5('ppk'.$this->post('Password'));
                if($this->ModelUsers->cekUsers($res['Username']) > 0){
                    $message = [
                        "status" => FALSE,
                        "message" => "Username telah digunakan, masukkan username yang lainnya"
                    ];
                    $this->response($message, REST_Controller::HTTP_CREATED);
                }else{
                    if($this->ModelUsers->createUsers($res) > 0){
                        $message = [
                            "status" => TRUE,
                            "message" => "User berhasil dibuat"
                        ];
                        $this->response($message, REST_Controller::HTTP_CREATED);
                    }else{
                        $message = [
                            "status" => FALSE,
                            "message" => "User gagal dibuat"
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
         * Update Data Users
         * @param: Username,Password,Nama,Jabatan,Id
         * @return: data users
         */

        $is_valid_token = $this->authorization_token->validateToken();
        if(!empty($is_valid_token) && $is_valid_token['status'] === TRUE){
            try {
                $Id = $this->put('Id');
                $res['Nama'] = $this->put('Nama');
                $res['Jabatan'] = $this->put('Jabatan');
                $res['Level'] = $this->put('Level');
                $res['Username'] = $this->put('Username');
                if(!empty($this->put('Password'))){
                    $res['Password'] = md5('ppk'.$this->put('Password'));
                }
                if($this->ModelUsers->updateUsers($res,$Id) > 0){
                    $message = [
                        "status" => TRUE,
                        "message" => "User berhasil diupdate"
                    ];
                    $this->response($message, REST_Controller::HTTP_CREATED);
                }else{
                    $message = [
                        "status" => FALSE,
                        "message" => "Tidak data yang berubah"
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
         * Deletes Data Users
         * @param: Id
         * @return: message success
         */

        $is_valid_token = $this->authorization_token->validateToken();
        if(!empty($is_valid_token) && $is_valid_token['status'] === TRUE){
            try {
                $Id = $this->delete('Id');
                if($this->ModelUsers->deleteUsers($Id) > 0){
                    $message = [
                        "status" => TRUE,
                        "message" => "User berhasil dihapus"
                    ];
                    $this->response($message, REST_Controller::HTTP_CREATED);
                }else{
                    $message = [
                        "status" => FALSE,
                        "message" => "User gagal dihapus"
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

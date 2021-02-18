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
class Mahasiswa extends REST_Controller {

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->model('m_mahasiswa');
        $this->load->library("Authorization_Token");  
    }

    public function index_get(){
        $is_valid_token = $this->authorization_token->validateToken();
        if(!empty($is_valid_token) && $is_valid_token['status'] === TRUE){
            $id = $this->get('id');
            if($id === NULL){
                $data = $this->m_mahasiswa->get_mahasiswa();
                if(!empty($data)){
                    $this->response([
                                'status' => TRUE,
                                'data' => $data
                    ], REST_Controller::HTTP_OK);
                }else{
                    $this->response([
                        'status' => FALSE,
                        'message' => 'No users were found'
                    ], REST_Controller::HTTP_NOT_FOUND);
                }
            }else{
                $data = $this->m_mahasiswa->get_mahasiswa($id);
                if(!empty($data)){
                    $this->response([
                                'status' => TRUE,
                                'data' => $data
                    ], REST_Controller::HTTP_OK);
                }else{
                    $this->response([
                        'status' => FALSE,
                        'message' => 'No users were founds'
                    ], REST_Controller::HTTP_NOT_FOUND);
                }
            }
        }else{
            $this->response($is_valid_token, REST_Controller::HTTP_NOT_FOUND);
        }

        
    }

    public function index_post(){
        $data = [
            "nrp" => $this->post('nrp'),
            "nama" => $this->post('nama'),
            "email" => $this->post('email'),
            "jurusan" => $this->post('jurusan')
        ];
        if($this->m_mahasiswa->add_mahasiswa($data) > 0){
            $this->set_response([
                    'status' => TRUE,
                    'messages' => "data mahasiswa dengan nama ".$data['nama']." berhasil disimpan"
            ],REST_Controller::HTTP_CREATED); // CREATED (201) being the HTTP response code
        }else{
            $this->response([
                    'status' => FALSE,
                    'messages' => "Bad Request"
            ],REST_Controller::HTTP_BAD_REQUEST); 
        }
    }

    public function index_put(){
        $is_valid_token = $this->authorization_token->validateToken();
        if(!empty($is_valid_token) && $is_valid_token['status'] === TRUE){
            $data = [
                "nrp" => $this->put('nrp'),
                "nama" => $this->put('nama'),
                "email" => $this->put('email'),
                "jurusan" => $this->put('jurusan')
            ];
            $id = $this->put('id');
            if($this->m_mahasiswa->update_mahasiswa($data,$id) > 0){
                $this->set_response([
                        'status' => TRUE,
                        'messages' => "data mahasiswa dengan nama ".$data['nama']." berhasil diupdate"
                ],REST_Controller::HTTP_CREATED); // CREATED (201) being the HTTP response code
            }else{
                $this->response([
                        'status' => FALSE,
                        'messages' => "Error Cuui"
                ],REST_Controller::HTTP_BAD_REQUEST); 
            }
        }else{
            $this->response($is_valid_token,REST_Controller::HTTP_BAD_REQUEST); 
        }
    }

    public function index_delete(){
        $id = $this->delete('id');
        if($id === null){
            $this->response([
                    'status' => FALSE,
                    'messages' => "Id Tidak terkirim"
            ],REST_Controller::HTTP_BAD_REQUEST); 
        }else{
            if($this->m_mahasiswa->delete_mahasiswa($id) > 0){
                $this->set_response([
                        'status' => TRUE,
                        'messages' => "data mahasiswa dengan id ".$id." berhasil dihapus"
                ],REST_Controller::HTTP_CREATED); // CREATED (201) being the HTTP response code
            }else{
                $this->response([
                        'status' => FALSE,
                        'messages' => "Bad request"
                ],REST_Controller::HTTP_BAD_REQUEST); 
            }
        }
    }


    
}

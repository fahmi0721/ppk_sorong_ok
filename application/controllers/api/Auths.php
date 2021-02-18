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
class Auths extends REST_Controller {

    function __construct(){
        parent::__construct();
        $this->load->library("Authorization_Token");  
        $this->load->model('api/M_Auths','ModelAuth');
    }

    public function index_post(){
        /**
         * Login & Generate Token
         * @param: Username,Password,
         * @return: Nama,Jabatan,Token,Username,Id => Jika Success
         * @return: status,message => jika gagal
         */
        $res['Username'] = $this->post('Username');
        $res['Password'] = md5('ppk'.$this->post('Password'));
        $output = $this->ModelAuth->Login($res);
        if($output['status'] === TRUE){
            $token_data['id'] = $output['data']->Id;
            $token_data['Nama'] = $output['data']->Nama;
            $token_data['Jabatan'] = $output['data']->Jabatan;
            $token_data['Level'] = $output['data']->Level;
            $token_data['Username'] = $output['data']->Username;
            $token_data['time'] = time();
            $token_data['token'] = $this->authorization_token->generateToken($token_data);
            unset($token_data['id']);
            unset($token_data['Username']);
            $result = [
                "status" => TRUE,
                "data" => $token_data
            ];
            $this->response($result, REST_Controller::HTTP_OK);
        }else{
            $this->response($output , REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
        }
    }
}

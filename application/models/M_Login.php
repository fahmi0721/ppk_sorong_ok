<?php

class M_Login extends CI_Model {
        
        function cek_login(){
            if(empty($this->session->userdata('is_login'))){
                redirect('auth');
            }
        }




}
<?php

class M_Auths extends CI_Model {
        
        function Login($data){
            $pass =
            $this->db->where("Username",$data['Username']);
            $this->db->where("Password",$data['Password']);
            $res = $this->db->get('ppk_users')->row(); 
            if(!empty($res)){
                $msg = [
                    "status" => TRUE,
                    "data" => $res
                ];
                return $msg;
            }else{
                $msg = [
                    "status" => FALSE,
                    "message" => "Invalid Username OR Password"
                ];
                return $msg;
            }
        }


        function createUsers($data){
            $this->db->insert("ppk_users", $data);
            return $this->db->affected_rows();
        }


        function cekUsers($username){
            $this->db->where('Username', $username);
            $query = $this->db->get("ppk_users");
            return $query->num_rows();
        }


}
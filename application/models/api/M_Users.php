<?php

class M_Users extends CI_Model {
        
        function loadData($id=null){
            if($id != null){
                $this->db->where('Id', $id);
            }
            $this->db->order_by('Id', 'DESC');
            return $this->db->get("ppk_users")->result_array();
             
        }

        function createUsers($data){
            $this->db->insert("ppk_users", $data);
            return $this->db->affected_rows();
        }

        function updateUsers($data,$Id){
            $this->db->where('Id', $Id);
            $this->db->update("ppk_users", $data);
            return $this->db->affected_rows();
        }

        function deleteUsers($Id){
            $this->db->where('Id', $Id);
            $this->db->delete("ppk_users");
            return $this->db->affected_rows();
        }


        function cekUsers($username){
            $this->db->where('Username', $username);
            $query = $this->db->get("ppk_users");
            return $query->num_rows();
        }


}
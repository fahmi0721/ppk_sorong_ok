<?php

class M_mahasiswa extends CI_Model {
        
        function get_mahasiswa($id=null){
            if($id != null){
                $this->db->where('id',$id);
            }
            return $this->db->get('mahasiswa')->result_array() ; 
        }

        function add_mahasiswa($data){
            $this->db->insert("mahasiswa", $data);
            return $this->db->affected_rows();
        }

        function update_mahasiswa($data,$id){
            $this->db->where('id', $id);
            $this->db->update("mahasiswa", $data);
            return $this->db->affected_rows();
        }

        function delete_mahasiswa($id){
            $this->db->where('id', $id);
            $this->db->delete("mahasiswa");
            return $this->db->affected_rows();
        }

}
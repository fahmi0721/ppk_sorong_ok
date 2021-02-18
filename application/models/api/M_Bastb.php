<?php

class M_Bastb extends CI_Model {
        
        function loadData($id=null){
            if($id != null){
                $this->db->where('Id', $id);
            }
            return $this->db->get("ppk_bastb")->result_array();
        }

        function cekDataExits($NoSurat){
            $this->db->where('NoSurat', $NoSurat);
            return $this->db->get("ppk_bastb")->num_rows();
        }

        function createData($data){
            $this->db->insert("ppk_bastb", $data);
            return $this->db->affected_rows();
        }

        function updateData($data,$Id){
            $this->db->where('Id', $Id);
            $this->db->update("ppk_bastb", $data);
            return $this->db->affected_rows();
        }

        function deleteData($Id){
            $this->db->where('Id', $Id);
            $this->db->delete("ppk_bastb");
            return $this->db->affected_rows();
        }

        function getDataBaPphp($NoSurat){
            $this->db->where('NoSurat', $NoSurat);
            return json_encode($this->db->get("ppk_baphp")->row());
        }

        function getDataPejabat($Kode){
            $this->db->where('Kode', $Kode);
            return json_encode($this->db->get("ppk_pejabat")->row());
        }

       

        

        


}
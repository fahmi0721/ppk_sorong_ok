<?php

class M_Baphp extends CI_Model {
        
        function loadData($id=null){
            if($id != null){
                $this->db->where('Id', $id);
            }
            return $this->db->get("ppk_baphp")->result_array();
        }

        function cekDataExits($NoSurat){
            $this->db->where('NoSurat', $NoSurat);
            return $this->db->get("ppk_baphp")->num_rows();
        }

        function createData($data){
            $this->db->insert("ppk_baphp", $data);
            return $this->db->affected_rows();
        }

        function updateData($data,$Id){
            $this->db->where('Id', $Id);
            $this->db->update("ppk_baphp", $data);
            return $this->db->affected_rows();
        }

        function deleteData($Id){
            $this->db->where('Id', $Id);
            $this->db->delete("ppk_baphp");
            return $this->db->affected_rows();
        }

        function getDataPphp($NoSurat){
            $this->db->where('NoSurat', $NoSurat);
            return json_encode($this->db->get("ppk_pphp")->row());
        }

        function getDataPejabat($Kode){
            $this->db->where('Kode', $Kode);
            return json_encode($this->db->get("ppk_pejabat")->row());
        }

        function getDataPanitiaPemeriksa($Kode){
            $this->db->where('Kode', $Kode);
            return json_encode($this->db->get("ppk_panitia_pemeriksa")->row());
        }

        

        


}
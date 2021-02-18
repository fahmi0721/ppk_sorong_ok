<?php

class M_Pphp extends CI_Model {
        
        function loadData($id=null){
            if($id != null){
                $this->db->where('Id', $id);
            }
            return $this->db->get("ppk_pphp")->result_array();
        }

        function cekDataExits($NoSurat){
            $this->db->where('NoSurat', $NoSurat);
            return $this->db->get("ppk_pphp")->num_rows();
        }

        function createData($data){
            $this->db->insert("ppk_pphp", $data);
            return $this->db->affected_rows();
        }

        function updateData($data,$Id){
            $this->db->where('Id', $Id);
            $this->db->update("ppk_pphp", $data);
            return $this->db->affected_rows();
        }

        function deleteData($Id){
            $this->db->where('Id', $Id);
            $this->db->delete("ppk_pphp");
            return $this->db->affected_rows();
        }

        function getDataSpk($NoSpk){
            $this->db->where('NoSpk', $NoSpk);
            return json_encode($this->db->get("ppk_spk")->row());
        }

        function getDataPejabat($Kode){
            $this->db->where('Kode', $Kode);
            return json_encode($this->db->get("ppk_pejabat")->row());
        }

        

        


}
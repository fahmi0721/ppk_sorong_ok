<?php

class M_Spk extends CI_Model {
        
        function loadData($id=null){
            if($id != null){
                $this->db->where('Id', $id);
            }
            return $this->db->get("ppk_spk")->result_array();
        }

        function cekDataExits($NoSpk){
            $this->db->where('NoSpk', $NoSpk);
            return $this->db->get("ppk_spk")->num_rows();
        }

        function createData($data){
            $this->db->insert("ppk_spk", $data);
            return $this->db->affected_rows();
        }

        function updateData($data,$Id){
            $this->db->where('Id', $Id);
            $this->db->update("ppk_spk", $data);
            return $this->db->affected_rows();
        }

        function deleteData($Id){
            $this->db->where('Id', $Id);
            $this->db->delete("ppk_spk");
            return $this->db->affected_rows();
        }

        function getDataPP($NoSurat){
            $this->db->where('NoSurat', $NoSurat);
            return json_encode($this->db->get("ppk_penunjukan_penyedia")->row());
        }

        function getDataPejabat($Kode){
            $this->db->where('Kode', $Kode);
            return json_encode($this->db->get("ppk_pejabat")->row());
        }

        

        


}
<?php

class M_Hps extends CI_Model {
        
        function loadData($id=null){
            if($id != null){
                $this->db->where('Id', $id);
            }
            return $this->db->get("ppk_hps")->result_array();
        }

        function cekDataExits($NoSurat){
            $this->db->where('NoSurat', $NoSurat);
            return $this->db->get("ppk_hps")->num_rows();
        }

        function createData($data){
            $this->db->insert("ppk_hps", $data);
            return $this->db->affected_rows();
        }

        function updateData($data,$Id){
            $this->db->where('Id', $Id);
            $this->db->update("ppk_hps", $data);
            return $this->db->affected_rows();
        }

        function deleteData($Id){
            $this->db->where('Id', $Id);
            $this->db->delete("ppk_hps");
            return $this->db->affected_rows();
        }

        function getDataAnggaran($Kode){
            $this->db->where('Kode', $Kode);
            return json_encode($this->db->get("ppk_anggaran")->row());
        }

        function getDataPejabat($Kode){
            $this->db->where('Kode', $Kode);
            return json_encode($this->db->get("ppk_pejabat")->row());
        }

        


}
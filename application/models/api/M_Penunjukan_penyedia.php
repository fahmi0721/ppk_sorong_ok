<?php

class M_Penunjukan_penyedia extends CI_Model {
        
        function loadData($id=null){
            if($id != null){
                $this->db->where('Id', $id);
            }
            return $this->db->get("ppk_penunjukan_penyedia")->result_array();
        }

        function cekDataExits($NoSurat){
            $this->db->where('NoSurat', $NoSurat);
            return $this->db->get("ppk_penunjukan_penyedia")->num_rows();
        }

        function createData($data){
            $this->db->insert("ppk_penunjukan_penyedia", $data);
            return $this->db->affected_rows();
        }

        function updateData($data,$Id){
            $this->db->where('Id', $Id);
            $this->db->update("ppk_penunjukan_penyedia", $data);
            return $this->db->affected_rows();
        }

        function deleteData($Id){
            $this->db->where('Id', $Id);
            $this->db->delete("ppk_penunjukan_penyedia");
            return $this->db->affected_rows();
        }

        function getDataHps($NoSurat){
            $this->db->where('NoSurat', $NoSurat);
            return json_encode($this->db->get("ppk_hps")->row());
        }

        function getDataPejabat($Kode){
            $this->db->where('Kode', $Kode);
            return json_encode($this->db->get("ppk_pejabat")->row());
        }

        function getDataVendor($Kode){
            $this->db->where('Kode', $Kode);
            return json_encode($this->db->get("ppk_vendor")->row());
        }

        


}
<?php

class M_Ba_bayar extends CI_Model {
        
        function loadData($id=null){
            if($id != null){
                $this->db->where('Id', $id);
            }
            return $this->db->get("ppk_babayar")->result_array();
        }

        function cekDataExits($NoSurat){
            $this->db->where('NoSurat', $NoSurat);
            return $this->db->get("ppk_babayar")->num_rows();
        }

        function createData($data){
            $this->db->insert("ppk_babayar", $data);
            return $this->db->affected_rows();
        }

        function updateData($data,$Id){
            $this->db->where('Id', $Id);
            $this->db->update("ppk_babayar", $data);
            return $this->db->affected_rows();
        }

        function deleteData($Id){
            $this->db->where('Id', $Id);
            $this->db->delete("ppk_babayar");
            return $this->db->affected_rows();
        }

        function getDataBastb($NoSurat){
            $this->db->where('NoSurat', $NoSurat);
            return json_encode($this->db->get("ppk_bastb")->row());
        }

        function getDataPejabat($Kode){
            $this->db->where('Kode', $Kode);
            return json_encode($this->db->get("ppk_pejabat")->row());
        }

       

        

        


}
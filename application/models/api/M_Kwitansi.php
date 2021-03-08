<?php

class M_Kwitansi extends CI_Model {
        
        function loadData($id=null){
            if($id != null){
                $this->db->where('Id', $id);
            }
            return $this->db->get("ppk_kwitansi")->result_array();
        }

        function cekDataExits($NoBukti){
            $this->db->where('NoBukti', $NoBukti);
            return $this->db->get("ppk_kwitansi")->num_rows();
        }

        function createData($data){
            $this->db->insert("ppk_kwitansi", $data);
            return $this->db->affected_rows();
        }

        function updateData($data,$Id){
            $this->db->where('Id', $Id);
            $this->db->update("ppk_kwitansi", $data);
            return $this->db->affected_rows();
        }

        function deleteData($Id){
            $this->db->where('Id', $Id);
            $this->db->delete("ppk_kwitansi");
            return $this->db->affected_rows();
        }

        function getDataBaBayar($NoSurat){
            $this->db->where('NoSurat', $NoSurat);
            return json_encode($this->db->get("ppk_babayar")->row());
        }

        function getDataPejabat($Kode){
            $this->db->where('Kode', $Kode);
            return json_encode($this->db->get("ppk_pejabat")->row());
        }

       

        

        


}
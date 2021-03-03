<?php

class M_Data_pekerjaan extends CI_Model {
        
        function loadData($NoSuratHps){
            $this->db->where('NoSuratHps', $NoSuratHps);
            $query = $this->db->get("ppk_penunjukan_penyedia");
            $row = $query->num_rows();
            $data = $query->row();
            $result = [
                "row" => $row,
                "data" => $data
            ];
            return $result;
        }

        


}
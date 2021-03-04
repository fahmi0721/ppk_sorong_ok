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

        function loadDataSpk($NoSuratPP){
            $this->db->where('NoSuratPP', $NoSuratPP);
            $query = $this->db->get("ppk_spk");
            $row = $query->num_rows();
            $data = $query->row();
            $result = [
                "row" => $row,
                "data" => $data
            ];
            return $result;
        }

        function loadDataPphp($NoSuratHps){
            $this->db->where('NoSuratHps', $NoSuratHps);
            $query = $this->db->get("ppk_pphp");
            $row = $query->num_rows();
            $data = $query->row();
            $result = [
                "row" => $row,
                "data" => $data
            ];
            return $result;
        }

        


}
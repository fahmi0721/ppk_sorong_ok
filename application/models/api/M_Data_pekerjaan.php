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

        function loadDataSpk($NoSuratHps){
            $this->db->where('NoSuratHps', $NoSuratHps);
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

        function loadDataBaphp($NoSuratHps){
            $this->db->where('NoSuratHps', $NoSuratHps);
            $query = $this->db->get("ppk_baphp");
            $row = $query->num_rows();
            $data = $query->row();
            $result = [
                "row" => $row,
                "data" => $data
            ];
            return $result;
        }

        function loadDataBastb($NoSuratHps){
            $this->db->where('NoSuratHps', $NoSuratHps);
            $query = $this->db->get("ppk_bastb");
            $row = $query->num_rows();
            $data = $query->row();
            $result = [
                "row" => $row,
                "data" => $data
            ];
            return $result;
        }


        function loadDataBa_bayar($NoSuratHps){
            $this->db->where('NoSuratHps', $NoSuratHps);
            $query = $this->db->get("ppk_babayar");
            $row = $query->num_rows();
            $data = $query->row();
            $result = [
                "row" => $row,
                "data" => $data
            ];
            return $result;
        }

        function spk_tahun_ini_jalan(){
            $year = date("Y");
            $this->db->where("DATE_FORMAT(Tgl,'%Y')", $year);
            $query = $this->db->get("ppk_spk");
            $row = $query->num_rows();
            return $row;
        }
        


}
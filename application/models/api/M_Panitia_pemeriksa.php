<?php

class M_Panitia_pemeriksa extends CI_Model {
        
        function loadData($id=null){
            if($id != null){
                $this->db->where('Id', $id);
            }
            $this->db->order_by('Id',"DESC");
            return $this->db->get("ppk_panitia_pemeriksa")->result_array();
             
        }

        function createData($data){
            $this->db->insert("ppk_panitia_pemeriksa", $data);
            return $this->db->affected_rows();
        }

        function updateData($data,$Id){
            $this->db->where('Id', $Id);
            $this->db->update("ppk_panitia_pemeriksa", $data);
            return $this->db->affected_rows();
        }

        function deleteData($Id){
            $this->db->where('Id', $Id);
            $this->db->delete("ppk_panitia_pemeriksa");
            return $this->db->affected_rows();
        }


        function cekData($NoSk){
            $this->db->where('NoSk', $NoSk);
            $query = $this->db->get("ppk_panitia_pemeriksa");
            return $query->num_rows();
        }

        function generateKode(){
            $this->db->select("Kode");
            $this->db->order_by("Id","DESC");
            $row = $this->db->get("ppk_panitia_pemeriksa")->row();
            if($row === NULL){
                $Kode = "PNP"."-".date("His")."-"."0001";
                return $Kode;
            }else{
                $ambilIdTerakhir = explode("-",$row->Kode);
                $KodeLast = intval(end($ambilIdTerakhir))+1;
                $KodeBaru = "PNP"."-".date("His")."-".sprintf("%04d",$KodeLast);
                return $KodeBaru;
            }
        }


}
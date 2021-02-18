<?php

class M_Anggaran extends CI_Model {
        
        function loadData($id=null){
            if($id != null){
                $this->db->where('Id', $id);
            }
            $this->db->order_by('Id', "DESC");
            return $this->db->get("ppk_anggaran")->result_array();
             
        }

        function createAnggaran($data){
            $this->db->insert("ppk_anggaran", $data);
            return $this->db->affected_rows();
        }

        function updateAnggaran($data,$Id){
            $this->db->where('Id', $Id);
            $this->db->update("ppk_anggaran", $data);
            return $this->db->affected_rows();
        }

        function deleteAnggaran($Id){
            $this->db->where('Id', $Id);
            $this->db->delete("ppk_anggaran");
            return $this->db->affected_rows();
        }


        function cekAnggaran($Nomor){
            $this->db->where('Nomor', $Nomor);
            $query = $this->db->get("ppk_anggaran");
            return $query->num_rows();
        }

        function generateKode(){
            $this->db->select("Kode");
            $this->db->order_by("Id","DESC");
            $row = $this->db->get("ppk_anggaran")->row();
            if($row === NULL){
                $Kode = "AGR"."-".date("His")."-"."0001";
                return $Kode;
            }else{
                $ambilIdTerakhir = explode("-",$row->Kode);
                $KodeLast = intval(end($ambilIdTerakhir)) + 1;
                $KodeBaru = "AGR"."-".date("His")."-".sprintf("%04d",$KodeLast);
                return $KodeBaru;
            }
        }


}
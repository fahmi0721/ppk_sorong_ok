<?php

class M_Pejabat extends CI_Model {
        
        function loadData($id=null){
            if($id != null){
                $this->db->where('Id', $id);
            }
            $this->db->order_by('Id', "DESC");
            return $this->db->get("ppk_pejabat")->result_array();
             
        }

        function createPejabat($data){
            $this->db->insert("ppk_pejabat", $data);
            return $this->db->affected_rows();
        }

        function updatePejabat($data,$Id){
            $this->db->where('Id', $Id);
            $this->db->update("ppk_pejabat", $data);
            return $this->db->affected_rows();
        }

        function deletePejabat($Id){
            $this->db->where('Id', $Id);
            $this->db->delete("ppk_pejabat");
            return $this->db->affected_rows();
        }


        function cekPejabat($Nip){
            $this->db->where('Nip', $Nip);
            $query = $this->db->get("ppk_pejabat");
            return $query->num_rows();
        }

        function generateKode(){
            $this->db->select("Kode");
            $this->db->order_by("Id","DESC");
            $row = $this->db->get("ppk_pejabat")->row();
            if($row === NULL){
                $Kode = "PJB"."-".date("His")."-"."0001";
                return $Kode;
            }else{
                $ambilIdTerakhir = explode("-",$row->Kode);
                $KodeLast = intval(end($ambilIdTerakhir)) + 1;
                $KodeBaru = "PJB"."-".date("His")."-".sprintf("%04d",$KodeLast);
                return $KodeBaru;
            }
        }


}
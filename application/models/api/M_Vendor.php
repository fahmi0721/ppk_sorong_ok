<?php

class M_Vendor extends CI_Model {
        
        function loadData($id=null){
            if($id != null){
                $this->db->where('Id', $id);
            }
                $this->db->order_by('Id', "DESC");
            return $this->db->get("ppk_vendor")->result_array();
        }

        function createData($data){
            $this->db->insert("ppk_vendor", $data);
            return $this->db->affected_rows();
        }

        function updateData($data,$Id){
            $this->db->where('Id', $Id);
            $this->db->update("ppk_vendor", $data);
            return $this->db->affected_rows();
        }

        function deleteData($Id){
            $this->db->where('Id', $Id);
            $this->db->delete("ppk_vendor");
            return $this->db->affected_rows();
        }

        function generateKode(){
            $this->db->select("Kode");
            $this->db->order_by("Id","DESC");
            $row = $this->db->get("ppk_vendor")->row();
            if($row === NULL){
                $Kode = "VDR"."-".date("His")."-"."0001";
                return $Kode;
            }else{
                $ambilIdTerakhir = explode("-",$row->Kode);
                $KodeLast = intval(end($ambilIdTerakhir))+1;
                $KodeBaru = "VDR"."-".date("His")."-".sprintf("%04d",$KodeLast);
                return $KodeBaru;
            }
        }


}
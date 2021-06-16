<?php

class M_Spk_bantu extends CI_Model {

    function detail_data(){
        $this->db->where("UserId",$this->session->userdata('token'));
        
        $idata['data'] = $this->db->get("ppk_spk_bantu")->result();
        $idata['jml'] = $this->db->get("ppk_spk_bantu")->num_rows();
        return $idata;
    }

    function ambil_data(){
        $this->db->where("UserId",$this->session->userdata('token'));
        return $this->db->get("ppk_spk_bantu")->result();
    }
        
    function save_data($data){
        $this->db->insert("ppk_spk_bantu", $data);
        return $this->db->affected_rows();
    }

    function update_data($Id,$data){
        $this->db->where('Id', $Id);
        $this->db->update("ppk_pl_surat_penunjukan", $data);
        return $this->db->affected_rows();
    }

    function hapus_data($Id){
        $this->db->where('Id', $Id);
        $this->db->delete("ppk_spk_bantu");
        return $this->db->affected_rows();
    }

    function delete_by_token($Token){
        $this->db->where('UserId', $Token);
        $this->db->delete("ppk_spk_bantu");
        return $this->db->affected_rows();
    }

}
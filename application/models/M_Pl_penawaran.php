<?php

class M_Pl_penawaran extends CI_Model {
        
    var $table = 'ppk_pl_penawaran'; //nama tabel dari database
    var $column_order = array(null,"NoSurat"); //field yang ada di table peserta
    var $column_search = array('NoSurat','Vendor',"Perihal"); //field yang diizin untuk pencarian 
    var $order = array('Id' => 'asc'); // default order 
 

    private function _get_datatables_query()
    {
         
        $this->db->from($this->table);
 
        $i = 0;
     
        foreach ($this->column_search as $item) // looping awal
        {
            if($_POST['search']['value']) // jika datatable mengirimkan pencarian dengan metode POST
            {
                 
                if($i===0) // looping awal
                {
                    $this->db->group_start(); 
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
 
                if(count($this->column_search) - 1 == $i) 
                    $this->db->group_end(); 
            }
            $i++;
        }
         
        if(isset($_POST['order'])) 
        {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } 
        else if(isset($this->order))
        {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function get_datatables()
    {
        $this->_get_datatables_query();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all()
    {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }
        
    function detail_data($Id){
        $this->db->where("Id",$Id);
        return $this->db->get("ppk_pl_penawaran")->row();
    }

    function detail_fakta($Id){
        $this->db->select("fakta_integritas");
        $this->db->where("Id",$Id);
        $res = $this->db->get("ppk_pl_penawaran")->row();
        if($res->fakta_integritas != ""){
            $iDt = json_decode($res->fakta_integritas,true);
            $result['Nama'] = $iDt['Nama'];
            $result['NoId'] = $iDt['NoId'];
            $result['Jabatan'] = $iDt['Jabatan'];
            $result['an'] = $iDt['an'];
            $result['Perihal'] = $iDt['Perihal'];
            $result['TglSurat'] = $iDt['TglSurat'];
        }else{
            $result['Nama'] = "";
            $result['NoId'] = "";
            $result['Jabatan'] = "";
            $result['an'] = "";
            $result['Perihal'] = "";
            $result['TglSurat'] = "";
        }
        return $result;
        
    }

    function detail_formulir($Id){
        $this->db->select("formulir_isian");
        $this->db->where("Id",$Id);
        $res = $this->db->get("ppk_pl_penawaran")->row();
        if($res->formulir_isian != ""){
            $iDt = json_decode($res->formulir_isian,true);
            $result['Nama'] = $iDt['Nama'];
            $result['NoId'] = $iDt['NoId'];
            $result['Jabatan'] = $iDt['Jabatan'];
            $result['an'] = $iDt['an'];
            $result['Alamat'] = $iDt['Alamat'];
            $result['NoTelp'] = $iDt['NoTelp'];
            $result['Email'] = $iDt['Email'];
            $result['Pernyataan'] = $iDt['Pernyataan'];
        }else{
            $result['Nama'] = "";
            $result['NoId'] = "";
            $result['Jabatan'] = "";
            $result['an'] = "";
            $result['Alamat'] = "";
            $result['NoTelp'] = "";
            $result['Email'] = "";
            $result['Pernyataan'] = "";
        }
        return $result;
        
    }


    function detail_lh($Id){
        $this->db->select("landasan_hukum");
        $this->db->where("Id",$Id);
        $res = $this->db->get("ppk_pl_penawaran")->row();
        if($res->landasan_hukum  != ""){
            $iDt = json_decode($res->landasan_hukum ,true);
            $result['Nomor'] = $iDt['Nomor'];
            $result['Tanggal'] = $iDt['Tanggal'];
            $result['Nama'] = $iDt['Nama'];
            $result['NoPengesahaan'] = $iDt['NoPengesahaan'];
            $result['NomorPerubahan'] = $iDt['NomorPerubahan'];
            $result['TanggalPerubahan'] = $iDt['TanggalPerubahan'];
            $result['NamaPerubahan'] = $iDt['NamaPerubahan'];
        }else{
            $result['Nomor'] = "";
            $result['Tanggal'] = "";
            $result['Nama'] = "";
            $result['NoPengesahaan'] = "";
            $result['NomorPerubahan'] = "";
            $result['TanggalPerubahan'] = "";
            $result['NamaPerubahan'] = "";
        }
        return $result;
        
    }


    function detail_da($Id){
        $this->db->select("data_administrasi");
        $this->db->where("Id",$Id);
        $res = $this->db->get("ppk_pl_penawaran")->row();
        if($res->data_administrasi  != ""){
            $iDt = json_decode($res->data_administrasi ,true);
            $result['Nama'] = $iDt['Nama'];
            $result['Status'] = $iDt['Status'];
            $result['AlamatPusat'] = $iDt['AlamatPusat'];
            $result['NoTelpPusat'] = $iDt['NoTelpPusat'];
            $result['FaxPusat'] = $iDt['FaxPusat'];
            $result['EmailPusat'] = $iDt['EmailPusat'];
            $result['AlamatCabang'] = $iDt['AlamatCabang'];
            $result['NoTelpCabang'] = $iDt['NoTelpCabang'];
            $result['FaxCabang'] = $iDt['FaxCabang'];
            $result['EmailCabang'] = $iDt['EmailCabang'];
        }else{
            $result['Nama'] = "";
            $result['Status'] = "";
            $result['AlamatPusat'] = "";
            $result['NoTelpPusat'] = "";
            $result['FaxPusat'] = "";
            $result['EmailPusat'] = "";
            $result['AlamatCabang'] = "";
            $result['NoTelpCabang'] = "";
            $result['FaxCabang'] = "";
            $result['EmailCabang'] = "";
        }
        return $result;
        
    }

    function save_data($data){
        $this->db->insert("ppk_pl_penawaran", $data);
        return $this->db->affected_rows();
    }

    function update_data($Id,$data){
        $this->db->where('Id', $Id);
        $this->db->update("ppk_pl_penawaran", $data);
        return $this->db->affected_rows();
    }

    function hapus_data($Id){
        $this->db->where('Id', $Id);
        $this->db->delete("ppk_pl_penawaran");
        return $this->db->affected_rows();
    }

}
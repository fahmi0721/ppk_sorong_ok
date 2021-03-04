<script>
    $(document).ready(function(){
        ShowdataTable();
        $("[data-toggle='tooltip']").tooltip();
        // FormMessage("Modul User",'Gagal menyimpan data','error');
    });
    <?php if($this->uri->segment(2) == "tambah" OR $this->uri->segment(2) == "edit"){ ?>
        $('.data_1 .input-group.date,.data_2 .input-group .awal,.data_2 .input-group .akhir').datepicker({
            startView: 1,
            todayBtn: "linked",
            keyboardNavigation: false,
            forceParse: false,
            autoclose: true,
            format: "yyyy-mm-dd"
        });

       

        $("#KodePejabat, #KodeVendor").select2({
            placeholder: "Pilih Data",
            allowClear: true
        });
        
    <?php } ?>
    

    $("#FormDataTambah").submit(function(e){
        e.preventDefault();
        SubmitTambah();
    })

    function rupiah(objek) {
        separator = ".";
        a = objek.value;
        b = a.replace(/[^\d]/g,"");
        c = "";
        panjang = b.length; 
        j = 0; 
        for (i = panjang; i > 0; i--) {
            j = j + 1;
            if (((j % 3) == 1) && (j != 1)) {
            c = b.substr(i-1,1) + separator + c;
            } else {
            c = b.substr(i-1,1) + c;
            }
        }
        objek.value = c;
    }

    function Validasi(){
        var iData = ["#NoSpk","#Tgl","#NoSuratUndangan","#TglSuratUndangan","#NoBaPl","#TglBaPl","#TglDari","#TglSampai","#KodePejabat"];
        var iKet = ["Nomor SPK belum lengkap!","Tanggal SPK belum lengkap!","No Surat Undangan belum lengkap!","Tanggal Surat Undangan belum lengkap!","No Berita Acara Hasil Pengadaan Langsung belum lengkap","Tanggal Berita Acara Hasil Pengadaan Langsung belum lengkap","Waktu Kerja Dari belum lengkap!","Waktu Kerja Sampai belum lengkap!","Pejabat yang bertandatangan belum dipilih"];
        for(var i =0; i < iData.length; i++){
            if($(iData[i]).val() === ""){
                PesanWarning('Pengisian Data', iKet[i]);
                $(iData[i]).focus();
                return false;
            }
        }
    }

    function SubmitTambah(){
        if(Validasi() != false){
            var iData = $("#FormDataTambah").serialize();
            $.ajax({
                type : "POST",
                url : "<?= base_url('spk/simpan'); ?>",
                data : iData,
                success: function(r){
                    var response = JSON.parse(r);
                    console.log(response);
                    if(response['status'] === false){
                        FormMessage("Modul Dokumen Surat Perjanjian Kerja (SPK)",response['message'],'error');
                    }else{
                        FormMessage('Modul Dokumen Surat Perjanjian Kerja (SPK)', response['message']);
                        setTimeout(function(){
                            window.location = "<?= base_url('data_pekerjaan/progres/'.$hps['Id']) ?>";
                        },1300)
                    }
                },
                error : function(er){
                    console.log(er);
                }
            })
        }
    }


    /** UPDATE DATA */
    $("#FormDataUpdate").submit(function(e){
        e.preventDefault();
        SubmitUpdate();
    })

    function SubmitUpdate(){
        if(Validasi() != false){
            var iData = $("#FormDataUpdate").serialize();
            $.ajax({
                type : "POST",
                url : "<?= base_url('spk/update'); ?>",
                data : iData,
                success: function(r){
                    var response = JSON.parse(r);
                    console.log(response);
                    if(response['status'] === false){
                        FormMessage("Modul Dokumen Surat Perjanjian Kerja (SPK)",response['message'],'error');
                    }else{
                        FormMessage('Modul Dokumen Surat Perjanjian Kerja (SPK)', response['message']);
                        setTimeout(function(){
                            window.location = "<?= base_url('data_pekerjaan/progres/'.$hps['Id']) ?>";
                        },1300)
                    }
                },
                error : function(er){
                    console.log(er);
                }
            })
        }
    }

    
</script>
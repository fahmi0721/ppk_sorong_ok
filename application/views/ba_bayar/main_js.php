<script>
    $(document).ready(function(){
        $("[data-toggle='tooltip']").tooltip();
        // FormMessage("Modul User",'Gagal menyimpan data','error');
    });
    <?php if($this->uri->segment(2) == "tambah" OR $this->uri->segment(2) == "edit"){ ?>
        $('.data_1 .input-group.date').datepicker({
            startView: 1,
            todayBtn: "linked",
            keyboardNavigation: false,
            forceParse: false,
            autoclose: true,
            format: "yyyy-mm-dd"
        });

        $("#KodePejabat").select2({
            placeholder: "Pilih Data",
            allowClear: true
        });
        
    <?php } ?>
    

    $("#FormDataTambah").submit(function(e){
        e.preventDefault();
        SubmitTambah();
    })


    function Validasi(){
        var iData = ["#NoSurat","#Tgl","#KodePejabat"];
        var iKet = ["Nomor Surat belum lengkap!","Tanggal Surat belum lengkap!","Pejabat yang bertanda tanngan belum dipilih!"];
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
                url : "<?= base_url('ba_bayar/simpan'); ?>",
                data : iData,
                success: function(r){
                    var response = JSON.parse(r);
                    console.log(response);
                    if(response['status'] === false){
                        FormMessage("Modul Dokumen Berita Acara Pembayaran",response['message'],'error');
                    }else{
                        FormMessage('Modul Dokumen Berita Acara Pembayaran', response['message']);
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
                url : "<?= base_url('ba_bayar/update'); ?>",
                data : iData,
                success: function(r){
                    var response = JSON.parse(r);
                    console.log(response);
                    if(response['status'] === false){
                        FormMessage("Modul Dokumen Berita Acara Pembayaran",response['message'],'error');
                    }else{
                        FormMessage('Modul Dokumen Berita Acara Pembayaran', response['message']);
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
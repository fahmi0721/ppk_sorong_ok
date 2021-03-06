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

        $("#KodePejabat,#KodePanitiaPemeriksa").select2({
            placeholder: "Pilih Data",
            allowClear: true
        });
        
    <?php } ?>
    

    $("#FormDataTambah").submit(function(e){
        e.preventDefault();
        SubmitTambah();
    })


    function Validasi(){
        var iData = ["#NoSurat","#Tgl","#KodePejabat","#KodePanitiaPemeriksa"];
        var iKet = ["Nomor Surat belum lengkap!","Tanggal Surat belum lengkap!","Pejabat yang bertanda tanngan belum dipilih!","No SK Panitia Pemeriksa belum dipilih!"];
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
                url : "<?= base_url('baphp/simpan'); ?>",
                data : iData,
                success: function(r){
                    var response = JSON.parse(r);
                    console.log(response);
                    if(response['status'] === false){
                        FormMessage("Modul Dokumen Berita Acara Pemeriksaan Hasil Pekerjaan",response['message'],'error');
                    }else{
                        FormMessage('Modul Dokumen Berita Acara Pemeriksaan Hasil Pekerjaan', response['message']);
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
                url : "<?= base_url('baphp/update'); ?>",
                data : iData,
                success: function(r){
                    var response = JSON.parse(r);
                    console.log(response);
                    if(response['status'] === false){
                        FormMessage("Modul Dokumen Berita Acara Pemeriksaan Hasil Pekerjaan",response['message'],'error');
                    }else{
                        FormMessage('Modul Dokumen Berita Acara Pemeriksaan Hasil Pekerjaan', response['message']);
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
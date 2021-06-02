<script>
    $(document).ready(function(){
        $('#TglSurat').datepicker({
            startView: 1,
            todayBtn: "linked",
            keyboardNavigation: false,
            forceParse: false,
            autoclose: true,
            format: "yyyy-mm-dd"
        });
    });
   
    function Validasi(){
        var iData = ["#NoSurat","#TglSurat","#Lampiran","#Perihal","#Kepada","#Dipa","#Pekerjaan","#Pelaksanaan","#NamaPejabat","#JabatanPejabat","#NipPejabat"];
        var iKet = ["No Surat belum lengkap!","Tanggal Surat belum lengkap!","Lampiran belum lengkap!","Perihal belum lengkap!","Kepada belum lengkap!", "Dipa belum lengkap!","Pekerjaan belum lengkap!","Pelaksanaan belum lengkap!","Nama Pejabat Belum Lengkap","Jabatan Pejabat Belum Lengkap","Nip Pejabat Belum Lengkap"];
        for(var i =0; i < iData.length; i++){
            if($(iData[i]).val() === ""){
                PesanWarning('Pengisian Data', iKet[i]);
                $(iData[i]).focus();
                return false;
            }
        }
    }

    function Submit(){
        if(Validasi() != false){
            var iData = $("#FormData").serialize();
            $.ajax({
                type : "POST",
                url : "<?= base_url('surat_penunjukan/update'); ?>",
                data : iData,
                success: function(r){
                    var response = JSON.parse(r);
                    console.log(response);
                    if(response['status'] === false){
                        FormMessage("Modul Surat Penunjukan",response['pesan'],'error');
                    }else{
                        FormMessage('Modul Surat Penunjukan', response['pesan']);
                        setTimeout(function(){
                            window.location = "<?= base_url('surat_penunjukan') ?>";
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
    $("#FormData").submit(function(e){
        e.preventDefault();
        Submit();
    })
   
</script>
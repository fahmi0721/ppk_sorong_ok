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
        var iData = ["#Nama","#AlamatPusat","#NoTelpPusat","#FaxPusat","#EmailPusat"];
        var iKet = ["Nama Badan Usaha belum lengkap!","Alamat Kantor Pusat belum lengkap!","No. Telepon  belum lengkap!","No. Fax belum lengkap!","E-Mail belum lengkap!"];
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
                url : "<?= base_url('pl_penawaran/update_da'); ?>",
                data : iData,
                success: function(r){
                    var response = JSON.parse(r);
                    console.log(response);
                    if(response['status'] === false){
                        FormMessage("Modul Surat Penawaran",response['pesan'],'error');
                    }else{
                        FormMessage('Modul Surat Penawaran', response['pesan']);
                        setTimeout(function(){
                            window.location = "<?= base_url('pl_penawaran') ?>";
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
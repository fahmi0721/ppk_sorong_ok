<script>
 
    $(document).ready(function(){
       

        $('#TanggalPerubahan,#Tanggal').datepicker({
            startView: 1,
            todayBtn: "linked",
            keyboardNavigation: false,
            forceParse: false,
            autoclose: true,
            format: "yyyy-mm-dd"
        });
    });
   
    function Validasi(){
        var iData = ["#Nama","#NoId","#Nama","#Jabatan"];
        var iKet = ["Nama belum lengkap!","Nomor Identitas belum lengkap!","Jabatan belum lengkap!"];
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
                url : "<?= base_url('pl_penawaran/update_pbu'); ?>",
                data : iData,
                success: function(r){
                    var response = JSON.parse(r);
                    console.log(response);
                    if(response['status'] === false){
                        FormMessage("Modul Surat Penawaran",response['pesan'],'error');
                    }else{
                        FormMessage('Modul Surat Penawaran', response['pesan']);
                        setTimeout(() => {
                            location.reload();
                        }, 1500);
                        
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
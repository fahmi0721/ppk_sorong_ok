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
        $('#Tgl0,#Tgl1,#Tgl2,#Tgl3').datetimepicker({
            weekStart: 1,
            todayBtn:  1,
            autoclose: 1,
            todayHighlight: 1,
            startView: 2,
            forceParse: 0,
            showMeridian: 1
        });
        
    });
   
    function Validasi(){
        var iData = ["#NoSurat","#TglSurat","#Lampiran","#Perihal","#Kepada","#KotaVendor","#AlamatVendor","#SumberDana","#Pekerjaan","#LikPekerjaan","#NilaiHps","#Tgl0","#Tgl1","#Tgl2","#Tgl3","#NamaPejabat","#JabatanPejabat","#NipPejabat"];
        var iKet = ["No Surat belum lengkap!","Tanggal Surat belum lengkap!","Lampiran belum lengkap!","Perihal belum lengkap!","Kepada belum lengkap!", "Kota Vendor belum lengkap!","Alamat Vendor belum lengkap!","Sumber Daba belum lengkap!","Pekerjaan Belum Lengkap","Lingkungan Pekerjaan Belum Lengkap","Nilai Total Hps Belum Lengkap","Pemasukan Dokumen Kualifikasi belum lengkap!","Pemasukan Dokumen Penawaran belum lengkap!","Pembukaan Dokumen Penawaran, Evaluasi, Klarifikasi Teknis dan Negosiasi Harga belum lengkap!","Penandatanganan SPK belum lengkap!","Nama Pejabat belum lengkap!","Jabatan Pejabat belum lengkap!","Nip Pejabat belum lengkap!"];
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
                url : "<?= base_url('pl_undangan/save'); ?>",
                data : iData,
                success: function(r){
                    var response = JSON.parse(r);
                    console.log(response);
                    if(response['status'] === false){
                        FormMessage("Modul Undangan Penawaran",response['pesan'],'error');
                    }else{
                        FormMessage('Modul Undangan Penawaran', response['pesan']);
                        setTimeout(function(){
                            window.location = "<?= base_url('pl_undangan') ?>";
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
<script>
    $(document).ready(function(){
        ShowdataTable();
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
        var iData = ["#Nomor","#Tgl","#TglPenawaran","#HargaSepakat","#KodePejabat","#KodeVendor"];
        var iKet = ["Nomor belum lengkap!","Tanggal Surat Penunjukan belum lengkap!","Tanggal Penawaran belum lengkap!","Harga yang disepakatai belum lengkap!","Pejabat yang bertanda tangan belum dipilih","Penyedia/Vendor belum dipilih"];
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
                url : "<?= base_url('penunjukan_penyedia/simpan'); ?>",
                data : iData,
                success: function(r){
                    var response = JSON.parse(r);
                    console.log(response);
                    if(response['status'] === false){
                        FormMessage("Modul Dokumen Penunjukan Penyedia/Vendor",response['message'],'error');
                    }else{
                        FormMessage('Modul Dokumen Penunjukan Penyedia/Vendor', response['message']);
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

    function ValidasiUpdate(){
        var iData = ["#Nomor","#Tgl","#TglPenawaran","#HargaSepakat","#KodePejabat","#KodeVendor"];
        var iKet = ["Nomor belum lengkap!","Tanggal Surat Penunjukan belum lengkap!","Tanggal Penawaran belum lengkap!","Harga yang disepakatai belum lengkap!","Pejabat yang bertanda tangan belum dipilih","Penyedia/Vendor belum dipilih"];
        for(var i =0; i < iData.length; i++){
            if($(iData[i]).val() === ""){
                PesanWarning('Pengisian Data', iKet[i]);
                $(iData[i]).focus();
                return false;
            }
        }
    }

    

    function SubmitUpdate(){
        if(ValidasiUpdate() != false){
            var iData = $("#FormDataUpdate").serialize();
            $.ajax({
                type : "POST",
                url : "<?= base_url('penunjukan_penyedia//update'); ?>",
                data : iData,
                success: function(r){
                    var response = JSON.parse(r);
                    console.log(response);
                    if(response['status'] === false){
                        FormMessage("Modul Dokumen Penunjukan Penyedia/Vendor",response['message'],'error');
                    }else{
                        FormMessage('Modul Dokumen Penunjukan Penyedia/Vendor', response['message']);
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
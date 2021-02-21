<script>
    $(document).ready(function(){
        //ShowdataTable();
        // $("[data-toggle='tooltip']").tooltip();
        $("#KodeAnggaran").select2({
            placeholder: "Pilih Anggaran",
            allowClear: true
        });

        $("#KodePejabat").select2({
            placeholder: "Pilih Pejabat",
            allowClear: true
        });
        $('#data_1 .input-group.date').datepicker({
            startView: 1,
            todayBtn: "linked",
            keyboardNavigation: false,
            forceParse: false,
            autoclose: true,
            format: "yyyy-mm-dd"
        });
    
    });

    $("#FormDataTambah").submit(function(e){
        e.preventDefault();
        SubmitTambah();
    })

    function Validasi(){
        var iData = ["#NoSurat","#Pekerjaan","#KodeAnggaran","#Tgl","#KodePejabat"];
        var iKet = ["Nmor Surat HPS belum lengkap!","Nama Pekerjaan belum lengkap!","Anggaran belum dipilih!","Tanggal belum lengkap!","Pejabat belum dipilih"];
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
                url : "<?= base_url('pekerjaan_baru/simpan'); ?>",
                data : iData,
                success: function(r){
                    var response = JSON.parse(r);
                    console.log(response);
                    if(response['status'] === false){
                        FormMessage("Modul Pekerjaan / HPS",response['message'],'error');
                    }else{
                        FormMessage('Modul Pekerjaan / HPS', response['message']);
                        setTimeout(function(){
                            window.location = "<?= base_url('data_pekerjaan') ?>";
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
        var iData = ["#Nama","#Nomor","#Tahun","#Tanggal"];
        var iKet = ["Nama belum lengkap!","Nomor belum lengkap!","Tahun belum lengkap!","Tanggal belum lengkap!"];
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
                url : "<?= base_url('anggaran/update'); ?>",
                data : iData,
                success: function(r){
                    var response = JSON.parse(r);
                    console.log(response);
                    if(response['status'] === false){
                        FormMessage("Modul Anggaran",response['message'],'error');
                    }else{
                        FormMessage('Modul Anggaran', response['message']);
                        setTimeout(function(){
                            window.location = "<?= base_url('anggaran') ?>";
                        },1300)
                    }
                },
                error : function(er){
                    console.log(er);
                }
            })
        }
    }

    function SubmitDelete(Id){
        iData = "Id="+Id;
        $.ajax({
            type : "POST",
            url : "<?= base_url('anggaran/delete'); ?>",
            data : iData,
            success: function(r){
                var response = JSON.parse(r);
                console.log(response);
                if(response['status'] === false){
                    FormMessage("Modul Anggaran",response['message'],'error');
                }else{
                    FormMessage('Modul Anggaran', response['message']);
                    setTimeout(function(){
                        window.location = "<?= base_url('anggaran') ?>";
                    },1300)
                }
            },
            error : function(er){
                console.log(er);
            }
        })
    }

    function ShowConfirm(Id){
        swal({
                title: "Anda yakin menghapus data ini?",
                text: "Data ini akan dihapus secara permanen!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Ya, Hapus!",
                closeOnConfirm: false
            }, function () {
                SubmitDelete(Id);
            });
    }

</script>
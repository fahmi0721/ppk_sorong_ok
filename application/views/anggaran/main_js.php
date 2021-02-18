<script>
    $(document).ready(function(){
        ShowdataTable();
        $("[data-toggle='tooltip']").tooltip();
        // FormMessage("Modul User",'Gagal menyimpan data','error');
    });
    <?php if($this->uri->segment(2) == "tambah" OR $this->uri->segment(2) == "edit"){ ?>
        $('#data_2 .input-group.date').datepicker({
            startView: 2,
            todayBtn: "linked",
            keyboardNavigation: false,
            forceParse: false,
            format: "yyyy",
            viewMode: "years",
            minViewMode: "years",
            autoclose: true
        });
        $('#data_1 .input-group.date').datepicker({
            startView: 1,
            todayBtn: "linked",
            keyboardNavigation: false,
            forceParse: false,
            autoclose: true,
            format: "yyyy-mm-dd"
        });
        
    <?php } ?>
    
    function ShowdataTable(){
        $('.dataTables-example').DataTable({
            pageLength: 25,
            responsive: true,
            ordering: false,
            dom: '<"html5buttons"B>lTfgitp',
            buttons: [
                {extend: 'excel', title: 'DataAnggaran'},
                {extend: 'print',
                    customize: function (win){
                        $(win.document.body).addClass('white-bg');
                        $(win.document.body).css('font-size', '10px');

                        $(win.document.body).find('table')
                                .addClass('compact')
                                .css('font-size', 'inherit');
                }
                }
            ]

        });
    }

    $("#FormDataTambah").submit(function(e){
        e.preventDefault();
        SubmitTambah();
    })

    function Validasi(){
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

    function SubmitTambah(){
        if(Validasi() != false){
            var iData = $("#FormDataTambah").serialize();
            $.ajax({
                type : "POST",
                url : "<?= base_url('anggaran/simpan'); ?>",
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
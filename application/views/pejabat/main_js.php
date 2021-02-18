<script>
    $(document).ready(function(){
        ShowdataTable();
        $("[data-toggle='tooltip']").tooltip();
        // FormMessage("Modul User",'Gagal menyimpan data','error');
    });
    
    function ShowdataTable(){
        $('.dataTables-example').DataTable({
            pageLength: 25,
            responsive: true,
            ordering: false,
            dom: '<"html5buttons"B>lTfgitp',
            buttons: [
                {extend: 'excel', title: 'DataPejabat'},
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
        var iData = ["#Nip","#Nama","#Jabatan","#DeskripsiJabatan","#Alamat"];
        var iKet = ["Nip belum lengkap!","Nama belum lengkap!","Jabatan belum lengkap!","Deskripsi Jabatan belum lengkap!","Alamat belum lengkap!"];
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
                url : "<?= base_url('pejabat/simpan'); ?>",
                data : iData,
                success: function(r){
                    var response = JSON.parse(r);
                    console.log(response);
                    if(response['status'] === false){
                        FormMessage("Modul Pejabat",response['message'],'error');
                    }else{
                        FormMessage('Modul Pejabat', response['message']);
                        setTimeout(function(){
                            window.location = "<?= base_url('pejabat') ?>";
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
        var iData = ["#Nip","#Nama","#Jabatan","#DeskripsiJabatan","#Alamat"];
        var iKet = ["Nip belum lengkap!","Nama belum lengkap!","Jabatan belum lengkap!","Deskripsi Jabatan belum lengkap!","Alamat belum lengkap!"];
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
                url : "<?= base_url('pejabat/update'); ?>",
                data : iData,
                success: function(r){
                    var response = JSON.parse(r);
                    console.log(response);
                    if(response['status'] === false){
                        FormMessage("Modul Pejabat",response['message'],'error');
                    }else{
                        FormMessage('Modul Pejabat', response['message']);
                        setTimeout(function(){
                            window.location = "<?= base_url('pejabat') ?>";
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
            url : "<?= base_url('pejabat/delete'); ?>",
            data : iData,
            success: function(r){
                var response = JSON.parse(r);
                console.log(response);
                if(response['status'] === false){
                    FormMessage("Modul Pejabat",response['message'],'error');
                }else{
                    FormMessage('Modul Pejabat', response['message']);
                    setTimeout(function(){
                        window.location = "<?= base_url('pejabat') ?>";
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
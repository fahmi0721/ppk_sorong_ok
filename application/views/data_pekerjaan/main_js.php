<script>
    $(document).ready(function(){
        ShowdataTable();
        $("[data-toggle='tooltip']").tooltip();
        // FormMessage("Modul User",'Gagal menyimpan data','error');
    });
   
   
    $('#data_1 .input-group.date').datepicker({
        startView: 1,
        todayBtn: "linked",
        keyboardNavigation: false,
        forceParse: false,
        autoclose: true,
        format: "yyyy-mm-dd"
    });

    $("#KodeAnggaran").select2({
        placeholder: "Pilih Anggaran",
        allowClear: true
    });

    $("#KodePejabat").select2({
        placeholder: "Pilih Pejabat",
        allowClear: true
    });
        
    
    
    function ShowdataTable(){
        $('.dataTables-example').DataTable({
            pageLength: 25,
            responsive: true,
            ordering: false,
            dom: '<"html5buttons"B>lTfgitp',
            buttons: [
                {extend: 'excel', title: 'DataHPS'},
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

   

    /** UPDATE DATA */
    $("#FormDataUpdate").submit(function(e){
        e.preventDefault();
        SubmitUpdate();
    })

    function ValidasiUpdate(){
        var iData = ["#NoSurat","#Pekerjaan","#KodeAnggaran","#Tgl","#KodePejabat"];
        var iKet = ["No Surat belum lengkap!","Pekerjaan belum lengkap!","Anggaran belum dipilih!","Tanggal belum lengkap!","Pejabat belum dipilih!"];
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
                url : "<?= base_url('data_pekerjaan/update'); ?>",
                data : iData,
                success: function(r){
                    var response = JSON.parse(r);
                    console.log(response);
                    if(response['status'] === false){
                        FormMessage("Modul Pekerjaan / Harga Perkiraan Sendiri",response['message'],'error');
                    }else{
                        FormMessage('Modul Pekerjaan / Harga Perkiraan Sendiri', response['message']);
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

    function SubmitDelete(Id){
        iData = "Id="+Id;
        $.ajax({
            type : "POST",
            url : "<?= base_url('data_pekerjaan/delete'); ?>",
            data : iData,
            success: function(r){
                var response = JSON.parse(r);
                console.log(response);
                if(response['status'] === false){
                    FormMessage("Modul Pekrjaan / Harga Perkiraan Sendiri",response['message'],'error');
                }else{
                    FormMessage('Modul Pekrjaan / Harga Perkiraan Sendiri', response['message']);
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
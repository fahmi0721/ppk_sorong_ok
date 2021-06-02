<script>
    $(document).ready(function(){
        getData();
        $("[data-toggle='tooltip']").tooltip();
    });
   
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

    function SubmitDelete(Id){
        iData = "Id="+Id;
        $.ajax({
            type : "POST",
            url : "<?= base_url('pl_undangan/hapus'); ?>",
            data : iData,
            success: function(r){
                var response = JSON.parse(r);
                console.log(response);
                if(response['status'] === false){
                    FormMessage("Modul Dokumen Undangan Penawaran",response['pesan'],'error');
                }else{
                    FormMessage('Modul Dokumen Undangan Penawaran', response['pesan']);
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
   
    function getData(){
        $('.dataTables-example').DataTable({
            responsive: true,
            processing: true, 
            serverSide: true, 
            order: [], 
            
            ajax: {
                "url": "<?php echo site_url('pl_undangan/get_data_peserta')?>",
                "type": "POST",
                async: true,
                error : function(er){
                    console.log(er['responseText']);
                }
                
            },
            fnDrawCallback: function (oSettings) {
                $("[data-toggle='tooltip']").tooltip();
            },
            
            columnDefs: [
                { 
                    "targets": [ 0,1,2,4,5,6,7], 
                    "orderable": false, 
                },
            ],

        });
    }
   
</script>
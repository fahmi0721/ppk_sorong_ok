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

    function ShowConfirmModulLain(Id,Modul){
        swal({
                title: "Anda yakin menghapus data ini?",
                text: "Data ini akan dihapus secara permanen!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Ya, Hapus!",
                closeOnConfirm: false
            }, function () {
                if(Modul === "penunjukan_penyedia"){
                    SubmitDeletePenunjukanPenyedia(Id);
                }else if(Modul === "spk"){
                    SubmitDeleteSpk(Id);
                }else if(Modul === "pphp"){
                    SubmitDeletePphp(Id);
                }else if(Modul === "baphp"){
                    SubmitDeleteBaphp(Id);
                }else if(Modul === "bastb"){
                    SubmitDeleteBastb(Id);
                }else if(Modul === "ba_bayar"){
                    SubmitDeleteBa_bayar(Id);
                }else if(Modul === "kwitansi"){
                    SubmitDeleteKwitansi(Id);
                }
                
                
        });
    }

    /**
    fungsi hapus penunnukan penyedia
     */

    function SubmitDeletePenunjukanPenyedia(Id){
        iData = "Id="+Id;
        $.ajax({
            type : "POST",
            url : "<?= base_url('penunjukan_penyedia/delete'); ?>",
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


    /**
    fungsi hapus Spk
    */

    function SubmitDeleteSpk(Id){
        iData = "Id="+Id;
        $.ajax({
            type : "POST",
            url : "<?= base_url('spk/delete'); ?>",
            data : iData,
            success: function(r){
                var response = JSON.parse(r);
                console.log(response);
                if(response['status'] === false){
                    FormMessage("Modul Dokumen Surat Perintah Kerja",response['message'],'error');
                }else{
                    FormMessage('Modul Dokumen Surat Perintah Kerja', response['message']);
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

    /**
    fungsi hapus Pphp
    */

    function SubmitDeletePphp(Id){
        iData = "Id="+Id;
        $.ajax({
            type : "POST",
            url : "<?= base_url('pphp/delete'); ?>",
            data : iData,
            success: function(r){
                var response = JSON.parse(r);
                console.log(response);
                if(response['status'] === false){
                    FormMessage("Modul Dokumen Permintaan Pemeriksan Barang/Jasa",response['message'],'error');
                }else{
                    FormMessage('Modul Dokumen Permintaan Pemeriksan Barang/Jasa', response['message']);
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

    /**
    fungsi hapus Baphp
    */

    function SubmitDeleteBaphp(Id){
        iData = "Id="+Id;
        $.ajax({
            type : "POST",
            url : "<?= base_url('baphp/delete'); ?>",
            data : iData,
            success: function(r){
                var response = JSON.parse(r);
                console.log(response);
                if(response['status'] === false){
                    FormMessage("Modul Dokumen Berita Acara Pemeriksaan Hasil Pekerjaan",response['message'],'error');
                }else{
                    FormMessage('Modul Dokumen Berita Acara Pemeriksaan Hasil Pekerjaan', response['message']);
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

    /**
    fungsi hapus Bastb
    */

    function SubmitDeleteBastb(Id){
        iData = "Id="+Id;
        $.ajax({
            type : "POST",
            url : "<?= base_url('bastb/delete'); ?>",
            data : iData,
            success: function(r){
                var response = JSON.parse(r);
                console.log(response);
                if(response['status'] === false){
                    FormMessage("Modul Dokumen Dokumen Berita Acara Serah Terima Barang",response['message'],'error');
                }else{
                    FormMessage('Modul Dokumen Dokumen Berita Acara Serah Terima Barang', response['message']);
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

    /**
    fungsi hapus BaBayar
    */

    function SubmitDeleteBa_bayar(Id){
        iData = "Id="+Id;
        $.ajax({
            type : "POST",
            url : "<?= base_url('ba_bayar/delete'); ?>",
            data : iData,
            success: function(r){
                var response = JSON.parse(r);
                console.log(response);
                if(response['status'] === false){
                    FormMessage("Modul Dokumen Berita Acara Pembayaran",response['message'],'error');
                }else{
                    FormMessage('Modul Dokumen Berita Acara Pembayaran', response['message']);
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

    function SubmitDeleteKwitansi(Id){
        iData = "Id="+Id;
        $.ajax({
            type : "POST",
            url : "<?= base_url('kwitansi/delete'); ?>",
            data : iData,
            success: function(r){
                var response = JSON.parse(r);
                console.log(response);
                if(response['status'] === false){
                    FormMessage("Modul Dokumen Kwitansi",response['message'],'error');
                }else{
                    FormMessage('Modul Dokumen Kwitansi', response['message']);
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

</script>
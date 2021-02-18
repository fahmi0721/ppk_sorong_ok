<script>
    $(document).ready(function(){
        coba();
        ShowdataTable();
        $("[data-toggle='tooltip']").tooltip();
        // FormMessage("Modul User",'Gagal menyimpan data','error');
        <?php if($this->uri->segment(2) == "tambah" || $this->uri->segment(2) == "edit"){ ?>
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
            LoadDataAddSession();
            
        <?php } ?>
    });

    
    
    
    function ShowdataTable(){
        $('.dataTables-example').DataTable({
            pageLength: 25,
            responsive: true,
            ordering: false,
            dom: '<"html5buttons"B>lTfgitp',
            buttons: [
                {extend: 'excel', title: 'DataVendor'},
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
        var iData = ["#Nama","#NoSk","#Perihal","#Tahun","#Tanggal"];
        var iKet = ["Judul SK belum lengkap!","Nomor SK belum lengkap!","Perihal belum lengkap!","Tahun belum lengkap!","Tanggal belum lengkap!"];
        for(var i =0; i < iData.length; i++){
            if($(iData[i]).val() === ""){
                PesanWarning('Pengisian Data', iKet[i]);
                $(iData[i]).focus();
                return false;
            }
        }
        if(parseInt($("#TotPanitia").val()) <= 0){
            PesanWarning('Pengisian Data', "Panitia Pemeriksa belum lengkap");
            $("#NamaPemeriksa").focus();
            return false;
        }
    }

    function coba() {
        var dt = ['aa','vvv','dd'];
        for( key in dt){
            console.log(dt[key]);
        }
    }

    function LoadDataAddSession(){
        $.ajax({
            type : "GET",
            url : "<?= base_url('panitia/load_pemeriksa'); ?>",
            success: function(r){
                var response = JSON.parse(r);   
                console.log(response);
                if(response['status'] == 200){
                    var html = "";
                    var no =1;
                    $("#TotPanitia").val(response['data'].length);
                    for(key in response['data']){
                        var iDats = response['data'][key];
                        html += "<tr>";
                        html += "<td class='text-center'>"+no+"</td>";
                        html += "<td>"+iDats['Nama']+"<br><small><b>NIP : </b>"+iDats['Nip']+"</small></td>";
                        html += "<td class='text-center'><a data-toggle='tooltip' onclick=\"HapusSessionData('"+key+"')\" title='Hapus data' href='javascript:void(0)' class='btn btn-danger btn-xs dim btn-outline'><i class='fa fa-trash-o'></i></a></td>";
                        html += "</tr>";
                        no++;
                    }
                    $("#dtHt").html(html);
                    $("[data-toggle='tooltip']").tooltip();
                }else{
                    $("#TotPanitia").val(0);
                    $("#dtHt").html("<tr><td colspan='3' class='text-center'>No data availbe in table</td></tr>");
                }
                
            },
            error : function(er){
                console.log(er);
            }
        })
    }
    
    function  ValidasiPeserta() {
        var iData = ["#NamaPemeriksa","#Nip"];
        var iKet = ["Nama  belum lengkap!","NIP belum lengkap!"];
        for(var i =0; i < iData.length; i++){
            if($(iData[i]).val() === ""){
                PesanWarning('Pengisian Data', iKet[i]);
                $(iData[i]).focus();
                return false;
            }
        }
    }

    function ClearData() {
        $("#NamaPemeriksa,#Nip").val("");
    }

    function  HapusSessionData(Id) {
        $.ajax({
            type : "POST",
            url : "<?= base_url('panitia/hapus_data_to_session'); ?>",
            data : "Id="+Id,
            success: function(r){
                var response = JSON.parse(r);
                console.log(response);
                if(response['status'] === false){
                    FormMessage("Modul SK Panitia Pemeriksa",response['message'],'error');
                }else{
                    FormMessage('Modul SK Panitia Pemeriksa', response['message'],'success');
                    LoadDataAddSession();
                    ClearData();
                }
            },
            error : function(er){
                console.log(er);
            }
        })
    }

    $("#TambahPeserta").click(function(){
        if(ValidasiPeserta() != false){
            <?php if($this->uri->segment(2) == "edit"){ ?>
                var iData = $("#FormDataUpdate").serialize(); 
            <?php }else{ ?> 
                var iData =  $("#FormDataTambah").serialize();
            <?php } ?>
            $.ajax({
                type : "POST",
                url : " <?= base_url('panitia/add_data_to_session') ?> ",
                data : iData,
                success: function(r){
                    var response = JSON.parse(r);
                    console.log(response);
                    if(response['status'] === false){
                        FormMessage("Modul SK Panitia Pemeriksa",response['message'],'error');
                    }else{
                        FormMessage('Modul SK Panitia Pemeriksa', response['message'],'success');
                        LoadDataAddSession();
                        ClearData();
                    }
                },
                error : function(er){
                    console.log(er);
                }
            })
        }
    })

    function SubmitTambah(){
        if(Validasi() != false){
            var iData = $("#FormDataTambah").serialize();
            $.ajax({
                type : "POST",
                url : "<?= base_url('panitia/simpan'); ?>",
                data : iData,
                success: function(r){
                    var response = JSON.parse(r);
                    console.log(response);
                    if(response['status'] === false){
                        FormMessage("Modul SK Panitia Pemeriksa",response['message'],'error');
                    }else{
                        FormMessage('Modul SK Panitia Pemeriksa', response['message']);
                        setTimeout(function(){
                            window.location = "<?= base_url('panitia') ?>";
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
        var iData = ["#Nama","#NamaPimpinan","#Jabatan","#NoTelp","#Bank","#NoRek","#AnBank","#Alamat"];
        var iKet = ["Nama belum lengkap!","Nama Pimpinan belum lengkap!","Jabatan belum lengkap!","No Telpon/Hp belum lengkap!","Bank belum lengkap!", "No Rekening belum lengkap!","A.n Bank belum lengkap!","Alamat belum lengkap!"];
        for(var i =0; i < iData.length; i++){
            if($(iData[i]).val() === ""){
                PesanWarning('Pengisian Data', iKet[i]);
                $(iData[i]).focus();
                return false;
            }
        }
        if(parseInt($("#TotPanitia").val()) <= 0){
            PesanWarning('Pengisian Data', "Panitia Pemeriksa belum lengkap");
            $("#Nama").focus();
            return false;
        }
    }

    

    function SubmitUpdate(){
        if(ValidasiUpdate() != false){
            var iData = $("#FormDataUpdate").serialize();
            $.ajax({
                type : "POST",
                url : "<?= base_url('panitia/update'); ?>",
                data : iData,
                success: function(r){
                    var response = JSON.parse(r);
                    if(response['status'] === false){
                        FormMessage("Modul SK Panitia Pemeriksa",response['message'],'error');
                    }else{
                        FormMessage('Modul SK Panitia Pemeriksa', response['message']);
                        setTimeout(function(){
                            window.location = "<?= base_url('panitia') ?>";
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
            url : "<?= base_url('panitia/delete'); ?>",
            data : iData,
            success: function(r){
                var response = JSON.parse(r);
                console.log(response);
                if(response['status'] === false){
                    FormMessage("Modul Vendor",response['message'],'error');
                }else{
                    FormMessage('Modul Vendor', response['message']);
                    setTimeout(function(){
                        window.location = "<?= base_url('panitia') ?>";
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
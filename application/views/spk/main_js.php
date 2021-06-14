<script>
    $(document).ready(function(){
        <?php if($this->uri->segment(2) == "tambah" OR $this->uri->segment(2) == "edit"){ ?>
            LoadIdataItem();

        <?php }else{ ?>
            ShowdataTable();
        <?php } ?>
        $("[data-toggle='tooltip']").tooltip();
        // FormMessage("Modul User",'Gagal menyimpan data','error');
    });
    <?php if($this->uri->segment(2) == "tambah" OR $this->uri->segment(2) == "edit"){ ?>
        $('.data_1 .input-group.date,.data_2 .input-group .awal,.data_2 .input-group .akhir').datepicker({
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

    function formatAngka(angka, prefix){
        var number_string = angka.toString().replace(/[^,\d]/g, ''),
        
        split       = number_string.split(','),
        sisa        = split[0].length % 3,
        rupiah      = split[0].substr(0, sisa),
        ribuan      = split[0].substr(sisa).match(/\d{3}/gi);

        // tambahkan titik jika yang di input sudah menjadi angka ribuan
        if(ribuan){
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix == undefined ? rupiah : (rupiah ?  rupiah : '');
    }

    function formatRupiah(angka, prefix){
        var number_string = angka.toString().replace(/[^,\d]/g, ''),
        
        split       = number_string.split(','),
        sisa        = split[0].length % 3,
        rupiah      = split[0].substr(0, sisa),
        ribuan      = split[0].substr(sisa).match(/\d{3}/gi);

        // tambahkan titik jika yang di input sudah menjadi angka ribuan
        if(ribuan){
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
    }

    function LoadIdataItem(){
        var html ="<tr><td colspan='7' class='text-center'>Data Belum Di Input</td></tr>";
        $.ajax({
            type : "POST",
            url : "<?= base_url('spk/load_session'); ?>",
            success: function(r){
                var response = JSON.parse(r);
                console.log(response);
                if(response['jml'] > 0){
                    $("#CekItem").val(1);
                    html = "";
                    var No=1;
                    var tData=0;
                    for(var i =0; i < response['data'].length; i++){
                        var iData = response['data'][i];
                        var Total = parseFloat(iData['Volume']) * parseFloat(iData['HargaSatuan']);
                        tData = tData + Total;
                        html += "<tr>";
                        html += "<td class='text-center'>"+No+"</td>";
                        html += "<td>"+iData['NamaKegiatan']+"</td>";
                        html += "<td>"+formatAngka(iData['Volume'],0)+"</td>";
                        html += "<td>"+iData['SatuanUkuran']+"</td>";
                        html += "<td>"+formatRupiah(iData['HargaSatuan'],0)+"</td>";
                        html += "<td>"+formatRupiah(Total,0)+"</td>";
                        html += "<td><a class='btn btn-danger btn-xs' onclick=\"DeleteItem('"+iData['Id']+"')\" href='javascript:void(0)'><i class='fa fa-trash'></i></a></td>";
                        html += "</tr>";
                        No++
                    }
                    html += "<tr>";
                    html += "<th class='text-center' colspan='5'>Total</th>";
                    html += "<th>"+formatRupiah(tData,0)+"</th>";
                    html += "<td></td>";
                    html += "</tr>";
                    $("#Pembulatan").val(formatAngka(tData,0));
                    $("#iData").html(html);
                }else{
                    $("#Pembulatan").val(0);
                    $("#CekItem").val(0);
                    $("#iData").html(html);
                }
            },
            error : function(er){
                console.log(er);
            }
        })


    }

    function DeleteItem(Id){
        $.ajax({
            type : "POST",
            url : "<?= base_url('spk/hapus_session'); ?>",
            data : "Id="+Id,
            success: function(r){
                FormMessage('Modul Dokumen Surat Perjanjian Kerja (SPK)', "Berhasil Menghapus Data");
                Bersih();
                LoadIdataItem();
            },
            error : function(er){
                console.log(er);
            }
        })

    }

    function ValidasiTambah(){
        var iData = ["#NamaKegiatan","#Volume","#SatuanUkuran","#HargaSatuan"];
        var iKet = ["Nama Kegiatan belum lengkap!","Volume belum lengkap!","Satuan Ukuran  belum lengkap!","Harga Satuan belum lengkap!"];
        for(var i =0; i < iData.length; i++){
            if($(iData[i]).val() === ""){
                PesanWarning('Pengisian Data', iKet[i]);
                $(iData[i]).focus();
                return false;
            }
        }
    }

    $("#BtnTambah").click(function(e){
        if(ValidasiTambah() != false){
            DaftarSessionItem();
        }
    })

    function DaftarSessionItem(){
        var iData = $("#FormDataTambah").serialize();
        $.ajax({
            type : "POST",
            url : "<?= base_url('spk/daftar_session'); ?>",
            data : iData,
            success: function(r){
                var response = JSON.parse(r);
                console.log(r);
                if(response['status'] === false){
                    FormMessage("Modul Dokumen Surat Perjanjian Kerja (SPK)",response['message'],'error');
                }else{
                    FormMessage('Modul Dokumen Surat Perjanjian Kerja (SPK)', response['message']);
                    Bersih();
                    LoadIdataItem();
                }
            },
            error : function(er){
                console.log(er);
            }
        })
    }

    function Bersih(){
        $("#NamaKegiatan").val("");
        $("#Volume").val("");
        $("#HargaSatuan").val("");
        $("#SatuanUkuran").val("");
    }

    function Validasi(){
        var iData = ["#NoSpk","#Tgl","#NoSuratUndangan","#TglSuratUndangan","#NoBaPl","#TglBaPl","#TglDari","#TglSampai","#KodePejabat"];
        var iKet = ["Nomor SPK belum lengkap!","Tanggal SPK belum lengkap!","No Surat Undangan belum lengkap!","Tanggal Surat Undangan belum lengkap!","No Berita Acara Hasil Pengadaan Langsung belum lengkap","Tanggal Berita Acara Hasil Pengadaan Langsung belum lengkap","Waktu Kerja Dari belum lengkap!","Waktu Kerja Sampai belum lengkap!","Pejabat yang bertandatangan belum dipilih"];
        for(var i =0; i < iData.length; i++){
            if($(iData[i]).val() === ""){
                PesanWarning('Pengisian Data', iKet[i]);
                $(iData[i]).focus();
                return false;
            }
        }
        var Uraian = parseInt($("#CekItem").val());
        if(Uraian == 0){
            PesanWarning('Pengisian Data', "Uraian SPK masih Kososngs");
            $("#NamaKegiatan").focus();
            return false;
        }
    }

    function SubmitTambah(){
        if(Validasi() != false){
            var iData = $("#FormDataTambah").serialize();
            $.ajax({
                type : "POST",
                url : "<?= base_url('spk/simpan'); ?>",
                data : iData,
                success: function(r){
                    var response = JSON.parse(r);
                    console.log(response);
                    if(response['status'] === false){
                        FormMessage("Modul Dokumen Surat Perjanjian Kerja (SPK)",response['message'],'error');
                    }else{
                        FormMessage('Modul Dokumen Surat Perjanjian Kerja (SPK)', response['message']);
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

    function SubmitUpdate(){
        if(Validasi() != false){
            var iData = $("#FormDataUpdate").serialize();
            $.ajax({
                type : "POST",
                url : "<?= base_url('spk/update'); ?>",
                data : iData,
                success: function(r){
                    var response = JSON.parse(r);
                    console.log(response);
                    if(response['status'] === false){
                        FormMessage("Modul Dokumen Surat Perjanjian Kerja (SPK)",response['message'],'error');
                    }else{
                        FormMessage('Modul Dokumen Surat Perjanjian Kerja (SPK)', response['message']);
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
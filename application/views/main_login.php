<script>
    PesanSukses('Selamat datang','silahkan masukkan username dan password anda');
    $("#FormLogin").submit(function(e){
        var iData = $(this).serialize();
        e.preventDefault();
        $.ajax({
            type : "POST",
            url : "<?= base_url('auth/proses'); ?>",
            data : iData,
            success: function(r){
                var response = JSON.parse(r);
                console.log(response);
                if(response['status'] === false){
                    PesanError('Authentication failed', response['message']);
                }else{
                    PesanSukses('Authentication success', response['message']);
                    setTimeout(function() {
                        window.location = "<?= base_url(); ?>"
                    },1300);
              }
            },
            error : function(er){
                console.log(er);
            }
        })
    })
</script>
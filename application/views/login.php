<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>PPK - SORONG | Login</title>

    <link href="<?= base_url('public/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('public/font-awesome/css/font-awesome.css') ?>" rel="stylesheet">

    <link href="<?= base_url('public/css/animate.css') ?>" rel="stylesheet">
    <link href="<?= base_url('public/css/plugins/toastr/toastr.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('public/css/style.css') ?>" rel="stylesheet">

</head>

<body class="gray-bg">

    <div class="middle-box text-center loginscreen animated fadeInDown">
        <div>
            <div>
                <center><img width='200px' src='<?= base_url('public/img/sorong.png') ?>'></center>
            </div>
            <h3>Welcome to PPK SORONG</h3>
            <p>Pejabat Pembuat Komitmen (PPK) SORONG
                <!--Continually expanded and constantly improved Inspinia Admin Them (IN+)-->
            </p>
            <p>Login in. To see it in action.</p>
            <form class="m-t"  role="form" id='FormLogin'>
                <div class="form-group">
                    <input type="username" name='Username' class="form-control" placeholder="Username" required="">
                </div>
                <div class="form-group">
                    <input type="password" name='Password' class="form-control" placeholder="Password" required="">
                </div>
                <button type="submit" class="btn btn-primary block full-width m-b">Login</button>                
            </form>
            
        </div>
    </div>

    <!-- Mainly scripts -->
    <script src="<?= base_url('public/js/jquery-3.1.1.min.js') ?>"></script>
    <script src="<?= base_url('public/js/popper.min.js') ?>"></script>
    <script src="<?= base_url('public/js/bootstrap.js') ?>"></script>
    <script src="<?= base_url('public/js/plugins/toastr/toastr.min.js') ?>"></script>
    <script src="<?= base_url('public/js/main.js') ?>"></script>
    <?php $this->load->view('main_login'); ?>
    

</body>

</html>


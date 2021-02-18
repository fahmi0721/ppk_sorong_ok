<nav class="navbar-default navbar-static-side" role="navigation">
<div class="sidebar-collapse">
    <ul class="nav metismenu" id="side-menu">
        <li class="nav-header">
            <div class="dropdown profile-element">
                <img alt="image" class="rounded-circle" src="<?= base_url('public/img/profile_small.jpg') ?>"/>
                <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                    <span class="block m-t-xs font-bold"><?= strtoupper($this->session->userdata('Nama')); ?></span>
                    <span class="text-muted text-xs block"><?= strtoupper($this->session->userdata('Jabatan')); ?><b class="caret"></b></span>
                </a>
                <ul class="dropdown-menu animated fadeInRight m-t-xs">
                    <li><a class="dropdown-item" href="<?= base_url('auth/logout') ?>">Logout</a></li>
                </ul>
            </div>
            <div class="logo-element">
                PPK+
            </div>
        </li>
        <li <?php if(empty($this->uri->segment(1))){ echo "class='active'"; } ?>>
            <a href="<?= base_url(); ?>"><i class="fa fa-dashboard"></i> <span class="nav-label">Dashboard</span> </a>
        </li>
        <li <?php $arr = array("users","pejabat","anggaran","vendors","panitia"); if(in_array($this->uri->segment(1), $arr)){ echo "class='active'"; } ?>>
            <a href="index.html"><i class="fa fa-building"></i> <span class="nav-label">Master Data</span><span class="fa arrow"></span></a>
            <ul class="nav nav-second-level">
                <li <?php if($this->uri->segment(1) === "users"){ echo "class='active'"; } ?>><a href="<?= base_url('users/') ?>">Data User</a></li>
                <li <?php if($this->uri->segment(1) === "pejabat"){ echo "class='active'"; } ?>><a href="<?= base_url('pejabat/') ?>">Data Pejabat</a></li>
                <li <?php if($this->uri->segment(1) === "anggaran"){ echo "class='active'"; } ?>><a href="<?= base_url('anggaran/') ?>">Data Anggaran</a></li>
                <li <?php if($this->uri->segment(1) === "vendors"){ echo "class='active'"; } ?>><a href="<?= base_url('vendors/') ?>">Data Vendor </a></li>
                <li <?php if($this->uri->segment(1) === "panitia"){ echo "class='active'"; } ?>><a href="<?= base_url('panitia/') ?>">Panitia Pemeriksa </a></li>
            </ul>
        </li>
        <!-- <li>
            <a href="minor.html"><i class="fa fa-th-large"></i> <span class="nav-label">Minor view</span> </a>
        </li> -->
    </ul>

</div>
</nav>

<div id="page-wrapper" class="gray-bg">
<div class="row border-bottom">
    <nav class="navbar navbar-static-top white-bg" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
        </div>
        <ul class="nav navbar-top-links navbar-right">
            <li>
                <a href="<?= base_url('auth/logout') ?>">
                    <i class="fa fa-sign-out"></i> Log out
                </a>
            </li>
        </ul>

    </nav>
</div>
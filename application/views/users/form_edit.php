<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-4">
        <h2>Data Users</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="<?= base_url(); ?>">Dashboard</a>
            </li>
            <li class="breadcrumb-item">
                <a href="<?= base_url('users'); ?>">Users</a>
            </li>
            <li class="breadcrumb-item active">
                <strong>Edit Users</strong>
            </li>
        </ol>
    </div>
    <div class="col-sm-8">
        <div class="title-action">
            <div class="btn-group">
                <a href="<?= base_url('users') ?>" class="btn btn-sm btn-danger"><i class='fa fa-mail-reply'></i> Kembali</a>
            </div>
            
        </div>
    </div>
</div>

<div class="row wrapper wrapper-content animated fadeInRight">
    <div class="col-lg-12">
        <div class="ibox">
            <div class="ibox-title">
                <h5>Edit Users </h5>
                <div class="ibox-tools">
                    <a class="collapse-link">
                        <i class="fa fa-chevron-up"></i>
                    </a>
                </div>
            </div>
            <div class="ibox-content">
                <div class="row">
                    <div class="col-sm-8 b-r">
                        <form role="form" id='FormDataUpdate'>
                            <input type='hidden' value='<?= $Id ?>' name='Id'>
                            <div class="form-group">
                                <label>Nama</label> 
                                <input type="text" value='<?= $Nama ?>' placeholder="Enter Nama" autocomplete=off class="form-control" name='Nama' id='Nama'>
                            </div>
                            <div class="form-group">
                                <label>Jabatan</label> 
                                <input type="text" value='<?= $Jabatan ?>' placeholder="Enter Jabatan" autocomplete=off name='Jabatan' id='Jabatan' class="form-control">
                            </div>

                            <div class="form-group">
                                <label>Level</label> 
                                <div class="radio radio-info">
                                    <input type="radio" id="Leveluser" value="user" name="Level" <?php if($Level == "user"){ echo "checked"; } ?>>
                                    <label for="inlineRadio1"> User </label>
                                </div>
                                <div class="radio radio-info">
                                    <input type="radio" id="Levelpimpinan" value="pimpinan" name="Level" <?php if($Level == "pimpinan"){ echo "checked"; } ?>
                                    <label for="inlineRadio1"> Pimpinan </label>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Username</label> 
                                <input type="text" value='<?= $Username ?>' placeholder="Enter Username" autocomplete=off name='Username' id='Username' class="form-control">
                            </div>

                            <div class="form-group">
                                <label>Password</label> 
                                <input type="text" placeholder="Enter Password" autocomplete=off name='Password' id='Password' class="form-control">
                            </div>
                            <div>
                                <button class="btn btn-sm btn-primary float-right m-t-n-xs" type="submit"><i class='fa fa-check-square'></i> Submit</button>
                            </div>
                        </form>
                    </div>
                    <div class="col-sm-4">
                        
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<?php $this->load->view('users/main_js') ?>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-4">
        <h2>Data Pejabat</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="<?= base_url(); ?>">Dashboard</a>
            </li>
            <li class="breadcrumb-item">
                <a href="<?= base_url('pejabat'); ?>">Pejabat</a>
            </li>
            <li class="breadcrumb-item active">
                <strong>Edit Pejabat</strong>
            </li>
        </ol>
    </div>
    <div class="col-sm-8">
        <div class="title-action">
            <div class="btn-group">
                <a href="<?= base_url('pejabat') ?>" class="btn btn-sm btn-danger"><i class='fa fa-mail-reply'></i> Kembali</a>
            </div>
            
        </div>
    </div>
</div>

<div class="row wrapper wrapper-content animated fadeInRight">
    <div class="col-lg-12">
        <div class="ibox">
            <div class="ibox-title">
                <h5>Edit Pejabat </h5>
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
                                <label>NIP</label> 
                                <input type="text" value='<?= $Nip ?>' placeholder="Enter NIP" autocomplete=off class="form-control" name='Nip' id='Nip'>
                            </div>
                            <div class="form-group">
                                <label>Nama</label> 
                                <input type="text" value='<?= $Nama ?>' placeholder="Enter Nama" autocomplete=off class="form-control" name='Nama' id='Nama'>
                            </div>
                            <div class="form-group">
                                <label>Jabatan</label> 
                                <input type="text" value='<?= $Jabatan ?>' placeholder="Enter Jabatan" autocomplete=off name='Jabatan' id='Jabatan' class="form-control">
                            </div>

                            <div class="form-group">
                                <label>Deskripsi Jabatan</label> 
                                <textarea type="text" rows='5' placeholder="Enter Deskripsi Jabatan" autocomplete=off name='DeskripsiJabatan' id='DeskripsiJabatan' class="form-control"><?= $DeskripsiJabatan ?></textarea>
                            </div>

                            <div class="form-group">
                                <label>Alamat</label> 
                                <textarea type="text" rows='5' placeholder="Enter Alamat" autocomplete=off name='Alamat' id='Alamat' class="form-control"><?= $Alamat ?></textarea>
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

<?php $this->load->view('pejabat/main_js') ?>
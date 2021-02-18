<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-4">
        <h2>Data Anggaran</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="<?= base_url(); ?>">Dashboard</a>
            </li>
            <li class="breadcrumb-item">
                <a href="<?= base_url('anggaran'); ?>">Anggaran</a>
            </li>
            <li class="breadcrumb-item active">
                <strong>Edit Anggaran</strong>
            </li>
        </ol>
    </div>
    <div class="col-sm-8">
        <div class="title-action">
            <div class="btn-group">
                <a href="<?= base_url('anggaran') ?>" class="btn btn-sm btn-danger"><i class='fa fa-mail-reply'></i> Kembali</a>
            </div>
            
        </div>
    </div>
</div>

<div class="row wrapper wrapper-content animated fadeInRight">
    <div class="col-lg-12">
        <div class="ibox">
            <div class="ibox-title">
                <h5>Edit Anggaran </h5>
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
                                <label>Nomor</label> 
                                <input type="text" value='<?= $Nomor ?>' placeholder="Enter Nomor" autocomplete=off name='Nomor' id='Nomor' class="form-control">
                            </div>

                            <div class="form-group" id='data_2'>
                                <label>Tahun</label> 
                                <div class="input-group date">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" value='<?= $Tahun ?>' placeholder="Enter Tahun" autocomplete=off name='Tahun' id='Tahun' class="form-control">
                                </div>
                            </div>

                            <div class="form-group" id='data_1'>
                                <label>Tanggal</label> 
                                <div class="input-group date">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" value='<?= $Tanggal ?>' placeholder="Enter Tanggal" autocomplete=off name='Tanggal' id='Tanggal' class="form-control">
                                </div>
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

<?php $this->load->view('anggaran/main_js') ?>
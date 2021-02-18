
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-4">
        <h2>Data Vendor</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="<?= base_url(); ?>">Dashboard</a>
            </li>
            <li class="breadcrumb-item">
                <a href="<?= base_url('vendors'); ?>">Vendor</a>
            </li>
            <li class="breadcrumb-item active">
                <strong>Tambah Vendor</strong>
            </li>
        </ol>
    </div>
    <div class="col-sm-8">
        <div class="title-action">
            <div class="btn-group">
                <a href="<?= base_url('vendors') ?>" class="btn btn-sm btn-danger"><i class='fa fa-mail-reply'></i> Kembali</a>
            </div>
            
        </div>
    </div>
</div>

<div class="row wrapper wrapper-content animated fadeInRight">
    <div class="col-lg-12">
        <div class="ibox">
            <div class="ibox-title">
                <h5>Tambah Vendor</h5>
                <div class="ibox-tools">
                    <a class="collapse-link">
                        <i class="fa fa-chevron-up"></i>
                    </a>
                </div>
            </div>
            <div class="ibox-content">
                <div class="row">
                    <div class="col-sm-8 b-r">
                        <form role="form" id='FormDataTambah'>
                            <div class="form-group">
                                <label>Nama Vendor</label> 
                                <input type="text" placeholder="Enter Nama Vendor" autocomplete=off class="form-control" name='Nama' id='Nama'>
                            </div>
                            <div class="form-group">
                                <label>Nama Pimpinan</label> 
                                <input type="text" placeholder="Enter Nama Pimpinan" autocomplete=off name='NamaPimpinan' id='NamaPimpinan' class="form-control">
                            </div>

                            <div class="form-group">
                                <label>Jabatan</label> 
                                <input type="text" placeholder="Enter Jabatan" autocomplete=off name='Jabatan' id='Jabatan' class="form-control">
                            </div>

                            <div class="form-group">
                                <label>No Telpon/HP</label> 
                                <input type="text" onkeyup='angka(this)' placeholder="Enter No Telpon/Hp" autocomplete=off name='NoTelp' id='NoTelp' class="form-control">
                            </div>

                            <div class="form-group">
                                <label>Nama Bank</label> 
                                <input type="text" placeholder="Enter Nama Bank" autocomplete=off name='Bank' id='Bank' class="form-control">
                            </div>

                            <div class="form-group">
                                <label>No Rekening</label> 
                                <input type="text" onkeyup='angka(this)' placeholder="Enter No Rekening" autocomplete=off name='NoRek' id='NoRek' class="form-control">
                            </div>

                            <div class="form-group">
                                <label>A.n Nama Bank</label> 
                                <input type="text" placeholder="Enter A.n Nama Bank" autocomplete=off name='AnBank' id='AnBank' class="form-control">
                            </div>

                            <div class="form-group">
                                <label>Alamat</label> 
                                <textarea type="text" placeholder="Enter Alamat" rows='5' autocomplete=off name='Alamat' id='Alamat' class="form-control"></textarea>
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

<?php $this->load->view('vendor/main_js') ?>
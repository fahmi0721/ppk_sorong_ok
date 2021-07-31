
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-8">
        <h2>Pengadaan Langsung / Tambah Lampiran Fakta Integritas</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="<?= base_url(); ?>">Dashboard</a>
            </li>
            <li class="breadcrumb-item">
                <a href="<?= base_url('pl_penawaran'); ?>">Surat Lampiran Fakta Integritas</a>
            </li>
            <li class="breadcrumb-item active">
                <strong>Tambah Lampiran Fakta Integritas</strong>
            </li>
        </ol>
    </div>
    <div class="col-sm-4">
        <div class="title-action">
            <div class="btn-group">
                <a href="<?= base_url('pl_penawaran') ?>" class="btn btn-sm btn-danger"><i class='fa fa-mail-reply'></i> Kembali</a>
            </div>
            
        </div>
    </div>
</div>

<div class="row wrapper wrapper-content animated fadeInRight">
    <div class="col-lg-12">
        <div class="ibox">
            <div class="ibox-title">
                <h5>Pengadaan Langsung / Tambah Lampiran Fakta Integritas </h5>
                <div class="ibox-tools">
                    <a class="collapse-link">
                        <i class="fa fa-chevron-up"></i>
                    </a>
                </div>
            </div>
            <div class="ibox-content">
                <div class="row">
                    <div class="col-sm-8 b-r">
                        <form role="form" id='FormData'>
                            <input type="hidden" name='Id' value='<?= $data['Id'] ?>'>
                            <div class="form-group">
                                <label>Nama</label> 
                                <input type="text"  placeholder="Enter Nama" autocomplete=off class="form-control" name='Nama' id='Nama' value="<?= $data['Nama'] ?>">
                            </div>

                            <div class="form-group">
                                <label>No Identitas</label> 
                                <input type="text"  placeholder="Enter No Identitas" autocomplete=off class="form-control" name='NoId' id='NoId' value="<?= $data['NoId'] ?>">
                            </div>

                            <div class="form-group">
                                <label>Jabatan</label> 
                                <input type="text"  placeholder="Jabatan" autocomplete=off class="form-control" name='Jabatan' id='Jabatan' value="<?= $data['Jabatan'] ?>">       
                            </div>

                            <div class="form-group">
                                <label>Bertindak untuk dan Atas Nama</label> 
                                <input type="text"  placeholder="Bertindak untuk dan Atas Nama" autocomplete=off class="form-control" name='an' id='an' value="<?= $data['an'] ?>">       
                            </div>

                            <div class="form-group">
                                <label>Perihal</label> 
                                <textarea type="text" rows="4" placeholder="Perihal" autocomplete=off class="form-control" name='Perihal'  id='Perihal'><?= $data['Perihal'] ?></textarea>                        
                            </div>

                            <div class="form-group" id='data_1'>
                                <label>Tanggal</label> 
                                <div class="input-group date">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" placeholder="Enter Tanggal Surat" autocomplete=off name='TglSurat' id='TglSurat' value="<?= $data['TglSurat'] ?>" class="form-control">
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

<?php 
$this->load->view('pl_penawaran/form_fakta_js') ?>
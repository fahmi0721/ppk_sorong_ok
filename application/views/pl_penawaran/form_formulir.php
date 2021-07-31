
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-8">
        <h2>Pengadaan Langsung / FORMULIR ISIAN KUALIFIKASI</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="<?= base_url(); ?>">Dashboard</a>
            </li>
            <li class="breadcrumb-item">
                <a href="<?= base_url('pl_penawaran'); ?>">Surat Lampiran FORMULIR ISIAN KUALIFIKASI </a>
            </li>
            <li class="breadcrumb-item active">
                <strong>Tambah Lampiran FORMULIR ISIAN KUALIFIKASI </strong>
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
                <h5>Pengadaan Langsung / FORMULIR ISIAN KUALIFIKASI  </h5>
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
                                <label>Alamat</label> 
                                <input type="text"  placeholder="Alamat" autocomplete=off class="form-control" name='Alamat' id='Alamat' value="<?= $data['Alamat'] ?>">       
                            </div>

                            <div class="form-group">
                                <label>Telepon/Fax</label> 
                                <input type="text"  placeholder="Telepon/Fax" autocomplete=off class="form-control" name='NoTelp' id='NoTelp' value="<?= $data['NoTelp'] ?>">       
                            </div>

                            <div class="form-group">
                                <label>Email</label> 
                                <input type="text"  placeholder="Email" autocomplete=off class="form-control" name='Email' id='Email' value="<?= $data['Email'] ?>">       
                            </div>

                            <div class="form-group">
                                <label>Pernyataan</label> 
                                <textarea type="text" rows="4" placeholder="Pernyataan" autocomplete=off class="form-control" name='Pernyataan' id='Perihal'><?= $data['Pernyataan'] ?></textarea>                        
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
$this->load->view('pl_penawaran/form_formulir_js') ?>
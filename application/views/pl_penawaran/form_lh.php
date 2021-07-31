
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-8">
        <h2>Pengadaan Langsung / Landasan Hukum Pendirian Perusahaan </h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="<?= base_url(); ?>">Dashboard</a>
            </li>
            <li class="breadcrumb-item">
                <a href="<?= base_url('pl_penawaran'); ?>">Surat Lampiran Landasan Hukum Pendirian Perusahaan  </a>
            </li>
            <li class="breadcrumb-item active">
                <strong>Tambah Lampiran Landasan Hukum Pendirian Perusahaan  </strong>
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
                <h5>Pengadaan Langsung / Landasan Hukum Pendirian Perusahaan </h5>
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
                            <h5>Akta Pendirian Perusahaan/Anggaran Dasar </h5>
                            <div class="form-group">
                                <label>Nomor</label> 
                                <input type="text"  placeholder="Enter Nomor" autocomplete=off class="form-control" name='Nomor' id='Nomor' value="<?= $data['Nomor'] ?>">
                            </div>

                            <div class="form-group" id='data_1'>
                                <label>Tanggal</label> 
                                <div class="input-group date">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" placeholder="Enter Tanggal" autocomplete=off name='Tanggal' id='Tanggal' value="<?= $data['Tanggal'] ?>" class="form-control">
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Nama Notaris</label> 
                                <input type="text"  placeholder="Nama Notaris" autocomplete=off class="form-control" name='Nama' id='Nama' value="<?= $data['Nama'] ?>">       
                            </div>

                            <div class="form-group">
                                <label>Nomor Pengesahan</label> 
                                <input type="text"  placeholder="Nomor Pengesahan Kementerian Hukum dan HAM. (untuk yang berbentuk PT)" autocomplete=off class="form-control" name='NoPengesahaan' id='NoPengesahaan' value="<?= $data['NoPengesahaan'] ?>">       
                            </div>
                            <hr>
                            <h5>Perubahan Terakhir Akta Pendirian Perusahaan /Anggaran Dasar Koperasi</h5>
                            <div class="form-group">
                                <label>Nomor</label> 
                                <input type="text"  placeholder="Enter Nomor" autocomplete=off class="form-control" name='NomorPerubahan' id='NomorPerubahan' value="<?= $data['NomorPerubahan'] ?>">
                            </div>

                            <div class="form-group" id='data_1'>
                                <label>Tanggal</label> 
                                <div class="input-group date">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" placeholder="Enter Tanggal" autocomplete=off name='TanggalPerubahan' id='TanggalPerubahan' value="<?= $data['TanggalPerubahan'] ?>" class="form-control">
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Nama Notaris</label> 
                                <input type="text"  placeholder="Nama Notaris" autocomplete=off class="form-control" name='NamaPerubahan' id='NamaPerubahan' value="<?= $data['NamaPerubahan'] ?>">       
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
$this->load->view('pl_penawaran/form_lh_js') ?>
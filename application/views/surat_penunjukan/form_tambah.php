
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-8">
        <h2>Pengadaan Langsung / Tambah Surat Penunjukan</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="<?= base_url(); ?>">Dashboard</a>
            </li>
            <li class="breadcrumb-item">
                <a href="<?= base_url('surat_penunjukan'); ?>">Surat Penunjukan</a>
            </li>
            <li class="breadcrumb-item active">
                <strong>Tambah Surat Penunjukan</strong>
            </li>
        </ol>
    </div>
    <div class="col-sm-4">
        <div class="title-action">
            <div class="btn-group">
                <a href="<?= base_url('surat_penujukan') ?>" class="btn btn-sm btn-danger"><i class='fa fa-mail-reply'></i> Kembali</a>
            </div>
            
        </div>
    </div>
</div>

<div class="row wrapper wrapper-content animated fadeInRight">
    <div class="col-lg-12">
        <div class="ibox">
            <div class="ibox-title">
                <h5>Pengadaan Langsung / Tambah Surat Penunjukan </h5>
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
                            <div class="form-group">
                                <label>Nomor Surat</label> 
                                <input type="text"  placeholder="Enter Nomor Surat" autocomplete=off class="form-control" name='NoSurat' id='NoSurat'>
                            </div>

                            <div class="form-group" id='data_1'>
                                <label>Tanggal</label> 
                                <div class="input-group date">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" placeholder="Enter Tanggal Surat" autocomplete=off name='TglSurat' id='TglSurat' class="form-control">
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Lampiran</label> 
                                <input type="text"  placeholder="Lampiran" autocomplete=off class="form-control" name='Lampiran' id='Lampiran'>       
                            </div>

                            <div class="form-group">
                                <label>Perihal</label> 
                                <input type="text"  placeholder="Perihal" autocomplete=off class="form-control" name='Perihal' id='Perihal'>                              
                            </div>

                            
                            <div class="form-group">
                                <label>Kepada</label> 
                                <input type="text"  placeholder="Kepada" autocomplete=off class="form-control" name='Kepada' id='Kepada'>
                            </div>

                            <div class="form-group">
                                <label>DIPA</label> 
                                <textarea type="text" rows="5" placeholder="DIPA" autocomplete=off class="form-control" name='Dipa' id='Dipa'></textarea>
                            </div>

                            <div class="form-group">
                                <label>Pekerjaan</label> 
                                <textarea type="text" rows="5" placeholder="Pekerjaan" autocomplete=off class="form-control" name='Pekerjaan' id='Pekerjaan'></textarea>
                            </div>

                            <div class="form-group">
                                <label>Pelaksanaan</label> 
                                <input type="text"  placeholder="Pelaksanaan" autocomplete=off class="form-control" name='Pelaksanaan' id='Pelaksanaan'>
                            </div>
                            <hr>
                            <div class="form-group">
                                <label>Nama Pejabat TTD</label> 
                                <input type="text"  placeholder="Nama Pejabat TTD" autocomplete=off class="form-control" name='Pejabat[]' id='NamaPejabat'>
                            </div>
                            <div class="form-group">
                                <label>Jabatan Pejabat TTD</label> 
                                <input type="text"  placeholder="Jabatan Pejabat TTD" autocomplete=off class="form-control" name='Pejabat[]' id='JabatanPejabat'>
                            </div>
                            <div class="form-group">
                                <label>NIP Pejabat TTD</label> 
                                <input type="text"  placeholder="NIP Pejabat TTD" autocomplete=off class="form-control" name='Pejabat[]' id='NipPejabat'>
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
$this->load->view('surat_penunjukan/form_tambah_js') ?>
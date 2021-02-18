<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-8">
        <h2>Data SK Panitia Pemeriksa</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="<?= base_url(); ?>">Dashboard</a>
            </li>
            <li class="breadcrumb-item">
                <a href="<?= base_url('panitia'); ?>">SK Panitia Pemeriksa</a>
            </li>
            <li class="breadcrumb-item active">
                <strong>Edit SK Panitia Pemeriksa</strong>
            </li>
        </ol>
    </div>
    <div class="col-sm-4">
        <div class="title-action">
            <div class="btn-group">
                <a href="<?= base_url('panitia') ?>" class="btn btn-sm btn-danger"><i class='fa fa-mail-reply'></i> Kembali</a>
            </div>
            
        </div>
    </div>
</div>

<div class="row wrapper wrapper-content animated fadeInRight">
    <div class="col-lg-12">
        <div class="ibox">
            <div class="ibox-title">
                <h5>Edit SK Panitia Pemeriksa </h5>
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
                                <label>Judul SK</label> 
                                <input type="text" value='<?= $Nama; ?>' placeholder="Enter Judul SK" autocomplete=off class="form-control" name='Nama' id='Nama'>
                            </div>
                            <div class="form-group">
                                <label>Nomor SK</label> 
                                <input type="text" value='<?= $NoSk; ?>' placeholder="Enter Nomor SK" autocomplete=off name='NoSk' id='NoSk' class="form-control">
                            </div>

                            <div class="form-group">
                                <label>Perihal</label> 
                                <input type="text" value='<?= $Perihal; ?>' placeholder="Enter Perihal" autocomplete=off name='Perihal' id='Perihal' class="form-control">
                            </div>

                           <div class="form-group" id='data_2'>
                                <label>Tahun</label> 
                                <div class="input-group date">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" placeholder="Enter Tahun" value='<?= $Tahun; ?>' autocomplete=off name='Tahun' id='Tahun' class="form-control">
                                </div>
                            </div>

                            <div class="form-group" id='data_1'>
                                <label>Tanggal</label> 
                                <div class="input-group date">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" placeholder="Enter Tanggal" value='<?= $Tanggal; ?>' autocomplete=off name='Tanggal' id='Tanggal' class="form-control">
                                </div>
                            </div>
                            <hr>
                            <h5>Data Pemeriksa </h5>
                            <hr>
                            <div class="form-group">
                                <label>Nama</label> 
                                <input type="text" placeholder="Enter Nama" autocomplete=off class="form-control" name='NamaPemeriksa'  id='NamaPemeriksa'>
                            </div>
                            <div class="form-group">
                                <label>NIP</label> 
                                <input type="text" placeholder="Enter NIP" autocomplete=off name='Nip' id='Nip' class="form-control">
                            </div>
                            <div>
                                <button type='button' id='TambahPeserta' class="btn btn-sm btn-info float-right m-t-n-xs" ><i class='fa fa-check-square'></i> Tambah</button>
                            </div>
                            <span class='clearfix'></span>
                            <hr>
                            <h5>List Data Pemeriksa</h5>
                            <hr>
                            <div class="form-group table-responsive">
                                <input type="hidden"  id='TotPanitia' >
                                <table class='table table-striped table-bordered'>
                                    <thead>
                                        <tr>
                                            <th class='text-center' width='5px'>No</th>
                                            <th>Nama Pemeriksa</th>
                                            <th class='text-center' width='5px'>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody id='dtHt'></tbody>
                                </table>
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

<?php $this->load->view('panitia/main_js') ?>
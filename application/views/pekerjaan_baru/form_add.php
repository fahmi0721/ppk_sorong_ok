
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-8">
        <h2>Tambah Pekrjaan Baru / Harga Perkiraan Sendiri</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="<?= base_url(); ?>">Dashboard</a>
            </li>
            <li class="breadcrumb-item">
                <a href="<?= base_url('data_pekerjaan'); ?>">Pekrjaan Baru / Harga Perkiraan Sendiri</a>
            </li>
            <li class="breadcrumb-item active">
                <strong>Tambah Pekrjaan Baru / Harga Perkiraan Sendiri</strong>
            </li>
        </ol>
    </div>
    <div class="col-sm-4">
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
                <h5>Pekrjaan Baru / Harga Perkiraan Sendiri </h5>
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
                                <label>Nomor Surat HPS</label> 
                                <input type="text" placeholder="Enter Nomor Surat HPS" autocomplete=off class="form-control" name='NoSurat' id='NoSurat'>
                            </div>
                            <div class="form-group">
                                <label>Nama Pekerjaan</label> 
                                <textarea rows='2' placeholder="Enter Nama Pekerjaan" autocomplete=off name='Pekerjaan' id='Pekerjaan' class="form-control"></textarea>
                               
                            </div>

                            <div class="form-group">
                                <label>Anggaran yang dipakai</label> 
                                <select class="select2_demo_3 form-control" name='KodeAnggaran' id='KodeAnggaran'>
                                <option value=""></option>
                                    <?php 
                                    if(!empty($anggaran)){
                                    foreach($anggaran as $item): 
                                    ?>
                                        <option value="<?= $item['Kode'] ?>"><?= $item['Nomor']; ?> [<?= $item['Nama'] ?>]</option>
                                    <?php endforeach;
                                    }else{
                                    ?>
                                        <option value="">Belum Ada Data Anggaran</option>
                                    <?php } ?>
                                </select>
                                <?php if(empty($anggaran)){ ?><small class='text  text-danger'>Angggaran Belum Ada</small> <?php } ?>
                            </div>

                            <div class="form-group" id='data_1'>
                                <label>Tanggal</label> 
                                <div class="input-group date">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" placeholder="Enter Tanggal" autocomplete=off name='Tgl' id='Tgl' class="form-control">
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Pejabat yang bertanda tangan</label> 
                                <select class="select2_demo_2 form-control" name='KodePejabat' id='KodePejabat'>
                                <option value=""></option>
                                    <?php 
                                    if(!empty($pejabat)){
                                    foreach($pejabat as $item): ?>
                                        <option value="<?= $item['Kode'] ?>"><?= $item['Nama']; ?> [<?= $item['Nip'] ?>]</option>
                                    <?php endforeach; 
                                    }else{
                                    ?>
                                        <option value="">Belum ada data pejabat</option>
                                    <?php } ?>
                                </select>
                                <?php if(empty($pejabat)){ ?><small class='text  text-danger'>Belum ada data pejabat</small> <?php } ?>
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

<?php $this->load->view('pekerjaan_baru/main_js') ?>

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-8">
        <h2>Ubah Pekrjaan  / Harga Perkiraan Sendiri</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="<?= base_url(); ?>">Dashboard</a>
            </li>
            <li class="breadcrumb-item">
                <a href="<?= base_url('data_pekerjaan'); ?>">Pekerjaan atau Harga Perkiraan Sendiri</a>
            </li>
            <li class="breadcrumb-item active">
                <strong>Ubah Pekerjaan atau Harga Perkiraan Sendiri</strong>
            </li>
        </ol>
    </div>
    <div class="col-sm-4">
        <div class="title-action">
            <div class="btn-group">
                <a href="<?= base_url('data_pekerjaan') ?>" class="btn btn-sm btn-danger"><i class='fa fa-mail-reply'></i> Kembali</a>
            </div>
            
        </div>
    </div>
</div>

<div class="row wrapper wrapper-content animated fadeInRight">
    <div class="col-lg-12">
        <div class="ibox">
            <div class="ibox-title">
                <h5>Pekrjaan / Harga Perkiraan Sendiri </h5>
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
                            <input type="hidden" name='Id'  value="<?= $item['Id'] ?>">
                            <div class="form-group">
                                <label>Nomor Surat HPS</label> 
                                <input type="text" value="<?= $item['NoSurat'] ?>" placeholder="Enter Nomor Surat HPS" autocomplete=off class="form-control" name='NoSurat' id='NoSurat'>
                            </div>
                            <div class="form-group">
                                <label>Nama Pekerjaan</label> 
                                <textarea rows='2' placeholder="Enter Nama Pekerjaan" autocomplete=off name='Pekerjaan' id='Pekerjaan' class="form-control"><?= $item['Pekerjaan'] ?></textarea>                              
                            </div>

                            <div class="form-group">
                                <label>Anggaran yang dipakai</label> 
                                <select class="select2_demo_3 form-control" name='KodeAnggaran' id='KodeAnggaran'>
                                <option value=""></option>
                                    <?php foreach($anggaran as $items): 
                                        $selc = $item['KodeAnggaran'] == $items['Kode'] ? "selected" : "";    
                                    ?>
                                        <option value="<?= $items['Kode'] ?>" <?= $selc ?>><?= $items['Nomor']; ?> [<?= $items['Nama'] ?>]</option>
                                    <?php endforeach ?>
                                </select>
                            </div>

                            <div class="form-group" id='data_1'>
                                <label>Tanggal</label> 
                                <div class="input-group date">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" value="<?= $item['Tgl'] ?>" placeholder="Enter Tanggal" autocomplete=off name='Tgl' id='Tgl' class="form-control">
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Pejabat yang bertanda tangan</label> 
                                <select class="select2_demo_2 form-control" name='KodePejabat' id='KodePejabat'>
                                <option value=""></option>
                                    <?php foreach($pejabat as $items): 
                                        $selc = $item['KodePejabat'] == $items['Kode'] ? "selected" : ""    
                                    ?>
                                        <option value="<?= $items['Kode'] ?>" <?= $selc ?>><?= $items['Nama']; ?> [<?= $items['Nip'] ?>]</option>
                                    <?php endforeach ?>
                                </select>
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
$data['hps'] = $item;
$this->load->view('data_pekerjaan/main_js',$data) ?>
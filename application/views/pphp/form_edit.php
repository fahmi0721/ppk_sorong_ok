
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-8">
        <h2>Data Dokumen Permintaan Pemeriksaan Hasil Pengadaan Barang/Jasa</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="<?= base_url(); ?>">Dashboard</a>
            </li>
            <li class="breadcrumb-item">
                <a href="<?= base_url('data_pekerjaan/progres/'.$hps['Id']); ?>">Data Pekerjaan</a>
            </li>
            <li class="breadcrumb-item active">
                <strong>Ubah Dokumen Permintaan Pemeriksaan Hasil Pengadaan Barang/Jasa</strong>
            </li>
        </ol>
    </div>
    <div class="col-sm-4">
        <div class="title-action">
            <div class="btn-group">
                <a href="<?= base_url('data_pekerjaan/progres/'.$hps['Id']); ?>" class="btn btn-sm btn-danger"><i class='fa fa-mail-reply'></i> Kembali</a>
            </div>
            
        </div>
    </div>
</div>

<div class="row wrapper wrapper-content animated fadeInRight">
    <div class="col-lg-12">
        <div class="ibox">
            <div class="ibox-title">
                <h5>Ubah Dokumen Permintaan Pemeriksaan Hasil Pengadaan Barang/Jasa </h5>
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
                            <input type="hidden" name="NoSuratHps" id="NoSuratHps" value='<?= $pphp['NoSuratHps'] ?>'>
                            <input type="hidden" name="NoSpk" id="NoSpk" value='<?= $pphp['NoSpk'] ?>'>
                            <input type="hidden" name="Id" id="Id" value='<?= $pphp['Id'] ?>'>
                            <div class="form-group">
                                <label>Nomor Surat (*)</label> 
                                <input type="text" placeholder="Enter Nomor Surat" value="<?= $pphp['NoSurat'] ?>" autocomplete=off name='NoSurat' id='NoSurat' class="form-control">
                            </div>

                            <div class="form-group data_1">
                                <label>Tanggal Surat (*)</label> 
                                <div class="input-group date">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" placeholder="Enter Tanggal Surat" autocomplete=off name='Tgl' id='Tgl' value="<?= $pphp['Tgl'] ?>" class="form-control">
                                </div>
                            </div>

                            <div class="form-group data_1">
                                <label>Tanggal Permintaan Pemeriksaan (*)</label> 
                                <div class="input-group date">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" placeholder="Enter Tanggal Permintaan Pemeriksaan" value="<?= $pphp['TglPermintaan'] ?>" autocomplete=off name='TglPermintaan' id='TglPermintaan' class="form-control">
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Pejabat yang bertanda tangan</label> 
                                <select class="select2_demo_2 form-control" name='KodePejabat' id='KodePejabat'>
                                <option value=""></option>
                                    <?php foreach($pejabat as $item): 
                                        $sel = $item['Kode'] === $pphp['KodePejabat'] ? "selected" : ""; 
                                    ?>
                                        <option value="<?= $item['Kode'] ?>" <?= $sel; ?>><?= $item['Nama']; ?> [<?= $item['Nip'] ?>]</option>
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
$data['hps'] = $hps;
$this->load->view('pphp/main_js',$data) ?>
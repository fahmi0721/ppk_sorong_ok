
<?php 
$CI =& get_instance();
$CI->load->library('MyLib');
?>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-8">
        <h2>Data Dokumen Penunjukan Penyedia / Vendor</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="<?= base_url(); ?>">Dashboard</a>
            </li>
            <li class="breadcrumb-item">
                <a href="<?= base_url('data_pekerjaan/progres/'.$hps['Id']); ?>">Data Pekerjaan</a>
            </li>
            <li class="breadcrumb-item active">
                <strong>Ubah Dokumen Penunjukan Penyedia / Vendor</strong>
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
                <h5>Ubah Dokumen Penyedia/Vendor </h5>
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
                            <input type="hidden" name="Id" id="Id" value='<?= $penunjukan_penyedia['Id'] ?>'>
                            <input type="hidden" name="NoSuratHps" id="NoSuratHps" value='<?= $penunjukan_penyedia['NoSuratHps'] ?>'>
                            <div class="form-group">
                                <label>Nomor Surat (*)</label> 
                                <input type="text" value="<?= $penunjukan_penyedia['NoSurat'] ?>" placeholder="Enter Nomor Surat" autocomplete=off name='Nomor' id='Nomor' class="form-control">
                            </div>

                            <div class="form-group data_1">
                                <label>Tanggal Surat Penunjukan (*)</label> 
                                <div class="input-group date">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input value="<?= $penunjukan_penyedia['Tgl'] ?>" type="text" placeholder="Enter Tanggal Surat Penunjukan" autocomplete=off name='Tgl' id='Tgl' class="form-control">
                                </div>
                            </div>

                            <div class="form-group data_1">
                                <label>Tanggal Penawaran Penyedia/Vendor (*)</label> 
                                <div class="input-group date">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" value="<?= $penunjukan_penyedia['TglPenawaran'] ?>" placeholder="Enter Tanggal Penawaran Penyedia/Vendor" autocomplete=off name='TglPenawaran' id='TglPenawaran' class="form-control">
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Harga yang disepakati (*)</label> 
                                <div class="input-group">
                                    <span class="input-group-addon">Rp. </span><input onkeyup="rupiah(this)" type="text" placeholder="Harga yang disepakati" value="<?= $CI->mylib->rupiah1($penunjukan_penyedia['HargaSepakat']) ?>" autocomplete=off name='HargaSepakat' id='HargaSepakat' class="form-control">
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Pejabat yang bertanda tangan</label> 
                                <select class="select2_demo_2 form-control" name='KodePejabat' id='KodePejabat'>
                                <option value=""></option>
                                    <?php foreach($pejabat as $item): 
                                        $selc = $item['Kode'] ==$penunjukan_penyedia['KodePejabat'] ? "selected" : ""    
                                    ?>
                                        <option value="<?= $item['Kode'] ?>" <?= $selc ?>><?= $item['Nama']; ?> [<?= $item['Nip'] ?>]</option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                            

                            <div class="form-group">
                                <label>Penyedia/Vendor yang ditunjuk</label> 
                                <select class="select2_demo_2 form-control" name='KodeVendor' id='KodeVendor'>
                                <option value=""></option>
                                    <?php foreach($vendor as $item): 
                                        $selc = $item['Kode'] ==$penunjukan_penyedia['KodeVendor'] ? "selected" : ""    
                                    ?>
                                        <option value="<?= $item['Kode'] ?>" <?= $selc ?>><?= $item['Nama']; ?></option>
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
$this->load->view('penunjukan_penyedia/main_js',$data) ?>
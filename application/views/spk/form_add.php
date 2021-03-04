
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-8">
        <h2>Data Dokumen Surat Perintah Kerja (SPK)</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="<?= base_url(); ?>">Dashboard</a>
            </li>
            <li class="breadcrumb-item">
                <a href="<?= base_url('data_pekerjaan/progres/'.$hps['Id']); ?>">Data Pekerjaan</a>
            </li>
            <li class="breadcrumb-item active">
                <strong>Tambah Dokumen Surat Perintah Kerja (SPK)</strong>
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
                <h5>Tambah Dokumen Surat Perintah Kerja (SPK) </h5>
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
                            <input type="hidden" name="NoSuratHps" id="NoSuratHps" value='<?= $hps['NoSurat'] ?>'>
                            <input type="hidden" name="NoSuratPP" id="NoSuratPP" value='<?= $pp['NoSurat'] ?>'>
                            <div class="form-group">
                                <label>Nomor SPK (*)</label> 
                                <input type="text" placeholder="Enter Nomor SPK" autocomplete=off name='NoSpk' id='NoSpk' class="form-control">
                            </div>

                            <div class="form-group data_1">
                                <label>Tanggal SPK (*)</label> 
                                <div class="input-group date">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" placeholder="Enter Tanggal SPK" autocomplete=off name='Tgl' id='Tgl' class="form-control">
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Nomor Surat Undangan (*)</label> 
                                <input type="text" placeholder="Enter Nomor Surat Undangan" autocomplete=off name='NoSuratUndangan' id='NoSuratUndangan' class="form-control">
                            </div>

                            <div class="form-group data_1">
                                <label>Tanggal Surat Undangan (*)</label> 
                                <div class="input-group date">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" placeholder="Enter Tanggal Surat Undangan" autocomplete=off name='TglSuratUndangan' id='TglSuratUndangan' class="form-control">
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Nomor Berita Acara Hasil Pengadaan Langsung (*)</label> 
                                <input type="text" placeholder="Enter Nomor Berita Acara Hasil Pengadaan Langsung" autocomplete=off name='NoBaPl' id='NoBaPl' class="form-control">
                            </div>

                            <div class="form-group data_1">
                                <label>Tanggal Berita Acara Hasil Pengadaan Langsung (*)</label> 
                                <div class="input-group date">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" placeholder="Enter Tanggal Berita Acara Pengadaan Langsung" autocomplete=off name='TglBaPl' id='TglBaPl' class="form-control">
                                </div>
                            </div>

                            <div class="form-group data_2">
                                <label>Waktu Kerja</label> 
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                    <input type="text" placeholder="Enter Dari" autocomplete=off name='TglDari' id='TglDari' class="awal form-control">
                                    <span class="input-group-addon">S/D</span>
                                    <input type="text" placeholder="Enter Sampai" autocomplete=off name='TglSampai' id='TglSampai' class="akhir form-control">
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Pejabat yang bertanda tangan</label> 
                                <select class="select2_demo_2 form-control" name='KodePejabat' id='KodePejabat'>
                                <option value=""></option>
                                    <?php foreach($pejabat as $item): ?>
                                        <option value="<?= $item['Kode'] ?>"><?= $item['Nama']; ?> [<?= $item['Nip'] ?>]</option>
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
$this->load->view('spk/main_js',$data) ?>
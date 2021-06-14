
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
                            <hr>
                            <h5>URAIAN SPK</h5>
                            <div class="form-group">
                                <label>Nama Kegiatan</label> 
                                <input type="text" placeholder="Enter Nama Kegiatan" autocomplete=off name='NamaKegiatan' id='NamaKegiatan' class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Volume</label> 
                                <input type="text" onkeyup="rupiah(this)" placeholder="Enter Volume" autocomplete=off name='Volume' id='Volume' class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Satuan Ukuran</label> 
                                <input type="text" placeholder="Enter Satuan Ukuran" autocomplete=off name='SatuanUkuran' id='SatuanUkuran' class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Harga Satuan</label> 
                                <input type="text" onkeyup="rupiah(this)" placeholder="Enter Harga Satuan" autocomplete=off name='HargaSatuan' id='HargaSatuan' class="form-control">
                            </div>
                            <div>
                                <button id="BtnTambah" class="btn btn-sm btn-primary float-right m-t-n-xs" type="button"><i class='fa fa-plus'></i> Tambah</button>
                            </div>
                            <br>
                            <br>
                            <div class="form-group">
                                <table class='table table-striped table-bordered'>
                                    <thead>
                                        <tr>
                                            <th width="5%" class="text-center">No</th>
                                            <th class="text-center">Nama Kegiatan</th>
                                            <th class="text-center">Volume</th>
                                            <th class="text-center">Satuan Ukuran</th>
                                            <th class="text-center">Harga Satuan</th>
                                            <th class="text-center">Total</th>
                                            <th class="text-center">#</th>
                                        </tr>
                                    </thead>
                                    <tbody id="iData"></tbody>
                                </table>
                            </div>
                            <div class="form-group">
                                <label>Pembulatan</label> 
                                <input type="text" onkeyup="rupiah(this)" placeholder="Enter Harga Satuan" autocomplete=off name='Pembulatan' id='Pembulatan' class="form-control">
                            </div>
                            <input type="hidden" id="CekItem" value=0>
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
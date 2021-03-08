<?php 
$CI =& get_instance();
$CI->load->library('MyLib');
?>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-8">
        <h2>Progress Pekrjaan  / Harga Perkiraan Sendiri</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="<?= base_url(); ?>">Dashboard</a>
            </li>
            <li class="breadcrumb-item">
                <a href="<?= base_url('data_pekerjaan'); ?>">Pekerjaan atau Harga Perkiraan Sendiri</a>
            </li>
            <li class="breadcrumb-item active">
                <strong>Progress Pekerjaan atau Harga Perkiraan Sendiri</strong>
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

<div class="row animated fadeInRight">
        <div class="col-lg-12">
            <div class="ibox ">
                <div class="text-center  p-md">
                    <span>Progress Pekerjaan <?= $Progress ?>% </span>
                </div>
                <div class="" id="ibox-content">
                    <div id="vertical-timeline" class="vertical-container center-orientation light-timeline">
                        <div class="vertical-timeline-block">
                            <div class="vertical-timeline-icon navy-bg">
                                <i class="fa fa-file-text"></i>
                            </div>

                            <div class="vertical-timeline-content">
                                <h2>Dokumen Harga Perkiraan Sendiri (HPS)</h2>
                                <?php $Anggaran = json_decode($hps['DataAnggaran'],true); ?>
                                <p><?= $hps['Pekerjaan']; ?><br>
                                    <small>No Surat : <b><?= $hps['NoSurat'] ?></b></small><br>
                                    <small>Anggaran  : <b><?= $Anggaran['Nama'] ?></b></small><br>

                                </p>
                                <a href="<?= base_url('data_pekerjaan/cetak/'.$hps['Id']) ?>" target='_blank' class="btn btn-xs btn-primary" data-toggle='tooltip' title='Cetak Dokumen PDF'><i class='fa fa-file-pdf-o'></i> Cetak</a>
                                <a href="#" class="btn btn-xs btn-info" data-toggle='tooltip' title='Unduh Dokumen Word'> <i class='fa fa-file-word-o'></i> Unduh</a>
                                <span class='clearfix'></span>
                                <span class="vertical-date">
                                    <?= $CI->mylib->hari_indo($hps['Tgl']) ?> <br/>
                                    <small><?= $CI->mylib->tgl_indo($hps['Tgl']) ?></small>
                                </span>
                            </div>
                        </div>

                        <div class="vertical-timeline-block">
                            <div class="vertical-timeline-icon blue-bg">
                                <i class="fa fa-file-text"></i>
                            </div>

                            <div class="vertical-timeline-content">
                                <h2>Dokumen Penunjukan Penyedia</h2>
                                
                                <?php if($penunjukan_peyedia['row'] > 0){ 
                                    $dataVendor = json_decode($penunjukan_peyedia['data']['DataVendor'],true);

                                ?>
                                    <p> Vendor yang ditujuk  <b><?= strtoupper($dataVendor['Nama']); ?></b> dan Nilai Yang Disepekati : Rp. <?= $CI->mylib->rupiah1($penunjukan_peyedia['data']['HargaSepakat']); ?></p>
                                    <small>No Surat : <b><?= $penunjukan_peyedia['data']['NoSurat'] ?></b></small><br>
                                    <small> Tanggal Penawara Vendor: <b><?= $CI->mylib->tgl_indo($penunjukan_peyedia['data']['TglPenawaran']) ?></b></small><br>
                                    
                                    <a href="javascript:void(0)" onclick="ShowConfirmModulLain('<?= $penunjukan_peyedia['data']['Id']; ?>','penunjukan_penyedia')" class="btn btn-xs btn-danger" data-toggle='tooltip' title='Hapus Dokumen'><i class='fa fa-trash-o'></i> Hapus</a>
                                    <a href="<?= base_url('penunjukan_penyedia/edit/'.$penunjukan_peyedia['data']['Id']) ?>"  class="btn btn-xs btn-warning" data-toggle='tooltip' title='Ubah Dokumen'><i class='fa fa-pencil'></i> Ubah</a>
                                    <a href="<?= base_url('cetak_data/penunjukan_penyedia/'.$penunjukan_peyedia['data']['Id']) ?>" target='_blank' class="btn btn-xs btn-primary" data-toggle='tooltip' title='Cetak Dokumen PDF'><i class='fa fa-file-pdf-o'></i> Cetak</a>
                                    <a href="#" class="btn btn-xs btn-info" data-toggle='tooltip' title='Unduh Dokumen Word'> <i class='fa fa-file-word-o'></i> Unduh</a>
                                    <span class="vertical-date">
                                        <?= $CI->mylib->hari_indo($penunjukan_peyedia['data']['Tgl']) ?> <br/>
                                    <small><?= $CI->mylib->tgl_indo($penunjukan_peyedia['data']['Tgl']) ?></small>
                                </span>
                                <?php }else{ ?>
                                    <p>Dokumen ini belum dibuat</p>
                                    <a href="<?= base_url('penunjukan_penyedia/tambah/'.$hps['Id']) ?>" class="btn btn-sm btn-success"> Buat Dokumen </a>
                                    <span class="vertical-date">
                                        - <br/>
                                        <small>-</small>
                                    </span>
                                <?php } ?>
                            </div>
                        </div>

                        <div class="vertical-timeline-block">
                            <div class="vertical-timeline-icon lazur-bg">
                                <i class="fa fa-file-text"></i>
                            </div>

                            <div class="vertical-timeline-content">
                                <h2>Dokumen Surat Perintah Kerja (SPK)</h2>
                                <?php if($spk['row'] > 0){ ?>
                                    <p> Waktu Pelaksanaan Pekerjaan:  <b><?= $spk['data']['WaktuKerja']; ?> </b>  hari kerja dari tanggal <?= $CI->mylib->tgl_indo($spk['data']['TglDari']) ?> S/D <?= $CI->mylib->tgl_indo($spk['data']['TglSampai']) ?></p>
                                    <small>No SPK : <b><?= $spk['data']['NoSpk'] ?></b></small><br>
                                    <small> Tanggal SPK: <b><?= $CI->mylib->tgl_indo($spk['data']['Tgl']) ?></b></small><br>
                                    
                                    <a href="javascript:void(0)" onclick="ShowConfirmModulLain('<?= $spk['data']['Id']; ?>','spk')" class="btn btn-xs btn-danger" data-toggle='tooltip' title='Hapus Dokumen'><i class='fa fa-trash-o'></i> Hapus</a>
                                    <a href="<?= base_url('spk/edit/'.$spk['data']['Id']) ?>"  class="btn btn-xs btn-warning" data-toggle='tooltip' title='Ubah Dokumen'><i class='fa fa-pencil'></i> Ubah</a>
                                    <a href="<?= base_url('cetak_data/spk/'.$spk['data']['Id']) ?>" target='_blank' class="btn btn-xs btn-primary" data-toggle='tooltip' title='Cetak Dokumen PDF'><i class='fa fa-file-pdf-o'></i> Cetak</a>
                                    <a href="#" class="btn btn-xs btn-info" data-toggle='tooltip' title='Unduh Dokumen Word'> <i class='fa fa-file-word-o'></i> Unduh</a>
                                    <span class="vertical-date">
                                        <?= $CI->mylib->hari_indo($spk['data']['Tgl']) ?> <br/>
                                    <small><?= $CI->mylib->tgl_indo($spk['data']['Tgl']) ?></small>
                                </span>
                                <?php }else{ ?>
                                    <p>Dokumen ini belum dibuat</p>
                                    <?php if($penunjukan_peyedia['row'] > 0){ ?>
                                    <a  href="<?= base_url('spk/tambah/'.$hps['Id']) ?>"  class="btn btn-sm btn-success"> Buat Dokumen </a>
                                    <?php } else{ ?>
                                        <small>Buat Dokumen Penunjukan Penyedia Terlebih dahulu</small>
                                    <?php } ?>
                                    <span class="vertical-date">
                                        - <br/>
                                        <small>-</small>
                                    </span>
                                <?php } ?>
                            </div>
                        </div>

                        <div class="vertical-timeline-block">
                            <div class="vertical-timeline-icon yellow-bg">
                                <i class="fa fa-file-text"></i>
                            </div>

                            <div class="vertical-timeline-content">
                            <h2>Dokumen Permintaan Pemeriksaan Hasil Pengadaan Barang/Jasa</h2>
                                <?php if($pphp['row'] > 0){ ?>
                                    <p>Keapda Yth. Panitia Penerima Hasil Pekerjaan pada Politeknik Pelayaran Sorong</p>
                                    <small>No Surat : <b><?= $pphp['data']['NoSurat'] ?></b></small><br>
                                    <small> Tanggal Surat: <b><?= $CI->mylib->tgl_indo($pphp['data']['Tgl']) ?></b></small><br>
                                    
                                    <a href="javascript:void(0)" onclick="ShowConfirmModulLain('<?= $pphp['data']['Id']; ?>','pphp')" class="btn btn-xs btn-danger" data-toggle='tooltip' title='Hapus Dokumen'><i class='fa fa-trash-o'></i> Hapus</a>
                                    <a href="<?= base_url('pphp/edit/'.$pphp['data']['Id']) ?>"  class="btn btn-xs btn-warning" data-toggle='tooltip' title='Ubah Dokumen'><i class='fa fa-pencil'></i> Ubah</a>
                                    <a href="<?= base_url('cetak_data/pphp/'.$pphp['data']['Id']) ?>" target='_blank' class="btn btn-xs btn-primary" data-toggle='tooltip' title='Cetak Dokumen PDF'><i class='fa fa-file-pdf-o'></i> Cetak</a>
                                    <a href="#" class="btn btn-xs btn-info" data-toggle='tooltip' title='Unduh Dokumen Word'> <i class='fa fa-file-word-o'></i> Unduh</a>
                                    <span class="vertical-date">
                                        <?= $CI->mylib->hari_indo($pphp['data']['Tgl']) ?> <br/>
                                    <small><?= $CI->mylib->tgl_indo($pphp['data']['Tgl']) ?></small>
                                </span>
                                <?php }else{ ?>
                                    <p>Dokumen ini belum dibuat</p>
                                    <?php if($spk['row'] > 0){ ?>
                                    <a href="<?= base_url('pphp/tambah/'.$hps['Id']) ?>" class="btn btn-sm btn-success"> Buat Dokumen </a>
                                    <?php } else{ ?>
                                        <small>Buat Dokumen SPK Terlebih dahulu</small>
                                    <?php } ?>
                                    <span class="vertical-date">
                                        - <br/>
                                        <small>-</small>
                                    </span>
                                <?php } ?>
                            </div>
                        </div>

                        <div class="vertical-timeline-block">
                            <div class="vertical-timeline-icon lazur-bg">
                                <i class="fa fa-file-text"></i>
                            </div>

                            <div class="vertical-timeline-content">
                            <h2>Dokumen Berita Acara Pemeriksaan Hasil Pekerjaan </h2>
                                <?php if($baphp['row'] > 0){ 
                                    $NoSkPemeriksa = json_decode($baphp['data']['DataPemeriksa'],true);
                                ?>
                                    <p>Panitia Penerima Hasil Pekerjaan berdasarkan Nomor <b><?= $NoSkPemeriksa['NoSk'] ?></b></p>
                                    <small>No Surat : <b><?= $baphp['data']['NoSurat'] ?></b></small><br>
                                    <small> Tanggal Surat: <b><?= $CI->mylib->tgl_indo($baphp['data']['Tgl']) ?></b></small><br>
                                    
                                    <a href="javascript:void(0)" onclick="ShowConfirmModulLain('<?= $baphp['data']['Id']; ?>','baphp')" class="btn btn-xs btn-danger" data-toggle='tooltip' title='Hapus Dokumen'><i class='fa fa-trash-o'></i> Hapus</a>
                                    <a href="<?= base_url('baphp/edit/'.$baphp['data']['Id']) ?>"  class="btn btn-xs btn-warning" data-toggle='tooltip' title='Ubah Dokumen'><i class='fa fa-pencil'></i> Ubah</a>
                                    <a href="<?= base_url('cetak_data/baphp/'.$baphp['data']['Id']) ?>" target='_blank' class="btn btn-xs btn-primary" data-toggle='tooltip' title='Cetak Dokumen PDF'><i class='fa fa-file-pdf-o'></i> Cetak</a>
                                    <a href="#" class="btn btn-xs btn-info" data-toggle='tooltip' title='Unduh Dokumen Word'> <i class='fa fa-file-word-o'></i> Unduh</a>
                                    <span class="vertical-date">
                                        <?= $CI->mylib->hari_indo($baphp['data']['Tgl']) ?> <br/>
                                    <small><?= $CI->mylib->tgl_indo($baphp['data']['Tgl']) ?></small>
                                </span>
                                <?php }else{ ?>
                                    <p>Dokumen ini belum dibuat</p>
                                    <?php if($pphp['row'] > 0){ ?>
                                    <a href="<?= base_url('baphp/tambah/'.$hps['Id']) ?>" class="btn btn-sm btn-success"> Buat Dokumen </a>
                                    <?php } else{ ?>
                                        <small>Buat Dokumen Permintaan Pemeriksaan Hasil Pengadaan Barang/Jasa Terlebih dahulu</small>
                                    <?php } ?>
                                    <span class="vertical-date">
                                        - <br/>
                                        <small>-</small>
                                    </span>
                                <?php } ?>
                            </div>
                        </div>

                        <div class="vertical-timeline-block">
                            <div class="vertical-timeline-icon navy-bg">
                                <i class="fa fa-file-text"></i>
                            </div>

                            <div class="vertical-timeline-content">
                            <h2>Dokumen Berita Acara Serah Terima Barang </h2>
                                <?php if($bastb['row'] > 0){ ?>
                                   <p>No Dokumen : <b><?= $bastb['data']['NoSurat'] ?></b></p>
                                   <p>Tanggal Surat: <b><?= $CI->mylib->tgl_indo($bastb['data']['Tgl']) ?></b><p>
                                    
                                    <a href="javascript:void(0)" onclick="ShowConfirmModulLain('<?= $bastb['data']['Id']; ?>','bastb')" class="btn btn-xs btn-danger" data-toggle='tooltip' title='Hapus Dokumen'><i class='fa fa-trash-o'></i> Hapus</a>
                                    <a href="<?= base_url('bastb/edit/'.$bastb['data']['Id']) ?>"  class="btn btn-xs btn-warning" data-toggle='tooltip' title='Ubah Dokumen'><i class='fa fa-pencil'></i> Ubah</a>
                                    <a href="<?= base_url('cetak_data/bastb/'.$bastb['data']['Id']) ?>" target='_blank' class="btn btn-xs btn-primary" data-toggle='tooltip' title='Cetak Dokumen PDF'><i class='fa fa-file-pdf-o'></i> Cetak</a>
                                    <a href="#" class="btn btn-xs btn-info" data-toggle='tooltip' title='Unduh Dokumen Word'> <i class='fa fa-file-word-o'></i> Unduh</a>
                                    <span class="vertical-date">
                                        <?= $CI->mylib->hari_indo($bastb['data']['Tgl']) ?> <br/>
                                    <small><?= $CI->mylib->tgl_indo($bastb['data']['Tgl']) ?></small>
                                </span>
                                <?php }else{ ?>
                                    <p>Dokumen ini belum dibuat</p>
                                    <?php if($baphp['row'] > 0){ ?>
                                    <a href="<?= base_url('bastb/tambah/'.$hps['Id']) ?>" class="btn btn-sm btn-success"> Buat Dokumen </a>
                                    <?php } else{ ?>
                                        <small>Buat Dokumen Berita Acara Pemeriksaan Hasil Pekerjaan</small>
                                    <?php } ?>
                                    <span class="vertical-date">
                                        - <br/>
                                        <small>-</small>
                                    </span>
                                <?php } ?>
                            </div>
                        </div>

                        <div class="vertical-timeline-block">
                            <div class="vertical-timeline-icon navy-bg">
                                <i class="fa fa-file-text"></i>
                            </div>

                            <div class="vertical-timeline-content">
                            <h2>Dokumen Berita Acara Pembayaran </h2>
                                <?php if($ba_bayar['row'] > 0){ ?>
                                   <p>No Dokumen : <b><?= $ba_bayar['data']['NoSurat'] ?></b></p>
                                   <p>Tanggal Surat: <b><?= $CI->mylib->tgl_indo($ba_bayar['data']['Tgl']) ?></b><p>
                                    
                                    <a href="javascript:void(0)" onclick="ShowConfirmModulLain('<?= $ba_bayar['data']['Id']; ?>','ba_bayar')" class="btn btn-xs btn-danger" data-toggle='tooltip' title='Hapus Dokumen'><i class='fa fa-trash-o'></i> Hapus</a>
                                    <a href="<?= base_url('ba_bayar/edit/'.$ba_bayar['data']['Id']) ?>"  class="btn btn-xs btn-warning" data-toggle='tooltip' title='Ubah Dokumen'><i class='fa fa-pencil'></i> Ubah</a>
                                    <a href="<?= base_url('cetak_data/ba_bayar/'.$ba_bayar['data']['Id']) ?>" target='_blank' class="btn btn-xs btn-primary" data-toggle='tooltip' title='Cetak Dokumen PDF'><i class='fa fa-file-pdf-o'></i> Cetak</a>
                                    <a href="#" class="btn btn-xs btn-info" data-toggle='tooltip' title='Unduh Dokumen Word'> <i class='fa fa-file-word-o'></i> Unduh</a>
                                    <span class="vertical-date">
                                        <?= $CI->mylib->hari_indo($ba_bayar['data']['Tgl']) ?> <br/>
                                    <small><?= $CI->mylib->tgl_indo($ba_bayar['data']['Tgl']) ?></small>
                                </span>
                                <?php }else{ ?>
                                    <p>Dokumen ini belum dibuat</p>
                                    <?php if($bastb['row'] > 0){ ?>
                                    <a href="<?= base_url('ba_bayar/tambah/'.$hps['Id']) ?>" class="btn btn-sm btn-success"> Buat Dokumen </a>
                                    <?php } else{ ?>
                                        <small>Buat Dokumen Berita Acara Serah Terima Barang</small>
                                    <?php } ?>
                                    <span class="vertical-date">
                                        - <br/>
                                        <small>-</small>
                                    </span>
                                <?php } ?>
                            </div>
                        </div>

                        <div class="vertical-timeline-block">
                            <div class="vertical-timeline-icon navy-bg">
                                <i class="fa fa-file-text"></i>
                            </div>

                            <div class="vertical-timeline-content">
                            <h2>Dokumen Kwitansi </h2>
                                <?php if($kwitansi['row'] > 0){ ?>
                                   <p>No Bukti : <b><?= $kwitansi['data']['NoBukti'] ?></b></p>
                                   <p>Tanggal: <b><?= $CI->mylib->tgl_indo($kwitansi['data']['Tgl']) ?></b><p>
                                    
                                    <a href="javascript:void(0)" onclick="ShowConfirmModulLain('<?= $kwitansi['data']['Id']; ?>','kwitansi')" class="btn btn-xs btn-danger" data-toggle='tooltip' title='Hapus Dokumen'><i class='fa fa-trash-o'></i> Hapus</a>
                                    <a href="<?= base_url('kwitansi/edit/'.$kwitansi['data']['Id']) ?>"  class="btn btn-xs btn-warning" data-toggle='tooltip' title='Ubah Dokumen'><i class='fa fa-pencil'></i> Ubah</a>
                                    <a href="<?= base_url('cetak_data/kwitansi/'.$kwitansi['data']['Id']) ?>" target='_blank' class="btn btn-xs btn-primary" data-toggle='tooltip' title='Cetak Dokumen PDF'><i class='fa fa-file-pdf-o'></i> Cetak</a>
                                    <a href="#" class="btn btn-xs btn-info" data-toggle='tooltip' title='Unduh Dokumen Word'> <i class='fa fa-file-word-o'></i> Unduh</a>
                                    <span class="vertical-date">
                                        <?= $CI->mylib->hari_indo($kwitansi['data']['Tgl']) ?> <br/>
                                    <small><?= $CI->mylib->tgl_indo($kwitansi['data']['Tgl']) ?></small>
                                </span>
                                <?php }else{ ?>
                                    <p>Dokumen ini belum dibuat</p>
                                    <?php if($bastb['row'] > 0){ ?>
                                    <a href="<?= base_url('kwitansi/tambah/'.$hps['Id']) ?>" class="btn btn-sm btn-success"> Buat Dokumen </a>
                                    <?php } else{ ?>
                                        <small>Buat Dokumen Kwitansi</small>
                                    <?php } ?>
                                    <span class="vertical-date">
                                        - <br/>
                                        <small>-</small>
                                    </span>
                                <?php } ?>
                            </div>
                        </div>
                    
                    </div>
                </div>
            </div>
        </div>
</div>

<?php 
$data['hps'] = $hps;
$this->load->view('data_pekerjaan/main_js',$hps) ?>
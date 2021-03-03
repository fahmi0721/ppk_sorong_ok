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
                    <span>Progress Pekerjaan 10% </span>
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
                                    <i class="fa fa-coffee"></i>
                                </div>

                                <div class="vertical-timeline-content">
                                    <h2>Coffee Break</h2>
                                    <p>Go to shop and find some products. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's. </p>
                                    <a href="#" class="btn btn-sm btn-info">Read more</a>
                                    <span class="vertical-date"> Yesterday <br/><small>Dec 23</small></span>
                                </div>
                            </div>

                            <div class="vertical-timeline-block">
                                <div class="vertical-timeline-icon yellow-bg">
                                    <i class="fa fa-phone"></i>
                                </div>

                                <div class="vertical-timeline-content">
                                    <h2>Phone with Jeronimo</h2>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iusto, optio, dolorum provident rerum aut hic quasi placeat iure tempora laudantium ipsa ad debitis unde? Iste voluptatibus minus veritatis qui ut.</p>
                                    <span class="vertical-date">Yesterday <br/><small>Dec 23</small></span>
                                </div>
                            </div>

                            <div class="vertical-timeline-block">
                                <div class="vertical-timeline-icon lazur-bg">
                                    <i class="fa fa-user-md"></i>
                                </div>

                                <div class="vertical-timeline-content">
                                    <h2>Go to the doctor dr Smith</h2>
                                    <p>Find some issue and go to doctor. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s. </p>
                                    <span class="vertical-date">Yesterday <br/><small>Dec 23</small></span>
                                </div>
                            </div>

                            <div class="vertical-timeline-block">
                                <div class="vertical-timeline-icon navy-bg">
                                    <i class="fa fa-comments"></i>
                                </div>

                                <div class="vertical-timeline-content">
                                    <h2>Chat with Monica and Sandra</h2>
                                    <p>Web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like). </p>
                                    <span class="vertical-date">Yesterday <br/><small>Dec 23</small></span>
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
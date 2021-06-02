
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-8">
        <h2>Pengadaan Langsung / Ubah Undangan Penawaran</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="<?= base_url(); ?>">Dashboard</a>
            </li>
            <li class="breadcrumb-item">
                <a href="<?= base_url('pl_undangan'); ?>">Undangan Penawaran</a>
            </li>
            <li class="breadcrumb-item active">
                <strong>Ubah Undangan Penawaran</strong>
            </li>
        </ol>
    </div>
    <div class="col-sm-4">
        <div class="title-action">
            <div class="btn-group">
                <a href="<?= base_url('pl_undangan') ?>" class="btn btn-sm btn-danger"><i class='fa fa-mail-reply'></i> Kembali</a>
            </div>
            
        </div>
    </div>
</div>

<div class="row wrapper wrapper-content animated fadeInRight">
    <div class="col-lg-12">
        <div class="ibox">
            <div class="ibox-title">
                <h5>Pengadaan Langsung / Ubah Undangan Penawaran </h5>
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
                            <input type="hidden" name="Id" value="<?= $data->Id ?>">
                            <div class="form-group">
                                <label>Nomor Surat</label> 
                                <input type="text" value="<?= $data->NoSurat ?>"  placeholder="Enter Nomor Surat" autocomplete=off class="form-control" name='NoSurat' id='NoSurat'>
                            </div>

                            <div class="form-group" id='data_1'>
                                <label>Tanggal</label> 
                                <div class="input-group date">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" placeholder="Enter Tanggal Surat" autocomplete=off name='TglSurat' value="<?= $data->TglSurat ?>" id='TglSurat' class="form-control">
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Lampiran</label> 
                                <input type="text"  placeholder="Lampiran" value="<?= $data->Lampiran ?>" autocomplete=off class="form-control" name='Lampiran' id='Lampiran'>       
                            </div>

                            <div class="form-group">
                                <label>Perihal</label> 
                                <input type="text"  placeholder="Perihal" value="<?= $data->Perihal ?>" autocomplete=off class="form-control" name='Perihal' id='Perihal'>                              
                            </div>

                            
                            <div class="form-group">
                                <label>Kepada</label> 
                                <input type="text"  placeholder="Kepada" value="<?= $data->Kepada ?>" autocomplete=off class="form-control" name='Kepada' id='Kepada'>
                            </div>

                            <div class="form-group">
                                <label>Kota Vendor</label> 
                                <input type="text"  placeholder="Kota Vendor" value="<?= $data->KotaVendor ?>" autocomplete=off class="form-control" name='KotaVendor' id='KotaVendor'>
                            </div>

                            <div class="form-group">
                                <label>Alamat Vendor</label> 
                                <input type="text"  placeholder="Alamat Vendor" value="<?= $data->AlamatVendor ?>" autocomplete=off class="form-control" name='AlamatVendor' id='AlamatVendor'>
                            </div>

                            <div class="form-group">
                                <label>Sumber Dana</label> 
                                <textarea type="text" rows="5" placeholder="Sumber Dana"  autocomplete=off class="form-control" name='SumberDana' id='SumberDana'><?= $data->SumberDana ?></textarea>
                            </div>

                            <div class="form-group">
                                <label>Pekerjaan</label> 
                                <textarea type="text" rows="5" placeholder="Pekerjaan" autocomplete=off class="form-control" name='Pekerjaan' id='Pekerjaan'><?= $data->Pekerjaan ?></textarea>
                            </div>

                            <div class="form-group">
                                <label>Lingkungan Pekerjaan</label> 
                                <textarea type="text" rows="5" placeholder="Lingkungan Pekerjaan" autocomplete=off class="form-control" name='LikPekerjaan' id='LikPekerjaan'><?= $data->LikPekerjaan ?></textarea>
                            </div>

                            <div class="form-group">
                                <label>Nilai Total HPS</label> 
                                <input type="text"  placeholder="Nilai Total HPS" value="<?= $data->NilaiHps ?>" autocomplete=off class="form-control" name='NilaiHps' id='NilaiHps'>
                            </div>
                            <legend>Kegiatan</legend>
                            <?php 
                                $Kegiatan = json_decode($data->Kegiatan,true);
                            ?>
                            <div class="form-group " id='data_2'>
                                <label>Pemasukan Dokumen Kualifikasi</label> 
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" placeholder="Enter Tanggal" autocomplete=off name='Kegiatan[]' value="<?= $Kegiatan[0] ?>" id='Tgl0' class="form-control">
                                </div>
                            </div>
                            <div class="form-group " id='data_3'>
                                <label>Pemasukan Dokumen Penawaran</label> 
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" placeholder="Enter Tanggal" autocomplete=off name='Kegiatan[]' value="<?= $Kegiatan[1] ?>" id='Tgl1' class="form-control">
                                </div>
                            </div>
                            <div class="form-group " id='data_4'>
                                <label>Pembukaan Dokumen Penawaran, Evaluasi, Klarifikasi Teknis dan Negosiasi Harga</label> 
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" placeholder="Enter Tanggal" autocomplete=off name='Kegiatan[]' value="<?= $Kegiatan[2] ?>" id='Tgl2' class="form-control">
                                </div>
                            </div>
                            <div class="form-group " id='data_5'>
                                <label>Penandatanganan SPK</label> 
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" placeholder="Enter Tanggal" autocomplete=off name='Kegiatan[]' value="<?= $Kegiatan[3] ?>" id='Tgl3' class="form-control">
                                </div>
                            </div>

                            <hr><?php
                                $Pejabat = json_decode($data->Pejabat,true);
                            ?>
                            <div class="form-group">
                                <label>Nama Pejabat TTD</label> 
                                <input type="text" value="<?= $Pejabat[0] ?>" placeholder="Nama Pejabat TTD" autocomplete=off class="form-control" name='Pejabat[]' id='NamaPejabat'>
                            </div>
                            <div class="form-group">
                                <label>Jabatan Pejabat TTD</label> 
                                <input type="text" value="<?= $Pejabat[1] ?>"  placeholder="Jabatan Pejabat TTD" autocomplete=off class="form-control" name='Pejabat[]' id='JabatanPejabat'>
                            </div>
                            <div class="form-group">
                                <label>NIP Pejabat TTD</label> 
                                <input type="text" value="<?= $Pejabat[2] ?>"  placeholder="NIP Pejabat TTD" autocomplete=off class="form-control" name='Pejabat[]' id='NipPejabat'>
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
$this->load->view('pl_undangan/form_edit_js') ?>
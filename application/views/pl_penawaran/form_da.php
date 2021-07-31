
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-8">
        <h2>Pengadaan Langsung / Data Administrasi</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="<?= base_url(); ?>">Dashboard</a>
            </li>
            <li class="breadcrumb-item">
                <a href="<?= base_url('pl_penawaran'); ?>">Surat Lampiran Data Administrasi </a>
            </li>
            <li class="breadcrumb-item active">
                <strong>Tambah Lampiran Data Administrasi </strong>
            </li>
        </ol>
    </div>
    <div class="col-sm-4">
        <div class="title-action">
            <div class="btn-group">
                <a href="<?= base_url('pl_penawaran') ?>" class="btn btn-sm btn-danger"><i class='fa fa-mail-reply'></i> Kembali</a>
            </div>
            
        </div>
    </div>
</div>

<div class="row wrapper wrapper-content animated fadeInRight">
    <div class="col-lg-12">
        <div class="ibox">
            <div class="ibox-title">
                <h5>Pengadaan Langsung / Data Administrasi  </h5>
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
                            <input type="hidden" name='Id' value='<?= $data['Id'] ?>'>
                            <div class="form-group">
                                <label>Nama Badan Usaha</label> 
                                <input type="text"  placeholder="Enter Nama Badan Usaha" autocomplete=off class="form-control" name='Nama' id='Nama' value="<?= $data['Nama'] ?>">
                            </div>

                            <div class="form-group">
                                <label>Status</label> 
                                <div class='input-group'>
                                    <span class="input-group-addon"><input type="radio" name="Status" id="StatusPusat" value="Pusat" <?php if($data['Status'] != "Cabang"){ echo "checked"; } ?>></span>
                                    <input type="text" value="Pusat" readonly class="form-control">
                                    <span class="input-group-addon"><input type="radio" name="Status" id="StatusCabang" value="Cabang" <?php if($data['Status'] == "Cabang"){ echo "checked"; } ?>></span>
                                    <input type="text" value="Cabang" readonly class="form-control">
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Alamat Kantor Pusat</label> 
                                <input type="text"  placeholder="Alamat Kantor Pusat" autocomplete=off class="form-control" name='AlamatPusat' id='AlamatPusat' value="<?= $data['AlamatPusat'] ?>">       
                            </div>

                            <div class="form-group">
                                <label>No. Telepon Kantor Pusat</label> 
                                <input type="text"  placeholder="No. Telepon" autocomplete=off class="form-control" name='NoTelpPusat' id='NoTelpPusat' value="<?= $data['NoTelpPusat'] ?>">       
                            </div>

                            <div class="form-group">
                                <label>No. Fax Kantor Pusat</label> 
                                <input type="text"  placeholder="No. Fax Kantor Pusat" autocomplete=off class="form-control" name='FaxPusat' id='FaxPusat' value="<?= $data['FaxPusat'] ?>">       
                            </div>

                            <div class="form-group">
                                <label>Email Kantor Pusat</label> 
                                <input type="text"  placeholder="Email Kantor Pusat" autocomplete=off class="form-control" name='EmailPusat' id='EmailPusat' value="<?= $data['EmailPusat'] ?>">       
                            </div>
                            <hr />
                            <div class="form-group">
                                <label>Alamat Kantor Cabang</label> 
                                <input type="text"  placeholder="Alamat Kantor Cabang" autocomplete=off class="form-control" name='AlamatCabang' id='AlamatCabang' value="<?= $data['AlamatCabang'] ?>">       
                            </div>

                            <div class="form-group">
                                <label>No. Telepon Kantor Cabang</label> 
                                <input type="text"  placeholder="No. Telepon" autocomplete=off class="form-control" name='NoTelpCabang' id='NoTelpCabang' value="<?= $data['NoTelpCabang'] ?>">       
                            </div>

                            <div class="form-group">
                                <label>No. Fax Kantor Cabang</label> 
                                <input type="text"  placeholder="No. Fax Kantor Cabang" autocomplete=off class="form-control" name='FaxCabang' id='FaxCabang' value="<?= $data['FaxCabang'] ?>">       
                            </div>

                            <div class="form-group">
                                <label>Email Kantor Cabang</label> 
                                <input type="text"  placeholder="Email Kantor Cabang" autocomplete=off class="form-control" name='EmailCabang' id='EmailCabang' value="<?= $data['EmailCabang'] ?>">       
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
$this->load->view('pl_penawaran/form_da_js') ?>
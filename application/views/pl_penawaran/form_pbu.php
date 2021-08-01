
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-8">
        <h2>Pengadaan Langsung / Pengurus Badan Usaha </h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="<?= base_url(); ?>">Dashboard</a>
            </li>
            <li class="breadcrumb-item">
                <a href="<?= base_url('pl_penawaran'); ?>">Surat Lampiran Pengurus Badan Usaha  </a>
            </li>
            <li class="breadcrumb-item active">
                <strong>Tambah Lampiran Pengurus Badan Usaha  </strong>
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
                <h5>Pengadaan Langsung / Pengurus Badan Usaha </h5>
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
                            <h5>Akta Pendirian Perusahaan/Anggaran Dasar </h5>
                            <div class="form-group">
                                <label>Nama</label> 
                                <input type="text" placeholder="Enter Nama" autocomplete=off class="form-control" name='Nama' id='Nama'>
                            </div>

                            <div class="form-group">
                                <label>Nomor Identitas</label> 
                                <input type="text"  placeholder="Nomor Identitas" autocomplete=off class="form-control" name='NoId' id='NoId'>       
                            </div>

                            <div class="form-group">
                                <label>Jabatan</label> 
                                <input type="text"  placeholder="Jabatan" autocomplete=off class="form-control" name='Jabatan' id='Jabatan' >       
                            </div>
                            <div>
                                <button class="btn btn-sm btn-primary float-right m-t-n-xs" type="submit"><i class='fa fa-check-square'></i> Tambah</button>
                            </div>
                            <br>
                            <br>
                        </form>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th>Nama</th>
                                        <th>Nomor Identitas</th>
                                        <th>Jabatan Dalam Badan Usaha</th>
                                        <th class='text-center'>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $no=1;
                                        foreach($iData as $key => $item){
                                            echo "<tr>";
                                                echo "<td class='text-center'>".$no."</td>";
                                                echo "<td>".$item['Nama']."</td>";
                                                echo "<td>".$item['NoId']."</td>";
                                                echo "<td>".$item['Jabatan']."</td>";
                                                echo "<td class='text-center'><a data-toggle='tooltip' href='".base_url()."/pl_penawaran/hapus_item_pbu?Id=".$data['Id']."&Key=".$key."' title='Hapus Data' class='btn btn-danger btn-xs'><i class='fa fa-trash-o'></i></a></span></center></td>";
                                            echo "</tr>";
                                            $no++;
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<?php 
$this->load->view('pl_penawaran/form_pbu_js') ?>
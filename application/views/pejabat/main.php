<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-4">
        <h2>Data Pejabat</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="<?= base_url(); ?>">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">
                <strong>Pejabat</strong>
            </li>
        </ol>
    </div>
    <div class="col-sm-8">
        <div class="title-action">
            <div class="btn-group">
                <a href="<?= base_url('pejabat/tambah') ?>" class="btn btn-sm btn-primary"><i class='fa fa-plus'></i> Tambah Data</a>
            </div>
            
        </div>
    </div>
</div>

<div class="row wrapper wrapper-content animated fadeInRight">
    <div class="col-lg-12">
        <div class="ibox">
            <div class="ibox-title">
                <h5>Daftar Pejabat</h5>
                <div class="ibox-tools">
                    <a class="collapse-link">
                        <i class="fa fa-chevron-up"></i>
                    </a>
                </div>
            </div>
            <div class="ibox-content">
                <div class="table-responsive">
                    <table class="table table-striped dataTables-example">
                        <thead>
                        <tr>
                            <th width='5px' class='text-center'>No</th>
                            <th width='15%'>Pejabat</th>
                            <th>Jabatan </th>
                            <th>Deskrpsi Jabatan </th>
                            <th>Alamat </th>
                            <th width='5%'>Aksi </th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                            if(!empty($data)){ 
                            $no=1; foreach ($data as $item): 
                        ?>
                        <tr>
                            <td class='text-center'><?= $no++ ?></td>
                            <td><?= $item['Nama']; ?><br> <small><b>NIP :</b><?= $item['Nip']; ?></small><br><small><b>Kode :</b><?= $item['Kode']; ?></small></td>
                            <td><?= $item['Jabatan']; ?></td>
                            <td><?= $item['DeskripsiJabatan']; ?></td>
                            <td><?= $item['Alamat']; ?></td>
                            <td class='text-center'>
                                <div class="btn-group">
                                    <button onclick="window.location='<?= base_url('pejabat/edit/').$item['Id'] ?>'" data-toggle='tooltip' title='Ubah Data' class="btn btn-outline btn-primary btn-xs dim"><i class='fa fa-edit'></i></button>
                                    <button onclick="ShowConfirm('<?= $item['Id'] ?>')" data-toggle='tooltip' title='Hapus Data' class="btn btn-outline btn-danger btn-xs dim"><i class='fa fa-trash-o'></i></button>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; 
                            }else{
                        ?>
                        <tr><td colspan='6' class='text-center'>Data Masih Kosong</td></tr>
                        <?php } ?>
                        
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>

<?php $this->load->view('pejabat/main_js') ?>
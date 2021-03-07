
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-4">
        <h2>Data Vendor</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="<?= base_url(); ?>">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">
                <strong>Vendor</strong>
            </li>
        </ol>
    </div>
    <div class="col-sm-8">
        <div class="title-action">
            <div class="btn-group">
                <a href="<?= base_url('Vendors/tambah') ?>" class="btn btn-sm btn-primary"><i class='fa fa-plus'></i> Tambah Data</a>
            </div>
            
        </div>
    </div>
</div>

<div class="row wrapper wrapper-content animated fadeInRight">
    <div class="col-lg-12">
        <div class="ibox">
            <div class="ibox-title">
                <h5>Daftar Vendor</h5>
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
                            <th width='15%'>Vendor</th>
                            <th>Pimpinan </th>
                            <th>No Telpon/HP </th>
                            <th>Rekekning </th>
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
                            <td><?= $item['Nama']; ?><br> <small><b>Kode :</b><?= $item['Kode']; ?></small></td>
                            <td><?= $item['NamaPimpinan']; ?><br> <small><b>Jabatan :</b><?= $item['Jabatan']; ?></small></td>
                            <td><?= $item['NoTelp']; ?></td>
                            <td><?= $item['NoRek']; ?><br> <small><b>A.n :</b><?= $item['AnBank']; ?></small><br> <small><b>Bank :</b><?= $item['Bank']; ?></small></td>
                            <td><?= $item['Alamat']; ?></td>
                            <td class='text-center'>
                                <div class="btn-group">
                                    <button onclick="window.location='<?= base_url('Vendors/edit/').$item['id'] ?>'" data-toggle='tooltip' title='Ubah Data' class="btn btn-outline btn-primary btn-xs dim"><i class='fa fa-edit'></i></button>
                                    <button onclick="ShowConfirm('<?= $item['id'] ?>')" data-toggle='tooltip' title='Hapus Data' class="btn btn-outline btn-danger btn-xs dim"><i class='fa fa-trash-o'></i></button>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; 
                        }else{
                        ?>
                        <tr><td colspan='7' class='text-center'>Data Vendor masih kosong</td></tr>
                        <?php } ?>
                        
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>

<?php $this->load->view('vendor/main_js') ?>
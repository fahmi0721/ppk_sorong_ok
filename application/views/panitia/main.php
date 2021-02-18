<?php 
$CI =& get_instance();
$CI->load->library('MyLib');
?>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-4">
        <h2>Data SK Panitia Pemeriksa</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="<?= base_url(); ?>">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">
                <strong>SK Panitia Pemeriksa</strong>
            </li>
        </ol>
    </div>
    <div class="col-sm-8">
        <div class="title-action">
            <div class="btn-group">
                <a href="<?= base_url('panitia/tambah') ?>" class="btn btn-sm btn-primary"><i class='fa fa-plus'></i> Tambah Data</a>
            </div>
            
        </div>
    </div>
</div>

<div class="row wrapper wrapper-content animated fadeInRight">
    <div class="col-lg-12">
        <div class="ibox">
            <div class="ibox-title">
                <h5>Daftar Panitia Pemeriksa</h5>
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
                            <th width='15%'>SK</th>
                            <th>Judul SK </th>
                            <th>Tanggal </th>
                            <th>Tahun </th>
                            <th>Pemeriksa</th>
                            <th width='5%'>Aksi </th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $no=1; foreach ($data as $item): ?>
                        <tr>
                            <td class='text-center'><?= $no++ ?></td>
                            <td><?= $item['NoSk']; ?><br> <small><b>Kode :</b><?= $item['Kode']; ?></small><br> <small><b>Perihal :</b><?= $item['Perihal']; ?></small></td>
                            <td><?= $item['Nama']; ?></td>
                            <td><?= $CI->mylib->tgl_indo($item['Tanggal']); ?></td>
                            <td><?= $item['Tahun']; ?></td>
                            <td>
                                <?php
                                    if(!empty($item['DataPemeriksa'])){
                                        $iData = json_decode($item['DataPemeriksa'],true);
                                        foreach($iData as $pemeriksa){
                                            echo "<p>".$pemeriksa['Nama'];
                                            echo "<br><small>NIP : ".$pemeriksa['Nip']."</small>";
                                            echo "</p>";
                                        }
                                    }else{
                                        echo "-";
                                    }

                                ?>
                            </td>
                            <td class='text-center'>
                                <div class="btn-group">
                                    <button onclick="window.location='<?= base_url('panitia/edit/').$item['Id'] ?>'" data-toggle='tooltip' title='Ubah Data' class="btn btn-outline btn-primary btn-xs dim"><i class='fa fa-edit'></i></button>
                                    <button onclick="ShowConfirm('<?= $item['Id'] ?>')" data-toggle='tooltip' title='Hapus Data' class="btn btn-outline btn-danger btn-xs dim"><i class='fa fa-trash-o'></i></button>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                        
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>

<?php $this->load->view('panitia/main_js') ?>
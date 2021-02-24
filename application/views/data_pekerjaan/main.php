<?php 
$CI =& get_instance();
$CI->load->library('MyLib');
?>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-8">
        <h2>Data Pekrjaan Baru / Harga Perkiraan Sendiri</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="<?= base_url(); ?>">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">
                <strong>Data Pekrjaan Baru / Harga Perkiraan Sendiri</strong>
            </li>
        </ol>
    </div>
    <div class="col-sm-4">
        
    </div>
</div>

<div class="row wrapper wrapper-content animated fadeInRight">
    <div class="col-lg-12">
        <div class="ibox">
            <div class="ibox-title">
                <h5>Data Pekrjaan Baru / Harga Perkiraan Sendiri</h5>
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
                            <th>Pekerjaan</th>
                            <th>Anggaran Yang Dipakai </th>
                            <th>Tanggal </th>
                            <th>Pejabat</th>
                            <th width='5%'>Aksi </th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $no=1; foreach ($data as $item): 
                            $Anggran = json_decode($item['DataAnggaran'],true);
                            $Pejabat = json_decode($item['DataPejabat'],true);
                            
                        ?>
                        <tr>
                            <td class='text-center'><?= $no++ ?></td>
                            <td><?= $item['Pekerjaan']; ?><br> <small><b>Nomor Surat HPS :</b><?= $item['NoSurat']; ?></small></td>
                            <td><?= $Anggran['Nama']; ?><br> <small><b>No DIPA :</b><?= $Anggran['Nomor']; ?></small></td>
                            <td><?= $CI->mylib->tgl_indo($item['Tgl']); ?></td>
                            <td><?= $Pejabat['Nama']; ?><br> <small><b>NIP :</b><?= $Pejabat['Nip']; ?></small></td>
                            <td class='text-center'>
                                <div class="btn-group">
                                    <button onclick="window.location='<?= base_url('data_pekerjaan/cetak/').$item['Id'] ?>'" data-toggle='tooltip' title='Cetak HPS' class="btn btn-outline btn-success btn-xs dim"><i class='fa fa-print'></i></button>
                                    <button onclick="window.location='<?= base_url('data_pekerjaan/progres/').$item['Id'] ?>'" data-toggle='tooltip' title='Tambah Progress' class="btn btn-outline btn-info btn-xs dim"><i class='fa fa-plus-circle'></i></button>
                                    <button onclick="window.location='<?= base_url('data_pekerjaan/edit/').$item['Id'] ?>'" data-toggle='tooltip' title='Ubah Data' class="btn btn-outline btn-primary btn-xs dim"><i class='fa fa-edit'></i></button>
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

<?php $this->load->view('data_pekerjaan/main_js') ?>
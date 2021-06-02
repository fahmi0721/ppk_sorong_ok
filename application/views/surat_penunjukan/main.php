<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-8">
        <h2>Pengadaan Langsung / Surat Penunjukan</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="<?= base_url(); ?>">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">
                <strong>Pengadaan Langsung / Surat Penunjukan</strong>
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
                <h5>Pengadaan Langsung / Surat Penunjukan</h5>
                <div class="ibox-tools">
                    <a class="btn btn-xs btn-primary" href="<?= base_url("surat_penunjukan/form_tambah") ?>" data-toggle='tooltip' title="Tambah Surat Penunjukan"><i class="fa fa-plus"></i></a>
                    <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                </div>
            </div>
            <div class="ibox-content">
                <div class="table-responsive">
                    <table class="table table-striped dataTables-example" id="#TableData">
                        <thead>
                            <tr>
                                <th width='5px' class='text-center'>No</th>
                                <th>Surat</th>
                                <th>DIPA</th>
                                <th>Kepada </th>
                                <th width="20%">Pejabat</th>
                                <th width='5%'>Aksi </th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>

<?php $this->load->view('surat_penunjukan/main_js') ?>
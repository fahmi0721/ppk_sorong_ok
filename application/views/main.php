<?php
$CI =& get_instance();
$CI->load->library('MyLib');
?>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-3">
            <div class="ibox ">
                <div class="ibox-title">
                    <!-- <span class="label label-success float-right">All</span> -->
                    <h5>Vendor</h5>
                </div>
                <div class="ibox-content">
                    <h1 class="no-margins"><?= $CI->mylib->rupiah1($tot_vendor) ?></h1>
                    <!-- <div class="stat-percent font-bold text-success">98% <i class="fa fa-bolt"></i></div> -->
                    <small>Total Vendor</small>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="ibox ">
                <div class="ibox-title">
                    <span class="label label-info float-right">Tahun ini</span>
                    <h5>Pekerjaan</h5>
                </div>
                <div class="ibox-content">
                    <h1 class="no-margins">20</h1>
                    <!-- <div class="stat-percent font-bold text-info">20% <i class="fa fa-level-up"></i></div> -->
                    <small>Telah Selesai</small>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="ibox ">
                <div class="ibox-title">
                    <span class="label label-primary float-right">Bulan ini</span>
                    <h5>Pekerjaan</h5>
                </div>
                <div class="ibox-content">
                    <h1 class="no-margins">2</h1>
                    <!-- <div class="stat-percent font-bold text-navy">44% <i class="fa fa-level-up"></i></div> -->
                    <small>Telah Selesai</small>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="ibox ">
                <div class="ibox-title">
                    <span class="label label-warning float-right">Tahun ini</span>
                    <h5>Pekerjaan</h5>
                </div>
                <div class="ibox-content">
                    <h1 class="no-margins"><?= $CI->mylib->rupiah1($tahun_ini_jalan) ?></h1>
                    <!-- <div class="stat-percent font-bold text-danger">38% <i class="fa fa-level-down"></i></div> -->
                    <small>Dalam Proses</small>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="ibox">
            <div class="ibox-title">
                <h5>Daftar Progres Pekerjaan </h5>
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

                            <th>#</th>
                            <th>Pekerjaan </th>
                            <th>No SPK </th>
                            <th>Vendor </th>
                            <th>Progress </th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                            if($row > 0){
                            foreach($data as $item):
                            $pp = json_decode($item['DataPP'],true);
                            $vendor = json_decode($pp['DataVendor'],true);
                            $hps = json_decode($pp['DataHps'],true);
                        ?>
                        <tr>
                            <td>1</td>
                            <td><?= $hps['Pekerjaan'] ?></td>
                            <td><?= $item['NoSpk'] ?></td>
                            <td><?= $vendor['Nama'] ?></td>
                            <td><?= $CI->progres($hps['Id']) ?>%</td>
                        </tr>
                        <?php 
                            endforeach;
                        }else{ ?>
                            <tr>
                            <td colspan='5'>Pekerjaan belum dibuat</td>
                        </tr>
                        <?php } ?>
                        
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        ShowdataTable();
    })
    function ShowdataTable(){
        $('.dataTables-example').DataTable({
            pageLength: 25,
            responsive: true,
            ordering: false,
            dom: '<"html5buttons"B>lTfgitp',
            buttons: [
                {extend: 'excel', title: 'DataProgress'},
                {extend: 'print',
                    customize: function (win){
                        $(win.document.body).addClass('white-bg');
                        $(win.document.body).css('font-size', '10px');

                        $(win.document.body).find('table')
                                .addClass('compact')
                                .css('font-size', 'inherit');
                }
                }
            ]

        });
    }
</script>
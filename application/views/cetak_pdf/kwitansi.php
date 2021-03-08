<?php 
$CI =& get_instance();
$CI->load->library('MyLib');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BERITA ACARA SERAH PEMBAYARAN
    <style>
        @media print {
            body{
                width: 21cm;
                height: 29.7cm;
                margin: 24mm 25mm 30mm 45mm; 
                /* change the margins as you want them to be. */
            } 
        }
        @page {
            size: 21cm 29.7cm;
            margin: 15mm 20mm 15mm 20mm;
            /* change the margins as you want them to be. */
        }
        body{
            font-family: Arial, Helvetica, sans-serif;
            font-size: 14px;
            border: solid 1px #777;
        }
        
        p.title{
            padding:0;
            margin:0;
        }
        .bold{
            font-weight: bold;
        }
        .text-center{
            text-align : center;
        }
        .text-justify{ text-align:justify;}
        .text-right{ text-align:right;}
    </style>
</head>
<body>
    <?php
        $ba_bayar = json_decode($data['DataBaBayar'],true);
        $bastb = json_decode($ba_bayar['DataBastb'],true);
        $baphp = json_decode($bastb['DataBaPhp'],true);
        $pphp = json_decode($baphp['DataPphp'],true);
        $spk = json_decode($pphp['DataSpk'],true);
        $pp = json_decode($spk['DataPP'],true);
        $hps = json_decode($pp['DataHps'],true);
        $anggaran = json_decode($hps['DataAnggaran'],true);
        $vendor = json_decode($pp['DataVendor'],true);
        $pejabat = json_decode($data['DataPejabat'],true);
        $pejabattj = json_decode($data['DataPejabatTj'],true);

    ?>

    <table width='100%'>
        <tr>
            <td class='text-right' width='70%' valign='top'>TA</td>
            <td width='10%' class='text-center' valign='top'>:</td>
            <td><?= $anggaran['Tahun'] ?></td>
        </tr>
        <tr>
            <td class='text-right' width='70%' valign='top'>Nomor bukti</td>
            <td width='10%' class='text-center' valign='top'>:</td>
            <td><?= $data['NoBukti'] ?></td>
        </tr>
        <tr>
            <td class='text-right' width='70%' valign='top'>MAK</td>
            <td width='10%' class='text-center' valign='top'>:</td>
            <td></td>
        </tr>
    </table>
    <br>
    <br>
    <h4 class='text-center'>KUITANSI/BUKTI PEMBAYARAN</h4>
    <table width='100%'>
        <tr>
            <td  width='20%' valign='top'>Sudah terima dari </td>
            <td width='5%' class='text-center' valign='top'>:</td>
            <td>Pejabat Pembuat Komitmen <br>POLITEKNIK PELAYARAN SORONG<br><br></td>
        </tr>

        <tr>
            <td  width='20%' valign='top'>Jumlah uang </td>
            <td width='5%' class='text-center' valign='top'>:</td>
            <td>Rp. <?= $CI->mylib->rupiah1($pp['HargaSepakat']) ?>.,-<br><br></td>
        </tr>
        <tr>
            <td  width='20%' valign='top'>Terbilang </td>
            <td width='5%' class='text-center' valign='top'>:</td>
            <td>"<?= $CI->mylib->Terbilang($pp['HargaSepakat']) ?>"<br><br></td>
        </tr>
        <tr>
            <td  width='20%' valign='top'>Untuk </td>
            <td width='5%' class='text-center' valign='top'>:</td>
            <td><?= $hps['Pekerjaan'] ?><br><br></td>
        </tr>
        
    </table>

    <table width='100%'>
        <tr>
            <td class='text-center'  width='50%' valign='top'>
            a.n.Kuasa Pengguna Anggaran<br>
            Pejabat Pembuat Komitmen <br>
            Badan Layanan Umum (BLU)<br>
            <br><br><br><br><br>

            <u><b><?= $pejabat['Nama'] ?></b></u><br>
            NIP. <?= $pejabat['Nip'] ?>

            </td>
            <td width='50%' class='text-center' valign='top'>
            Sorong, <?= $CI->mylib->tgl_indo($data['Tgl']) ?><br>
            <br>
            <?= $vendor['Nama'] ?><br>
            <br><br><br><br><br>

            <u><b><?= $vendor['Nama'] ?></b></u><br>
            <?= $vendor['Jabatan'] ?>
            </td>
        </tr>
        <hr />
        <span style='clear:both'></span>

       
        
    </table>
    <p style='padding-left:35px;' class='text-justify'>Barang/pekerjaan tersebut telah diterima/diselesaikan dengan lengkap dan baik Pejabat yang bertanggung jawab</p>
    <table width='100%'>
        <tr>
            <td class='text-center'  width='50%' valign='top'>
            <br><br><br><br><br>

            <u><b><?= $pejabattj['Nama'] ?></b></u><br>
            NIP. <?= $pejabattj['Nip'] ?>

            </td>
            <td width='50%' class='text-center' valign='top'></td>
        </tr>
        <span style='clear:both'></span>

       
        
    </table>
</body>
</html>
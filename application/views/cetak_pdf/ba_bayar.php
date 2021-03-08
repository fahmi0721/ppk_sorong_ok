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
    </style>
</head>
<body>
    <?php
        $bastb = json_decode($data['DataBastb'],true);
        $baphp = json_decode($bastb['DataBaPhp'],true);
        $pphp = json_decode($baphp['DataPphp'],true);
        $spk = json_decode($pphp['DataSpk'],true);
        $pp = json_decode($spk['DataPP'],true);
        $hps = json_decode($pp['DataHps'],true);
        $anggaran = json_decode($hps['DataAnggaran'],true);
        $vendor = json_decode($pp['DataVendor'],true);
        $pejabat = json_decode($data['DataPejabat'],true);

    ?>
    <p class='text-center bold title'><u>B E R I T A &nbsp; A C A R A &nbsp; P E M B A Y A R A N</u></p>
    <p class='text-center bold title'>NOMOR : <?= $data['NoSurat'] ?></p>
    <p class='text-justify'>Pada hari ini <b><?= $CI->mylib->hari_indo($data['Tgl']) ?></b> , kami yang bertanda tangan dibawah ini :</p>
    <table width='100%'>
        <tr>
            <td valign='top' width='8%'>1. </td>
            <td valign='top' width='15%'>N a m a</td>
            <td valign='top' width='5%'>:</td>
            <td valign='top'><?= $pejabat['Nama'] ?></td>
        </tr>
        <tr>
            <td valign='top'></td>
            <td valign='top'>J a b a t a n</td>
            <td valign='top'>:</td>
            <td valign='top'><?= $pejabat['Jabatan'] ?></td>
        </tr>
        <tr>
            <td valign='top'></td>
            <td valign='top'>A l a m a t</td>
            <td valign='top'>:</td>
            <td valign='top'><?= $pejabat['Alamat'] ?></td>
        </tr>
        <tr>
            <td valign='top'></td>
            <td valign='top' colspan='3'>Dalam hal ini selanjutnya disebut PIHAK PERTAMA<br><br></td>
        </tr>

        <tr>
            <td valign='top'>2. </td>
            <td valign='top'>N a m a</td>
            <td valign='top'>:</td>
            <td valign='top'><?= $vendor['NamaPimpinan'] ?></td>
        </tr>
        
        <tr>
            <td valign='top'></td>
            <td valign='top'>J a b  a t a n</td>
            <td valign='top'>:</td>
            <td valign='top'><?= $vendor['Jabatan'] ?> <?= $vendor['Nama'] ?></td>
        </tr>
        <tr>
            <td valign='top'></td>
            <td valign='top'>A l a m a t</td>
            <td valign='top'>:</td>
            <td valign='top'><?= $vendor['Alamat'] ?></td>
        </tr>
        <tr>
            <td valign='top'></td>
            <td valign='top' colspan='3'>Dalam hal ini selanjutnya disebut PIHAK KEDUA</td>
        </tr>
    </table>
    <br>
    <table width='100%' cellspacing='0' class='text-justify'>
        <tr>
            <td valign='top' width='8%'>A. </td>
            <td valign='top' width='25%'>Berdasarkan :</td>
            <td valign='top' colsnap='2'></td>
        </tr>
        <tr>
            <td valign='top' width='8%'></td>
            <td valign='top'>Nomor & tanggal DIPA</td>
            <td valign='top' width='3%'>:</td>
            <td valign='top'><?= $anggaran['Nomor'] ?> Tanggal <?= $CI->mylib->tgl_indo($anggaran['Tanggal']) ?></td>
        </tr>
        <tr>
            <td valign='top' width='8%'></td>
            <td valign='top'>Nomor & tanggal SPK</td>
            <td valign='top' width='3%'>:</td>
            <td valign='top'><?= $spk['NoSpk'] ?> Tanggal <?= $CI->mylib->tgl_indo($spk['Tgl']) ?></td>
        </tr>
        <tr>
            <td valign='top' width='8%'></td>
            <td valign='top'>Nilai Pekerjaan</td>
            <td valign='top' width='3%'>:</td>
            <td valign='top'>Rp. <?= $CI->mylib->rupiah1($pp['HargaSepakat']) ?>.,- (<?= $CI->mylib->Terbilang($pp['HargaSepakat']) ?>). Harga sudah termasuk PPN 10%</td>
        </tr>

        <tr>
            <td valign='top' width='8%'></td>
            <td valign='top'>Nama Pekerjaan</td>
            <td valign='top' width='3%'>:</td>
            <td valign='top'><?= $hps['Pekerjaan'] ?><br><br></td>
        </tr>

        <tr>
            <td valign='top' width='8%'>B.</td>
            <td valign='top' colspan='3'>Sesuai dengan Berita Acara Pemeriksaan Pekerjaan Nomor <?= $baphp['NoSurat'] ?> tanggal <?= $CI->mylib->tgl_indo($baphp['Tgl']) ?>, maka PIHAK KEDUA berhak menerima pembayaran dari PIHAK PERTAMA, sebesar Rp. <?= $CI->mylib->rupiah1($pp['HargaSepakat']) ?>.,- (<?= $CI->mylib->Terbilang($pp['HargaSepakat']) ?>). Harga sudah termasuk PPN 10%<br><br></td>
        </tr>
        <tr>
            <td valign='top' width='8%'>C.</td>
            <td valign='top' colspan='3'>PIHAK KEDUA setuju atas jumlah pembayaran tersebut di atas dan dibayarkan ke rekening <b><?= $vendor['Bank'] ?> Rek. No. <?= $vendor['NoRek'] ?></b></td>
        </tr>
        <p class="text-justify">Demikian Berita Acara ini dibuat dan dapat dipergunakan sebagaimana mestinya.</p>
        
    </table>
    <br>
    <table width='100%'>
        <tr>
            <td width='60%' class='text-center'></td>
            <td width='40%' class='text-justify' style='border-bottom:1px solid #777;'>
                D i b u a t di &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: &nbsp;&nbsp;&nbsp;<?= $data['Dibuatdi'] ?><br>
                T a n g g a l  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: &nbsp;&nbsp;&nbsp;<?= $CI->mylib->tgl_indo($data['Tgl']) ?>
            </td>
        </tr>
    </table>
    <br>
    <br>
    <table width='100%'>
        <tr>
            <td width='50%' class='text-center'>
                PIHAK KEDUA <br>
                <?= $vendor['Nama'] ?>
                <br><br><br><br><br><br>
                <u><?= $vendor['NamaPimpinan'] ?></u><br>
                <?= $vendor['Jabatan'] ?>
            </td>
            <td width='50%' class='text-center'>
                PIHAK KESATU <br>
                KUASA PENGGUNA ANGGARAN,<br>
                <br><br><br><br><br>
                <u><?= $pejabat['Nama'] ?></u><br>
                NIP. <?= $pejabat['Nip'] ?>
            </td>
        </tr>
        
    </table>
</body>
</html>
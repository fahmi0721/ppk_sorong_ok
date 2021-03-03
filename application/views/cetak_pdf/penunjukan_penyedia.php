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
    <title>Surat Penunjukan Penyedia/Vendor</title>
    <style>
        @media print {
            body{
                width: 21cm;
                height: 29.7cm;
                margin: 30mm 45mm 30mm 45mm; 
                /* change the margins as you want them to be. */
            } 
        }
        @page {
            size: 21cm 29.7cm;
            margin: 20mm 20mm 20mm 20mm;
            /* change the margins as you want them to be. */
        }
        body{
            font-family: Arial, Helvetica, sans-serif;
            font-size: 12px;
        }
        .text-center{ text-align : center; }
        .text-top{ vertical-align : text-top; }
        .text-justify{ text-align : justify; }
        .text-bold{ text-align : justify; font-weight: bold; }
        .table-body{ width: 100%; }
        .tinggi-ttd{ height: 80px;}
        .tinggi-spasi{ height: 20px;}
    </style>
</head>
<body>
    <table class='table-body'>
        <tr>
            <td class='text-top' width='14%'>Nomor</td>
            <td class='text-center text-top' width='1%'>:</td>
            <td width='50%'>PL.102/21/12/Poltekpel.Btn-2020</td>
            <td width='35%'>Sorong, <?= $CI->mylib->tgl_indo($data['Tgl']) ?></td>
        </tr>
        <tr>
            <td class='text-top' width='10%'>Lampiran</td>
            <td class='text-center text-top' width='1%'>:</td>
            <td colspan='2'></td>
        </tr>
        <tr>
            <td class='text-top' width='10%'>Perihal</td>
            <td class='text-center text-top' width='1%'>:</td>
            <td colspan='2' class='text-bold'>Penunjukan Penyedia</td>
        </tr>
        <tr>
            <td class='text-top tinggi-spasi' colspan='4'></td>
        </tr>
        <tr>
            <td class='text-top' colspan='4'>Kepada Yth.</td>
        </tr>
        <tr>
            <?php 
                $Vendor = json_decode($data['DataVendor'],true);
            ?>
            <td class='text-top' colspan='4'><?= $Vendor['Nama']; ?></td>
        </tr>
        <tr>
        <td class='text-top' colspan='4'><?= $Vendor['Alamat']; ?></td>
        </tr>
        <tr>
            <td class='text-top tinggi-spasi' colspan='4'></td>
        </tr>
        <tr>
            <td class='text-top' width='10%'>Perihal</td>
            <td class='text-center text-top' width='1%'>:</td>
            <?php 
                $hps = json_decode($data['DataHps'],true);
            ?>
            <td colspan='2' class='text-justify'>Penunjukan Penyedia untuk Pelaksanaan Paket Pekerjaan  <b><?= $hps['Pekerjaan']; ?></td>
        </tr>
        <tr>
            <td class='text-top tinggi-spasi' colspan='4'></td>
        </tr>
        <tr>
            <td class='text-top text-justify' colspan='4'>Dengan ini kami beritahukan berdasarkan penawaran Saudara tanggal <?= $CI->mylib->tgl_indo($data['TglPenawaran']) ?> perihal <?= $hps['Pekerjaan']; ?> dengan penawaran setelah negosiasi adalah sebesar Rp. <?= $CI->mylib->rupiah1($data['HargaSepakat']) ?>. ,- <b>(<?= $CI->mylib->Terbilang($data['HargaSepakat']) ?>)</b> kami nyatakan diterima/disetujui </td>
        </tr>
        <tr>
            <td class='text-top tinggi-spasi' colspan='4'></td>
        </tr>
        <tr>
            <td class='text-top text-justify' colspan='4'>Surat Perjanjian. Kegagalan Saudara untuk menerima penunjukan ini yang disusun berdasarkan evaluasi terhadap penawaran Saudara akan dikenakan sanksi sesuai dengan ketentuan yang tercantum dalam Peraturan Presiden No.16 Tahun 2018 tentang Pengadaan Barang/Jasa Pemerintah.</td>
        </tr>
        <tr>
            <td class='text-top tinggi-spasi' colspan='4'></td>
        </tr>
        <tr>
            <td class='text-top' colspan='3'>&nbsp;</td>
            <td width='20%' class='text-top text-center'>POLITEKNIK PELAYARAN SORONG</td>
        </tr>
        <tr>
            <td class='text-top' colspan='3'>&nbsp;</td>
            <td width='20%' class='text-top text-center'>PEJABAT PEMBUAT KOMITMEN</td>
        </tr>
        <tr>
            <td class='text-top' colspan='3'>&nbsp;</td>
            <td width='20%' class='text-top text-center'>BADAN LAYANAN UMUM (BLU)</td>
        </tr>
        <tr>
            <td class='text-top tinggi-ttd' colspan='3'></td>
            <td width='20%' class='text-top text-center'></td>
        </tr>
        <tr>
            <td class='text-top' colspan='3'>&nbsp;</td>
            <td width='20%' class='text-top text-center'><u>SANDY WAHYU PURNOMO</u></td>
        </tr>
        <tr>
            <td class='text-top' colspan='3'>&nbsp;</td>
            <td width='20%' class='text-top text-center'>NIP. 19900318 201503 1 006</td>
        </tr>
        
    </table>
</body>
</html>
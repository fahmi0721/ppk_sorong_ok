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
    <title>BERITA ACARA SERAH TERIMA BARANG </title>
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
        $baphp = json_decode($data['DataBaPhp'],true);
        $pphp = json_decode($baphp['DataPphp'],true);
        $spk = json_decode($pphp['DataSpk'],true);
        $pp = json_decode($spk['DataPP'],true);
        $hps = json_decode($pp['DataHps'],true);
        $vendor = json_decode($pp['DataVendor'],true);
        $pejabat = json_decode($data['DataPejabat'],true);

    ?>
    <p class='text-center bold title'><u>BERITA ACARA SERAH TERIMA BARANG</u></p>
    <p class='text-center bold title'>NOMOR : <?= $data['NoSurat'] ?></p>
    <br>
    <p class='text-justify'>Pada hari ini <?= $CI->mylib->hari_indo($data['Tgl']) ?> , kami yang bertanda tangan dibawah ini :</p>
    <table width='100%'>
        <tr>
            <td valign='top' width='8%'>1. </td>
            <td valign='top' width='15%'>N a m a</td>
            <td valign='top' width='5%'>:</td>
            <td valign='top'><?= $pejabat['Nama'] ?></td>
        </tr>
        <tr>
            <td valign='top'></td>
            <td valign='top'>NIP</td>
            <td valign='top'>:</td>
            <td valign='top'><?= $pejabat['Nip'] ?></td>
        </tr>
        <tr>
            <td valign='top'></td>
            <td valign='top'>Jabatan</td>
            <td valign='top'>:</td>
            <td valign='top'><?= $pejabat['DeskripsiJabatan'] ?></td>
        </tr>
        <tr>
            <td valign='top'></td>
            <td valign='top'>Alamat</td>
            <td valign='top'>:</td>
            <td valign='top'><?= $pejabat['Alamat'] ?><br><br></td>
        </tr>
        <tr>
            <td valign='top'></td>
            <td valign='top'></td>
            <td valign='top'></td>
            <td valign='top'>Yang selanjutnya disebut sebagai PIHAK KESATU<br><br></td>
        </tr>

        <tr>
            <td valign='top'>2. </td>
            <td valign='top'>N a m a</td>
            <td valign='top'>:</td>
            <td valign='top'><?= $vendor['NamaPimpinan'] ?></td>
        </tr>
        
        <tr>
            <td valign='top'></td>
            <td valign='top'>Jabatan</td>
            <td valign='top'>:</td>
            <td valign='top'><?= $vendor['Jabatan'] ?> <?= $vendor['Nama'] ?></td>
        </tr>
        <tr>
            <td valign='top'></td>
            <td valign='top'>Alamat</td>
            <td valign='top'>:</td>
            <td valign='top'><?= $vendor['Alamat'] ?><br><br></td>
        </tr>
        <tr>
            <td valign='top'></td>
            <td valign='top'></td>
            <td valign='top'></td>
            <td valign='top'>Yang selanjutnya disebut sebagai PIHAK KEDUA</td>
        </tr>
    </table>
    <p class='text-justify'>Bahwa sehubungan dengan selesainya pelaksanaan pekerjaan :</p>
    <table width='100%'>
        <tr>
            <td width='25%'>Nama Pekerjaan</td>
            <td width='5%'>:</td>
            <td><?= $hps['Pekerjaan'] ?></td>
        </tr>
        <tr>
            <td>Nomor Kontrak/SPK</td>
            <td>:</td>
            <td><?= $spk['NoSpk'] ?></td>
        </tr>
        <tr>
            <td>Tanggal Kontrak/SPK</td>
            <td>:</td>
            <td><?= $CI->mylib->tgl_indo($spk['Tgl']) ?></td>
        </tr>
        <tr>
            <td>Lama/Tanggal <br>Pelaksanaan  </td>
            <td>:</td>
            <td><?= $CI->mylib->rupiah1($spk['WaktuKerja']) ?> (<?= $CI->mylib->Terbilang($spk['WaktuKerja']) ?>) tanggal <?= $CI->mylib->tgl_indo($spk['TglDari']) ?> s.d <?= $CI->mylib->tgl_indo($spk['TglSampai']) ?></td>
        </tr>
    </table>
    <p class='text-justify'>Dengan memperhatikan Berita Acara Pemeriksaan Hasil Pekerjaan Nomor :   <?= $baphp['NoSurat'] ?> tanggal  <?= $CI->mylib->tgl_indo($baphp['Tgl']) ?>, maka dengan ini menyatakan sebagai berikut :
    </p>

    <p class='text-justify'> 
        <ol style="padding-left:18px">
            <li>PIHAK KEDUA melakukan penyerahan barang sebagaimana dimaksud kepada PIHAK KESATU.</li>
            <li>PIHAK KESATU menerima penyerahan barang yang diserahkan oleh PIHAK KEDUA.</li>
            <li>Terhadap hal-hal yang berkenaan dengan pasca serah terima pertama hasil pekerjaan ini tetap mengacu pada ketentuan SPK nomor PL.103/1/2/POLTEKPEL.SRG-2022 tanggal 07 Agustus 2020 dan ketentuan peraturan yang berlaku.</li>
        </ol>
    </p>
    <p class='text-justify'>Demikian Berita Acara Serah Terima Barang ini dibuat dengan sebenarnya guna bahan selanjutnya.</p>
    <table width='100%'>
        <tr>
            <td width='50%' class='text-center'>
                Yang Menyerahkan :<br>
                PIHAK KEDUA <br>
                <?= $vendor['Nama'] ?>
                <br><br><br><br><br><br>
                <u><?= $vendor['NamaPimpinan'] ?></u>
                <?= $vendor['Jabatan'] ?>
            </td>
            <td width='50%' class='text-center'>
                Yang Menerima :<br>
                PIHAK KESATU <br>
                PEJABAT PEMBUAT KOMITMEN<br>
                BADAN LAYANAN UMUM (BLU),<br>
                <br><br><br><br><br>
                <u><?= $pejabat['Nama'] ?></u><br>
                NIP. <?= $pejabat['Nip'] ?>
            </td>
        </tr>
        
    </table>
</body>
</html>
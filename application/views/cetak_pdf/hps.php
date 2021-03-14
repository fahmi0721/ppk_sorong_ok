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
    <title>Surat Penetapan Harga Perkiraan Sendiri</title>
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
            font-size: 14px;
        }
        ul.b li{
            list-style-position: outside;
            padding:0;
            margin:0;
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
    </style>
</head>
<body>
    <p class='text-center bold title'>SURAT PENETAPAN</p>
    <p class='text-center bold title'><u>HARGA PERKIRAAN SENDIRI (HPS)</u></p>
    <p class='text-center bold title'>Nomor : <?= $hps['NoSurat'] ?></p>
    <br>
    <table width='100%' border='0' celpadding=0 cellspacing=0>
        <tr>
            <td width='15%' valign='top'>Pekerjaan</td>
            <td valign='top' class='text-center' width='5px'>:</td>
            <td valign='top'><?= $hps['Pekerjaan'] ?></td>
        </tr>
        <tr>
            <td valign='top'>Kantor</td>
            <td class='text-center'>:</td>
            <td valign='top'>Politeknik Pelayaran Sorong</td>
        </tr>
        <tr>
            <td>Dana</td>
            <td class='text-center'>:</td>
            <td>
                <?php
                    $Dana = json_decode($hps['DataAnggaran'],true);
                    echo $Dana['Nama']." Tahun Anggran ".$Dana['Tahun']." Nomor ".$Dana['Nomor']." Tanggal ".$CI->mylib->tgl_indo($Dana['Tanggal']);
                ?>
            </td>
        </tr>
    </table>
    <hr>
    <table width='100%' border='0' celpadding=0 cellspacing=0>
        <tr>
            <td width='20px' valign='top'>1. </td>
            <td valign='top' align='justify'>Pada hari ini, <b><?= $CI->mylib->hari_indo($hps['Tgl']) ?></b> , bertempat di ruang rapat kantor Politeknik Pelayaran Sorong, saya yang bertanda tangan di bawah ini Pejabat Pembuat Komitmen Pada Politeknik Pelayaran Sorong Tahun Anggaran <?= $Dana['Tahun'] ?>, telah menyusun pembuatan Harga Perkiraan Sendiri (HPS) pekerjaan <span style='text-transform: lowercase;'><?= $hps['Pekerjaan'] ?></span> yang dibiayai dari anggaran DIPA Politeknik Pelayaran Sorong Tahun Anggaran <?= $Dana['Tahun'] ?> Nomor <?=  $Dana['Nama']." Tahun Anggran ".$Dana['Tahun']." Nomor ".$Dana['Nomor']." Tanggal ".$CI->mylib->tgl_indo($Dana['Tanggal']); ?>.
            <br>
            <br>
            </td>
        </tr>
        <tr>
            <td width='3px' valign='top' class='b'>2. </td>
            <td valign='top' align='justify'>Dalam melakukan pembahasan dan penyusunan untuk menentukan Harga Perkiraan Sendiri (HPS), Pejabat Pembuat Komitmen berpedoman pada Peraturan Presiden Republik Indonesia Nomor 16 Tahun 2018 tentang Pengadaan Barang/Jasa Pemerintah, menggunakan data dasar dan pertimbangan :
            <ul type='a' class='list-inline' style='list-style'>
                <li>Penelitian harga pasar setempat.</li>
                <li>Harga kontrak atau SPK sebelumnya.</li>
                <li>Analisa harga.</li>
            </ul>
            Harga satuan atas pekerjaan tersebut sebagaimana terlampir.
            <br>
            <br>
            </td>
        </tr>
        <tr>
            <td valign='top' align='justify'>3. </td>
            <td>Demikian Surat Penetapan ini dibuat untuk dapat digunakan sebagaimana mestinya.</td>
        </tr> 
    </table>
    <br>
    <br>
    <br>
    <table border='0' width='100%' cellspacing=0; cellpadding=0>
        <tr>
            <td width='30%'>Sorong, <?= $CI->mylib->tgl_indo($hps['Tgl']) ?></td>
            <td></td>
        </tr>
        <tr>
            <td height='70px' valign='top'><u>Pejabat Pembuat  Komitmen : </u><br>Badan Layanan umum (BLU)</td>
            <td></td>
        </tr>
        <tr>
            <?php 
                $Pejabat = json_decode($hps['DataPejabat'],true);
            ?>
            <td><br><br><u><?= $Pejabat['Nama'] ?></u><br>NIP. <?= $Pejabat['Nip'] ?></td>
            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;..............................................</td>
        </tr>
    </table>
</body>
</html>
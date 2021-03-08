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
    <title>BERITA ACARA PEMERIKSAAN HASIL PEKERJAAN </title>
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
        .text-justify{ text-align:justify;}
    </style>
</head>
<body>
    <?php
        $pphp = json_decode($data['DataPphp'],true);
        $spk = json_decode($pphp['DataSpk'],true);
        $pp = json_decode($spk['DataPP'],true);
        $vendor = json_decode($pp['DataVendor'],true);
        $pemeriksa = json_decode($data['DataPemeriksa'],true);

    ?>
    <p class='text-center bold title'><u>BERITA ACARA PEMERIKSAAN HASIL PEKERJAAN</u></p>
    <p class='text-center bold title'>NOMOR : <?= $data['NoSurat'] ?></p>
    <br>
    <p class='text-justify'>Berdasarkan surat Pejabat Pembuat Komitmen pekerjaan pemeliharaan kelas sorong Nomor : <?= $pphp['NoSurat'] ?> tanggal <?= $CI->mylib->tgl_indo($pphp['Tgl']) ?> tentang Permintaan Pemeriksaan Hasil Pengadaan Barang/Jasa maka pada hari ini <b><?= $CI->mylib->hari_indo($data['Tgl']) ?></b>, kami yang bertanda tangan dibawah ini :</p>
    <p>
        <ul type='I'>
            <li class='text-justify'> 
                <?= $pemeriksa['Nama'] ?><br>
                Berdasarkan Surat Keputusan Direktur Politeknik Pelayaran Banten Nomor : <?= $pemeriksa['NoSk'] ?> tanggal <?= $CI->mylib->tgl_indo($pemeriksa['Tanggal']) ?> tentang <?= $pemeriksa['Perihal'] ?> Tahun Anggaran <?= $pemeriksa['Tahun'] ?>.
                <p>Yang selanjutnya disebut sebagai PIHAK KESATU</p>
            </li>
            <li>Penyedia Barang/Jasa : <?= $vendor['NamaPimpinan'] ?> selaku <?= $vendor['Jabatan'] ?> <?= $vendor['Nama'] ?>
                <p>Yang selanjutnya disebut sebagai PIHAK KEDUA</p>
            </li>
        </ul>
    </p>
    <p class='text-justify'>
    bahwa sehubungan pekerjaan pemeliharaan kelas sorong sesuai SPK Nomor : <?= $spk['NoSpk'] ?> tanggal <?= $CI->mylib->tgl_indo($spk['Tgl']) ?> dan setelah dilakukan pemeriksaan dan penilaian oleh PIHAK KESATU, dengan ini menyatakan sebagai berikut:
    </p>
    <ol style='margin-left:19px; padding:0;'>
        <li style='margin-bottom:15px;'>Semua barang hasil pengadaan tersebut yang diperiksa dan dinilai oleh PIHAK KESATU adalah sebagaimana terlampir :</li>
        <li style='margin-bottom:15px;'>Hasil pemeriksaan dan penilaian adalah sebagai berikut :<br>Barang-barang tersebut telah sesuai dengan spesifikasi, jumlah dan dalam kondisi baik, lengkap serta dapat dioperasikan dengan sebagaimana mestinya.</li>
        <li>Selanjutnya kepada PPK dapat direkomendasikan untuk melanjutkan ke proses serah terima barang atas pekerjaan tersebut.</li>
    </ol>
    <p class='text-justify'>
    Demikian Berita Acara Pemeriksaan Hasil Pekerjaan ini dibuat dengan sebenarnya guna bahan selanjutnya.
    </p>
    <br>
    <table width='100%'>
        <tr>
            <td width='50%' class='text-center' valign='top'>
            PIIHAK KEDUA<br>
            Penyedia Barang dan Jasa<br>
            <?= $vendor['Nama'] ?>
            <br><br><br><br><br><br>
            <u><?= $vendor['NamaPimpinan'] ?></u><br>
            <?= $vendor['Jabatan'] ?>

            </td>
            <td width='50%' valign='top'>
            <div class='text-center'>PIIHAK KESATU<br>
            Panitia Penerima Hasil Pekerjaan :</div>
            <br>
            <table width='100%'>
                <?php
                    $DataPemeriksa = json_decode($pemeriksa['DataPemeriksa'],true);
                    $NO=1;
                    if(count($DataPemeriksa) > 0){
                    foreach($DataPemeriksa as $item):
                    $Nama = $item['Nama'];
                    $Nip = $item['Nip'];
                ?>  
                <tr>
                    <td width='5px' valign='top' height=60px'><?= $NO ?>. </td>
                    <td valign='top'><u><?= $Nama ?></u><br><?= $Nip ?></td>
                    <td valign='top' width='20px'>..........................</td>
                </tr>
                <?php $NO++; endforeach; } ?>
            </table>
            </td>
        </tr>
    </table>
</body>
</html>
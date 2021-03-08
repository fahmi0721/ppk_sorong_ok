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
    <title>Panitia Pemeriksaan Hasil Pekerjaan Barang/Jasa</title>
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
            position:relative;
        }
        .tembusan{ position:absolute; bottom:0;}
        .text-center{ text-align : center; }
        .text-top{ vertical-align : text-top; }
        .text-justify{ text-align : justify; }
        .text-bold{ text-align : justify; font-weight: bold; }
        .table-body{ width: 100%; }
        .tinggi-ttd{ height: 80px;}
        .tinggi-spasi{ height: 20px;}
        .p1{ line-height:17px; text-align:justify}
        .text-capital{ text-transform:capitalize; }
        ul.number{padding-left:10px;}
        .number li{ list-style-type:decimal; list-style-position:inside;}
        .margin-lft { margin-left:15px; }
        .margin-lfts { margin-left:30px; }
        .text-lower { text-transform:lowercase}
    </style>
</head>
<body>
    <table class='table-body'>
        <tr>
            <td class='text-top' width='14%'>Nomor</td>
            <td class='text-center text-top' width='1%'>:</td>
            <td width='50%'>PL.102/21/12/Poltekpel.Btn-2020</td>
            <td width='35%' colspan='2'>Sorong, <?= $CI->mylib->tgl_indo($data['Tgl']) ?></td>
        </tr>
        <tr>
            <td class='text-top' width='10%'>Lampiran</td>
            <td class='text-center text-top' width='1%'>:</td>
            <td colspan='3'>1 Lembar</td>
        </tr>
        <tr>
            <td class='text-top'>Perihal</td>
            <td class='text-center text-top' width='1%'>:</td>
            <td class='text-bold'>Panitia Pemeriksaan</td>
            <td class='text-top' width='7%'></td>
            <td class='text-top'>Kepada</td>

        </tr>
        <tr>
            <td class='text-top'></td>
            <td class='text-center text-top' width='1%'></td>
            <td class='text-bold'>Hasil Pengadaan Barang/Jasa</td>
            <td class='text-top'></td>
            <td class='text-top'></td>
        </tr>
        <tr>
            <td class='text-top'></td>
            <td class='text-center text-top' width='1%'></td>
            <td class='text-bold'></td>
            <td class='text-top'>Yth. </td>
            <td class='text-top'>Panitia Penerima Hasil</td>
        </tr>
        <tr>
            <td class='text-top'></td>
            <td class='text-center text-top' width='1%'></td>
            <td class='text-bold'></td>
            <td class='text-top'></td>
            <td class='text-top'>Pekerjaan</td>
        </tr>
        <tr>
            <td class='text-top'></td>
            <td class='text-center text-top' width='1%'></td>
            <td class='text-bold'></td>
            <td class='text-top'></td>
            <td class='text-top'>pada Politeknik Pelayaran Sorong</td>
        </tr>
        <tr>
            <td class='text-top' height='20px'></td>
            <td class='text-center text-top' width='1%'></td>
            <td class='text-bold'></td>
            <td class='text-top'></td>
            <td class='text-top'></td>
        </tr>
        <tr>
            <td class='text-top'></td>
            <td class='text-center text-top' width='1%'></td>
            <td class='text-bold'></td>
            <td class='text-top'>di-</td>
            <td class='text-top'></td>
        </tr>
        <tr>
            <td class='text-top'></td>
            <td class='text-center text-top' width='1%'></td>
            <td class='text-bold'></td>
            <td class='text-top'></td>
            <td class='text-top'>SORONG</td>
        </tr>
    </table>
    <br>
    <?php 
        $spk = json_decode($data['DataSpk'],true);
        $pejabat = json_decode($data['DataPejabat'],true);
        $pp = json_decode($spk['DataPP'],true);
        $hps = json_decode($pp['DataHps'],true);
        $vendor = json_decode($pp['DataVendor'],true);
    ?>
    <p class='p1 text-justify'><span class='margin-lfts'>Sehubungan <span> dengan  surat  <span class='text-capital'><?= $vendor['Nama'] ?></span>  tanggal <?= $CI->mylib->tgl_indo($data['TglPermintaan']); ?> perihal tentang permintaan pemeriksaan Hasil Pengadaan Barang/Jasa, dengan ini dimintakan untuk kiranya dapat dilakukan proses penilaian/pemeriksaan dan penerimaan terhadap hasil pekerjaan <span class='text-lower'><?= $hps['Pekerjaan'] ?></span>.</p>
    <p class='p1'>Sebagai bahan pertimbangan, berikut terlampir : </p>
    <ul class='number'>
        <li><span class='margin-lft'>SPK Nomor <?= $spk['NoSpk'] ?> Tanggal <?= $CI->mylib->tgl_indo($spk['Tgl']) ?></span>.</li>
        <li><span class='margin-lft'>Hasil Pekerjaan <?= $hps['Pekerjaan'] ?><span>.</li>
    </ul>
    <p class='p1 text-justify'><span class='margin-lfts'>Selanjutnya<span> hasil pekerjaan Saudara tersebut kiranya dapat dituangkan dalam bentuk Berita Acara Serah Terima Hasil Pekerjaan.</p>
    <p class='p1 text-justify'><span class='margin-lfts'>Demikian</span> disampaikan, atas perhatian dan kerjasamanya diucapkan terima kasih.</p>
    <br>
    <table width='100%'>
        <tr>
            <td width='50%'></td>
            <td class='text-center' width='50%'>
                Pejabat Pembuat Komitmen<br>
                Badan Layanan Umum (BLU)
                <br><br><br><br><br><br><br>
                <u><?= $pejabat['Nama'] ?></u><br>
                <?= $pejabat['Nip'] ?>
                
            </td>
        </tr>
    </table>
    <p class='tembusan'><u>Tembusan:</u><br>Kuasa Pengguna Anggaran Politeknik Pelayaran Sorong</p>
</body>
</html>
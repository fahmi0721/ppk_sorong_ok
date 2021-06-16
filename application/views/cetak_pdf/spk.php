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
    <title>SPK</title>
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
        .img-c{ width:100%; margin-top:10%}
        .text-center { text-align:center; }
        .text-upper { text-transform:uppercase; }
        .size-b{ font-size: 14px }
        #page1{ position:relative;}
        .page-down{ position:absolute;bottom:0;left;0; width:100%; }
        .page_break { page-break-before: always; }

        
    </style>
</head>
<body>
    <div id="page1">
    <div class='img-c'><center><img src="<?= base_url('public/img/logo.png') ?>" align='center' width='20%'></center></div>
    <h2 class='text-center'>SURAT PERINTAH KERJA (SPK)</h2>
    <table width="50%" align='center'>
        <tr>
            <td width='25%'>Nomor</td>
            <td width='3%' align='center'>:</td>
            <td><?= $data['NoSpk'] ?></td>
        </tr>
        <tr>
            <td>Tanggal</td>
            <td align='center'>:</td>
            <td><?= $CI->mylib->tgl_indo($data['Tgl']) ?></td>
        </tr>
    </table>
    <br>
    <br>
    <br>
    <?php 
        $hps = json_decode($data['DataPP'],true);
        $pp = json_decode($data['DataPP'],true);
        $vendor = json_decode($hps['DataVendor'],true);
        $hps = json_decode($hps['DataHps'],true);
        $anggaran = json_decode($hps['DataAnggaran'],true);
        
    ?>
    <p class='text-center'>Tentang</p>
    <h3 class='text-center text-upper'><?= $hps['Pekerjaan'] ?></h3>
    <h3 class='text-center'>SATKER POLITEKNIK PELAYARAN SORONG</h3>
    <h3 class='text-center'>TAHUN ANGGARAN <?= $anggaran['Tahun'] ?></h3>
    <br>
    <br>
    <br>
    <br>
    <p class='text-center'>Oleh</p>
    <br>
    <p class='text-center size-b'><b><?= $vendor['Nama'] ?></b></p>
    <p class='text-center size-b' ><?= $vendor['Alamat'] ?></p>
    <div class='page-down'>
        <h1 class='text-center'>SATKER POLITEKNIK PELAYARAN SORONG</h1>
        <h1 class='text-center'>TAHUN ANGGARAN <?= $anggaran['Tahun'] ?></h1>
    </div>
    </div>
    <div class="page_break"></div>
    <table class='table-utama' width='100%' cellpadding='5px' cellspacing='0' border='1'>
        <tr>
            <td rowspan='2' class='text-center' width='30%'>SURAT PERINTAH KERJA<br>(SPK)</td>
            <td colspan='3' width='70%'>SATUAN KERJA : POLITEKNIK PELAYARAN SORONG</td>
        </tr>
        <tr>
            <td colspan='3'>NOMOR & TANGGAL SPK : <?= $data['NoSpk'] ?> Tanggal <?= $CI->mylib->tgl_indo($data['Tgl']) ?></td>
        </tr>
        <tr>
            <td class='text-center'>Nama PPK : </td>
            <td colspan='3'>PPK (BLU) POLITEKNIK PELAYARAN SORONG</td>
        </tr>
        <tr>
            <td class='text-center'>Nama Penyedia : </td>
            <td colspan='3'><?= $vendor['Nama'] ?></td>
        </tr>
        <tr>
            <td rowspan='3' class='text-center'>PAKET PEKERJAAN:<br>
                <?= $hps['Pekerjaan'] ?>
            </td>
            <td colspan='3'>NOMOR SURAT UNDANGAN PENGADAAN LANGSUNG: <?= $data['NoSuratUndangan'] ?><br><br>TANGGAL SURAT UNDANGAN PENGADAAN LANGSUNG : <?= $CI->mylib->tgl_indo($data['TglSuratUndangan']) ?></td>
        </tr>
        <tr>
        <td colspan='3'>NOMOR BERITA ACARA HASIL PENGADAAN LANGSUNG: <?= $data['NoBaPl'] ?><br><br>TANGGAL BERITA ACARA HASIL PENGADAAN LANGSUNG: : <?= $CI->mylib->tgl_indo($data['TglBaPl']) ?></td>
        </tr>
       
        <tr>
            <td colspan='3'>SPK ini mulai berlaku efektif terhitung sejak tanggal diterbitkannya SPK dan penyelesaian keseluruhan pekerjaan sebagaimana diatur dalam SPK ini</td>
        </tr>
        <tr>
            <td colspan='4'>SUMBER DANA: Dibebankan atas <?= $anggaran['Nama'] ?> Tahun Anggaran <?= $anggaran['Tahun'] ?> Nomor <?= $anggaran['Nomor'] ?> Tanggal <?= $CI->mylib->tgl_indo($anggaran['Tanggal']) ?> Jangka Waktu Pelaksanaan Pekerjaan: <?= $data['WaktuKerja'] ?>(<?= $CI->mylib->Terbilang($data['WaktuKerja']) ?>) hari kalender, tanggal <?= $CI->mylib->tgl_indo($data['TglDari']) ?> s.d <?= $CI->mylib->tgl_indo($data['TglSampai']) ?></td>
        </tr>
        <tr>
            <td colspan='4'>
                <table width="100%" style="font-size:12px" border='1' cellpadding="4" cellspacing="0">
                    <tr>
                        <th>No</th>
                        <th>Nama Kegiatan</th>
                        <th>Volume</th>
                        <th>Satuan<br>Ukuran</th>
                        <th>Harga Satuan<br>Rp.</th>
                        <th>Total<br>Rp.</th>
                    </tr>
                    <?php

                        $res = json_decode($data['DataItem'],true);
                        if(!empty($res)){
                        $No=0;
                        $dTot =0;
                        foreach($res as $key => $Item){
                            $No++;
                            $Total = $Item['Volume'] * $Item['HargaSatuan'];
                            $dTot = $dTot + $Total;
                    ?>
                    <tr>
                        <td align="center"><?= $No; ?></td>
                        <td><?= $Item['NamaKegiatan'] ?></td>
                        <td align="center"><?= $Item['Volume'] ?></td>
                        <td align="center"><?= $Item['SatuanUkuran'] ?></td>
                        <td>Rp. <?= $CI->mylib->rupiah1($Item['HargaSatuan']); ?></td>
                        <td>Rp. <?= $CI->mylib->rupiah1($Total); ?></td>
                    </tr>
                    <?php } } ?>
                    <tr>
                        <th colspan='5' align="right">JUMLAH</th>
                        <th>Rp. <?= $CI->mylib->rupiah1($dTot); ?></th>
                    </tr>
                    <tr>
                        <th colspan='5' align="right">PEMBULATAN</th>
                        <th>Rp. <?= $CI->mylib->rupiah1($data['Pembulatan']); ?></th>
                    </tr>
                    <tr>
                        <th colspan='5' align="right">PPN</th>
                        <th>Rp. <?= $CI->mylib->rupiah1($data['Ppn']); ?></th>
                    </tr>
                    <tr>
                        <th colspan='5' align="right">Nilai Kontrak</th>
                        <th>Rp. <?= $CI->mylib->rupiah1($data['NilaiKontrak']); ?></th>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <th align='justify' colspan='4'>TERBILANG : <?= $CI->mylib->terbilang($data['NilaiKontrak']); ?></th>
        </tr>
        
        <tr>
            <td colspan='4'>INSTRUKSI KEPADA PENYEDIA: Penagihan hanya dapat dilakukan setelah penyelesaian pekerjaan yang diperintahkan dalam SPK ini dan dibuktikan dengan Berita Acara Serah Terima. Jika pekerjaan tidak dapat diselesaikan dalam jangka waktu pelaksanaan pekerjaan karena kesalahan atau kelalaian Penyedia maka Penyedia berkewajiban untuk membayar denda kepada PPK sebesar 1/1000 (satu per seribu) dari nilai SPK atau nilai bagian SPK untuk setiap hari keterlambatan.</td>
        </tr>
        <tr>
            <td colspan='2' valign='top' class='text-center'>Untuk dan atas nama <br>Politeknik Pelayaran Sorong <br>Pejabat Pembuat Komitmen<br>Badan Layanan Umum (BLU)
                <br><br><br><br><br>
                <?php 
                    $pejabat = json_decode($data['DataPejabat'],true);
                ?>
                <u><?= $pejabat['Nama'] ?></u><br>
                NIP. <?= $pejabat['Nip'] ?>
            </td>
            <td colspan='2' valign='top' class='text-center'>Untuk dan atas nama Penyedia<br><?= $vendor['Nama'] ?>
                <br><br><br><br><br><br><br>
                <u><?= $vendor['NamaPimpinan'] ?></u><br>
                <?= $vendor['Jabatan'] ?>
            </td>
        </tr>
        
    </table>
</body>
</html>
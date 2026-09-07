<?php
//masukkan library DomPDF
require_once 'vendor/autoload.php';
use dompdf\dompdf;
use dompdf\Options;

//instansiasi objek dompdf
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    //ambil data dari form html
    $nama             = htmlspecialchars($_POST['nama']);
    $nis              = htmlspecialchars($_POST['nis']);
    $kelas            = htmlspecialchars($_POST['kelas']);
    $alasan           = htmlspecialchars($_POST['alasan']);
    $tgl_mulai        = date('d F Y', strtotime($_POST['tgl_mulai']));
    $tgl_selesai      = date('d F Y', strtotime($_POST['tgl_selesai']));
    $keterangan       = htmlspecialchars($_POST['keterangan']);
    $tgl_sekarang     = date('d F Y');




//template halaman pdf
 $html = ' 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>cetak surat</title>
    <style>
        body{
            font-family:"times new roman";
            font-size: 12pt;
            margin: 20px;
        }
        .kop{
            font-family:"century gothic";
            text-align: center;
            border-bottom: 3px double #000;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        . kop p{
            margin: 2px;
            font-size: 10pt;
        }
        . title{
            text-align: center;
            font-weight: bold;
            text-decoration: underline;
            margin-bottom: 25px;
        }
        content{
            line-height: 1.6;
            text-align: justify;
        }
        .table-data{
            margin: 15px 0 15px 30px;
            width: 100%;
        }
        .table-data td{
            padding: 4px 0;
            vertical-align: top;
        }
        . tdd-container{
            width: 100%;
            margin-top: 50px;
        }
        .tdd-box{
            float: righr;
            widht: 200px;
            text-align: center;
        }
      </style>
</head>
<body>
  <div class="kop">
    <h2>SMK TEXMACO SEMARANG</h2>
    <P>Jl. raya mangkang kulon | telp:(024) 223-888</P>
  </div>  
  <div class="title"> SURAT IZIN MENINGGALKAN KELAS</div>

  <div class="content">
    <p>yang bertanda tanggan di bawah ini</p>
    <table class="table-data">
        <tr>
            <td width="130">nama</td>
            <td widht="15">:</td>
            <td><b>' .$nama . '</b></td>
        </tr>
        <tr>
            <td  width="130">NIS</td>
            <td> :</td>
            <td>' . $nis . '</td>
        <tr>
            <td>kelas</td>
            <td>' . $kelas .'</td>
        </tr> 
</table>
 <p>Bermaksud unutk mengajukan izin meninggalkan kelas,
    pada tanggal <b>' . $tgl_mulai .'</b>
    sampai dengan <b>' . $tgl_selesai .'</b>
    dikarenakan <b>' . $alasan .'</b>
 </p>
 ' .($keterangan ? '<p>detail keterangan: '
    . $keterangan . '</p>' : '').'
   <p>demikian surat pengajuan izin ini saya buat.
    atas perhatian dan pengertian bapak/ibu,
    saya ucapkan terimakasih.
   </p>  
   </div>
   <div class="ttd-coontainer">
    <div class="ttd-box">
        <p>semarang, '. $tgl_sekarang .'<br>hormat saya,</p>
        <br><br><br>
        <p><b>('. $nama .')</b></p>


    </div>

   </div>       
</body>
</html>

';

// 3. konfigurisari dan inisialisasi dompdf
$options = new Options();
$options ->set('isRemoteEnabled', true); //memungkinkan load gambar eksternal jika ada 
$dompdf = new dompdf($options);

// 4. render HTML ke PDF 
$dompdf->loadhtml('$html');
$dompdf->setpaper('A4', 'portrait');
$dompdf->render();

// 5. stream PDF ke browser 
$dompdf->stream("surat_izin_" . str_replace(' ','_',$nama) . "pdf", ["attachment" => false]);
}
?>
<?php
include('koneksi2.php');
require_once("dompdf/autoload.inc.php");//menginclude file autoload.inc.php yang berada di folder dompdf
use Dompdf\Dompdf;//menggunakan namespace Dompdf
$dompdf = new Dompdf();// membuat object dompdf 
//menuliskan perintah query 
$query = mysqli_query($con, "SELECT peserta_didik.jenispendaf, peserta_didik.tglmasuk, peserta_didik.nis, peserta_didik.nopeserta, peserta_didik.paud, 
peserta_didik.tk,peserta_didik.noskhun, peserta_didik.noijasah, peserta_didik.hobi,peserta_didik.citacita,
data_pribadi.nama, data_pribadi.jeniskelamin,  data_pribadi.nisn, data_pribadi.nik, data_pribadi.tempallahir 
FROM peserta_didik
JOIN data_pribadi ON peserta_didik.id_pribadi= data_pribadi.id_pribadi");
$html = '<center><h3>Data Pendaftaran Siswa</h3></center><hr/><br/>';
//membuat judul tabel serta header tabel
$html .= '<table border="1" width="10">
<tr>
<th>No</th>
<th>Jenis Pendaftaran</th>
<th>Tanggal Masuk</th>
<th>Nis</th>
<th>No Peserta</th>
<th>Paud</th>
<th>TK</th>
<th>No. SKHUN</th>
<th>No. Ijasah</th>
<th>Hobi</th>
<th>Cita-Cita</th>
<th>Nama</th>
<th>Jenis Kelamin</th>
<th>NISN</th>
<th>NIK</th>
<th>Tempat Lahir</th>
</tr>
';

$no = 1;//untuk memberi nomor urut
while($row = mysqli_fetch_array($query))
{//extract data di variabel $query menggunakan perintah while
    $html .="<tr>
    <td>".$no."</td>
    <td>".$row['jenispendaf']."</td>
    <td>".$row['tglmasuk']."</td>
    <td>".$row['nis']."</td>
    <td>".$row['nopeserta']."</td>
    <td>".$row['paud']."</td>
    <td>".$row['tk']."</td>
    <td>".$row['noskhun']."</td>
    <td>".$row['noijasah']."</td>
    <td>".$row['hobi']."</td>
    <td>".$row['citacita']."</td>
    <td>".$row['nama']."</td>
    <td>".$row['jeniskelamin']."</td>
    <td>".$row['nisn']."</td>
    <td>".$row['nik']."</td>
    <td>".$row['tempallahir']."</td>
    </tr>";
    $no++;
}

$html .= "</html>";//memberikan tutup html
$dompdf->loadHtml($html);//melakukan konversi dari code html
//setting ukuran dan orientasu kerta
$dompdf->setPaper('A4','landscape');
//rendering dari HTML ke PDF
$dompdf->render();
//melakukan outpu file pdf
$dompdf->stream('laporan_pendaftaran.pdf');
?>
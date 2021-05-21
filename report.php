<?php
include('koneksi.php');
require_once("dompdf/autoload.inc.php");//menginclude file autoload.inc.php yang berada di folder dompdf
use Dompdf\Dompdf;//menggunakan namespace Dompdf
$dompdf = new Dompdf();// membuat object dompdf 
$query = mysqli_query($con, "SELECT * FROM tb_siswa");//menuliskan perintah query 
$html = '<center><h3>Daftar Nama Siswa</h3></center><hr/><br/>';
//membuat judul tabel serta header tabel
$html .= '<table border="1" width="10">
<tr>
<th>No</th>
<th>Nama</th>
<th>Kelas</th>
<th>Alamat</th>
</tr>';

$no = 1;//untuk memberi nomor urut
while($row = mysqli_fetch_array($query))
{//extract data di variabel $query menggunakan perintah while
    $html .="<tr>
    <td>".$no."</td>
    <td>".$row['nama']."</td>
    <td>".$row['kelas']."</td>
    <td>".$row['alamat']."</td>
    </tr>";
    $no++;
}
$html .= "</html>";//memberikan tutup html
$dompdf->loadHtml($html);//melakukan konversi dari code html
//setting ukuran dan orientasu kerta
$dompdf->setPaper('A4','potrait');
//rendering dari HTML ke PDF
$dompdf->render();
//melakukan outpu file pdf
$dompdf->stream('laporan_siswa.pdf');
?>
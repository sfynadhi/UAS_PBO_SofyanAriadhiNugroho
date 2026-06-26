<?php

require_once "config/Koneksi.php";
require_once "model/Mahasiswa.php";
require_once "model/MahasiswaMandiri.php";
require_once "model/MahasiswaBidikmisi.php";
require_once "model/MahasiswaPrestasi.php";

$db = new Koneksi();
$conn = $db->getConnection();

$query = mysqli_query($conn, "SELECT * FROM tabel_pendaftaran ORDER BY jenis_pembayaran,nama_mahasiswa");

$mandiri = [];
$bidikmisi = [];
$prestasi = [];

while($row = mysqli_fetch_assoc($query)){

    switch($row['jenis_pembayaran']){

        case 'Mandiri':

            $mandiri[] = new MahasiswaMandiri(
                $row['id_mahasiswa'],
                $row['nama_mahasiswa'],
                $row['nim'],
                $row['semester'],
                $row['tarif_ukt_nominal'],
                $row['golongan_ukt'],
                $row['nama_wali']
            );

        break;

        case 'Bidikmisi':

            $bidikmisi[] = new MahasiswaBidikmisi(
                $row['id_mahasiswa'],
                $row['nama_mahasiswa'],
                $row['nim'],
                $row['semester'],
                $row['tarif_ukt_nominal'],
                $row['nomor_kip_kuliah'],
                $row['dana_saku_subsidi']
            );

        break;

        case 'Prestasi':

            $prestasi[] = new MahasiswaPrestasi(
                $row['id_mahasiswa'],
                $row['nama_mahasiswa'],
                $row['nim'],
                $row['semester'],
                $row['tarif_ukt_nominal'],
                $row['nama_instansi_beasiswa'],
                $row['minimal_ipk_syarat']
            );

        break;

    }

}

?>

<!DOCTYPE html>
<html>
<head>

<title>Dashboard Registrasi Pembayaran Kuliah</title>

<style>

body{
    font-family:Arial;
    background:#f4f4f4;
    margin:30px;
}

h1{
    text-align:center;
}

.card{
    display:inline-block;
    width:30%;
    background:white;
    padding:20px;
    text-align:center;
    border-radius:8px;
    margin:5px;
    box-shadow:0 0 5px gray;
}

table{

    width:100%;
    border-collapse:collapse;
    margin-bottom:40px;
    background:white;

}

th,td{

    border:1px solid #ccc;
    padding:10px;

}

th{

    background:#0d6efd;
    color:white;

}

h2{

    background:#0d6efd;
    color:white;
    padding:10px;

}

</style>

</head>

<body>

<h1>DASHBOARD REGISTRASI PEMBAYARAN KULIAH</h1>

<div class="card">
<h3>Total Mahasiswa</h3>
<h2><?= count($mandiri)+count($bidikmisi)+count($prestasi); ?></h2>
</div>

<div class="card">
<h3>Mandiri</h3>
<h2><?= count($mandiri); ?></h2>
</div>

<div class="card">
<h3>Bidikmisi + Prestasi</h3>
<h2><?= count($bidikmisi)+count($prestasi); ?></h2>
</div>

<br><br>

<h2>Mahasiswa Mandiri</h2>

<table>

<tr>

<th>Nama</th>
<th>NIM</th>
<th>Semester</th>
<th>Golongan UKT</th>
<th>Nama Wali</th>
<th>Total Tagihan</th>

</tr>

<?php foreach($mandiri as $mhs){ ?>

<tr>

<td><?= $mhs->getNamaMahasiswa(); ?></td>
<td><?= $mhs->getNim(); ?></td>
<td><?= $mhs->getSemester(); ?></td>
<td><?= $mhs->getGolonganUkt(); ?></td>
<td><?= $mhs->getNamaWali(); ?></td>
<td>Rp <?= number_format($mhs->hitungTagihanSemester(),0,",","."); ?></td>

</tr>

<?php } ?>

</table>

<h2>Mahasiswa Bidikmisi</h2>

<table>

<tr>

<th>Nama</th>
<th>NIM</th>
<th>Semester</th>
<th>Nomor KIP</th>
<th>Dana Saku</th>
<th>Total Tagihan</th>

</tr>

<?php foreach($bidikmisi as $mhs){ ?>

<tr>

<td><?= $mhs->getNamaMahasiswa(); ?></td>
<td><?= $mhs->getNim(); ?></td>
<td><?= $mhs->getSemester(); ?></td>
<td><?= $mhs->getNomorKipKuliah(); ?></td>
<td>Rp <?= number_format($mhs->getDanaSakuSubsidi(),0,",","."); ?></td>
<td>Rp <?= number_format($mhs->hitungTagihanSemester(),0,",","."); ?></td>

</tr>

<?php } ?>

</table>

<h2>Mahasiswa Prestasi</h2>

<table>

<tr>

<th>Nama</th>
<th>NIM</th>
<th>Semester</th>
<th>Instansi</th>
<th>Minimal IPK</th>
<th>Total Tagihan</th>

</tr>

<?php foreach($prestasi as $mhs){ ?>

<tr>

<td><?= $mhs->getNamaMahasiswa(); ?></td>
<td><?= $mhs->getNim(); ?></td>
<td><?= $mhs->getSemester(); ?></td>
<td><?= $mhs->getNamaInstansiBeasiswa(); ?></td>
<td><?= $mhs->getMinimalIpkSyarat(); ?></td>
<td>Rp <?= number_format($mhs->hitungTagihanSemester(),0,",","."); ?></td>

</tr>

<?php } ?>

</table>

</body>
</html>
<?php

require_once "model/Mahasiswa.php";
require_once "model/MahasiswaMandiri.php";
require_once "model/MahasiswaBidikmisi.php";
require_once "model/MahasiswaPrestasi.php";

$dataMahasiswa = [

    new MahasiswaMandiri(
        1,
        "Ahmad Fauzi",
        "231001",
        4,
        4500000,
        "UKT 4",
        "Slamet Riyadi"
    ),

    new MahasiswaBidikmisi(
        2,
        "Intan Permata",
        "231002",
        2,
        4000000,
        "KIP001",
        700000
    ),

    new MahasiswaPrestasi(
        3,
        "Olivia Putri",
        "231003",
        6,
        5000000,
        "Bank Indonesia",
        3.50
    )

];

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Implementasi Inheritance & Polymorphism</title>

    <style>
        body{
            font-family: Arial, sans-serif;
            background:#f4f4f4;
        }

        table{
            width:90%;
            margin:auto;
            border-collapse:collapse;
            background:white;
        }

        h2{
            text-align:center;
        }

        th,td{
            border:1px solid #ccc;
            padding:10px;
        }

        th{
            background:#0d6efd;
            color:white;
        }
    </style>
</head>
<body>

<h2>Data Mahasiswa</h2>

<table>

<tr>
    <th>No</th>
    <th>Nama</th>
    <th>NIM</th>
    <th>Semester</th>
    <th>Spesifikasi Akademik</th>
    <th>Total Tagihan</th>
</tr>

<?php

$no = 1;

foreach($dataMahasiswa as $mhs){

?>

<tr>

<td><?= $no++ ?></td>

<td><?= $mhs->getNamaMahasiswa(); ?></td>

<td><?= $mhs->getNim(); ?></td>

<td><?= $mhs->getSemester(); ?></td>

<td><?= $mhs->tampilkanSpesifikasiAkademik(); ?></td>

<td>
Rp <?= number_format($mhs->hitungTagihanSemester(),0,",","."); ?>
</td>

</tr>

<?php

}

?>

</table>

</body>
</html>
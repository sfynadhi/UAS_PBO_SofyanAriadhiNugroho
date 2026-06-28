<?php

require_once "Koneksi.php";
require_once "Mahasiswa.php";
require_once "MahasiswaMandiri.php";
require_once "MahasiswaBidikmisi.php";
require_once "MahasiswaPrestasi.php";

$db = new Koneksi();
$conn = $db->getConnection();

$query = mysqli_query($conn, "SELECT * FROM tabel_pendaftaran ORDER BY jenis_pembayaran, nama_mahasiswa");

if (!$query) {
    die(mysqli_error($conn));
}
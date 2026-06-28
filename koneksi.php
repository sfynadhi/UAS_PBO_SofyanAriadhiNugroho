<?php

class Koneksi
{
    private $host = "localhost";
    private $user = "root";
    private $password = "";
    private $database = "db_uas_pbo_trpl1a_sofyanapriadhinugroho";

    private $conn;

    public function __construct()
    {
        $this->conn = mysqli_connect(
            $this->host,
            $this->user,
            $this->password,
            $this->database
        );

        if (!$this->conn) {
            die("Koneksi gagal : " . mysqli_connect_error());
        }

        mysqli_set_charset($this->conn, "utf8");
    }

    public function getConnection()
    {
        return $this->conn;
    }
}
<?php

class Koneksi
{
    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $database = "db_uas_pbo_trpl1a_sofyanapriadhinugroho";

    private $conn;

    public function __construct()
    {
        $this->conn = mysqli_connect(
            $this->host,
            $this->username,
            $this->password,
            $this->database
        );

        if (!$this->conn) {
            die("Koneksi Database Gagal : " . mysqli_connect_error());
        }
    }

    public function getConnection()
    {
        return $this->conn;
    }
}

?>
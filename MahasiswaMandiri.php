<?php

require_once "Mahasiswa.php";

class MahasiswaMandiri extends Mahasiswa
{
    private $golonganUkt;
    private $namaWali;

    public function __construct(
        $id_mahasiswa,
        $nama_mahasiswa,
        $nim,
        $semester,
        $tarif_ukt_nominal,
        $golonganUkt,
        $namaWali
    ){
        parent::__construct(
            $id_mahasiswa,
            $nama_mahasiswa,
            $nim,
            $semester,
            $tarif_ukt_nominal
        );

        $this->golonganUkt = $golonganUkt;
        $this->namaWali = $namaWali;
    }

    public function getGolonganUkt()
    {
        return $this->golonganUkt;
    }

    public function getNamaWali()
    {
        return $this->namaWali;
    }

    public function setGolonganUkt($golonganUkt)
    {
        $this->golonganUkt = $golonganUkt;
    }

    public function setNamaWali($namaWali)
    {
        $this->namaWali = $namaWali;
    }

    // Polimorfisme
    public function hitungTagihanSemester()
    {
        return $this->getTarifUktNominal() + 100000;
    }

    public function tampilkanSpesifikasiAkademik()
    {
        return "Golongan UKT : ".$this->golonganUkt.
               "<br>Nama Wali : ".$this->namaWali;
    }
}

?>
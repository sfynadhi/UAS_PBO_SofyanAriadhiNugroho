<?php

require_once "Mahasiswa.php";

class MahasiswaPrestasi extends Mahasiswa
{
    private $namaInstansiBeasiswa;
    private $minimalIpkSyarat;

    public function __construct(
        $id_mahasiswa,
        $nama_mahasiswa,
        $nim,
        $semester,
        $tarif_ukt_nominal,
        $namaInstansiBeasiswa,
        $minimalIpkSyarat
    ){
        parent::__construct(
            $id_mahasiswa,
            $nama_mahasiswa,
            $nim,
            $semester,
            $tarif_ukt_nominal
        );

        $this->namaInstansiBeasiswa = $namaInstansiBeasiswa;
        $this->minimalIpkSyarat = $minimalIpkSyarat;
    }

    public function getNamaInstansiBeasiswa()
    {
        return $this->namaInstansiBeasiswa;
    }

    public function getMinimalIpkSyarat()
    {
        return $this->minimalIpkSyarat;
    }

    public function setNamaInstansiBeasiswa($namaInstansiBeasiswa)
    {
        $this->namaInstansiBeasiswa = $namaInstansiBeasiswa;
    }

    public function setMinimalIpkSyarat($minimalIpkSyarat)
    {
        $this->minimalIpkSyarat = $minimalIpkSyarat;
    }

    // Polimorfisme
    public function hitungTagihanSemester()
    {
        return $this->getTarifUktNominal() * 0.25;
    }

    public function tampilkanSpesifikasiAkademik()
    {
        return "Instansi Beasiswa : ".$this->namaInstansiBeasiswa.
               "<br>Minimal IPK : ".$this->minimalIpkSyarat;
    }
}

?>
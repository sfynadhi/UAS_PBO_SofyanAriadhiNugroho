<?php

abstract class Mahasiswa
{
    // Enkapsulasi (private)
    private $id_mahasiswa;
    private $nama_mahasiswa;
    private $nim;
    private $semester;
    private $tarif_ukt_nominal;

    // Constructor
    public function __construct($id_mahasiswa, $nama_mahasiswa, $nim, $semester, $tarif_ukt_nominal)
    {
        $this->id_mahasiswa = $id_mahasiswa;
        $this->nama_mahasiswa = $nama_mahasiswa;
        $this->nim = $nim;
        $this->semester = $semester;
        $this->tarif_ukt_nominal = $tarif_ukt_nominal;
    }

    // Getter
    public function getIdMahasiswa()
    {
        return $this->id_mahasiswa;
    }

    public function getNamaMahasiswa()
    {
        return $this->nama_mahasiswa;
    }

    public function getNim()
    {
        return $this->nim;
    }

    public function getSemester()
    {
        return $this->semester;
    }

    public function getTarifUktNominal()
    {
        return $this->tarif_ukt_nominal;
    }

    // Setter
    public function setIdMahasiswa($id_mahasiswa)
    {
        $this->id_mahasiswa = $id_mahasiswa;
    }

    public function setNamaMahasiswa($nama_mahasiswa)
    {
        $this->nama_mahasiswa = $nama_mahasiswa;
    }

    public function setNim($nim)
    {
        $this->nim = $nim;
    }

    public function setSemester($semester)
    {
        $this->semester = $semester;
    }

    public function setTarifUktNominal($tarif_ukt_nominal)
    {
        $this->tarif_ukt_nominal = $tarif_ukt_nominal;
    }

    // Method abstrak
    abstract public function hitungTagihanSemester();

    abstract public function tampilkanSpesifikasiAkademik();
}

?>
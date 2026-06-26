<?php

require_once "Mahasiswa.php";

class MahasiswaBidikmisi extends Mahasiswa
{
    private $nomorKipKuliah;
    private $danaSakuSubsidi;

    public function __construct(
        $id_mahasiswa,
        $nama_mahasiswa,
        $nim,
        $semester,
        $tarif_ukt_nominal,
        $nomorKipKuliah,
        $danaSakuSubsidi
    ){
        parent::__construct(
            $id_mahasiswa,
            $nama_mahasiswa,
            $nim,
            $semester,
            $tarif_ukt_nominal
        );

        $this->nomorKipKuliah = $nomorKipKuliah;
        $this->danaSakuSubsidi = $danaSakuSubsidi;
    }

    public function getNomorKipKuliah()
    {
        return $this->nomorKipKuliah;
    }

    public function getDanaSakuSubsidi()
    {
        return $this->danaSakuSubsidi;
    }

    public function setNomorKipKuliah($nomorKipKuliah)
    {
        $this->nomorKipKuliah = $nomorKipKuliah;
    }

    public function setDanaSakuSubsidi($danaSakuSubsidi)
    {
        $this->danaSakuSubsidi = $danaSakuSubsidi;
    }

    public function hitungTagihanSemester()
    {
        return 0;
    }

    public function tampilkanSpesifikasiAkademik()
    {
        return "Nomor KIP Kuliah : ".$this->nomorKipKuliah.
               "<br>Dana Saku Subsidi : Rp ".number_format($this->danaSakuSubsidi,0,",",".");
    }
}

?>a
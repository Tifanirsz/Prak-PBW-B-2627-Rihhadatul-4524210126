<?php
include "models/MahasiswaModel.php";
class MahasiswaController {
    private $model;
    public function __construct($koneksi) {
        $this->model = new MahasiswaModel($koneksi);
    }
    public function index() {
        $dataMahasiswa = $this->model->getAllmahasiswa();
        include "views/mahasiswa/index.php";
    }
}
?>
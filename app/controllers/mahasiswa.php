<?php

class Mahasiswa extends Controller
{

    public function index() //method default atau tampilan default
    {

        $data['judul'] = 'Daftar Mahasiswa';
        $data['mhs'] = $this->model('Mahasiswa_model')->getALLMahasiswa();
        $this->view('templates/header', $data);
        $this->view('mahasiswa/index', $data);
        $this->view('templates/footer');
    }

    public function detail($id) //method detail atau tampilan detail
    {

        $data['judul'] = 'Detail Mahasiswa';
        $data['mhs'] = $this->model('Mahasiswa_model')->getMahasiswaById($id);
        $this->view('templates/header', $data);
        $this->view('mahasiswa/detail', $data);
        $this->view('templates/footer');
    }

    public function tambah()
    {
        //cara mengelola data yang sudah di tambahkan
        //pengelolaan dalam folder model di file mahasiswa_model.php
        if ($this->model('Mahasiswa_model')->tambahDataMahasiswa($_POST) > 0) //post > 0 adalah jika ada data yang masuk maka pindahkan ke lokasi dibawah
        {
            Flasher::setFlash('Berhasil', 'Di Tambahkan', 'success');
            header('Location: ' . BASEURL . '/mahasiswa'); //jika ada data di arahkan ke halaman mahasiswa
            exit;
        } else {
            Flasher::setFlash('gagal', 'Di Tambahkan', 'danger');
            header('Location: ' . BASEURL . '/mahasiswa'); //jika ada data di arahkan ke halaman mahasiswa
            exit;
        }
    }


    public function hapus($id)
    {
        //cara menghapus data by id
        if ($this->model('Mahasiswa_model')->hapusDataMahasiswa($id) > 0) //post > 0 adalah jika ada data yang masuk maka pindahkan ke lokasi dibawah
        {
            Flasher::setFlash('Berhasil', 'Dihapus', 'success');
            header('Location: ' . BASEURL . '/mahasiswa'); //jika ada data di arahkan ke halaman mahasiswa
            exit;
        } else {
            Flasher::setFlash('gagal', 'Dihapus', 'danger');
            header('Location: ' . BASEURL . '/mahasiswa'); //jika ada data di arahkan ke halaman mahasiswa
            exit;
        }
    }


    public function getubah()
    {
        //agar datanya berubah menjadi json dari array assosiatif
        echo json_encode($this->model('Mahasiswa_model')->getMahasiswaById($_POST['id']));
    }

    public function ubah()
    {
        if ($this->model('Mahasiswa_model')->ubahDataMahasiswa($_POST) > 0) //post > 0 adalah jika ada data yang masuk maka pindahkan ke lokasi dibawah
        {
            Flasher::setFlash('Berhasil', 'Di Edit', 'success');
            header('Location: ' . BASEURL . '/mahasiswa'); //jika ada data di arahkan ke halaman mahasiswa
            exit;
        } else {
            Flasher::setFlash('gagal', 'di Edit', 'danger');
            header('Location: ' . BASEURL . '/mahasiswa'); //jika ada data di arahkan ke halaman mahasiswa
            exit;
        }
    }


    //fungsi cari
    public function cari()
    {
        $data['judul'] = 'Daftar Mahasiswa';
        $data['mhs'] = $this->model('Mahasiswa_model')->cariDataMahasiswa();
        $this->view('templates/header', $data);
        $this->view('mahasiswa/index', $data);
        $this->view('templates/footer');
    }
}

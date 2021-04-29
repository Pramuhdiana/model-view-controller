<?php

class Mahasiswa_model
{
    private $table = 'mahasiswa';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    //cara eksekusinya
    public function getALLMahasiswa()
    {
        $this->db->query('SELECT * FROM ' . $this->table);
        return $this->db->resultSet();
    }

    public function getMahasiswaById($id)
    {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE id=:id');
        $this->db->bind('id', $id);
        return $this->db->single();
    }

    public function tambahDataMahasiswa($data) //menangkap $_POST disimopan di variabel $data
    {
        $query = "INSERT INTO mahasiswa 
        VALUES 
        ('', :nama, :nrp, :email, :jurusan)"; //harus sesuai tabel di database

        $this->db->query($query); //menjalankan querynya
        //cara bind
        $this->db->bind('nama', $data['nama']); //nama yang di dalam kurung data adalah name pada tabel form nama
        $this->db->bind('nrp', $data['nrp']); //nama yang di dalam kurung data adalah name pada tabel form nrp
        $this->db->bind('email', $data['email']); //nama yang di dalam kurung data adalah name pada tabel form email
        $this->db->bind('jurusan', $data['jurusan']); //nama yang di dalam kurung data adalah name pada tabel form jurusan

        //eksekusinya
        $this->db->execute();

        return $this->db->rowCount(); //jika berhasil menambahkan data akan menghasilkan angka 1
    }

    public function hapusDataMahasiswa($id)
    {
        $query = "DELETE FROM mahasiswa WHERE id = :id"; //mengkoneksikan ke database mahasiswa
        $this->db->query($query); //mengkoneksikan ke database yang sudah di simpan di Database.php
        $this->db->bind('id', $id); //binding datanya

        //eksekusinya
        $this->db->execute();
        return $this->db->rowCount();
    }

    // fungsi mengubah data
    public function ubahDataMahasiswa($data) //menangkap $_POST disimpan di variabel $data
    {
        $query = "UPDATE mahasiswa 
        SET 
        nama = :nama,
        nrp = :nrp,
        email = :email,
        jurusan = :jurusan
        WHERE id = :id";

        $this->db->query($query); //menjalankan querynya
        //cara bind
        $this->db->bind('nama', $data['nama']); //nama yang di dalam kurung data adalah name pada tabel form nama
        $this->db->bind('nrp', $data['nrp']); //nama yang di dalam kurung data adalah name pada tabel form nrp
        $this->db->bind('email', $data['email']); //nama yang di dalam kurung data adalah name pada tabel form email
        $this->db->bind('jurusan', $data['jurusan']); //nama yang di dalam kurung data adalah name pada tabel form jurusan
        $this->db->bind('id', $data['id']); //nama yang di dalam kurung data adalah name pada tabel form id

        //eksekusinya
        $this->db->execute();

        return $this->db->rowCount(); //jika berhasil menambahkan data akan menghasilkan angka 1
    }


    public function cariDataMahasiswa()
    {
        $keyword = $_POST['keyword'];
        $query = "SELECT * FROM mahasiswa WHERE nama LIKE :keyword";
        $this->db->query($query);
        $this->db->bind('keyword', "%$keyword%");
        return $this->db->resultSet();
    }
}

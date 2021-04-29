<?php
class Home extends Controller
{
    public function index()
    {
        $data['judul'] = 'Home'; //menyimpan judul yang ada di home ke variabel
        $data['nama'] = $this->model('User_model')->getUser();
        $this->view('templates/header', $data); //memanggil template header.php
        //isinya alamat yang ingin di akses
        $this->view('home/index', $data); //cara memanggil view method
        $this->view('templates/footer'); //memanggil template footer.php
    }
}

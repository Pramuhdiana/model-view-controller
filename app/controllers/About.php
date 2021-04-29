<?php
class About extends Controller
{
    public function index($nama = "sandy", $hobi = "web develop", $umur = 25) //sebagai method default
    { //defaultnya
        $data['nama'] = $nama;
        $data['hobi'] = $hobi;
        $data['umur'] = $umur;
        $data['judul'] = 'About Me';
        $this->view('templates/header', $data);
        $this->view('about/index', $data);
        $this->view('templates/footer');
    }
    public function page()
    {
        $data['judul'] = 'Pages'; // mengirim data judul ke header untuk method page
        $this->view('templates/header', $data); //cara menampilkannya
        $this->view('about/page');
        $this->view('templates/footer');
    }
}

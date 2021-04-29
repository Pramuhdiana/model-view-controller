<?php
class App
{
    protected $controller = 'Home';
    protected $method = 'index';
    protected $params = [];

    public function __construct()
    {
        $url = $this->parseURL();
        //jika url tidak di isi atau null maka panggil controler default
        if ($url == null) {
            $url = [$this->controller];
        }
        //membuat controllersnya
        //cari sebuah file dalam folder controler sesuai yang di ketik di url gabungkan dengan file .php
        if (file_exists('../app/controllers/' . $url[0] . '.php')) {  //jika file tersebut ada maka tampilkan isi fungsi ini jika tidak ada maka tampilan default
            $this->controller = $url[0]; //menimpa controler yang sudah ada menjadi yang baru
            unset($url[0]); //menghapus agar tidak menjadi string karena sudah menjadi controller
        }
        //memanggil controller yang baru
        require_once '../app/controllers/' . $this->controller . '.php';
        $this->controller = new $this->controller; //cara instansiasi controler agar bisa memanggil method

        //membuat mehtodnya
        if (isset($url[1])) { //jika di url methodnya ada maka buatkan method barunya
            if (method_exists($this->controller, $url[1])) {
                $this->method = $url[1]; //menyimpan methodnya
                unset($url[1]); //jika sudah dibuat method hapu dalam stringnya
            }
        }

        //membuat parameternya
        if (!empty($url)) {
            $this->params = array_values($url); //jika parameter tidak kosong masukan ke variabel porams
        }
        //setelah controller method dan parameter bisa di buat jika ada melalu url
        //lalu cara menjalankan serta mengirimkan parameternya (jika ada)
        call_user_func_array([$this->controller, $this->method], $this->params);
    }
    public function parseURL()
    {
        if (isset($_GET['url'])) { //jika url di isi maka ambil isinya
            //rtrim adalah fungsi untuk menghapus tanda / yang ada di akhri url
            $url = rtrim($_GET['url'], '/'); //menyimpan tulisan di url ke variabel
            $url = filter_var($url, FILTER_SANITIZE_URL); //agar urlnya bersih/aman dari ketikan2 url yang aneh
            $url = explode('/', $url); //fungsi explode untuk memecah agar / tidak di masukan kepada string
            return $url; //mengembalikan url
        }
    }
}

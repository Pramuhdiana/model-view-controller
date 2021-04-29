<?php

class Database
{
    //koneksi databasenya disimpan dalam variabel
    private $host = DB_HOST;
    private $user = DB_USER;
    private $pass = DB_PASS;
    private $db_name = DB_NAME;

    private $dbh;
    private $stmt;

    //cara mengkoneksikannya
    public function __construct()
    {
        $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->db_name; //data source name

        $option = [
            PDO::ATTR_PERSISTENT => true, //agar koneksinya terjaga
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION //pesan bila eror
        ];

        try {
            $this->dbh = new PDO($dsn, $this->user, $this->pass, $option);
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function query($query)
    {
        $this->stmt = $this->dbh->prepare($query);
    }

    public function bind($param, $value, $type = null)
    {
        if (is_null($type)) {
            switch (true) {
                case is_int($value): //jika value int maka type int
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
                default:   //jika kondisi di atas tida terpenuhi maka
                    $type = PDO::PARAM_STR; //type di isi dengan string
            }
        }
        $this->stmt->bindValue($param, $value, $type);
    }

    //cara mengeksekusinya

    public function execute()
    {
        $this->stmt->execute();
    }

    public function resultSet() //untuk menampilkan semua
    {
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_ASSOC); //jika datanya ingin di tampilkan semua
    }

    public function single() //untuk menampilkan single(satu)
    {
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_ASSOC); //jika datanya ingin di tampikan 1
    }

    public function rowCount() //untuk menghitung berapa baris
    {
        return $this->stmt->rowCount(); //rowCount milik PDO
    }
}
